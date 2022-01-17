<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentStoredNotification extends Notification implements ShouldQueue
{
    use Queueable;
    private $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
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
        $user = User::where('id', $this->comment->user_id)->first();
        return [
            'task_id' => $this->comment->task->id,
            'task_name' => $this->comment->task->name,
            'creator_name' => $user->name,
            'creator_id' => $user->id,
            'created_at' => $this->comment->created_at
        ];
    }
}
