<?php

namespace App\Livewire;

use App\Models\QrTag;
use Filament\Pages\SimplePage;

class TagScannedPage extends SimplePage
{
    public static ?string $title = 'Thank you for scanning my QR code!';

    protected static string $view = 'livewire.tag-scanned-page';
    protected static string $layout = 'components.layouts.tag-scanned-layout';
    public ?string $subheading = 'If you are seeing this, it means I have lost whatever I attached this QR code to. Please contact me if you have found it.';
    
    public QrTag $tag;

    public function mount(QrTag $tag): void
    {
        $this->tag = $tag;
    }
}
