<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin;

use App\Enum\EventNames;
use App\Enum\LivewireQueryString;
use App\Enum\OrderByCriteria;
use App\Enum\TableFilters;
use App\Exports\AdminLogsExport;
use App\Http\Livewire\Base\BaseComponent;
use App\Managers\AdminLogManager;
use App\Managers\UserManager;
use App\Services\SessionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminLogCrud extends BaseComponent
{
    protected $queryString = [
        LivewireQueryString::NAME_SEARCH => ['except' => TableFilters::VALUE_NULL_STRING],
        LivewireQueryString::NAME_FILTER_TYPE => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_FILTER_USER => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_FILTER_TABLE => ['except' => TableFilters::VALUE_ALL],
        LivewireQueryString::NAME_PER_PAGE => ['except' => TableFilters::PER_PAGE_DEFAULT_VALUE],
        LivewireQueryString::NAME_ORDER_BY => ['except' => OrderByCriteria::ORDER_BY_ID_DESC],
    ];

    private AdminLogManager $adminLogManager;

    private UserManager $userManager;

    private SessionService $sessionService;

    private string $tableName = 'admin_logs';

    private LengthAwarePaginator $data;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function boot(
        AdminLogManager $adminLogManager,
        UserManager $userManager,
        SessionService $sessionService
    ): void {
        $this->adminLogManager = $adminLogManager;
        $this->userManager = $userManager;
        $this->sessionService = $sessionService;

        $this->tableInfo = $this->getTableInfoByTableName($this->tableName);
        $this->optionProperties = $this->sessionService->getOptionPropertiesByTableName($this->tableName);
        $this->filterProperties = $this->sessionService->getFilterPropertiesByTableName($this->tableName);
        $this->initializeOptions($this->tableName);
        $this->initializeFilters();
    }

    public function render()
    {
        $this->setPropertiesInSession($this->filterProperties, $this->tableName);
        $this->setPropertiesInSession($this->optionProperties, $this->tableName);

        $this->data = $this->getData();
        $this->checkCurrentPage();
        $this->setIsCheckAllSelector();

        return view('admin.admin_logs', [
            'data' => $this->data,
            'selectedData' => $this->getSelectedData(),
        ])->layout('adminlte::page');
    }

    public function view($id): void
    {
        $this->regView = $this->adminLogManager->findOneById($id);
        $this->dispatchEvent(EventNames::NAME_OPEN_VIEW_MODAL);
    }

    public function destroy(): void
    {
        if (empty($this->selectedIds)) {
            return;
        }

        $countDeleted = 0;

        foreach ($this->selectedIds as $id) {
            $reg = $this->adminLogManager->findOneById($id);

            if ($reg === null) {
                continue;
            }

            if ($reg->canDestroy()) {
                try {
                    $reg->delete();
                    $countDeleted++;
                } catch (\Throwable $exception) {
                }
            }
        }

        $this->selectedIds = TableFilters::VALUE_EMPTY_ARRAY;
        $this->sessionService->dispatchDestroyFlashFromSelectedIds($countDeleted, \count($this->selectedIds));
        $this->dispatchEvent(EventNames::NAME_CLOSE_DESTROY_MODAL);
    }

    public function checkAll(): void
    {
        foreach ($this->getIdsFromData() as $id) {
            if ($this->isCheckAllSelector) {
                unset($this->selectedIds[$id]);

                continue;
            }

            $this->selectedIds[$id] = $id;
        }
	}

    public function getUserNameByUser(): void
    {
        if ($this->user === TableFilters::VALUE_ALL) {
            return;
        }

        $user = $this->userManager->findOneById((int)$this->user);

        if ($user === null) {
            $this->user = TableFilters::VALUE_ALL;

            return;
        }

        $this->userName = $user->getName();
    }

    public function resetFilters(): void
    {
        $this->resetCommonFilters($this->tableName);
    }

    public function confirmExportTable(string $format): void
    {
        $this->formatExport = $format;
        $this->dispatchEvent(EventNames::NAME_OPEN_EXPORT_TABLE_MODAL);
    }

    public function tableExport(): BinaryFileResponse
    {
        $filename = $this->filenameExportTable ?: $this->tableInfo['plural'];
        $filename .= '.'.$this->formatExport;
        $data = $this->getData(false);
        $data->makeHidden(['user_name']);

        $this->dispatchEvent(EventNames::NAME_CLOSE_EXPORT_TABLE_MODAL);
        $this->sessionService->dispatchFlash(SessionService::FLASH_TYPE_SUCCESS, 'Registros exportados correctamente!.');

        return Excel::download(new AdminLogsExport($data), $filename);
    }

    public function confirmExportSelected(string $format): void
    {
        $this->formatExport = $format;
        $this->dispatchEvent(EventNames::NAME_OPEN_EXPORT_SELECTED_MODAL);
    }

    public function selectedExport(): BinaryFileResponse
    {
        $filename = $this->filenameExportSelected ?: 'logs_seleccionados';
        $filename .= '.'.$this->formatExport;
        $data = $this->getSelectedData();
        $data->makeHidden(['user_name']);

        $this->dispatchEvent(EventNames::NAME_CLOSE_EXPORT_SELECTED_MODAL);
        $this->sessionService->dispatchFlash(SessionService::FLASH_TYPE_SUCCESS, 'Registros exportados correctamente!.');

        return Excel::download(new AdminLogsExport($data), $filename.'.'.$this->formatExport);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function initializeFilters(): void
    {
        $this->initializeCommonFilters($this->tableName, $this->tableInfo);

        $userNamesIndexedById = $this->adminLogManager->getDistinctUsers();
        $this->relatedUsers = $userNamesIndexedById;

        $tables = $this->adminLogManager->getDistinctTables();
        $this->relatedTables = $tables;

        $types = $this->adminLogManager->getDistinctTypes();
        $this->relatedTypes = $types;
    }

    private function getData(bool $withPaginator = true): LengthAwarePaginator|Collection
    {
        return $this->adminLogManager->commandFilter(
            $this->search,
            $this->type,
            $this->userName,
            $this->table,
            $withPaginator ? $this->perPage : null,
            $this->orderByColumn,
            $this->orderByOrder
        );
    }

    private function getSelectedData(): Collection
    {
        return $this->adminLogManager->findByIds($this->selectedIds, $this->orderByColumn, $this->orderByOrder);
    }

    private function checkCurrentPage(): void
    {
        if ($this->page !== 1 && $this->data->total() > 0 && $this->data->isEmpty()) {
            $this->previousPage();
        }
    }

    private function setIsCheckAllSelector(): void
    {
        $this->isCheckAllSelector = !\array_diff($this->getIdsFromData(), $this->selectedIds);
    }

    /**
     * @return int[]
     */
    private function getIdsFromData(): array
    {
        if (!isset($this->data)) {
            $this->data = $this->getData();
        }

        return $this->data->pluck('id')->toArray();
    }
}
