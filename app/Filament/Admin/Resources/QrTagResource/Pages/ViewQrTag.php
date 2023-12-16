<?php

namespace App\Filament\Admin\Resources\QrTagResource\Pages;

use App\Filament\Admin\Resources\QrTagResource;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Attributes\On;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ViewQrTag extends ViewRecord
{
    protected static string $resource = QrTagResource::class;

    #[On('qr-code-png-download-requested')]
    public function downloadQrCode(string $secret)
    {
        return response()->streamDownload(
            function () use ($secret) {
                echo QrCode::size(512)
                    ->format('png')
                    ->margin(2)
                    ->generate($secret);
            },
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }

    #[On('qr-code-svg-download-requested')]
    public function downloadQrCodeSvg(string $secret)
    {
        return response()->streamDownload(
            function () use ($secret) {
                echo QrCode::format('svg')
                    ->margin(2)
                    ->generate($secret);
            },
            'qr-code.svg',
            [
                'Content-Type' => 'image/svg+xml',
            ]
        );
    }
}
