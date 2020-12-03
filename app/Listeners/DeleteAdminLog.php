<?php

namespace App\Listeners;

use App\Events\RegWasDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\AdminLog;

class DeleteAdminLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RegWasDeleted  $event
     * @return void
     */
    public function handle(RegWasDeleted $event)
    {
        $table = $event->reg->getTable();

        $log = new AdminLog;
        $log->user_id = auth()->id();
        $log->table = $table;
        $log->reg_id = $event->reg->id;
        $log->type = "DELETE";
        $log->description = 'Registro "' . $event->title . '" eliminado';
        if ($event->description) {
            $log->description .= " - " . $event->description;
        }

        $log->save();
    }
}
