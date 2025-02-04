<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagsResource\Pages;
use App\Models\Tags;
use App\Models\Article;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TagsResource extends Resource
{
    protected static ?string $model = Tags::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Теги';
    protected static ?string $pluralLabel = 'Теги';
    protected static ?string $modelLabel = 'Тег';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_tag')
                    ->label('Название тега')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_tag')
                    ->label('Название тега'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Удалить'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'Создать' => Pages\CreateTags::route('/create'),
            'Редактировать' => Pages\EditTags::route('/{record}/edit'),
        ];
    }
}
