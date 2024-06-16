<?php

declare(strict_types=1);

namespace App\DTO;

class OrderDetailDTO
{
    private string $fieldName;

    private string $direction;

    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    public function setFieldName(string $fieldName): OrderDetailDTO
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): OrderDetailDTO
    {
        $this->direction = $direction;
        return $this;
    }
}
