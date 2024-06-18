<?php

declare(strict_types=1);

namespace App\DTO;

class TableFiltersDTO
{
    private ?string $search = null;

    private ?string $perPage = null;

    private ?string $type = null;

    private ?string $user = null;

    private ?string $userName = null;

    private ?string $table = null;

    private ?string $order = null;

    private ?string $orderField = null;

    private ?string $orderDirection = null;

    private ?int $page = null;

    private array $relatedUserIds = [];

    private array $relatedTypes = [];

    private array $relatedTables = [];

    public function getSearch(): string
    {
        return $this->search;
    }

    public function setSearch(string $search): TableFiltersDTO
    {
        $this->search = $search;

        return $this;
    }

    public function getPerPage(): string
    {
        return $this->perPage;
    }

    public function setPerPage(string $perPage): TableFiltersDTO
    {
        $this->perPage = $perPage;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): TableFiltersDTO
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function setUser(string $user): TableFiltersDTO
    {
        $this->user = $user;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): TableFiltersDTO
    {
        $this->userName = $userName;

        return $this;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): TableFiltersDTO
    {
        $this->table = $table;

        return $this;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function setOrder(string $order): TableFiltersDTO
    {
        $this->order = $order;

        return $this;
    }

    public function getOrderField(): ?string
    {
        return $this->orderField;
    }

    public function setOrderField(?string $orderField): TableFiltersDTO
    {
        $this->orderField = $orderField;

        return $this;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }

    public function setOrderDirection(?string $orderDirection): TableFiltersDTO
    {
        $this->orderDirection = $orderDirection;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): TableFiltersDTO
    {
        $this->page = $page;

        return $this;
    }

    public function getRelatedUserIds(): array
    {
        return $this->relatedUserIds;
    }

    public function setRelatedUserIds(array $relatedUserIds): TableFiltersDTO
    {
        $this->relatedUserIds = $relatedUserIds;

        return $this;
    }

    public function getRelatedTypes(): array
    {
        return $this->relatedTypes;
    }

    public function setRelatedTypes(array $relatedTypes): TableFiltersDTO
    {
        $this->relatedTypes = $relatedTypes;

        return $this;
    }

    public function getRelatedTables(): array
    {
        return $this->relatedTables;
    }

    public function setRelatedTables(array $relatedTables): TableFiltersDTO
    {
        $this->relatedTables = $relatedTables;

        return $this;
    }
}
