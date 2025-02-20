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

    protected static ?string $recordTitleAttribute = 'owner';

    protected static ?string $title = 'Отзыв';
    protected static ?string $pluralTitle = 'Отзывы';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('text')
                    ->label('Текст отзыва')
                    ->required(),
                Forms\Components\FileUpload::make('picture')
                    ->label('Изображение')
                    ->required()
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск
                    ->directory('article')
                    ->image(),
                Forms\Components\TextInput::make('video')
                    ->label('Ссылка на видео')
                    ->url()
                    ->nullable(),
                Forms\Components\TextInput::make('owner')
                    ->label('Автор отзыва')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->label('Отображать на главной')
                    ->default(false),
                Forms\Components\TextInput::make('place_job')
                    ->label('Место работы')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('job_before')
                    ->label('Профессия до обучения')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('job_after')
                    ->label('Профессия после обучения')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->label('Текст отзыва')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->text),
                Tables\Columns\ImageColumn::make('picture')
                    ->label('Фото'),
                Tables\Columns\TextColumn::make('video')
                    ->label('Видео')
                    ->url(fn($record) => $record->video),
                Tables\Columns\TextColumn::make('owner')
                    ->label('Автор'),
                Tables\Columns\BooleanColumn::make('status')
                    ->label('На главной'),
                Tables\Columns\TextColumn::make('job_before')
                    ->label('До обучения'),
                Tables\Columns\TextColumn::make('job_after')
                    ->label('После обучения'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Отображать на главной'),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Создать'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ]);
    }
}
