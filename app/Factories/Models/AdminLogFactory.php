<?php

declare(strict_types=1);

namespace App\Factories\Models;

use App\DTO\AdminLogDTO;
use App\Models\AdminLog;

class AdminLogFactory
{
    public static function buildFromAdminLogDTO(AdminLogDTO $adminLogDTO): AdminLog
    {
        $adminLog = new AdminLog();

        $adminLog->setUserId($adminLogDTO->getUserId());
        $adminLog->setType($adminLogDTO->getType());
        $adminLog->setTableAttribute($adminLogDTO->getTable());
        $adminLog->setRegId($adminLogDTO->getRegId());
        $adminLog->setRegName($adminLogDTO->getRegName());
        $adminLog->setDetail($adminLogDTO->getDetail());
        $adminLog->setDetailBefore($adminLogDTO->getDetailBefore());

        return $adminLog;
    }
}
