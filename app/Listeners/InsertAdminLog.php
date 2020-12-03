<?php

namespace App\Listeners;

use App\Events\TableWasSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\AdminLog;

class InsertAdminLog
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
     * @param  TableWasSaved  $event
     * @return void
     */
    public function handle(TableWasSaved $event)
    {
        $table = $event->reg->getTable();

        $log = new AdminLog;
        $log->user_id = auth()->id();
        $log->table = $table;
        $log->reg_id = $event->reg->id;
        $log->type = "INSERT";
        $log->description = 'Registro insertado "' . $event->title . '"';
        if ($event->description) {
            $log->description .= " - " . $event->description;
        }

        $log->save();
    }
}
