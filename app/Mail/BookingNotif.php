<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingNotif extends Mailable
{
    use Queueable, SerializesModels;

    protected $bookingData;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->bookingData = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('hello@jjamtravelcebu.com', 'JJAMTRAVELCEBU.COM'),
            subject: $this->bookingData->fullname . ' just booked a reservation 👍',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.bookingnotif',
            with: [
                'data' => $this->bookingData,
            ]
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