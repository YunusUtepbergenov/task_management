<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewTaskNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNewTaskNotification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->task->user, new NewTaskNotification($event->task));
    }
}
