<?php

declare(strict_types=1);

namespace App\Factories\ViewModels;

use App\Factories\DTO\TableDataDTOFactory;
use App\Services\SessionService;
use App\Services\TableFiltersService;
use App\ViewModels\CrudViewModel;

class AdminLogCrudFactory
{
    private TableFiltersService $tableFiltersService;

    private SessionService $sessionService;

    public function __construct(
        TableFiltersService $tableFiltersService,
        SessionService $sessionService
    ) {
        $this->tableFiltersService = $tableFiltersService;
        $this->sessionService = $sessionService;
    }

    /**
     * @throws \JsonException
     */
    public function create(string $tableName): CrudViewModel
    {
        $view = new CrudViewModel();

        $view->setTableData(TableDataDTOFactory::create($tableName));
        $view->setTableFilters($this->tableFiltersService->initialize($tableName));
        $view->setTableOptions($this->sessionService->getTableOptionsByTableName($tableName));

        return $view;
    }
}
