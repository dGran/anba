<?php

declare(strict_types=1);

namespace App\Factories\ViewModels;

use App\Factories\DTO\TableDataDTOFactory;
use App\Managers\AdminLogManager;
use App\Services\SessionService;
use App\Services\TableFiltersService;
use App\ViewModels\AdminLogCrudViewModel;
use App\ViewModels\CrudViewModel;

class AdminLogCrudFactory
{
    private TableFiltersService $tableFiltersService;

    private SessionService $sessionService;

    private AdminLogManager $adminLogManager;

    public function __construct(
        TableFiltersService $tableFiltersService,
        SessionService $sessionService,
        AdminLogManager $adminLogManager
    ) {
        $this->tableFiltersService = $tableFiltersService;
        $this->sessionService = $sessionService;
        $this->adminLogManager = $adminLogManager;
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
