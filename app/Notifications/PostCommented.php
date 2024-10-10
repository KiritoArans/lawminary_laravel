<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\UserAccount;

class PostCommented extends Notification
{
    protected $commenter;
    protected $comment;

    public function __construct(UserAccount $commenter, $comment)
    {
        $this->commenter = $commenter; 
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'commenter_id' => $this->commenter->id, // ID of the user who commented
            'comment_id' => $this->comment->comment_id, // Comment ID
            'post_id' => $this->comment->post_id, // Post ID
            'message' => "commented on your post",
        ];
    }
}
