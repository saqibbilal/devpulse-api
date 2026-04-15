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
        public Contact $contact // <--- 2. TYPE HINT THE MODEL
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
        // Pulls MAIL_FROM_ADDRESS and MAIL_FROM_NAME from your config
            from: new Address(
                config('mail.from.address'),
                config('mail.from.name')
            ),

            // Keeps the reply-to as the person who filled out the form
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
            // Data passed here is available in your Blade view as $name, $email, etc.
            with: [
                'name'  => $this->contact->name,
                'email' => $this->contact->email,
                'body'  => $this->contact->body, // Matches your DB 'body' column
            ],
        );
    }
}
