<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $notificationCount;
    public $userId;

    public function __construct($notificationCount, $userId)
    {
        $this->notificationCount = $notificationCount;
        $this->userId = $userId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('notifications.' . $this->userId);
    }

    public function broadcastWith()
    {
        return ['notificationCount' => $this->notificationCount];
    }
}
