<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\OrderByCriteria;
use App\Models\AdminLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        return AdminLog::distinct()
            ->join('users', 'admin_logs.user_id', '=', 'users.id')
            ->whereNotNull('admin_logs.user_id')
            ->orderBy('users.name', OrderByCriteria::ORDER_ASC)
            ->pluck('users.name as name', 'admin_logs.user_id as id')
            ->toArray();
    }

    /**
     * @return string[]
     */
    public function getDistinctTables(): array
    {
        return AdminLog::distinct()
            ->whereNotNull('table')
            ->orderBy('table', OrderByCriteria::ORDER_ASC)
            ->pluck('table')
            ->toArray();
    }

    /**
     * @return string[]
     */
    public function getDistinctTypes(): array
    {
        return AdminLog::distinct()
            ->whereNotNull('type')
            ->orderBy('type', OrderByCriteria::ORDER_ASC)
            ->pluck('type')
            ->toArray();
    }

    public function findBy(
        array $criteria,
        ?string $orderBy = null,
        ?string $orderDirection = null,
        ?int $perPage = null,
        ?int $limit = null,
        ?int $offset = null
    ): LengthAwarePaginator|Collection {
        $search = $criteria['search'] ?? null;
        $type = $criteria['type'] ?? null;
        $userName = $criteria['userName'] ?? null;
        $table = $criteria['table'] ?? null;

        $queryBuilder = AdminLog::select('admin_logs.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'admin_logs.user_id');

        if ($search !== null && \trim($search) !== '') {
            $queryBuilder->where(function ($query) use ($search) {
                if (trim($search) !== "") {
                    $query->where('admin_logs.reg_name', 'LIKE', "%{$search}%")
                        ->orWhere('admin_logs.reg_id', 'LIKE', "%{$search}%")
                        ->orWhere('admin_logs.table', 'LIKE', "%{$search}%")
                        ->orWhere('admin_logs.id', 'LIKE', "%{$search}%")
                        ->orWhere('users.name', 'LIKE', "%{$search}%");
                }
            });
        }

        if ($type !== null && $type !== 'all') {
            $queryBuilder->where('admin_logs.type', $type);
        }

        if ($table !== null && $table !== 'all') {
            $queryBuilder->where('admin_logs.table', $table);
        }

        if ($userName !== null && $userName !== 'all') {
            $queryBuilder->where('users.name', 'LIKE', "%{$userName}%");
        }

        if ($orderBy !== null && $orderDirection !== null) {
            $queryBuilder->orderBy($orderBy, $orderDirection);
        }

        $queryBuilder->orderBy('admin_logs.id', 'desc');

        if ($limit !== null) {
            $queryBuilder->limit($limit);
        }

        if ($offset !== null) {
            $queryBuilder->offset($offset);
        }

        if ($perPage === null) {
            return $queryBuilder->get();
        }

        return $queryBuilder->paginate($perPage)->onEachSide(2);
    }

    /**
     * @param int[] $ids
     */
    public function findByIds(array $ids, ?string $orderBy = null, ?string $orderDirection = null): Collection
    {
        $queryBuilder = AdminLog::leftJoin('users', 'users.id', 'admin_logs.user_id')
            ->select('admin_logs.*', 'users.name as user_name')
            ->whereIn('admin_logs.id', $ids);

        if ($orderBy !== null && $orderDirection !== null) {
            $queryBuilder->orderBy($orderBy, $orderDirection);
        }

        return $queryBuilder->get();
    }
}
