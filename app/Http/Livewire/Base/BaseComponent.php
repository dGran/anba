<?php

declare(strict_types=1);

namespace App\Http\Livewire\Base;

use App\Enum\OrderByCriteria;
use App\Enum\TableFilters;
use App\Enum\TableInfo;
use App\Enum\TableOptions;
use Livewire\Component;
use Livewire\WithPagination;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BaseComponent extends Component
{
    use WithPagination;

    public array $tableInfo;

    //filters

    public ?string $search = null;

    public ?string $type = null;

    public ?string $user = null;

    public ?string $userName = null;

    public ?string $table = null;

    public ?string $perPage = null;

    public ?string $orderBy = null;

    public ?string $orderByColumn = null;

    public ?string $orderByOrder = null;

    public ?array $relatedUsers = null;

    public ?array $relatedTypes = null;

    public ?array $relatedTables = null;

    //options

    public ?bool $isShowTableImages = null;

    public ?bool $isShowStriped = null;

    public ?bool $isFixedFirstColumn = null;

    public ?bool $isShowTypeColumn = null;

    public ?bool $isShowTableColumn = null;

    public ?bool $isShowUserColumn = null;

    public ?bool $isShowDateColumn = null;

    public ?string $currentModal = null;

    public ?array $selectedIds = null;

    public ?bool $isCheckAllSelector = null;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function initializeCommonFilters(string $tableName, array $tableInfo): void
    {
        $this->search = session()->get($tableName.TableFilters::NAME_SEARCH) ?? '';
        $this->type = session()->get($tableName.TableFilters::NAME_TYPE) ?? '';
        $this->user = session()->get($tableName.TableFilters::NAME_USER) ?? '';
        $this->userName = session()->get($tableName.TableFilters::NAME_USER_NAME) ?? '';
        $this->table = session()->get($tableName.TableFilters::NAME_TABLE) ?? '';
        $this->page = session()->get($tableName.TableFilters::NAME_PAGE) ?? '';
        $this->perPage = session()->get($tableName.TableFilters::NAME_PER_PAGE) ?? TableFilters::VALUE_PER_PAGE_DEFAULT;
        $this->orderBy = session()->get($tableName.TableFilters::NAME_ORDER_BY) ?? OrderByCriteria::ORDER_BY_ID_DESC;
        $this->orderByColumn = session()->get($tableName.TableFilters::NAME_ORDER_BY_COLUMN) ?? $tableInfo[TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME][$this->orderBy]['column'];
        $this->orderByOrder = session()->get($tableName.TableFilters::NAME_ORDER_BY_ORDER) ?? $tableInfo[TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME][$this->orderBy]['order'];
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function initializeOptions(string $tableName): void
    {
        $this->selectedIds = session()->get($tableName.TableOptions::NAME_SELECTED_IDS) ?? [];
        $this->currentModal = session()->get($tableName.TableOptions::NAME_CURRENT_MODAL) ?? '';
        $this->isCheckAllSelector = session()->get($tableName.TableOptions::NAME_CHECK_ALL_SELECTOR) ?? false;
    }

    public function setNextPage(): void
    {
        $this->page++;
    }

    public function setPreviousPage(): void
    {
        $this->page--;
    }

    public function closeAnyModal(): void
    {
        $this->currentModal = null;
    }
}
