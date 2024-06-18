<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TableOptionsDTO;

class TableOptionsService
{
    /**
     * @return array{tableName: string, showTableImages: bool, showStriped: bool, fixedFirstColumn: bool, showTypeColumn: bool, showTableColumn: bool, showUserColumn: bool, showDateColumn: bool, currentModal: string, selectedIds: array<int, int>, checkAllSelector: bool}
     */
    public function toArray(TableOptionsDTO $tableOptionsDTO): array
    {
        return [
            'tableName' => $tableOptionsDTO->getTableName(),
            'showTableImages' => $tableOptionsDTO->isShowTableImages(),
            'showStriped' => $tableOptionsDTO->isShowStriped(),
            'fixedFirstColumn' => $tableOptionsDTO->isFixedFirstColumn(),
            'showTypeColumn' => $tableOptionsDTO->isShowTypeColumn(),
            'showTableColumn' => $tableOptionsDTO->isShowTableColumn(),
            'showUserColumn' => $tableOptionsDTO->isShowUserColumn(),
            'showDateColumn' => $tableOptionsDTO->isShowDateColumn(),
            'currentModal' => $tableOptionsDTO->getCurrentModal(),
            'selectedIds' => $tableOptionsDTO->getSelectedIds(),
            'checkAllSelector' => $tableOptionsDTO->isCheckAllSelector(),
        ];
    }
}
