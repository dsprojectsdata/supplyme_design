<?php

namespace App\Events;

use App\Models\Conversation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conversation;

    public $html;

    public $doc;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Conversation $conversation, $message, $doc)
    {
        $this->conversation = $conversation;

        $this->html = $message;

        $this->doc = $doc;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('groups.' . $this->conversation->group->id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->conversation->id
        ];
    }
}
