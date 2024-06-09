<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\Criteria;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Cache;

class AdminLogRepository
{
    public function findOneById(int $id): ?AdminLog
    {
        return AdminLog::find($id);
    }

    /**
     * @return int[]
     */
    public function getDistinctUserIds(): array
    {
        return Cache::remember(__METHOD__, now()->addHours(24), static function () {
            return AdminLog::distinct()->pluck('user_id')->toArray();
        });
    }

    /**
     * @return int[]
     */
    public function getDistinctTables(): array
    {
        return AdminLog::distinct()->whereNotNull('table')->orderBy('table', Criteria::ASC)->pluck('table')->toArray();
    }
}
