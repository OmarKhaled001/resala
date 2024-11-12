<?php

namespace App\Filament\Widgets;

use App\Models\Branche;
use App\Models\Category;
use App\Models\Section;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('الفروع', Branche::count())
            ->description('عدد الفروع الحالية')
            ->color('success'),
            Stat::make('الأنشطة', Section::count())
            ->description('عدد الأنشطة المفعلة ')
            ->color('success'),
            Stat::make('اللجان', Category::where('is_active',1)->count())
            ->description('عدد اللجان المفعلة')
            ->color('success'),
            
        ];
    }
}
