<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TableFiltersDTO;
use App\Enum\OrderByCriteria;
use App\Enum\TableFilters;
use App\Enum\TableNames;
use App\Helpers\Serializer;
use App\Managers\AdminLogManager;
use App\Managers\UserManager;

class TableFiltersService
{
    private UserManager $userManager;

    private AdminLogManager $adminLogManager;

    public function __construct(
        UserManager $userManager,
        AdminLogManager $adminLogManager
    ) {
        $this->userManager = $userManager;
        $this->adminLogManager = $adminLogManager;
    }

    public const FILTERS_INDEXED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableFilters::NAME_SEARCH => TableFilters::VALUE_NULL,
            TableFilters::NAME_TYPE => TableFilters::VALUE_ALL,
            TableFilters::NAME_USER => TableFilters::VALUE_ALL,
            TableFilters::NAME_TABLE => TableFilters::VALUE_ALL,
            TableFilters::NAME_ORDER_BY => OrderByCriteria::ORDER_BY_ID_DESC,
            TableFilters::NAME_PER_PAGE => TableFilters::VALUE_PER_PAGE_DEFAULT,
        ],
    ];

    /**
     * @throws \JsonException
     */
    public function initialize(string $tableName): TableFiltersDTO
    {
        $tableFilters = \json_encode(self::FILTERS_INDEXED_BY_TABLE_NAME[$tableName], JSON_THROW_ON_ERROR);
        $tableFiltersDTO = Serializer::deserialize($tableFilters, TableFiltersDTO::class);

        switch ($tableName) {
            case TableNames::TABLE_ADMIN_LOG:
                $userIds = $this->adminLogManager->getDistinctUsers();
                $tableFiltersDTO->setRelatedUserIds($userIds);

                $tables = $this->adminLogManager->getDistinctTables();
                $tableFiltersDTO->setRelatedTables($tables);

                $types = $this->adminLogManager->getDistinctTypes();
                $tableFiltersDTO->setRelatedTypes($types);

                break;
            default:
                throw new \InvalidArgumentException("Unknown table name: $tableName");
        }

        return $tableFiltersDTO;
    }

    public function setByFilterName(string $filterName, TableFiltersDTO $tableFiltersDTO, ?string $value = null): TableFiltersDTO
    {
        switch ($filterName) {
            case TableFilters::NAME_SEARCH:
                $tableFiltersDTO->setSearch($value);

                break;
            case TableFilters::NAME_TYPE:
                $tableFiltersDTO->setType($value);

                break;
            case TableFilters::NAME_USER:
                if ($value !== null) {
                    $user = $this->userManager->findOneById((int)$tableFiltersDTO->getUser());

                    if ($user === null) {
                        $tableFiltersDTO->setUser(TableFilters::VALUE_NULL);
                        $tableFiltersDTO->setUserName(TableFilters::VALUE_NULL);

                        break;
                    }

                    $tableFiltersDTO->setUserName($user->getName());
                }

                $tableFiltersDTO->setUser($value);

                break;
            case TableFilters::NAME_TABLE:
                $tableFiltersDTO->setTable($value);

                break;
            case TableFilters::NAME_PER_PAGE:
                if ($value !== null) {

                }

                $tableFiltersDTO->setPerPage($value);

                break;
            case TableFilters::NAME_ORDER:
                $tableFiltersDTO->setOrder($value);

                break;
            default:
                throw new \InvalidArgumentException("Unknown filter name: $filterName");
        }

        return $tableFiltersDTO;
    }

    /**
     * @return array{search: string, perPage: string, type: string, user: string, userName: string, table: string, order: string, orderField: string, orderDirection: string, page: int}
     */
    public function toArray(TableFiltersDTO $tableFiltersDTO): array
    {
        return [
            'search' => $tableFiltersDTO->getSearch(),
            'perPage' => $tableFiltersDTO->getPerPage(),
            'type' => $tableFiltersDTO->getType(),
            'user' => $tableFiltersDTO->getUser(),
            'userName' => $tableFiltersDTO->getUserName(),
            'table' => $tableFiltersDTO->getTable(),
            'order' => $tableFiltersDTO->getOrder(),
            'orderField' => $tableFiltersDTO->getOrderField(),
            'orderDirection' => $tableFiltersDTO->getOrderDirection(),
            'page' => $tableFiltersDTO->getPage(),
            'relatedUserIds' => $tableFiltersDTO->getRelatedUserIds(),
            'relatedTypes' => $tableFiltersDTO->getRelatedTypes(),
            'relatedTables' => $tableFiltersDTO->getRelatedTables(),
        ];
    }
}
