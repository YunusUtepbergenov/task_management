<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatedResponseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $response;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($response)
    {
        $this->response = $response;
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
        $user = User::where('id', $this->response->task->user_id)->first();
        return [
            'name' => $this->response->task->name,
            'leader_name' => $user->name,
            'user_id' => $user->id,
            'task_id' => $this->response->task->id,
        ];
    }
}
