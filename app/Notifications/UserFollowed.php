<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\UserAccount;

class UserFollowed extends Notification
{
    protected $follower;

    public function __construct(UserAccount $follower)
    {
        $this->follower = $follower;
    }

    public function via($notifiable)
    {
        return ['database']; 
    }

    public function toDatabase($notifiable)
    {
        return [
            'follower_id' => $this->follower->id, 
            'message' => "started following you.",
        ];
    }
}
