<?php

namespace App\Filament\Widgets;

use App\Models\Activity;
use App\Models\Branch;
use App\Models\Section;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('الفروع', Branch::count())
            ->description('عدد الفروع الحالية')
            ->color('success'),
            Stat::make('الأنشطة', Activity::count())
            ->description('عدد الأنشطة المفعلة ')
            ->color('success'),
            Stat::make('اللجان', Section::where('is_active',1)->count())
            ->description('عدد اللجان المفعلة')
            ->color('success'),
            
        ];
    }
}
