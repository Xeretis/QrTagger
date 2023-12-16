<?php

namespace App\Filament\Resources\UserResource\Pages\Widgets;

use App\Filament\Resources\UserResource\Pages\ListUsers;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Contracts\Support\Htmlable;

class UserVerifiedChart extends ChartWidget
{
    use InteractsWithPageTable;

    protected static ?string $heading = 'Email verification';

    protected static ?string $maxHeight = '270px';

    public function getDescription(): Htmlable|string|null
    {
        return 'This chart uses the table filters.';
    }

    protected function getTablePage(): string
    {
        return ListUsers::class;
    }

    protected function getData(): array
    {
        $verifiedCount = $this->getPageTableQuery()->whereNotNull('email_verified_at')->count();
        $unverifiedCount = $this->getPageTableQuery()->whereNull('email_verified_at')->count();

        $counts = [
            'verified' => $verifiedCount,
            'unverified' => $unverifiedCount,
        ];

        return [
            'labels' => [
                'Verified',
                'Unverified',
            ],
            'datasets' => [
                [
                    'data' => [
                        $counts['verified'],
                        $counts['unverified'],
                    ],
                    'backgroundColor' => [
                        '#ff7c43',
                        //'#f95d6a',
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
