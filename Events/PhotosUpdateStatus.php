<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PhotosUpdateStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $images = '';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($value)
    {
        //
        $this->images = $value;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('images');
        //return new PrivateChannel('channel-name');
    }
}
