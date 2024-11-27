<?php

namespace App\Providers;

use App\Events\UserLoggedIn;
use App\Listeners\LogUserIp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\TableWasUpdated;
use App\Listeners\InsertAdminLog;
use App\Events\PostStored;
use App\Listeners\SendPostNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TableWasUpdated::class => [
            InsertAdminLog::class,
        ],
        PostStored::class => [
            SendPostNotification::class,
        ],
        UserLoggedIn::class => [
            LogUserIp::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
