<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\DB;

class LogUserIp
{
    public function handle(UserLoggedIn $event): void
    {
        $user = $event->user;
        $ip = $event->ip;

        DB::table('user_ip_logs')->updateOrInsert(
            ['user_id' => $user->id, 'ip' => $ip],
            [
                'date_last_login' => now(),
                'counter' => DB::raw('IFNULL(counter, 0) + 1'),
            ]
        );
    }
}
