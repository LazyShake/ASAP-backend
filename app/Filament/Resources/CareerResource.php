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

                Forms\Components\TextInput::make('hh')
                    ->label('Вакансии HH.ru')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->required(),

                Forms\Components\TextInput::make('habr')
                    ->label('Вакансии Habr')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->required(),

                Forms\Components\TextInput::make('freelance')
                    ->label('Заказы на фрилансе')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->required(),

                Forms\Components\TextInput::make('start_vage')
                    ->label('Зарплата на старте')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->required(),

                Forms\Components\TextInput::make('one_year_vage')
                    ->label('Зарплата после 1 года')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->required(),

                Forms\Components\TextInput::make('three_year_vage')
                    ->label('Зарплата после 3 лет')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->required(),


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


                Tables\Columns\TextColumn::make('hh')
                    ->label('Вакансии HH.ru')
                    ->sortable(),

                Tables\Columns\TextColumn::make('habr')
                    ->label('Вакансии Habr')
                    ->sortable(),

                Tables\Columns\TextColumn::make('freelance')
                    ->label('Заказы на фрилансе')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_vage')
                    ->label('Зарплата на старте')
                    ->sortable(),

                Tables\Columns\TextColumn::make('one_year_vage')
                    ->label('Зарплата после 1 года')
                    ->sortable(),

                Tables\Columns\TextColumn::make('three_year_vage')
                    ->label('Зарплата после 3 лет')
                    ->sortable(),


            ])
            ->filters([
                // Добавить фильтры, если нужно
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Удалить'),
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
