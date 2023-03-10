<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SpeedControlEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $url = 'http://68.183.225.134:8004/account/validate/';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->url = $this->url . $token;
    }


    public function build()
    {
        return $this->view('email.email', ['token' => $this->url]);
    }
}
