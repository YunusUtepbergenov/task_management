<?php

namespace App\Listeners;

use App\Notifications\RejectedExtendNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendRejectedExtendNotification
{
    public function handle($event)
    {
        Notification::send($event->task->user,new RejectedExtendNotification($event->task));
    }
}
