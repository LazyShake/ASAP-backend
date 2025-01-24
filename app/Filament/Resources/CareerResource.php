<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $pluralLabel = 'Карьеры';
    protected static ?string $modelLabel = 'Карьера';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('vacancy')
                    ->label('Количество вакансий')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('images_vacancy')
                    ->label('шрифт вакансии')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('vacancies_hh')
                    ->label('Вакансии HH.ru')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('vacancies_habr')
                    ->label('Вакансии Habr')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('freelance_orders')
                    ->label('Заказы на фрилансе')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('start_salary')
                    ->label('Зарплата на старте')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('salary_after_1_year')
                    ->label('Зарплата после 1 года')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('salary_after_3_years')
                    ->label('Зарплата после 3 лет')
                    ->numeric()
                    ->nullable(),

                Forms\Components\Textarea::make('growth_description')
                    ->label('Описание роста')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->sortable(),

                Tables\Columns\TextColumn::make('vacancy')
                    ->label('Количество вакансий')
                    ->sortable(),

                Tables\Columns\TextColumn::make('images_vacancy')
                    ->label('шрифт вакансии'),

                Tables\Columns\TextColumn::make('vacancies_hh')
                    ->label('Вакансии HH.ru')
                    ->sortable(),

                Tables\Columns\TextColumn::make('vacancies_habr')
                    ->label('Вакансии Habr')
                    ->sortable(),

                Tables\Columns\TextColumn::make('freelance_orders')
                    ->label('Заказы на фрилансе')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_salary')
                    ->label('Зарплата на старте')
                    ->sortable(),

                Tables\Columns\TextColumn::make('salary_after_1_year')
                    ->label('Зарплата после 1 года')
                    ->sortable(),

                Tables\Columns\TextColumn::make('salary_after_3_years')
                    ->label('Зарплата после 3 лет')
                    ->sortable(),

                Tables\Columns\TextColumn::make('growth_description')
                    ->label('Описание роста')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->growth_description),
            ])
            ->filters([
                // Добавить фильтры, если нужно
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
