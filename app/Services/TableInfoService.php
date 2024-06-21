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
                    'column' => 'id',
                    'order' => OrderByCriteria::ORDER_ASC
                ],
                OrderByCriteria::ORDER_BY_ID_DESC => [
                    'column' => 'id',
                    'order' => OrderByCriteria::ORDER_DESC,
                ],
                OrderByCriteria::ORDER_BY_NAME => [
                    'column' => 'admin_logs.reg_name',
                    'order' => OrderByCriteria::ORDER_ASC
                ],
                OrderByCriteria::ORDER_BY_NAME_DESC => [
                    'column' => 'admin_logs.reg_name',
                    'order' => OrderByCriteria::ORDER_DESC,
                ],
                OrderByCriteria::ORDER_BY_TYPE => [
                    'column' => 'admin_logs.type',
                    'order' => OrderByCriteria::ORDER_ASC
                ],
                OrderByCriteria::ORDER_BY_TYPE_DESC => [
                    'column' => 'admin_logs.type',
                    'order' => OrderByCriteria::ORDER_DESC,
                ],
                OrderByCriteria::ORDER_BY_TABLE => [
                    'column' => 'admin_logs.table',
                    'order' => OrderByCriteria::ORDER_ASC
                ],
                OrderByCriteria::ORDER_BY_TABLE_DESC => [
                    'column' => 'admin_logs.table',
                    'order' => OrderByCriteria::ORDER_DESC,
                ],
                OrderByCriteria::ORDER_BY_USER => [
                    'column' => 'users.name',
                    'order' => OrderByCriteria::ORDER_ASC
                ],
                OrderByCriteria::ORDER_BY_USER_DESC => [
                    'column' => 'users.name',
                    'order' => OrderByCriteria::ORDER_DESC,
                ],
                OrderByCriteria::ORDER_BY_DATE => [
                    'column' => 'admin_logs.created_at',
                    'order' => OrderByCriteria::ORDER_ASC
                ],
                OrderByCriteria::ORDER_BY_DATE_DESC => [
                    'column' => 'admin_logs.created_at',
                    'order' => OrderByCriteria::ORDER_DESC,
                ],
            ],
        ],
    ];

    public function getTableInfoByTableName(string $tableName): array
    {
        return self::TABLE_INFO_INDEXED_BY_TABLE_NAME[$tableName];
    }
}
