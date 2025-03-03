<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyContact extends Mailable
{
    use Queueable, SerializesModels;

    public $property;
    public $clientFirstname;
    public $clientName;
    public $clientPhone;
    public $clientEmail;
    public $content;

    /**
     * Create a new message instance.
     */
    public function __construct(Property $property, array $contact)
    {
        $this->property = $property;
        $this->clientFirstname = $contact['firstname'];
        $this->clientName = $contact['name'];
        $this->clientPhone = $contact['phone'];
        $this->clientEmail = $contact['mail'];
        $this->content = $contact['content'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Tuto Agence] Un client vous a contacté !'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
        );
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
