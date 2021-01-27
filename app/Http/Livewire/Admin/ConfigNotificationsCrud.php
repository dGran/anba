<?php

namespace App\Http\Livewire\Admin;

use App\Models\Config;
use Livewire\Component;

use App\Events\TableWasUpdated;

class ConfigNotificationsCrud extends Component
{
	//fields
	public $active_notifications, $notifications_test_mode;

	public function mount()
	{
    	$config = Config::first();
    	if (!$config) {
    		$config = Config::create([
    			'active_notifications' => true,
    			'notifications_test_mode' => false,
    		]);
    	}
		$this->active_notifications = $config->active_notifications;
		$this->notifications_test_mode = $config->notifications_test_mode;
	}

	public function update()
	{
		$config = Config::first();

		$config->active_notifications = $this->active_notifications;
		$config->notifications_test_mode = $this->notifications_test_mode;
		if ($config->update()) {
    		session()->flash('success', 'Configuración actualizada correctamente.');
		}
	}

    // Render
    public function render()
    {
        return view('admin.config.notifications', [
        		])->layout('adminlte::page');
    }
}