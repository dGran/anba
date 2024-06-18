<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\DTO\TableDataDTO;
use App\DTO\TableFiltersDTO;
use App\DTO\TableOptionsDTO;

class CrudViewModel
{
    private TableDataDTO $tableData;

    private TableFiltersDTO $tableFiltersDTO;

    private TableOptionsDTO $tableOptionsDTO;

    public function getTableData(): TableDataDTO
    {
        return $this->tableData;
    }

    public function setTableData(TableDataDTO $tableData): CrudViewModel
    {
        $this->tableData = $tableData;

        return $this;
    }

    public function getTableFilters(): TableFiltersDTO
    {
        return $this->tableFiltersDTO;
    }

    public function setTableFilters(TableFiltersDTO $tableFiltersDTO): CrudViewModel
    {
        $this->tableFiltersDTO = $tableFiltersDTO;

        return $this;
    }

    public function getTableOptions(): TableOptionsDTO
    {
        return $this->tableOptionsDTO;
    }

    public function setTableOptions(TableOptionsDTO $tableOptionsDTO): CrudViewModel
    {
        $this->tableOptionsDTO = $tableOptionsDTO;

        return $this;
    }
}
