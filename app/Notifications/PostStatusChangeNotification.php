<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PostStatusChangeNotification extends Notification
{
    use Queueable;

    protected $postId;
    protected $status;
    protected $reason;

    public function __construct($postId, $status, $reason = null)
    {
        $this->postId = $postId;
        $this->status = $status;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->postId,
            'status' => $this->status,
            'message' => "Your post has been {$this->status}.",
            'reason' => $this->status === 'Rejected' ? $this->reason : null,
        ];
    }
}
