<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SubmittedTaskNotification;
use App\Notifications\UpdatedResponseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUpdatedResponseNotification
{

    public function handle($event)
    {
        $creator = User::find($event->response->task->creator_id);
        Notification::send($creator, new UpdatedResponseNotification($event->response));
    }
}
