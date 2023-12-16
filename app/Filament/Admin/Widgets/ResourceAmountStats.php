<?php

namespace App\Filament\Admin\Widgets;

use App\Models\QrTag;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;

class ResourceAmountStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static bool $isLazy = false;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('User count', User::count())->chart(Trend::model(User::class)
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->count()->map(fn($value) => $value->aggregate)->toArray())
                ->color('primary'),
            Stat::make('Tag count', QrTag::count())->chart(Trend::model(QrTag::class)
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->count()->map(fn($value) => $value->aggregate)->toArray())
                ->color('primary'),
        ];
    }
}
