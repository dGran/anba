<?php

declare(strict_types=1);

namespace App\Managers;

use App\Enum\Criteria;
use App\Models\User;
use App\Repositories\UserRepository;

class UserManager
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(): User
    {
        return new User();
    }

    public function save(User $seasonTeam): void
    {
        $seasonTeam->save();
    }

    public function update(User $seasonTeam): void
    {
        $seasonTeam->setUpdatedAt(new \DateTime());
        $seasonTeam->save();
    }

    public function findOneById(int $seasonId): ?User
    {
        return $this->repository->findOneById($seasonId);
    }

    /**
     * @param int[] $ids
     *
     * @return User[]
     */
    public function findNamesByIdsIndexedById(array $ids, ?string $orderByField = null, string $orderDirection = Criteria::ASC): array
    {
        return $this->repository->findNamesByIdsIndexedById($ids);
    }
}
