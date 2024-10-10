<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\UserAccount;

class CommentRated extends Notification
{
    protected $rater;
    protected $post;

    public function __construct(UserAccount $rater, $post)
    {
        $this->rater = $rater;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'rater_id' => $this->rater->id, // Storing user ID only for later retrieval
            'post_id' => $this->post->post_id,
            'message' => "bookmarked your post.",
        ];
    }
}
