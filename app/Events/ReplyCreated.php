<?php

namespace App\Events;

use App\Models\Reply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ReplyCreated implements ShouldBroadcast
{
    use SerializesModels;

    public $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function broadcastOn()
    {
        return new Channel('replies.' . $this->reply->comment_id);  // Broadcast on the correct comment channel
    }

    public function broadcastWith()
    {
        return [
            'reply' => $this->reply->reply,
            'user_id' => $this->reply->user->user_id,
            'user_name' => $this->reply->user->firstName . ' ' . $this->reply->user->lastName,
            'user_photo_url' => $this->reply->user->userPhoto ? Storage::url($this->reply->user->userPhoto) : asset('imgs/user-img.png'),
        ];
    }
}
