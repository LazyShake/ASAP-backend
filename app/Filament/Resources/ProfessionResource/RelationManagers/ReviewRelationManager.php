<?php

namespace App\Filament\Resources\ProfessionResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class ReviewRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    protected static ?string $recordTitleAttribute = 'author';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('author')
                    ->label('Автор')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->label('Содержание отзыва')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\TextInput::make('rating')
                    ->label('Рейтинг')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author')
                    ->label('Автор'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Содержание')
                    ->limit(50),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Рейтинг'),
            ])
            ->filters([
                // Можно добавить фильтры, если необходимо
            ])
            
            ->defaultSort('author')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
