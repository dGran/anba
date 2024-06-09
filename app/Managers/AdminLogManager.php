<?php

declare(strict_types=1);

namespace App\Managers;

use App\Models\AdminLog;
use App\Repositories\AdminLogRepository;

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
    public function getDistinctUserIds(): array
    {
        return $this->repository->getDistinctUserIds();
    }

    /**
     * @return int[]
     */
    public function getDistinctTables(): array
    {
        return $this->repository->getDistinctTables();
    }

    public function findByUserIdAndTypeAndTable()
    {
        $regs = AdminLog::select('admin_logs.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'admin_logs.user_id')
            ->where(function ($query) {
                if (trim($this->search) !== "") {
                    $query->where('admin_logs.reg_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('admin_logs.reg_id', 'LIKE', "%{$this->search}%")
                        ->orWhere('admin_logs.table', 'LIKE', "%{$this->search}%")
                        ->orWhere('admin_logs.id', 'LIKE', "%{$this->search}%");
                }
            })
            ->when($this->filterType, function ($query) {
                $query->where('admin_logs.type', $this->filterType);
            })
            ->when($this->filterUser, function ($query) {
                $query->where('admin_logs.user_id', $this->filterUser);
            })
            ->when($this->filterTable, function ($query) {
                $query->where('admin_logs.table', $this->filterTable);
            })
            ->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
            ->orderBy('admin_logs.id', 'desc')
            ->paginate($this->perPage)->onEachSide(2);
    }
}
