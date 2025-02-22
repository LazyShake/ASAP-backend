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

    protected static ?string $title = 'Ментор';
    protected static ?string $pluralTitle = 'Менторы';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_mentors')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Описание')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\FileUpload::make('picture')
                    ->label('Изображение')
                    ->required()
                    ->image()
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск
                    ->directory('article')
                    ->default(fn($get) => $get('record.picture')),
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
                Tables\Actions\CreateAction::make()->label('Создать'),
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
