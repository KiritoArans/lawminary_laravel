<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RestrictionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $restrictDays;
    public $isBlocked;

    public function __construct($username, $restrictDays, $isBlocked = false)
    {
        $this->username = $username;
        $this->restrictDays = $restrictDays;
        $this->isBlocked = $isBlocked;
    }

    public function build()
    {
        return $this->subject('Account Restriction Notification')->view(
            'emails.restriction_notification'
        );
    }
}
