<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TableDataDTO;

class TableDataService
{
    /**
     * @return array{singular: string, plural: string, gender: string, hasImage: bool, orderByIndexedByName: array<string, array{column: string, order: string}>}
     */
    public function toArray(TableDataDTO $tableDataDTO): array
    {
        return [
            'singular' => $tableDataDTO->getSingular(),
            'plural' => $tableDataDTO->getPlural(),
            'gender' => $tableDataDTO->getGender(),
            'hasImage' => $tableDataDTO->isHasImage(),
            'orderByIndexedByName' => $tableDataDTO->getOrderByCriteriaIndexedByName(),
        ];
    }
}
