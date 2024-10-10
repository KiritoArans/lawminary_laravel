<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\UserAccount;

class PostLiked extends Notification
{
    protected $liker;
    protected $post;

    public function __construct(UserAccount $liker, $post)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'liker_id' => $this->liker->id, // Storing user ID only for later retrieval
            'post_id' => $this->post->post_id,
            'message' => "liked your post.",
        ];
    }
}
