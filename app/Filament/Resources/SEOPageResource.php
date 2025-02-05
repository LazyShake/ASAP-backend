<?php

namespace App\Filament\Resources;

use App\Models\SEOPage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SEOPageResource extends Resource
{
    protected static ?string $model = SEOPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $pluralLabel = 'SEO страницы';
    protected static ?string $navigationGroup = 'Управление';
    protected static ?string $modelLabel = 'SEO страница';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('page_name')
                    ->label('Название страницы')
                    ->required()
                    ->maxLength(255)
                    ->disabled(),
                Forms\Components\TextInput::make('SEO_title')
                    ->label('SEO Заголовок')
                    ->maxLength(255),
                Forms\Components\TextInput::make('SEO_key_words')
                    ->label('SEO Ключевые слова')
                    ->maxLength(255),
                Forms\Components\Textarea::make('SEO_description')
                    ->label('SEO Описание')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page_name')
                    ->label('Название страницы')
                    ->sortable(),
                Tables\Columns\TextColumn::make('SEO_title')
                    ->label('SEO Заголовок'),
                Tables\Columns\TextColumn::make('SEO_key_words')
                    ->label('SEO Ключевые слова'),
                Tables\Columns\TextColumn::make('SEO_description')
                    ->label('SEO Описание'),
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
            'index' => SEOPageResource\Pages\ListSEOPages::route('/'),
            'edit' => SEOPageResource\Pages\EditSEOPage::route('/{record}/edit'),
        ];
    }
}
