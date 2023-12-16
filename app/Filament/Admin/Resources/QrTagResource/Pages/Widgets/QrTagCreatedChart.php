<?php

namespace App\Filament\Admin\Resources\QrTagResource\Pages\Widgets;

use App\Models\QrTag;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;

class QrTagCreatedChart extends ChartWidget
{
    protected static ?string $heading = 'Tag Creation';

    protected static ?string $maxHeight = '270px';

    public function getDescription(): Htmlable|string|null
    {
        return 'This chart does not use the table filters.';
    }

    protected function getData(): array
    {
        $trend = Trend::model(QrTag::class)
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
                    'label' => 'Tags',
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
