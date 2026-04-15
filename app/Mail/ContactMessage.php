<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Contact $contact
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
        // The sender remains your domain's mail service
            from: new Address('contact@mail.mbilal.ca', 'DevPulse Portfolio'),

            // This ensures the inquiry is sent directly to your new email
            to: [
                new Address('saqib@mbilal.ca', 'Saqib Bilal')
            ],

            // Allows you to hit 'Reply' and respond directly to the sender
            replyTo: [
                new Address($this->contact->email, $this->contact->name)
            ],

            subject: "Portfolio Inquiry from " . $this->contact->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact',
            with: [
                'name'  => $this->contact->name,
                'email' => $this->contact->email,
                'body'  => $this->contact->body,
            ],
        );
    }
}
