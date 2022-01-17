<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubmittedTaskNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $task;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user = User::where('id', $this->task->user_id)->first();
        return [
            'name' => $this->task->name,
            'leader_name' => $user->name,
            'task_id' => $this->task->id,
            'creator_id' => $user->id,
            'submitted_at' => $this->task->created_at
        ];
    }
}
