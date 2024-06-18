<?php

declare(strict_types=1);

namespace App\Factories\DTO;

use App\DTO\TableDataDTO;
use App\Enum\OrderByCriteria;
use App\Enum\TableData;
use App\Enum\TableNames;

class TableDataDTOFactory
{
    public const TABLE_DATA_INDEXED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            TableData::SINGULAR => 'log',
            TableData::PLURAL => 'logs',
            TableData::GENDER => 'male',
            TableData::HAS_IMAGE => false,
            TableData::ORDER_BY_CRITERIA_INDEXED_BY_NAME => [
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

    public static function create(string $tableName): TableDataDTO
    {
        $tableData = self::TABLE_DATA_INDEXED_BY_TABLE_NAME[$tableName];

        $tableDataDTO = new TableDataDTO();
        $tableDataDTO->setSingular($tableData[TableData::SINGULAR]);
        $tableDataDTO->setPlural($tableData[TableData::PLURAL]);
        $tableDataDTO->setGender($tableData[TableData::GENDER]);
        $tableDataDTO->setHasImage($tableData[TableData::HAS_IMAGE]);
        $tableDataDTO->setOrderByCriteriaIndexedByName($tableData[TableData::ORDER_BY_CRITERIA_INDEXED_BY_NAME]);

        return $tableDataDTO;
    }
}
