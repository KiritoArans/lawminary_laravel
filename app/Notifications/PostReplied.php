<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\UserAccount;

class PostReplied extends Notification
{
    protected $replier;
    protected $comment;
    protected $reply;

    public function __construct(UserAccount $replier, $comment, $reply)
    {
        $this->replier = $replier;
        $this->comment = $comment;
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'replier_id' => $this->replier->id, // Storing replier user ID for later retrieval
            'comment_id' => $this->comment->comment_id,
            'reply_id' => $this->reply->reply_id,
            'message' => "replied to your comment.",
        ];
    }
}
