<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Helpers\Notes\Filament\Pages\ManageRecordNotes;

class ManageUserNotes extends ManageRecordNotes
{
    protected static string $resource = UserResource::class;
}
