<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionsResource\Pages;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfessionsResource extends Resource
{
    protected static ?string $model = Profession::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Управление курсами';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_profession')
                    ->label('Название профессии')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('period')
                    ->label('Период обучения (дни)')
                    ->numeric()
                    ->nullable(),
                Forms\Components\DatePicker::make('start_of_training')
                    ->label('Дата начала обучения')
                    ->nullable(),
                Forms\Components\Textarea::make('program')
                    ->label('Программа курса')
                    ->nullable(),

                // Отношение с наставниками (HasManyRepeater)
                Repeater::make('mentors') // Используем HasManyRepeater для наставников
                    ->relationship('mentors') // Указываем отношение "mentors"
                    ->schema([
                        Forms\Components\TextInput::make('name_mentors')
                            ->label('Имя ментора')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Описание')
                            ->rows(3),
                    ])
                    ->label('Наставники')
                    ->createItemButtonLabel('Добавить наставника'),

                Repeater::make('article') // Используем HasManyRepeater для наставников
                    ->relationship('article') // Указываем отношение "mentors"
                    ->schema([
                        Forms\Components\TextInput::make('name_article')
                            ->label('Имя ментора')
                            ->required(),
                        Forms\Components\Textarea::make('text')
                            ->label('Описание')
                            ->rows(3),
                    ])
                    ->label('Статьи')
                    ->createItemButtonLabel('Добавить статью'),

                Repeater::make('reviews') // Используем HasManyRepeater для наставников
                    ->relationship('reviews') // Указываем отношение "mentors"
                    ->schema([
                        Forms\Components\TextInput::make('owner')
                            ->label('Автор')
                            ->required(),
                        Forms\Components\Textarea::make('text')
                            ->label('Отзыв')
                            ->rows(3),
                    ])
                    ->label('Отзывы')
                    ->createItemButtonLabel('Добавить отзыв'),


                /*Repeater::make('tariffs') // Используем Repeater для тарифов
                    ->relationship('tariff') // Указываем отношение "tariffs"
                    ->schema([
                        Forms\Components\TextInput::make('name_tariff')
                            ->label('Название')
                            ->required(),
                        Forms\Components\Textarea::make('short_description')
                            ->label('Краткое описание')
                            ->nullable(),
                        Forms\Components\Textarea::make('place')
                            ->label('place')
                            ->nullable(),
                        Forms\Components\TextInput::make('price')
                            ->label('Стоимость')
                            ->required(),
                    ])
                    ->label('Тарифы')
                    ->createItemButtonLabel('Добавить тариф'),*/
                
                /*Repeater::make('articles') // Используем Repeater для статей
                    ->relationship('article') // Указываем отношение "articles"
                    ->schema([
                        Forms\Components\Select::make('id_article')
                            ->label('Статья')
                            ->relationship('article', 'name_article') // Замените `article` и `name_article` на нужные атрибуты
                            ->nullable(),
                    ])
                    ->label('Статьи')
                    ->createItemButtonLabel('Добавить статью'),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_profession')
                    ->label('Название профессии')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB'),
                Tables\Columns\TextColumn::make('period')
                    ->label('Период обучения (дни)'),
                Tables\Columns\TextColumn::make('start_of_training')
                    ->label('Дата начала')
                    ->date(),
            ])
            ->filters([
                // Добавьте фильтры, если нужно
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
            'index' => Pages\ListProfessions::route('/'),
            'create' => Pages\CreateProfessions::route('/create'),
            'edit' => Pages\EditProfessions::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}