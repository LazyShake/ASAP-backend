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
                        Forms\Components\TextInput::make('text')
                            ->label('Текст')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(1) // Элементы будут выстраиваться в столбик
                    ->createItemButtonLabel('Добавить текст'),
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
                Tables\Columns\TextColumn::make('content_module')  // Для поля content_module
                    ->label('Контент')
                    ->formatStateUsing(fn($state) => is_array($state)
                        ? implode(', ', array_column($state, 'text'))  // Преобразуем массив в строку
                        : $state)
                    ->limit(50),  // Ограничиваем длину отображаемого текста
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
