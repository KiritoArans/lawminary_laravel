<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CommentCreated implements ShouldBroadcast
{
    use SerializesModels;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn()
    {
        return new Channel('comments.' . $this->comment->post_id);  // Ensure this matches the channel in JS
    }

    public function broadcastWith()
    {
        return [
            'comment' => $this->comment->comment,
            'user_id' => $this->comment->user->user_id,
            'user_name' => $this->comment->user->firstName . ' ' . $this->comment->user->lastName,
            'user_photo_url' => $this->comment->user->userPhoto ? Storage::url($this->comment->user->userPhoto) : asset('imgs/user-img.png'),
        ];
    }
}