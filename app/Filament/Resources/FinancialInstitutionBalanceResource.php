<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialInstitutionBalanceResource\Pages;
use App\Models\FinancialInstitution;
use App\Models\FinancialInstitutionBalance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FinancialInstitutionBalanceResource extends Resource
{
    protected static ?string $model = FinancialInstitutionBalance::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Balances';

    public static function getLabel(): string
    {
        return 'balance';
    }

    public static function getPluralLabel(): string
    {
        return 'Balances';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('financial_institution_id')
                    ->label('Financial Institution')
                    ->options(FinancialInstitution::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('balance')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('financialInstitution.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultPaginationPageOption(50)
            ->defaultSort('date', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFinancialInstitutionBalances::route('/'),
        ];
    }
}
