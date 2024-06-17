<?php

namespace App\Notifications\File;

use App\Models\Model\SuperAdmin\File\File;
use App\Models\Model\SuperAdmin\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FileReviewNotification extends Notification
{
    use Queueable;
    private $receivedUser;
    private $sentUser;
    private $latestFile;
    /**
     * Create a new notification instance.
     *
     * @return void
     */


    public function __construct(User $receivedUser, User $sentUser, File $latestFile)
    {    
        $this->receivedUser = $receivedUser;
        $this->sentUser = $sentUser;
        $this->latestFile = $latestFile;

        
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'type' => "File Reviewed",
            'text' =>"File reviewed by " . $this->sentUser->name, 
            'receiver_id' => $this->receivedUser->id,
            'sender_id' => $this->sentUser->id,
            'file_id' => $this->latestFile->id
        ];
    }
}
