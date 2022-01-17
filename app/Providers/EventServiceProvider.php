<?php

namespace App\Providers;

use App\Events\CommentStoredEvent;
use App\Events\ExtendDeadlineAcceptedEvent;
use App\Events\ExtendDeadlineEvent;
use App\Events\ExtendDeadlineRejectedEvent;
use App\Events\ResponseUpdatedEvent;
use App\Events\TaskCreatedEvent;
use App\Events\TaskSubmittedEvent;
use App\Events\TaskUpdatedEvent;
use App\Listeners\SendAcceptedExtendNotification;
use App\Listeners\SendCommentStoredNotification;
use App\Listeners\SendExtendDeadlineNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendNewTaskNotification;
use App\Listeners\SendRejectedExtendNotification;
use App\Listeners\SendSubmittedTaskNotification;
use App\Listeners\SendUpdatedResponseNotification;
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
        ],
        ResponseUpdatedEvent::class => [
            SendUpdatedResponseNotification::class,
        ],
        ExtendDeadlineEvent::class => [
            SendExtendDeadlineNotification::class,
        ],
        ExtendDeadlineAcceptedEvent::class => [
            SendAcceptedExtendNotification::class,
        ],
        ExtendDeadlineRejectedEvent::class => [
            SendRejectedExtendNotification::class,
        ],
        CommentStoredEvent::class => [
            SendCommentStoredNotification::class,
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
