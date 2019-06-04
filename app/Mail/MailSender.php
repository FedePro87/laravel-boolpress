<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailSender extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $description;
    public $username;
    public $mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$description,$username,$mail)
    {
        $this->title=$title;
        $this->description=$description;
        $this->username=$username;
        $this->mail=$mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.test-mail');
    }
}
