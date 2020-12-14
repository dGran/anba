<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\User;

class Dashboard extends Component
{

    public function render()
    {
    	$last_users = User::whereNotNull('email_verified_at')->orderBy('created_at', 'desc')->take(8)->get();
        return view('admin.dashboard', [
        	'last_users' => $last_users
        ])->layout('adminlte::page');
    }
}
