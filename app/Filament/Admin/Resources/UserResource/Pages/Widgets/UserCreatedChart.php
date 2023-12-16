<?php

namespace App\Filament\Admin\Resources\UserResource\Pages\Widgets;

use App\Filament\Admin\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;

class UserCreatedChart extends ChartWidget
{
    use InteractsWithPageTable;

    protected static ?string $heading = 'User Creation ';

    protected static ?string $maxHeight = '270px';

    public function getDescription(): Htmlable|string|null
    {
        return 'This chart does not use the table filters.';
    }

    protected function getTablePage(): string
    {
        return ListUsers::class;
    }

    protected function getData(): array
    {
        $trend = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'labels' => $trend->map(fn(TrendValue $value) => Carbon::parse($value->date)->format('M')),
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $trend->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => [
                        '#f95d6a'
                    ],
                    'borderWidth' => 0
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
