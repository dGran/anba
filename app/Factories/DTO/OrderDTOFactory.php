<?php

declare(strict_types=1);

namespace App\Factories\DTO;

use App\DTO\OrderDetailDTO;
use App\DTO\OrderDTO;

class OrderDTOFactory
{
    /**
     * @param array<string, array{fieldName: string, direction: string}> $ordersIndexedByName
     *
     * @return OrderDTO[]
     */
    public static function create(array $ordersIndexedByName): array
    {
        $orders = [];

        foreach ($ordersIndexedByName as $orderName => $orderDetails) {
            $order = new OrderDTO();
            $order->setName($orderName);

            $orderDetail = new OrderDetailDTO();
            $orderDetail->setFieldName($orderDetails['fieldName']);
            $orderDetail->setDirection($orderDetails['direction']);

            $order->setDetail($orderDetail);
            $orders[$orderName] = $order;
        }

        return $orders;
    }
}
