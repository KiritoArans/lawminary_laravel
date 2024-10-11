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
    protected $comment;
    protected $rating;

    public function __construct(UserAccount $rater, $comment, $rating)
    {
        $this->rater = $rater;
        $this->comment = $comment;
        $this->rating = $rating;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'rater_id' => $this->rater->id, // Storing the rater's user ID
            'comment_id' => $this->comment->comment_id,
            'rating' => $this->rating,
            'message' => "rated your comment.",
        ];
    }
}
