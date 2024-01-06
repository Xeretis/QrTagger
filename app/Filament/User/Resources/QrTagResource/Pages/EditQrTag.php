<?php

namespace App\Filament\User\Resources\QrTagResource\Pages;

use App\Filament\User\Resources\QrTagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQrTag extends EditRecord
{
    protected static string $resource = QrTagResource::class;

    public function mount(int|string $record): void
    {
        $tag = $this->resolveRecord($record);

        abort_unless($tag->user_id === auth()->id(), 403);

        $this->record = $tag;

        $this->authorizeAccess();

        $this->fillForm();

        $this->previousUrl = url()->previous();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
