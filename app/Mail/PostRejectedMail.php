<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $reason;

    public function __construct($post, $reason)
    {
        $this->post = $post;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('Your post has been rejected')->view(
            'emails.postRejected'
        );
    }
}
