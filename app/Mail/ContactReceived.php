<?php
namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReceived extends Mailable
{
    use Queueable, SerializesModels;

    // We define the property so it's accessible within the class
    public Contact $contact;

    /**
     * Pass the Contact model into the constructor
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
        // Use the sender's name in the subject for better visibility
            subject: 'Portfolio Inquiry: ' . $this->contact->name,
            replyTo: [$this->contact->email], // Allows you to hit 'Reply' in your email client
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-received',
            with: [
                'name'    => $this->contact->name,
                'email'   => $this->contact->email,
                'message_body' => $this->contact->body, // Changed 'body' to 'message' to match your DB column
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
