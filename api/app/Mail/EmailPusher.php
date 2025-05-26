<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPusher extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        // store the payloads in constructor
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), 'Sips & Sparks'),
            subject: $this->data['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $data = $this->data;
        if ($data['type'] == 'contactus-business') {
            return new Content(view: 'mail.contactus-business', with: $data);
        } else if ($data['type'] == 'contactus-admin') {
            return new Content(view: 'mail.contactus-admin', with: $data);
        } else if ($data['type'] == 'matchup_result') {
            return new Content(view: 'mail.matchup-result', with: $data);
        } else if ($data['type'] == 'matchup_result_final') {
            return new Content(view: 'mail.matchup-result-final', with: $data);
        } else if ($data['type'] == 'feedback') {
            return new Content(view: 'mail.feedback', with: $data);
        }
        // return new Content(
        //     view: 'view.name',
        // );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
