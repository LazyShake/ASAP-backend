<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionResource\Pages;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

class ProfessionResource extends Resource
{
    protected static ?string $model = Profession::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

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
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('period')->label('Период обучения')->maxLength(255),
                Forms\Components\DatePicker::make('start_of_training')->label('Дата начала обучения')->required(),
                Forms\Components\TextInput::make('place')->label('Место обучения')->maxLength(255),
                Forms\Components\Select::make('id_type') // Тип профессии
                    ->label('Тип профессии')
                    ->required()
                    ->options(\App\Models\TypeProfession::pluck('name_type', 'id')) // Список типов профессий
                    ->searchable()
                    ->placeholder('Выберите тип профессии'),
                Forms\Components\Select::make('id_color')
                    ->relationship('color', 'name') // Связь с моделью Color
                    ->label('Цвет')
                    ->required(),
                Forms\Components\Repeater::make('skills')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Название навыка')->required(),
                        Forms\Components\Textarea::make('text')->label('Описание навыка'),
                    ]),
                Forms\Components\FileUpload::make('image')->label('Изображения')->image(),
                Forms\Components\FileUpload::make('miniimage')->label('Мини-изображения')->image(),
                Repeater::make('mentors')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('name_mentors')->label('Имя ментора')->required(),
                        Forms\Components\FileUpload::make('picture')->label('Фото')->image(),
                        Forms\Components\Textarea::make('description')->label('Описание')->maxLength(65535),
                        Forms\Components\TextInput::make('status')->label('Статус')->maxLength(255),
                        Forms\Components\TextInput::make('workplace')->label('Место работы')->maxLength(255),
                    ]),
                Repeater::make('reviews')
                    ->relationship()
                    ->schema([
                        Forms\Components\Textarea::make('text')->label('Текст отзыва')->required(),
                        Forms\Components\TextInput::make('owner')->label('Автор отзыва')->required(),
                        Forms\Components\TextInput::make('status')->label('Статус')->maxLength(255),
                        Forms\Components\FileUpload::make('picture')->label('Фото')->image(),
                    ]),
                Repeater::make('progress')
                    ->relationship()
                    ->schema([
                        Forms\Components\Textarea::make('before')->label('Прогресс до')->maxLength(65535),
                        Forms\Components\Textarea::make('after')->label('Прогресс после')->maxLength(65535),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_profession')->label('Название профессии')->sortable()->searchable(),
                TextColumn::make('price')->label('Цена')->sortable(),
                TextColumn::make('period')->label('Период обучения'),
                TextColumn::make('start_of_training')->label('Дата начала')->dateTime(),
                TextColumn::make('place')->label('Место обучения'),
                TextColumn::make('type.name_type')->label('Тип профессии'), // Изменено на корректное отображение связи
                TextColumn::make('color.name')->label('Цвет'),
            ])
            ->filters([
                Filter::make('price_above_1000')
                    ->query(fn ($query) => $query->where('price', '>', 1000))
                    ->label('Цена > 1000'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessions::route('/'),
            'create' => Pages\CreateProfession::route('/create'),
            'edit' => Pages\EditProfession::route('/{record}/edit'),
        ];
    }
}
