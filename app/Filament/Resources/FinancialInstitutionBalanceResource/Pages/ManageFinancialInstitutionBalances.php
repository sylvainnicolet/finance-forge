<?php

namespace App\Filament\Resources\FinancialInstitutionBalanceResource\Pages;

use App\Filament\Resources\FinancialInstitutionBalanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFinancialInstitutionBalances extends ManageRecords
{
    protected static string $resource = FinancialInstitutionBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
