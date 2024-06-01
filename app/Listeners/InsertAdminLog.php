<?php

namespace App\Listeners;

use App\Events\TableWasUpdated;

use App\Models\AdminLog;

class InsertAdminLog
{
    public function handle(TableWasUpdated $event): void
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
