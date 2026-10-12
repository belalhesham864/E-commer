<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactUsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $contact;
    public function __construct($contact)
    {
        $this->contact=$contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','broadcast','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('New Contact Message')
        ->greeting('Hello Admin,')
        ->line('You have received a new contact message.')
        ->line('Name: ' . $this->contact->name)
        ->line('Email: ' . $this->contact->email)
        ->line('Phone: ' . $this->contact->phone)
        ->line('Subject: ' . $this->contact->subject)
        ->line('Message: ' . $this->contact->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function notificationData(){
           return [
            'contact_id'=>$this->contact->id,
            'user_id' => $this->contact->user_id,
            'user_name' => $this->contact->name,
            'user_email' => $this->contact->email,
            'user_phone' => $this->contact->user_phone,
            'subject' => $this->contact->subject,
            'message' => 'your resever new contact',
            'created_at' => now()->toDateString(),
        ];
    }
    public function toArray(): array
    {
        return $this->notificationData();
    }
    public function toBroadcast(): BroadcastMessage
{
        return new BroadcastMessage($this->notificationData());

}
    public function databaseType(): string
    {
        return 'ContactUsNotification';
    }
    public function broadcastType(): string
    {
        return 'ContactUsNotification';
    }
}
