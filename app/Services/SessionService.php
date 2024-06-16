<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TableFiltersDTO;
use App\DTO\TableOptionsDTO;
use App\Enum\TableFilters;
use App\Enum\TableNames;
use App\Enum\TableOptions;
use App\Helpers\Serializer;

class SessionService
{
    private const FILTER_SESSION_NAMES_INDEXED_BY_FILTER_NAME_GROUPED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableFilters::NAME_SEARCH => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_SEARCH,
            TableFilters::NAME_TYPE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_TYPE,
            TableFilters::NAME_USER => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_USER,
            TableFilters::NAME_USER_NAME => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_USER_NAME,
            TableFilters::NAME_TABLE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_TABLE,
            TableFilters::NAME_ORDER => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_ORDER,
            TableFilters::NAME_PAGE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_PAGE,
            TableFilters::NAME_PER_PAGE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_PER_PAGE,
        ]
    ];

    private const OPTION_SESSION_NAMES_INDEXED_BY_OPTION_NAME_GROUPED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableOptions::NAME_SHOW_TABLE_IMAGES => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SHOW_TABLE_IMAGES,
            TableOptions::NAME_SHOW_STRIPED => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SHOW_STRIPED,
            TableOptions::NAME_FIXED_FIRST_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_FIXED_FIRST_COLUMN,
            TableOptions::NAME_SHOW_TYPE_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SHOW_TYPE_COLUMN,
            TableOptions::NAME_SHOW_TABLE_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SHOW_TABLE_COLUMN,
            TableOptions::NAME_SHOW_USER_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SHOW_USER_COLUMN,
            TableOptions::NAME_SHOW_DATE_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SHOW_DATE_COLUMN,
            TableOptions::NAME_CURRENT_MODAL => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_CURRENT_MODAL,
            TableOptions::NAME_SELECTED_IDS => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SELECTED_IDS,
            TableOptions::NAME_CHECK_ALL_SELECTOR => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_CHECK_ALL_SELECTOR,
        ]
    ];

    /**
     * @throws \JsonException
     */
    public function getTableFiltersByTableName(string $tableName): TableFiltersDTO
    {
        $tableFilterSessionNames = self::FILTER_SESSION_NAMES_INDEXED_BY_FILTER_NAME_GROUPED_BY_TABLE_NAME[$tableName];
        $tableFilters = [];

        foreach ($tableFilterSessionNames as $filterName => $tableFilterSessionName) {
            $tableFilters[$filterName] = $tableFilterSessionName;
        }

        return Serializer::deserialize(\json_encode($tableFilters, JSON_THROW_ON_ERROR), TableFiltersDTO::class);
    }

    /**
     * @throws \JsonException
     */
    public function getTableOptionsByTableName(string $tableName): TableOptionsDTO
    {
        $tableOptionSessionNames = self::OPTION_SESSION_NAMES_INDEXED_BY_OPTION_NAME_GROUPED_BY_TABLE_NAME[$tableName];
        $tableOptions = [];

        $tableOptions['tableName'] = $tableName;

        foreach ($tableOptionSessionNames as $optionName => $tableOptionSessionName) {
            $tableOptions[$optionName] = session()->get($tableOptionSessionName);
        }

        return Serializer::deserialize(\json_encode($tableOptions, JSON_THROW_ON_ERROR), TableOptionsDTO::class);
    }

    public function setOptionValues(string $tableName, TableOptionsDTO $tableOptionsDTO): void
    {
        $options = [
            TableOptions::NAME_SHOW_TABLE_IMAGES => $tableOptionsDTO->isShowTableImages(),
            TableOptions::NAME_SHOW_STRIPED => $tableOptionsDTO->isShowStriped(),
            TableOptions::NAME_SHOW_TYPE_COLUMN => $tableOptionsDTO->isShowTypeColumn(),
            TableOptions::NAME_SHOW_TABLE_COLUMN => $tableOptionsDTO->isShowTableColumn(),
            TableOptions::NAME_SHOW_USER_COLUMN => $tableOptionsDTO->isShowUserColumn(),
            TableOptions::NAME_SHOW_DATE_COLUMN => $tableOptionsDTO->isShowDateColumn(),
            TableOptions::NAME_CURRENT_MODAL => $tableOptionsDTO->getCurrentModal(),
            TableOptions::NAME_SELECTED_IDS => $tableOptionsDTO->getSelectedIds(),
            TableOptions::NAME_CHECK_ALL_SELECTOR => $tableOptionsDTO->isCheckAllSelector(),
            TableOptions::NAME_FIXED_FIRST_COLUMN => $tableOptionsDTO->isFixedFirstColumn()
        ];

        foreach ($options as $optionName => $value) {
            if ($value === null) {
                continue;
            }

            if (\is_bool($value)) {
                $value = $value ? 'on' : 'off';
            }

            session([$tableName.'.'.$optionName => $value]);
        }

        $allColumnOptionsDisabled = true;

        foreach (TableOptions::COLUMN_OPTION_NAMES as $columnOption) {
            if (session($tableName.'.'.$columnOption) !== 'off') {
                $allColumnOptionsDisabled = false;

                break;
            }
        }

        if ($allColumnOptionsDisabled) {
            session([$tableName.'.'.TableOptions::NAME_FIXED_FIRST_COLUMN => 'off']);
        }
    }

    public function setFilterValues(string $tableName, TableFiltersDTO $tableFiltersDTO): void
    {
        $filters = [
            TableFilters::NAME_SEARCH => $tableFiltersDTO->getSearch(),
            TableFilters::NAME_TYPE => $tableFiltersDTO->getType(),
            TableFilters::NAME_USER => $tableFiltersDTO->getUser(),
            TableFilters::NAME_TABLE => $tableFiltersDTO->getTable(),
            TableFilters::NAME_PAGE => $tableFiltersDTO->getPage(),
            TableFilters::NAME_PER_PAGE => $tableFiltersDTO->getPerPage(),
            TableFilters::NAME_ORDER => $tableFiltersDTO->getOrder(),
        ];

        foreach ($filters as $filterName => $value) {
            if ($value === null) {
                continue;
            }

            session([$tableName.'.'.$filterName => $value]);
        }
    }
}
