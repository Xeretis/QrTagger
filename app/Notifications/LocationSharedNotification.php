<?php

namespace App\Notifications;

use App\Data\LocationSharedDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocationSharedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public LocationSharedDto $locationSharedDto)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your item has been found!')
            ->markdown('emails.location-shared', [
                'tagName' => $this->locationSharedDto->qrTag->name,
                'latitude' => $this->locationSharedDto->latitude,
                'longitude' => $this->locationSharedDto->longitude,
                'accuracy' => $this->locationSharedDto->accuracy,
            ]);
    }

    public function toArray($notifiable): array
    {
        return [
            'qr_tag_id' => $this->locationSharedDto->qrTag->id,
            'latitude' => $this->locationSharedDto->latitude,
            'longitude' => $this->locationSharedDto->longitude,
            'accuracy' => $this->locationSharedDto->accuracy,
        ];
    }

    public function databaseType()
    {
        return 'location_shared';
    }
}
