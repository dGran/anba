<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\OrderByCriteria;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Cache;

class AdminLogRepository
{
    public function findOneById(int $id): ?AdminLog
    {
        return AdminLog::find($id);
    }

    /**
     * @return string[]
     */
    public function getDistinctUsers(): array
    {
        return Cache::remember(__METHOD__, now()->addHours(24), static function () {
            return AdminLog::distinct()
                ->join('users', 'admin_logs.user_id', '=', 'users.id')
                ->whereNotNull('admin_logs.user_id')
                ->orderBy('users.name', OrderByCriteria::ORDER_ASC)
                ->pluck('admin_logs.user_id', 'users.name')
                ->toArray();
        });
    }

    /**
     * @return string[]
     */
    public function getDistinctTables(): array
    {
        return Cache::remember(__METHOD__, now()->addHours(24), static function () {
            return AdminLog::distinct()
                ->whereNotNull('table')
                ->orderBy('table', OrderByCriteria::ORDER_ASC)
                ->pluck('table')
                ->toArray();
        });
    }

    /**
     * @return string[]
     */
    public function getDistinctTypes(): array
    {
        return Cache::remember(__METHOD__, now()->addHours(24), static function () {
            return AdminLog::distinct()
                ->whereNotNull('type')
                ->orderBy('type', OrderByCriteria::ORDER_ASC)
                ->pluck('type')
                ->toArray();
        });
    }

    public function findBy(
        array $criteria,
        ?string $orderBy = null,
        ?string $orderDirection = null,
        ?int $perPage = null,
        ?int $limit = null,
        ?int $offset = null
    ): array {
        //TODO
        $search = $criteria['search'] ?? null;
        $type = $criteria['type'] ?? null;
        $userId = $criteria['userId'] ?? null;
        $table = $criteria['table'] ?? null;

        return AdminLog::select('admin_logs.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'admin_logs.user_id')
            ->where(function ($query) use ($search) {
                if (trim($search) !== "") {
                    $query->where('admin_logs.reg_name', 'LIKE', "%{$search}%")
                        ->orWhere('admin_logs.reg_id', 'LIKE', "%{$search}%")
                        ->orWhere('admin_logs.table', 'LIKE', "%{$search}%")
                        ->orWhere('admin_logs.id', 'LIKE', "%{$search}%");
                }
            })
            ->when($type, function ($query) use ($type) {
                $query->where('admin_logs.type', $type);
            })
            ->when($userId, function ($query) use ($userId) {
                $query->where('admin_logs.user_id', $userId);
            })
            ->when($table, function ($query) use ($table) {
                $query->where('admin_logs.table', $table);
            })
            ->orderBy($orderBy, $orderDirection)
            ->orderBy('admin_logs.id', 'desc')
            ->paginate($perPage)->onEachSide(2);
    }
}
