<?php

declare(strict_types=1);

namespace App\Factories\DTO;

use App\DTO\OrderDetailDTO;
use App\DTO\OrderDTO;
use App\DTO\TableDataDTO;
use App\Enum\Criteria;
use App\Enum\OrderNames;
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
            TableData::ORDERS => [
                OrderNames::ID => [
                    'fieldName' => 'id',
                    'direction' => Criteria::ASC
                ],
                OrderNames::ID_DESC => [
                    'fieldName' => 'id',
                    'direction' => Criteria::DESC,
                ],
                OrderNames::NAME => [
                    'fieldName' => 'admin_logs.reg_name',
                    'direction' => Criteria::ASC
                ],
                OrderNames::NAME_DESC => [
                    'fieldName' => 'admin_logs.reg_name',
                    'direction' => Criteria::DESC,
                ],
                OrderNames::TYPE => [
                    'fieldName' => 'admin_logs.type',
                    'direction' => Criteria::ASC
                ],
                OrderNames::TYPE_DESC => [
                    'fieldName' => 'admin_logs.type',
                    'direction' => Criteria::DESC,
                ],
                OrderNames::TABLE => [
                    'fieldName' => 'admin_logs.table',
                    'direction' => Criteria::ASC
                ],
                OrderNames::TABLE_DESC => [
                    'fieldName' => 'admin_logs.table',
                    'direction' => Criteria::DESC,
                ],
                OrderNames::USER => [
                    'fieldName' => 'users.name',
                    'direction' => Criteria::ASC
                ],
                OrderNames::USER_DESC => [
                    'fieldName' => 'users.name',
                    'direction' => Criteria::DESC,
                ],
                OrderNames::DATE => [
                    'fieldName' => 'admin_logs.created_at',
                    'direction' => Criteria::ASC
                ],
                OrderNames::DATE_DESC => [
                    'fieldName' => 'admin_logs.created_at',
                    'direction' => Criteria::DESC,
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
        $orders = OrderDTOFactory::create($tableData[TableData::ORDERS]);
        $tableDataDTO->setOrders($orders);

        return $tableDataDTO;
    }
}
