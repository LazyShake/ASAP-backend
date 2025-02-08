<?php

namespace App\Filament\Resources\ProfessionResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class CareerRelationManager extends RelationManager
{
    protected static string $relationship = 'career';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $title = 'Карьера';
    protected static ?string $pluralTitle = 'Карьеры';


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
                    ->nullable(),

                Forms\Components\TextInput::make('habr')
                    ->label('Вакансии Habr')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('freelance')
                    ->label('Заказы на фрилансе')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('start_vage')
                    ->label('Зарплата на старте')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('one_year_vage')
                    ->label('Зарплата после 1 года')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('three_year_vage')
                    ->label('Зарплата после 3 лет')
                    ->numeric()
                    ->nullable(),

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
            ->defaultSort('name') // Сортировка по умолчанию по названию
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Создать')
                    ->using(function (array $data, $livewire) {
                        $career = $livewire->getRelationship()->create($data);
                        $livewire->ownerRecord->update(['id_career' => $career->id]); // Связываем профессию с карьерой
                        return $career;
                    })
                    ->visible(fn($livewire) => !$livewire->getRelationship()->exists()),

            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Удалить'),
            ]);
    }
}
