<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\UserAccount;
use App\Models\Posts;

class PostApproved extends Notification
{
    use Queueable;

    protected $post;
    protected $approver;

    public function __construct($post, $approver)
    {
        $this->post = $post;
        $this->approver = $approver;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->post_id,
            'approver_id' => $this->approver->id,
            'message' => "A post related to your expertise waiting to be advised.",
        ];
    }
}