<?php

namespace App\Filament\Resources;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Table;
use Z3d0X\FilamentLogger\Resources\ActivityResource as BaseResource;

class ActivityResource extends BaseResource
{
    public static function getNavigationGroup(): ?string
    {
        return 'Logs';
    }

    public static function table(Table $table): Table
    {
        $table = parent::table($table);

        return $table->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }
}
