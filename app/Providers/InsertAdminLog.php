<?php

namespace App\Providers;

use App\Providers\TableWasSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
