<?php

namespace App\Filament\User\Resources\QrTagResource\Pages;

use App\Filament\User\Resources\QrTagResource;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Attributes\On;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ViewQrTag extends ViewRecord
{
    protected static string $resource = QrTagResource::class;

    public function mount(int|string $record): void
    {
        $tag = $this->resolveRecord($record);

        abort_unless($tag->user_id === auth()->id(), 403);

        $this->record = $tag;

        $this->authorizeAccess();
    }

    #[On('qr-code-png-download-requested')]
    public function downloadQrCode(string $secret): StreamedResponse
    {
        return response()->streamDownload(
            function () use ($secret) {
                echo QrCode::size(512)
                    ->errorCorrection('H')
                    ->format('png')
                    ->margin(2)
                    ->generate(route('tag-scanned', ['tag' => $secret]));
            },
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }

    #[On('qr-code-svg-download-requested')]
    public function downloadQrCodeSvg(string $secret): StreamedResponse
    {
        return response()->streamDownload(
            function () use ($secret) {
                echo QrCode::format('svg')
                    ->errorCorrection('H')
                    ->margin(2)
                    ->generate(route('tag-scanned', ['tag' => $secret]));
            },
            'qr-code.svg',
            [
                'Content-Type' => 'image/svg+xml',
            ]
        );
    }
}
