<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class NotifyUser extends Mailable implements ShouldQueue 
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $message;
    public $email;
    public $attachmentsPaths;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name ,$email,$subject,$message,$attachmentsPaths)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message;
        $this->email = $email;
        $this->attachmentsPaths = $attachmentsPaths;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
        );
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
     * Get the attachments for the message.
     *
     * @return array
     */
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $message = $this->markdown('emails.notify')
        ->subject($this->subject);
        foreach ($this->attachmentsPaths as $path) {
        $message->attach(storage_path('app/' . $path));
        }

        return $message;
    }
}
