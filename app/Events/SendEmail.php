<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $to_email;
    public $user;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($to_email, $message,$user)
    {
        $this->to_email = $to_email;
        $this->message = $message;
        $this->user = $user;
    }
}
