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
                    ->label('Изображения вакансий')
                    ->required()
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
                    ->label('Изображения вакансий'),
            ])
            ->filters([
                // Можно добавить фильтры, если потребуется
            ])
            ->defaultSort('name') // Сортировка по умолчанию по названию
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
