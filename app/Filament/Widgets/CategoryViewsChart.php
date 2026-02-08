<?php

namespace App\Filament\Widgets;

use App\Models\ViewCategoryStat;
use Filament\Widgets\ChartWidget;

class CategoryViewsChart extends ChartWidget
{
    protected ?string $heading = 'Category Views Chart';

    protected function getData(): array
    {
        $stats = ViewCategoryStat::all();

        return [
            'datasets' => [
                [
                    'label' => 'Views',
                    'data' => $stats->pluck('total_views')->toArray(),
                ],
            ],
            'labels' => $stats->pluck('category_name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'precision' => 0,
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
