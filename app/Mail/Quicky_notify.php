<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Quicky_notify extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $name;
    public $password;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$name,$password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quickyNotify')
            ->subject('Rwanda Bar Association Comminication');
    }
}
