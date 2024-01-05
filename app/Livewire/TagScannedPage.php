<?php

namespace App\Livewire;

use App\Data\LocationSharedDto;
use App\Data\QrTagDto;
use App\Mail\LocationSharedMail;
use App\Models\QrTag;
use App\Notifications\LocationSharedNotification;
use Filament\Pages\SimplePage;
use Filament\Support\Enums\MaxWidth;

class TagScannedPage extends SimplePage
{
    public static ?string $title = 'Thank you for scanning my QR code!';

    protected static string $view = 'livewire.tag-scanned-page';
    protected static string $layout = 'components.layouts.tag-scanned-layout';
    public ?string $subheading = 'If you are seeing this, it means I have lost whatever I attached this QR code to. Please contact me if you have found it.';
    public QrTag $tag;

    protected ?string $maxWidth = MaxWidth::FourExtraLarge->value;

    public function mount(QrTag $tag): void
    {
        $this->tag = $tag;
    }

    public function hasLogo(): bool
    {
        return false;
    }

    public function sendLocation(float $latitude, float $longitude, float $accuracy): void
    {
        $data = new LocationSharedDto(
            qrTag: QrTagDto::createFromQrTag($this->tag),
            latitude: $latitude,
            longitude: $longitude,
            accuracy: $accuracy,
        );

        $this->tag->user->notify(new LocationSharedNotification($data));
    }
}