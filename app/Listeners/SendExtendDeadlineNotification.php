<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\ExtendDeadlineNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendExtendDeadlineNotification
{

    public function handle($event)
    {
        $creator = User::find($event->task->creator_id);
        Notification::send($creator, new ExtendDeadlineNotification($event->task, $event->deadline));
    }
}
