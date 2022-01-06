<?php

namespace App\Providers;

use App\Events\TaskCreatedEvent;
use App\Events\TaskSubmittedEvent;
use App\Events\TaskUpdatedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendNewTaskNotification;
use App\Listeners\SendSubmittedTaskNotification;
use App\Listeners\SendUpdatedTaskNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        TaskCreatedEvent::class => [
            SendNewTaskNotification::class,
        ],
        TaskUpdatedEvent::class => [
            SendUpdatedTaskNotification::class,
        ],
        TaskSubmittedEvent::class => [
            SendSubmittedTaskNotification::class,
        ]
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
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
