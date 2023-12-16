<?php

namespace App\Filament\Admin\Resources\QrTagResource\Pages;

use App\Filament\Admin\Resources\QrTagResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListQrTags extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = QrTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            QrTagResource\Pages\Widgets\QrTagDeletedChart::class,
            QrTagResource\Pages\Widgets\QrTagCreatedChart::class
        ];
    }
}
