<?php

namespace App\Filament\Widgets;

use App\Models\FinancialInstitution;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class FinancialInstitutionBalanceSummary extends BaseWidget
{
    protected function getStats(): array
    {
        $currentYear = now()->year;
        $totalBalance = $this->getTotalBalanceByYear($currentYear);

        $lastYear = now()->subYear()->year;
        $lastYearTotalBalance = $this->getTotalBalanceByYear($lastYear);

        $changePercentage = $this->getChangePercentage($lastYearTotalBalance, $totalBalance);
        $isPositive = $changePercentage >= 0;

        $description = $isPositive
            ? $changePercentage . '% increase'
            : $changePercentage . '% decrease';

        $descriptionIcon = $isPositive
            ? 'heroicon-m-arrow-trending-up'
            : 'heroicon-m-arrow-trending-down';

        $color = $isPositive ? 'success' : 'danger';

        return [
            Stat::make('Total '. $lastYear, Number::currency($lastYearTotalBalance, 'CHF', 'de_CH')),
            Stat::make('Total '. $currentYear, Number::currency($totalBalance, 'CHF', 'de_CH'))
                ->description($description)
                ->descriptionIcon($descriptionIcon)
                ->color($color),
        ];
    }

    private function getTotalBalanceByYear($year)
    {
        return FinancialInstitution::with(['balances' => function ($query) use ($year) {
            $query->whereYear('date', $year)
            ->latest('date')
            ->limit(1);
        }])->get()->sum(function ($institution) {
            return $institution->balances->first()->balance ?? 0;
        });
    }

    private function getChangePercentage($lastYearTotalBalance, $totalBalance): int
    {
        return ($totalBalance - $lastYearTotalBalance) / $lastYearTotalBalance * 100;
    }
}
