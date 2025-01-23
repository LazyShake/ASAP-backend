<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackerResource\Pages;
use App\Models\Tracker;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TrackerResource extends Resource
{
    protected static ?string $model = Tracker::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $pluralLabel = 'Трекеры';
    protected static ?string $modelLabel = 'Трекер';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_tracker')
                    ->label('Название трекера')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('picture')
                    ->label('Фото')
                    ->image(),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_trackers')
                    ->label('Название трекера'),
                Tables\Columns\ImageColumn::make('picture')
                    ->label('Фото'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->text), // Явно указываем, что это за текст
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                // Можно добавить фильтры, если необходимо
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
            'index' => Pages\ListTrackers::route('/'),
            'create' => Pages\CreateTracker::route('/create'),
            'edit' => Pages\EditTracker::route('/{record}/edit'),
        ];
    }
}
