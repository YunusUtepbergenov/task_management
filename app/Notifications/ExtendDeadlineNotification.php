<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExtendDeadlineNotification extends Notification
{
    use Queueable;
    private $task, $deadline;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task, $deadline)
    {
        $this->task = $task;
        $this->deadline = $deadline;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $user = User::find($this->task->user_id)->first();
        return [
            'task_id' => $this->task->id,
            'new_deadline' => $this->deadline,
            'old_deadline'=> $this->task->deadline,
            'leader_name' => $user->name,
        ];
    }
}
