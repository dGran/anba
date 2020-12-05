<?php

namespace App\Listeners;

use App\Events\TableWasUpdated;
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
    public function handle(TableWasUpdated $event)
    {
        AdminLog::create([
            'user_id' => auth()->id(),
            'type' => strtoupper($event->type),
            'table' => $event->table->getTable(),
            'reg_id' => $event->table->id,
            'reg_name' => $event->table->getName(),
            'detail' => $event->detail,
            'detail_before' => $event->detail_before
        ]);
    }
}
