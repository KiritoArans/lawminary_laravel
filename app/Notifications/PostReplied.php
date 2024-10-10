<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\UserAccount;

class PostReplied extends Notification
{
    protected $replier;
    protected $reply;

    public function __construct(UserAccount $replier, $reply)
    {
        $this->replier = $replier; // The user who replied
        $this->reply = $reply; // The reply data
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'replier_id' => $this->replier->id, 
            'reply_id' => $this->reply->reply_id, // Comment ID
            'comment_id' => $this->reply->comment_id, // Comment ID
            'post_id' => $this->reply->post_id, // Post ID
            'message' => "replied to your comment",
        ];
    }
}