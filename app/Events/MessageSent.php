<?php

namespace App\Events;



use App\User;
use App\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * user that sent the message
     *
     * @var User
     */
    public $user;
    /**
     * chat where sent the message
     *
     * @var String
     */
    public $chat;


    /**
     * Message details
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Message $message,$chat)
    {
        $this->user = $user;
        $this->message = $message;
        $this->chat = $chat;

    }


    public function broadcastOn(){

        return ['chat.'.$this->chat];
    }

    public function broadcastWith() // payload data to send
    {
        return ['user'=>$this->user, 'message'=> $this->message];
    }

    public function broadcastAs() // event name on client
    {

        return 'MessageSent';
    }
}
