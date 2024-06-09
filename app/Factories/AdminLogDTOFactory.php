<?php

declare(strict_types=1);

namespace App\Factories;

use App\DTO\AdminLogDTO;

class AdminLogDTOFactory
{
    /**
     * @param array $data {model: Model, type: string, reg_data: array, reg_data_before: array}
     *
     * @throws \JsonException
     */
    public static function create(array $data): AdminLogDTO
    {
        $adminLogDTO = new AdminLogDTO();
        $detailData = $data['reg_data'];
        $detailDataBefore = $data['reg_data_before'];

        $diffBefore = \array_diff($detailDataBefore, $detailData);
        $diffAfter = \array_diff($detailData, $detailDataBefore);

        if (empty($diffBefore) || empty($diffAfter)) {
            return $adminLogDTO;
        }

        $model = $data['model'];

        $adminLogDTO->setUserId(auth()->id());
        $adminLogDTO->setType($data['type']);
        $adminLogDTO->setTable($model->getTable());
        $adminLogDTO->setRegId((string)$model->id);
        $adminLogDTO->setRegName($model->getName());
        $adminLogDTO->setDetail(\json_encode($diffAfter, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT),);
        $adminLogDTO->setDetailBefore(\json_encode($diffBefore, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT),);

        return $adminLogDTO;
    }
}
