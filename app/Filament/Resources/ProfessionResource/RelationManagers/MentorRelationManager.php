<?php

namespace App\Filament\Resources\ProfessionResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class MentorRelationManager extends RelationManager
{
    protected static string $relationship = 'mentors';

    protected static ?string $recordTitleAttribute = 'name_mentors';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_mentors')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->label('Описание')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\TextInput::make('picture')
                    ->label('Ссылка на изображение')
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->label('Отображать на главной')
                    ->default(false),
                Forms\Components\TextInput::make('workplace')
                    ->label('Место работы')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_mentors')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('picture')
                    ->label('Изображение')
                    ->size(50),
                Tables\Columns\TextColumn::make('workplace')
                    ->label('Место работы'),
                Tables\Columns\BooleanColumn::make('status')
                    ->label('На главной'),
            ])
            ->filters([
                // Можно добавить фильтры, если потребуется
            ])
            ->defaultSort('name_mentors')
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
