<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\OrderByCriteria;
use App\Enum\TableInfo;
use App\Enum\TableNames;

class TableInfoService
{
    private const TABLE_INFO_INDEXED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableInfo::SINGULAR => 'log',
            TableInfo::PLURAL => 'logs',
            TableInfo::GENDER => 'male',
            TableInfo::HAS_IMAGE => false,
            TableInfo::ORDER_BY_CRITERIA_INDEXED_BY_NAME => [
                OrderByCriteria::ORDER_BY_ID => [
                    OrderByCriteria::CRITERIA_COLUMN => 'id',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'ID',
                ],
                OrderByCriteria::ORDER_BY_ID_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'id',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'ID (desc)',
                ],
                OrderByCriteria::ORDER_BY_NAME => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.reg_name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Nombre',
                ],
                OrderByCriteria::ORDER_BY_NAME_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.reg_name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Nombre (desc)',
                ],
                OrderByCriteria::ORDER_BY_TYPE => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.type',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tipo',
                ],
                OrderByCriteria::ORDER_BY_TYPE_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.type',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tipo (desc)',
                ],
                OrderByCriteria::ORDER_BY_TABLE => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.table',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tabla',
                ],
                OrderByCriteria::ORDER_BY_TABLE_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.table',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Tabla (desc)',
                ],
                OrderByCriteria::ORDER_BY_USER => [
                    OrderByCriteria::CRITERIA_COLUMN => 'users.name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Usuario',
                ],
                OrderByCriteria::ORDER_BY_USER_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'users.name',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Usuario (desc)',
                ],
                OrderByCriteria::ORDER_BY_DATE => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.created_at',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_ASC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Fecha',
                ],
                OrderByCriteria::ORDER_BY_DATE_DESC => [
                    OrderByCriteria::CRITERIA_COLUMN => 'admin_logs.created_at',
                    OrderByCriteria::CRITERIA_ORDER => OrderByCriteria::ORDER_DESC,
                    OrderByCriteria::CRITERIA_CAPTION => 'Fecha (desc)',
                ],
            ],
        ],
    ];

    public function getTableInfoByTableName(string $tableName): array
    {
        return self::TABLE_INFO_INDEXED_BY_TABLE_NAME[$tableName];
    }
}
