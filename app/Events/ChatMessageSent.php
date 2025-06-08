<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Message $message)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $senderId = $this->message->user_id;
        $messagable = $this->message->messagable;

        $recipientId = $messagable->user_one_id == $senderId
            ? $messagable->user_two_id
            : $messagable->user_one_id;
        $this->message->messagable->load(['userOne', 'userTwo']);
        $this->message->load('replied');


        return [
            new PrivateChannel("users.{$recipientId}"),
            new PrivateChannel("users.{$senderId}"),
            new PrivateChannel("chats.{$this->message->messagable->id}"),
        ];
    }
}
