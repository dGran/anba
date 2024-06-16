<?php

declare(strict_types=1);

namespace App\Factories\DTO;

use App\DTO\OrderDetailDTO;
use App\DTO\OrderDTO;
use App\DTO\TableDataDTO;
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
                'id' => [
                    'fieldName' => 'id',
                    'direction' => 'asc'
                ],
                'id_desc' => [
                    'fieldName' => 'id',
                    'direction' => 'desc'
                ],
                'name' => [
                    'fieldName' => 'admin_logs.reg_name',
                    'direction' => 'asc'
                ],
                'name_desc' => [
                    'fieldName' => 'admin_logs.reg_name',
                    'direction' => 'desc'
                ],
                'type' => [
                    'fieldName' => 'admin_logs.type',
                    'direction' => 'asc'
                ],
                'type_desc' => [
                    'fieldName' => 'admin_logs.type',
                    'direction' => 'desc'
                ],
                'table' => [
                    'fieldName' => 'admin_logs.table',
                    'direction' => 'asc'
                ],
                'table_desc' => [
                    'fieldName' => 'admin_logs.table',
                    'direction' => 'desc'
                ],
                'user' => [
                    'fieldName' => 'users.name',
                    'direction' => 'asc'
                ],
                'user_desc' => [
                    'fieldName' => 'users.name',
                    'direction' => 'desc'
                ],
                'date' => [
                    'fieldName' => 'admin_logs.created_at',
                    'direction' => 'asc'
                ],
                'date_desc' => [
                    'fieldName' => 'admin_logs.created_at',
                    'direction' => 'desc'
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

        $orders = [];

        foreach ($tableData[TableData::ORDERS] as $orderName => $orderDetails) {
            $order = new OrderDTO();
            $order->setName($orderName);

            $orderDetail = new OrderDetailDTO();
            $orderDetail->setFieldName($orderDetails['fieldName']);
            $orderDetail->setDirection($orderDetails['direction']);

            $order->setDetail($orderDetail);
            $orders[$orderName] = $order;
        }

        $tableDataDTO->setOrders($orders);

        return $tableDataDTO;
    }
}
