<?php

declare(strict_types=1);

namespace App\Managers;

use App\Enum\OrderByCriteria;
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

    /**
     * @return AdminLog[]
     */
    public function commandFilter(
        ?string $search = null,
        ?string $type = null,
        ?int $userId = null,
        ?string $table = null,
        ?int $perPage = null,
        ?string $orderBy = null,
        ?string $orderDirection = OrderByCriteria::ORDER_ASC,
        ?int $offset = null,
        ?int $limit = null
    ): array {
        // TODO: para sustituir los scopes por este filtro completo de la tabla
        // adaptar a cada tabla con todos los campos que usen scope
        // si tienen perPage una respuesta sino otra
        // probar con AdminLog y si es buena solucion adaptar el resto de tablas

        $criteria = [];

        if ($search !== null) {
            $criteria['search'] = $search;
        }

        if ($type !== null) {
            $criteria['type'] = $type;
        }

        if ($userId !== null) {
            $criteria['userId'] = $userId;
        }

        if ($table !== null) {
            $criteria['table'] = $table;
        }

        if ($perPage !== null) {
            $criteria['perPage'] = $perPage;
        }

        if ($orderBy !== null) {
            $criteria['orderBy'] = $orderBy;
        }

        if ($orderDirection !== null) {
            $criteria['orderDirection'] = $orderDirection;
        }

        return $this->repository->findBy($criteria, $orderBy, $orderDirection, $offset, $limit);
    }
}
