<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferalResource\Pages;
use App\Models\Referal;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ReferalResource extends Resource
{
    protected static ?string $model = Referal::class;

    protected static ?string $navigationIcon = 'heroicon-o-cash';
    protected static ?string $pluralLabel = 'Реферальные программы';
    protected static ?string $modelLabel = 'Реферальная программа';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('price')
                    ->label('Стоимость')
                    ->numeric()
                    ->required()
                    ->suffix('₽'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('price')
                    ->label('Стоимость')
                    ->formatStateUsing(fn (string $state): string => number_format($state, 0, '.', ' ') . ' ₽')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата обновления')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReferals::route('/'),
            'edit' => Pages\EditReferal::route('/{record}/edit'),
            'create' => Pages\CreateReferal::route('/create'),
        ];
    }
}
