<?php

namespace App\Filament\Admin\Resources\QrTagResource\Pages\Widgets;

use App\Filament\Admin\Resources\QrTagResource\Pages\ListQrTags;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Contracts\Support\Htmlable;

class QrTagDeletedChart extends ChartWidget
{
    use InteractsWithPageTable;

    protected static ?string $heading = 'Tag Deletion';

    protected static ?string $maxHeight = '270px';

    public function getDescription(): Htmlable|string|null
    {
        return 'This chart uses the table filters.';
    }

    protected function getTablePage(): string
    {
        return ListQrTags::class;
    }

    protected function getData(): array
    {
        $notDeletedCount = $this->getPageTableQuery()->whereNull('deleted_at')->count();
        $deletedCount = $this->getPageTableQuery()->whereNotNull('deleted_at')->count();

        $counts = [
            'not_deleted' => $notDeletedCount,
            'deleted' => $deletedCount,
        ];

        return [
            'labels' => [
                'Not Deleted',
                'Deleted',
            ],
            'datasets' => [
                [
                    'data' => [
                        $counts['not_deleted'],
                        $counts['deleted'],
                    ],
                    'backgroundColor' => [
                        '#ff7c43',
                        '#ef5675',
                    ],
                    'borderWidth' => 0
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
