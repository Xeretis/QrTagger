<?php

namespace App\Helpers\Filament\Colums;

use Filament\Tables\Columns\TextColumn;

class DateTimeDiff
{
    public function __invoke(TextColumn $column): TextColumn
    {
        return $column->formatStateUsing(function ($state) {
            return $state->diffForHumans();
        });
    }
}
