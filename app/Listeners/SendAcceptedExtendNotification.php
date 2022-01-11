<?php

namespace App\Listeners;

use App\Notifications\AcceptedExtendNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAcceptedExtendNotification
{

    public function handle($event)
    {
        Notification::send($event->task->user, new AcceptedExtendNotification($event->task));
    }
}
