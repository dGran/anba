<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
    	$last_users = User::whereNotNull('email_verified_at')->orderBy('created_at', 'desc')->take(8)->get();
        $userIpLogs = DB::table('user_ip_logs')
            ->whereIn('user_id', function($query) {
                $query->select('user_id')
                    ->from('user_ip_logs')
                    ->groupBy('user_id')
                    ->havingRaw('COUNT(user_id) > 1');
            })
            ->get();

        return view('admin.dashboard', [
            'last_users' => $last_users,
            'userIpLogs' => $userIpLogs,
        ])->layout('adminlte::page');
    }
}
