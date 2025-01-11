<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Type;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $pluralLabel = 'Статьи';

    protected static ?string $modelLabel = 'Статья';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_article')
                    ->label('Название статьи')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('short_text')
                    ->label('Краткий текст')
                    ->maxLength(500),
                Forms\Components\RichEditor::make('content')
                    ->label('Контент')
                    ->required(),
                Forms\Components\FileUpload::make('picture')
                    ->label('Изображение')
                    ->image(),
                
                // Поле для выбора или создания нового типа статьи
                Select::make('type_id')
                    ->label('Тип статьи')
                    ->options(function () {
                        return Type::all()->pluck('name', 'id')->toArray();
                    })
                    ->createOption()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Название типа')
                            ->required(),
                    ])
                    ->reactive()
                    ->placeholder('Выберите или создайте тип'),

                // Поле для выбора или создания новой профессии
                Select::make('id_profession')
                    ->label('Профессия')
                    ->options(function () {
                        return Profession::all()->pluck('name_profession', 'id')->toArray();
                    })
                    ->createOption()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name_profession')
                            ->label('Название профессии')
                            ->required(),
                    ])
                    ->reactive()
                    ->placeholder('Выберите или создайте профессию'),

                Forms\Components\TextInput::make('link')
                    ->label('Ссылка')
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('owner_name')
                    ->label('Имя автора')
                    ->maxLength(255),
                Forms\Components\Textarea::make('owner_description')
                    ->label('Описание автора')
                    ->maxLength(500),
                Forms\Components\FileUpload::make('owner_picture')
                    ->label('Фото автора')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_article')
                    ->label('Название статьи')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('short_text')
                    ->label('Краткий текст')
                    ->limit(50),
                Tables\Columns\ImageColumn::make('picture')
                    ->label('Изображение'),
                Tables\Columns\TextColumn::make('type.name')
                    ->label('Тип статьи')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('profession.name_profession')
                    ->label('Профессия')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner_name')
                    ->label('Имя автора'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_id')
                    ->label('Тип статьи')
                    ->relationship('type', 'name'),
                Tables\Filters\SelectFilter::make('id_profession')
                    ->label('Профессия')
                    ->relationship('profession', 'name_profession'),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
