<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\TableFilters;
use App\Enum\TableNames;
use App\Enum\TableOptions;

class SessionService
{
    public const FLASH_TYPE_SUCCESS = 'success';

    public const FLASH_TYPE_ERROR = 'error';

    public const FLASH_TYPE_WARNING = 'warning';

    public const FLASH_TYPE_INFO = 'info';

    private const FILTER_SESSION_NAMES_INDEXED_BY_FILTER_NAME_GROUPED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableFilters::NAME_SEARCH => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_SEARCH,
            TableFilters::NAME_TYPE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_TYPE,
            TableFilters::NAME_USER => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_USER,
            TableFilters::NAME_USER_NAME => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_USER_NAME,
            TableFilters::NAME_TABLE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_TABLE,
            TableFilters::NAME_ORDER_BY => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_ORDER_BY,
            TableFilters::NAME_ORDER_BY_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_ORDER_BY_COLUMN,
            TableFilters::NAME_ORDER_BY_ORDER => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_ORDER_BY_ORDER,
            TableFilters::NAME_PAGE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_PAGE,
            TableFilters::NAME_PER_PAGE => TableNames::TABLE_ADMIN_LOG.'.'.TableFilters::NAME_PER_PAGE,
        ]
    ];

    private const OPTION_SESSION_NAMES_INDEXED_BY_OPTION_NAME_GROUPED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableOptions::NAME_IS_SHOW_TABLE_IMAGES => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_SHOW_TABLE_IMAGES,
            TableOptions::NAME_IS_SHOW_STRIPED => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_SHOW_STRIPED,
            TableOptions::NAME_IS_FIXED_FIRST_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_FIXED_FIRST_COLUMN,
            TableOptions::NAME_IS_SHOW_TYPE_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_SHOW_TYPE_COLUMN,
            TableOptions::NAME_IS_SHOW_TABLE_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_SHOW_TABLE_COLUMN,
            TableOptions::NAME_IS_SHOW_USER_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_SHOW_USER_COLUMN,
            TableOptions::NAME_IS_SHOW_DATE_COLUMN => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_SHOW_DATE_COLUMN,
            TableOptions::NAME_CURRENT_MODAL => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_CURRENT_MODAL,
            TableOptions::NAME_SELECTED_IDS => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_SELECTED_IDS,
            TableOptions::NAME_IS_CHECK_ALL_SELECTOR => TableNames::TABLE_ADMIN_LOG.'.'.TableOptions::NAME_IS_CHECK_ALL_SELECTOR,
        ]
    ];

    public function getOptionPropertiesByTableName(string $tableName): array
    {
        return \array_keys(self::OPTION_SESSION_NAMES_INDEXED_BY_OPTION_NAME_GROUPED_BY_TABLE_NAME[$tableName]);
    }

    public function getFilterPropertiesByTableName(string $tableName): array
    {
        return \array_keys(self::FILTER_SESSION_NAMES_INDEXED_BY_FILTER_NAME_GROUPED_BY_TABLE_NAME[$tableName]);
    }

    public function set(string $tableName, string $name, string $value): void
    {
        session([$tableName.'.'.$name => $value]);

        $allColumnOptionsDisabled = true;

        foreach (TableOptions::COLUMN_OPTION_NAMES as $columnOption) {
            if (session($tableName.'.'.$columnOption) !== 'off') {
                $allColumnOptionsDisabled = false;

                break;
            }
        }

        if ($allColumnOptionsDisabled) {
            session([$tableName.'.'.TableOptions::NAME_IS_FIXED_FIRST_COLUMN => 'off']);
        }
    }

    public function flashDestroyFromSelectedIds(int $countDeleted, int $countToDelete): void
    {
        if ($countDeleted > 0) {
            session()->flash(self::FLASH_TYPE_SUCCESS, $countToDelete === 1 ? 'Registro eliminado correctamente!.' : 'Registros eliminados correctamente!.');

            return;
        }

        if ($countToDelete > 1) {
            session()->flash(self::FLASH_TYPE_ERROR, 'No se ha eliminado ningún registro, no pueden ser eliminados o ya no existen.');

            return;
        }

        session()->flash(self::FLASH_TYPE_ERROR, 'El registro no puede ser eliminado o ya no existe.');
    }
}
