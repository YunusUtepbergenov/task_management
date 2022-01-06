<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SubmittedTaskNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendSubmittedTaskNotification
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $creator = User::find($event->task->creator_id);
        Notification::send($creator, new SubmittedTaskNotification($event->task));
    }
}
