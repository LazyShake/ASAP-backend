<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-alt-2';
    protected static ?string $pluralLabel = 'Отзывы';
    protected static ?string $modelLabel = 'Отзыв';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('text')
                    ->label('Текст отзыва')
                    ->required(),
                Forms\Components\FileUpload::make('picture')
                    ->label('Фото отзыва')
                    ->storeInDatabase()
                    ->image(),
                Forms\Components\TextInput::make('video')
                    ->label('Ссылка на видео')
                    ->url()
                    ->nullable(),
                Forms\Components\Select::make('profession_id')
                    ->label('Профессия')
                    ->options(Profession::all()->pluck('name_profession', 'id_profession')->toArray())
                    ->searchable()
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
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('job_before')
                    ->label('Профессия до обучения')
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\TextInput::make('job_after')
                    ->label('Профессия после обучения')
                    ->nullable()
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
                    ->tooltip(fn ($record) => $record->text), // Явно указываем, что это за текст
                Tables\Columns\ImageColumn::make('picture')
                    ->label('Фото'),
                Tables\Columns\TextColumn::make('video')
                    ->label('Видео')
                    ->url(fn ($record) => $record->link) // Открывает ссылку
                    ->Label('Открыть'),
                Tables\Columns\TextColumn::make('profession.name_profession')
                    ->label('Профессия'),
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
                Tables\Filters\SelectFilter::make('profession_id')
                    ->label('Профессия')
                    ->options(Profession::all()->pluck('name_profession', 'id_profession')->toArray()),
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Отображать на главной'),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
