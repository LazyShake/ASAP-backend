<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TariffResource\Pages;
use App\Models\Tariff;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TariffResource extends Resource
{
    protected static ?string $model = Tariff::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $pluralLabel = 'Тарифы';
    protected static ?string $modelLabel = 'Тариф';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_tariff')
                    ->label('Название тарифа')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('short_description')
                    ->label('Краткое описание')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('installment')
                    ->label('Рассрочка')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\Repeater::make('detailed_description')
                    ->label('Услуги, входящие в тариф')
                    ->schema([
                        Forms\Components\Textarea::make('description_item')
                            ->label('Элемент описания')
                            ->required()
                            ->maxLength(500), // Можно указать максимальную длину для каждого элемента
                    ])
                    ->minItems(1) // Минимум один элемент
                    ->maxItems(10) // Максимум 10 элементов
                    ->columnSpan('full'), // Опционально: растягиваем компонент на всю ширину

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_tariff')
                    ->label('Название тарифа'),
                Tables\Columns\TextColumn::make('short_description')
                    ->label('Краткое описание')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->text), // Явно указываем, что это за текст
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена'),
                Tables\Columns\TextColumn::make('installment')
                    ->label('Рассрочка'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                // Можно добавить фильтры, если необходимо
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Удалить'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTariffs::route('/'),
            'Создать' => Pages\CreateTariff::route('/create'),
            'Редактировать' => Pages\EditTariff::route('/{record}/edit'),
        ];
    }
}
