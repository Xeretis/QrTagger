<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use App\Helpers\Notes\Filament\Pages\ManageRecordNotes;

class ManageUserNotes extends ManageRecordNotes
{
    protected static string $resource = UserResource::class;
}
