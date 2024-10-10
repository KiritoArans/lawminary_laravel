<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\UserAccount;

class PostBookmarked extends Notification
{
    protected $bookmarker;
    protected $post;

    public function __construct(UserAccount $bookmarker, $post)
    {
        $this->bookmarker = $bookmarker;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'bookmarker_id' => $this->bookmarker->id, // Storing user ID only for later retrieval
            'post_id' => $this->post->post_id,
            'message' => "bookmarked your post.",
        ];
    }
}
