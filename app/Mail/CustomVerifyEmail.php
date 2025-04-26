<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $user;

    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Verify Your Email Address')
            ->view('login.emails.custom-verify-email')
            ->with([
                'user' => $this->user,
                'verificationUrl' => $this->url,
            ]);
    }
}
