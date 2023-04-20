<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // Generate the message envelope.
    public function envelope(): Envelope
    {
        $tenant = app('currentTenant');
        $from = 'contact-' . $tenant->slug . '@' . config('sightcms.mail_domain');
        $fromName = config('preferences.identity.name');
        $subject = $fromName . ' Contact Form: ' . $this->data['subject'];

        return new Envelope(
            from: new Address($from, $fromName),
            subject: $subject,
            replyTo: [
                new Address($this->data['email'])
            ]
        );
    }

    // Generate the message content.
    // Pass the raw message (not using any views or formatting).
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'preheader' => 'You have a new contact message from ' . $this->data['email'] . '.',
                'content' => $this->data['message'],
                'identityTitle' => config('preferences.identity.name')
            ],
        );
    }
}
