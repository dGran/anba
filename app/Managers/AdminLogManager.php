<?php

declare(strict_types=1);

namespace App\Managers;

use App\Enum\OrderByCriteria;
use App\Models\AdminLog;
use App\Repositories\AdminLogRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminLogManager
{
    private AdminLogRepository $repository;

    public function __construct(AdminLogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(): AdminLog
    {
        return new AdminLog();
    }

    public function save(AdminLog $adminLog): void
    {
        $adminLog->save();
    }

    public function update(AdminLog $adminLog): void
    {
        $adminLog->setUpdatedAt(new \DateTime());
        $adminLog->save();
    }

    public function findOneById(int $seasonId): ?AdminLog
    {
        return $this->repository->findOneById($seasonId);
    }

    /**
     * @return int[]
     */
    public function getDistinctUsers(): array
    {
        return $this->repository->getDistinctUsers();
    }

    /**
     * @return string[]
     */
    public function getDistinctTables(): array
    {
        return $this->repository->getDistinctTables();
    }

    /**
     * @return string[]
     */
    public function getDistinctTypes(): array
    {
        return $this->repository->getDistinctTypes();
    }

    public function commandFilter(
        ?string $search = null,
        ?string $type = null,
        ?string $userName = null,
        ?string $table = null,
        ?int $perPage = null,
        ?string $orderBy = null,
        ?string $orderDirection = OrderByCriteria::ORDER_ASC,
        ?int $offset = null,
        ?int $limit = null
    ): LengthAwarePaginator {
        $criteria = [];
        $criteria['search'] = $search;
        $criteria['type'] = $type;
        $criteria['userName'] = $userName;
        $criteria['table'] = $table;
        $criteria['perPage'] = $perPage;
        $criteria['orderBy'] = $orderBy;
        $criteria['orderDirection'] = $orderDirection;

        return $this->repository->findBy($criteria, $orderBy, $orderDirection, $perPage, $offset, $limit);
    }

    /**
     * @param int[] $ids
     */
    public function findByIds(array $ids, ?string $orderBy = null, ?string $orderDirection = null): Collection
    {
        return $this->repository->findByIds($ids, $orderBy, $orderDirection);
    }
}
