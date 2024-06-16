<?php

declare(strict_types=1);

namespace App\DTO;

class OrderDTO
{
    private string $name;

    private OrderDetailDTO $detail;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): OrderDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getDetail(): OrderDetailDTO
    {
        return $this->detail;
    }

    public function setDetail(OrderDetailDTO $detail): OrderDTO
    {
        $this->detail = $detail;
        return $this;
    }
}
