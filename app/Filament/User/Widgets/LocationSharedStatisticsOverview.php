<?php

namespace App\Filament\User\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;

class LocationSharedStatisticsOverview extends BaseWidget
{
    public static ?string $pollingInterval = null;

    public static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            Stat::make('Total location shares', auth()->user()->notifications()->whereType('location_shared')->count())
                ->icon('heroicon-o-map-pin'),
            Stat::make('Location shares this month', auth()->user()->notifications()->whereType('location_shared')->where('created_at', '>=', now()->startOfMonth())->count())
                ->icon('heroicon-o-map-pin')
                ->chart(Trend::query(auth()->user()->notifications()->whereType('location_shared')->getQuery())
                    ->between(
                        start: now()->startOfYear(),
                        end: now()->endOfYear(),
                    )
                    ->perMonth()
                    ->dateAlias('created_at')
                    ->count()->map(fn($value) => $value->aggregate)->toArray())
                ->color('primary'),
            Stat::make('Location shares this week', auth()->user()->notifications()->whereType('location_shared')->where('created_at', '>=', now()->startOfWeek())->count())
                ->icon('heroicon-o-map-pin')

        ];
    }
}
