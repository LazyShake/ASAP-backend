<?php

namespace App\Filament\Resources\ProfessionResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Form;
use Filament\Resources\Table;

class ProgramsRelationManager extends RelationManager
{
    protected static string $relationship = 'programs'; // Укажите название связи из модели Profession.

    protected static ?string $recordTitleAttribute = 'name_module';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_module')
                    ->label('Название модуля')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Repeater::make('content_module')
                    ->label('Контент модуля')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('text')
                            ->label('Текст')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Repeater::make('sub_items')
                            ->label('Подэлементы')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Текст')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->createItemButtonLabel('Добавить подэлемент')
                            ->columns(1), // Вложенные элементы тоже идут в столбик
                    ])
                    ->columns(1) // Основные элементы в столбик
                    ->createItemButtonLabel('Добавить модуль'),
                Forms\Components\TextInput::make('number_module')
                    ->label('Номер модуля')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_module')
                    ->label('Название модуля')
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_module')
                    ->label('Номер модуля')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([])
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
