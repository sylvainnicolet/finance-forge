<?php

namespace App\Filament\Resources\FinancialInstitutionResource\Pages;

use App\Filament\Resources\FinancialInstitutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFinancialInstitutions extends ManageRecords
{
    protected static string $resource = FinancialInstitutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
