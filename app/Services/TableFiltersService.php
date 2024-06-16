<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TableFiltersDTO;
use App\Enum\OrderNames;
use App\Enum\TableFilters;
use App\Enum\TableNames;
use App\Helpers\Serializer;
use App\Managers\UserManager;

class TableFiltersService
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public const FILTERS_INDEXED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableFilters::NAME_SEARCH => TableFilters::VALUE_NULL,
            TableFilters::NAME_TYPE => TableFilters::VALUE_ALL,
            TableFilters::NAME_USER => TableFilters::VALUE_ALL,
            TableFilters::NAME_TABLE => TableFilters::VALUE_ALL,
            TableFilters::NAME_ORDER => OrderNames::ID_DESC,
            TableFilters::NAME_PER_PAGE => TableFilters::VALUE_PER_PAGE_DEFAULT,
        ],
    ];

    /**
     * @throws \JsonException
     */
    public function initialize(string $tableName): TableFiltersDTO
    {
        $tableFilters = \json_encode(self::FILTERS_INDEXED_BY_TABLE_NAME[$tableName], JSON_THROW_ON_ERROR);

        return Serializer::deserialize($tableFilters, TableFiltersDTO::class);
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
}
