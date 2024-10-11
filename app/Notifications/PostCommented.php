<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\UserAccount;

class PostCommented extends Notification
{
    protected $commenter;
    protected $post;
    protected $comment;

    public function __construct(UserAccount $commenter, $post, $comment)
    {
        $this->commenter = $commenter;
        $this->post = $post;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'commenter_id' => $this->commenter->id, // Storing commenter user ID for later retrieval
            'post_id' => $this->post->post_id,
            'comment_id' => $this->comment->comment_id, // Storing the comment ID
            'message' => "commented on your post.",
        ];
    }
}