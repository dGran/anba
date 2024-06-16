<?php

declare(strict_types=1);

namespace App\Factories\ViewModels;

use App\Factories\DTO\TableDataDTOFactory;
use App\Managers\AdminLogManager;
use App\Managers\UserManager;
use App\Models\AdminLog;
use App\Services\SessionService;
use App\Services\TableFiltersService;
use App\ViewModels\AdminLogCrudViewModel;

class AdminLogCrudFactory
{
    private TableFiltersService $tableFiltersService;

    private SessionService $sessionService;

    private AdminLogManager $adminLogManager;

    private UserManager $userManager;

    public function __construct(
        TableFiltersService $tableFiltersService,
        SessionService $sessionService,
        AdminLogManager $adminLogManager,
        UserManager $userManager
    ) {
        $this->tableFiltersService = $tableFiltersService;
        $this->sessionService = $sessionService;
        $this->adminLogManager = $adminLogManager;
        $this->userManager = $userManager;
    }

    /**
     * @throws \JsonException
     */
    public function create(string $tableName): AdminLogCrudViewModel
    {
        $view = new AdminLogCrudViewModel();

        $view->setTableData(TableDataDTOFactory::create($tableName));
        $view->setTableFiltersDTO($this->tableFiltersService->initialize($tableName));
        $view->setTableOptionsDTO($this->sessionService->getTableOptionsByTableName($tableName));

        $distinctUserIds = $this->adminLogManager->getDistinctUserIds();
        $users = $this->userManager->findNamesByIdsIndexedById($distinctUserIds, 'name');
        $view->setUsers($users);

        $tables = $this->adminLogManager->getDistinctTables();
        $view->setTables($tables);

        $view->setTypes(AdminLog::TYPE_LIST);

        return $view;
    }
}
