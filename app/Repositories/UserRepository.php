<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findOneById(int $id): ?User
    {
        return User::find($id);
    }
}
