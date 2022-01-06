<?php

namespace App\Listeners;

use App\Notifications\UpdatedTaskInformation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUpdatedTaskNotification
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->task->user, new UpdatedTaskInformation($event->task));
    }
}
