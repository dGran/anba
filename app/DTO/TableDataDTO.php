<?php

declare(strict_types=1);

namespace App\DTO;

class TableDataDTO
{
    private string $singular;

    private string $plural;

    private string $gender;

    private bool $hasImage = false;

    /** @var OrderDTO[] */
    private array $orders = [];

    public function getSingular(): string
    {
        return $this->singular;
    }

    public function setSingular(string $singular): TableDataDTO
    {
        $this->singular = $singular;
        return $this;
    }

    public function getPlural(): string
    {
        return $this->plural;
    }

    public function setPlural(string $plural): TableDataDTO
    {
        $this->plural = $plural;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): TableDataDTO
    {
        $this->gender = $gender;
        return $this;
    }

    public function isHasImage(): bool
    {
        return $this->hasImage;
    }

    public function setHasImage(bool $hasImage): TableDataDTO
    {
        $this->hasImage = $hasImage;
        return $this;
    }

    /**
     * @return OrderDTO[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param OrderDTO[] $orders
     */
    public function setOrders(array $orders): TableDataDTO
    {
        $this->orders = $orders;
        return $this;
    }
}
