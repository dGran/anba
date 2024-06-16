<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TableFiltersDTO;
use App\Enum\TableFilters;
use App\Enum\TableNames;
use App\Helpers\Serializer;

class TableFiltersService
{
    public const FILTERS_INDEXED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableFilters::NAME_SEARCH => '',
            TableFilters::NAME_TYPE => '25',
            TableFilters::NAME_USER => 'all',
            TableFilters::NAME_TABLE => 'all',
            TableFilters::NAME_PER_PAGE => 'all',
            TableFilters::NAME_ORDER => 'id_desc',
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

    public function setByFilterName(string $filterName, string $value, TableFiltersDTO $tableFiltersDTO): TableFiltersDTO
    {
        switch ($filterName) {
            case TableFilters::NAME_SEARCH:
                $tableFiltersDTO->setSearch($value);

                break;
            case TableFilters::NAME_TYPE:
                $tableFiltersDTO->setType($value);

                break;
            case TableFilters::NAME_USER:
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
