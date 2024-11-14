<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PostRequiresLawyerAttentionNotification extends Notification
{
    use Queueable;

    protected $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

   public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->post_id,
            'message' => "A post requires your attention: {$this->post->concern}",
            'status' => 'Pending Lawyer Comment',
            'post_created_at' => $this->post->created_at,  // Ensure this contains the correct timestamp
        ];
    }
}
