<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Model\SuperAdmin\User\User;
use Carbon\Carbon;

class ChatNotification extends Notification
{
    use Queueable;
    private $receivedUser;
    private $sentUser;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $receivedUser, User $sentUser)
    {
        $this->receivedUser = $receivedUser;
        $this->sentUser = $sentUser;
        
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
        return [
            'type' => "Chat Message",
            'text' =>"New message from " . $this->sentUser->name, 
            'receiver_id' => $this->receivedUser->id,
            'sender_id' => $this->sentUser->id
        ];
    }
}
