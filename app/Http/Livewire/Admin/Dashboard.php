<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
	public $search = "Campo de busqueda livewire";

    public function render()
    {
        return view('livewire.admin.dashboard')->layout('adminlte::page');
    }
}
