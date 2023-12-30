<?php

namespace App\Mail;

use App\Models\QrTag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LocationSharedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public QrTag $tag, public float $longitude, public float $latitude, public float $accuracy)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Location Shared',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.location-shared',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
