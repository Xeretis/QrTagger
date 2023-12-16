<?php

namespace App\Filament\User\Resources\QrTagResource\Pages;

use App\Filament\User\Resources\QrTagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQrTags extends ListRecords
{
    protected static string $resource = QrTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
