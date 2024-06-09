<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enum\Criteria;
use App\Models\User;

class UserRepository
{
    public function findOneById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param int[] $ids
     *
     * @return User[]
     */
    public function findNamesByIdsIndexedById(array $ids, ?string $orderByField = null, string $orderDirection = Criteria::ASC): array
    {
        $query = User::whereIn('id', $ids);

        if ($orderByField) {
            $query->orderBy($orderByField, $orderDirection);
        }

        return $query->pluck('name', 'id')->toArray();
    }
}
