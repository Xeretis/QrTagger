<?php

namespace App\Filament\User\Resources\QrTagResource\Pages;

use App\Filament\User\Resources\QrTagResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateQrTag extends CreateRecord
{
    protected static string $resource = QrTagResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['secret'] = Str::random();

        return auth()->user()->qrTags()->create($data);
    }
}
