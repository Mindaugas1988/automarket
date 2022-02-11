<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class MarkAdvert extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public  $advert;
    public function __construct($advert)
    {
        //
        $this->advert = $advert;
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
            'url' => route('advert',['category'=> $this->advert->category,'item'=> $this->advert->id]),
            'icon' => 'fas fa-heart',
            'text'=> [
                'en'=> trans('custom.notifications.mark',[], 'en'),
                'lt'=> trans('custom.notifications.mark',[], 'lt'),
                'ru'=> trans('custom.notifications.mark',[], 'ru'),
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
            'url' => route('advert',['category'=> $this->advert->category,'item'=> $this->advert->id]),
            'icon' => 'fas fa-heart',
            'text'=> [
                'en'=> trans('custom.notifications.mark',[], 'en'),
                'lt'=> trans('custom.notifications.mark',[], 'lt'),
                'ru'=> trans('custom.notifications.mark',[], 'ru'),
            ],
        ]);
    }
}
