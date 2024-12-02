<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogUserIp
{
    public function handle(UserLoggedIn $event): void
    {
        $user = $event->user;
        $ip = $event->ip;

        try {
            $dateLoginLogThreshold  = Carbon::now()->subSeconds(20);
            $existsRecentLoginLog = DB::table('user_ip_logs')
                ->where('user_id', $user->id)
                ->where('ip', $ip)
                ->where('date_last_login', '>=', $dateLoginLogThreshold )
                ->exists();

            if ($existsRecentLoginLog) {
                return;
            }

            DB::table('user_ip_logs')->updateOrInsert(
                ['user_id' => $user->id, 'ip' => $ip],
                [
                    'date_last_login' => now(),
                    'counter' => DB::raw('IFNULL(counter, 0) + 1'),
                ]
            );
        } catch (\Throwable $exception) {
            Log::error(
                'Error al logear la IP del usuario',
                [
                    'user_id' => $user->id,
                    'ip' => $ip,
                    'exception' => $exception->getMessage(),
                ]
            );
        }
    }
}
