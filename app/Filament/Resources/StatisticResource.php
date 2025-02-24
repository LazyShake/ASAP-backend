<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatisticResource\Pages;
use App\Models\Statistic;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class StatisticResource extends Resource
{
    protected static ?string $model = Statistic::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $pluralLabel = 'Статистики';
    protected static ?string $navigationGroup = 'Главная';
    protected static ?string $modelLabel = 'Статистика';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_statistics')
                    ->label('Название статистики')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->label('Количество')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->required()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_statistics')->label('Название')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity')->label('Количество')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                //Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatistics::route('/'),
            'edit' => Pages\EditStatistic::route('/{record}/edit'),
            'create' => Pages\CreateStatistic::route('/create'),
        ];
    }
}
