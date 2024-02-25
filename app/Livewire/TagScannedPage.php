<?php

namespace App\Livewire;

use App\Data\LocationSharedDto;
use App\Data\ViewQrTagDto;
use App\Helpers\Translation\TranslationHelper;
use App\Models\QrTag;
use App\Notifications\LocationSharedNotification;
use Filament\Pages\SimplePage;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;

class TagScannedPage extends SimplePage
{
    protected static string $view = 'livewire.tag-scanned-page';
    protected static string $layout = 'components.layouts.tag-scanned-layout';
    public QrTag $tag;

    protected ?string $maxWidth = MaxWidth::FourExtraLarge->value;

    public function getTitle(): string|Htmlable
    {
        TranslationHelper::setTarget(request()->getPreferredLanguage());
        return TranslationHelper::translate('Thank you for scanning my QR code!');
    }

    public function getSubheading(): string|Htmlable|null
    {
        TranslationHelper::setTarget(request()->getPreferredLanguage());
        return TranslationHelper::translate('If you are seeing this, it means I have lost whatever I attached this QR code to. Please contact me if you have found it.');
    }

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
            qrTag: ViewQrTagDto::from($this->tag),
            latitude: $latitude,
            longitude: $longitude,
            accuracy: $accuracy,
        );

        $this->tag->user->notify(new LocationSharedNotification($data));
    }
}
