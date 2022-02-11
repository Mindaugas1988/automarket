<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class LikedNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public  $message;
    public function __construct($message)
    {
        //
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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


    public function toDatabase($notifiable)
    {
        return [
            'url' =>$this->message->url,
            'icon' => 'fas fa-thumbs-up',
            'text'=> [
                'en'=> trans('custom.notifications.like',[], 'en'),
                'lt'=> trans('custom.notifications.like',[], 'lt'),
                'ru'=> trans('custom.notifications.like',[], 'ru'),
            ],
        ];
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
            //
        ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'url' =>$this->message->url,
            'icon' => 'fas fa-thumbs-up',
            'text'=> [
                'en'=> trans('custom.notifications.like',[], 'en'),
                'lt'=> trans('custom.notifications.like',[], 'lt'),
                'ru'=> trans('custom.notifications.like',[], 'ru'),
            ],
        ]);
    }
}
