<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class UserLoggedIn
{
    use Dispatchable;

    public User $user;
    public string $ip;

    public function __construct(User $user, string $ip)
    {
        $this->user = $user;
        $this->ip = $ip;
    }
}
