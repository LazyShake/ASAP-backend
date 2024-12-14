<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionsResource\Pages;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Resources\Form;
use Spatie\Permission\Traits\HasRoles;
use Filament\Forms\Components\HasManyRepeater;


class ProfessionsResource extends Resource
{
    protected static ?string $model = Profession::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Управление курсами';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name_profession')
                ->label('Название профессии')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('price')
                ->label('Цена')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('period')
                ->label('Период обучения (дни)')
                ->numeric()
                ->nullable(),
            Forms\Components\DatePicker::make('start_of_training')
                ->label('Дата начала обучения')
                ->nullable(),
            Forms\Components\Textarea::make('program')
                ->label('Программа курса')
                ->nullable(),
                Forms\Components\Textarea::make('program')
                ->label('Программа курса')
                ->nullable(),
                HasManyRepeater::make('mentors') // Используем HasManyRepeater
                ->relationship('mentors') // Указываем отношение "mentors"
                ->schema([
                    Forms\Components\TextInput::make('name_mentors')
                        ->label('Имя ментора')
                        ->required(),

                    Forms\Components\Textarea::make('description')
                        ->label('Описание')
                        ->rows(3),
                ])
                ->label('Менторы')
                ->createItemButtonLabel('Добавить ментора'),
            Forms\Components\Select::make('id_tariff')
                ->label('Тариф')
                ->relationship('tariff', 'name_tariff') // Замените `tariff` и `name` на нужные атрибуты
                ->nullable(),
            Forms\Components\Select::make('id_article')
                ->label('Статья')
                ->relationship('article', 'name_article') // Замените `article` и `title` на нужные атрибуты
                ->nullable(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name_profession')
                ->label('Название профессии')
                ->searchable(),
            Tables\Columns\TextColumn::make('price')
                ->label('Цена')
                ->money('RUB'),
            Tables\Columns\TextColumn::make('period')
                ->label('Период обучения (дни)'),
            Tables\Columns\TextColumn::make('start_of_training')
                ->label('Дата начала')
                ->date(),
            Tables\Columns\TextColumn::make('mentors.name_mentors')
                ->label('Наставник'),
            Tables\Columns\TextColumn::make('tariff.name_tariff')
                ->label('Тариф'),
            Tables\Columns\TextColumn::make('article.title')
                ->label('Статья'),
        ])
        ->filters([
            // Добавьте фильтры, если нужно
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}

public static function getPages(): array
{
    return [
        'index' => Pages\ListProfessions::route('/'),
        'create' => Pages\CreateProfessions::route('/create'),
        'edit' => Pages\EditProfessions::route('/{record}/edit'),
    ];
}

public static function canViewAny(): bool
{
    return auth()->user()->HasRole('admin');
}

}