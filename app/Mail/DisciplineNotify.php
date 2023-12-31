<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DisciplineNotify extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $email;
    public $subject;
    public $message;
    public $attachmentsPaths;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$subject,$message,$attachmentsPaths)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->attachmentsPaths = $attachmentsPaths;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

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
    public function attachments()
    {
        return [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $message = $this->markdown('emails.discipline')
        ->subject($this->subject);
        foreach ($this->attachmentsPaths as $path) {
        $message->attach(storage_path('app/' . $path));
        }

        return $message;
    }
}
