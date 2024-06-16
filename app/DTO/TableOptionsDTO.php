<?php

declare(strict_types=1);

namespace App\DTO;

class TableOptionsDTO
{
    private ?string $tableName = null;

    private ?bool $showTableImages = null;

    private ?bool $showStriped = null;

    private ?bool $fixedFirstColumn = null;

    private ?bool $showTypeColumn = null;

    private ?bool $showTableColumn = null;

    private ?bool $showUserColumn = null;

    private ?bool $showDateColumn = null;

    private ?string $currentModal = null;

    /** @var int[] */
    private ?array $selectedIds = null;

    private ?bool $checkAllSelector = null;

    public function getTableName(): ?string
    {
        return $this->tableName;
    }

    public function setTableName(?string $tableName): TableOptionsDTO
    {
        $this->tableName = $tableName;

        return $this;
    }

    public function isShowTableImages(): ?bool
    {
        return $this->showTableImages;
    }

    public function setShowTableImages(?bool $showTableImages): TableOptionsDTO
    {
        $this->showTableImages = $showTableImages;

        return $this;
    }

    public function isShowStriped(): ?bool
    {
        return $this->showStriped;
    }

    public function setShowStriped(?bool $showStriped): TableOptionsDTO
    {
        $this->showStriped = $showStriped;

        return $this;
    }

    public function isFixedFirstColumn(): ?bool
    {
        return $this->fixedFirstColumn;
    }

    public function setFixedFirstColumn(?bool $fixedFirstColumn): TableOptionsDTO
    {
        $this->fixedFirstColumn = $fixedFirstColumn;

        return $this;
    }

    public function isShowTypeColumn(): ?bool
    {
        return $this->showTypeColumn;
    }

    public function setShowTypeColumn(?bool $showTypeColumn): TableOptionsDTO
    {
        $this->showTypeColumn = $showTypeColumn;

        return $this;
    }

    public function isShowTableColumn(): ?bool
    {
        return $this->showTableColumn;
    }

    public function setShowTableColumn(?bool $showTableColumn): TableOptionsDTO
    {
        $this->showTableColumn = $showTableColumn;

        return $this;
    }

    public function isShowUserColumn(): ?bool
    {
        return $this->showUserColumn;
    }

    public function setShowUserColumn(?bool $showUserColumn): TableOptionsDTO
    {
        $this->showUserColumn = $showUserColumn;

        return $this;
    }

    public function isShowDateColumn(): ?bool
    {
        return $this->showDateColumn;
    }

    public function setShowDateColumn(?bool $showDateColumn): TableOptionsDTO
    {
        $this->showDateColumn = $showDateColumn;

        return $this;
    }

    public function getCurrentModal(): ?string
    {
        return $this->currentModal;
    }

    public function setCurrentModal(?string $currentModal): TableOptionsDTO
    {
        $this->currentModal = $currentModal;

        return $this;
    }

    public function getSelectedIds(): ?array
    {
        return $this->selectedIds;
    }

    public function setSelectedIds(?array $selectedIds): TableOptionsDTO
    {
        $this->selectedIds = $selectedIds;

        return $this;
    }

    public function isCheckAllSelector(): ?bool
    {
        return $this->checkAllSelector;
    }

    public function setCheckAllSelector(?bool $checkAllSelector): TableOptionsDTO
    {
        $this->checkAllSelector = $checkAllSelector;

        return $this;
    }
}
