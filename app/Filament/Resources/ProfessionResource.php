<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionResource\RelationManagers\CareerRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\ColorRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\TypeProfessionRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\ProgressRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\SkillsRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\ReviewRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\MentorRelationManager;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProfessionResource extends Resource
{
    protected static ?string $model = Profession::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $pluralLabel = 'Профессии';

    protected static ?string $modelLabel = 'Профессия';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_profession')
                    ->label('Название профессии')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Стоимость обучения')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('place')
                    ->label('Количество мест')
                    ->numeric(),
                Forms\Components\TextInput::make('period')
                    ->label('Период обучения')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_of_training')
                    ->label('Дата начала обучения')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->label('Описание')
                    ->maxLength(500),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image(),
                Forms\Components\FileUpload::make('miniimage')
                    ->label('Мини-изображение')
                    ->image(),
                Forms\Components\BelongsToSelect::make('id_career')
                    ->relationship('career', 'name')
                    ->label('Карьера')
                    ->required(),
                Forms\Components\BelongsToSelect::make('id_color')
                    ->relationship('color', 'name')
                    ->label('Цвет')
                    ->required(),
                Forms\Components\BelongsToSelect::make('id_type')
                    ->relationship('typeProfession', 'name_type')
                    ->label('Тип профессии')
                    ->required(),
                
                // SEO поля
                Forms\Components\TextInput::make('SEO_key_words')
                    ->label('Ключевые слова SEO')
                    ->maxLength(255),
                Forms\Components\TextInput::make('SEO_title')
                    ->label('Заголовок SEO')
                    ->maxLength(255),
                Forms\Components\Textarea::make('SEO_description')
                    ->label('Описание SEO')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_profession')
                    ->label('Название профессии')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Стоимость обучения')
                    ->sortable(),
                Tables\Columns\TextColumn::make('place')
                    ->label('Количество мест'),
                Tables\Columns\TextColumn::make('period')
                    ->label('Период обучения'),
                Tables\Columns\TextColumn::make('start_of_training')
                    ->label('Дата начала обучения')
                    ->date('d.m.Y') // Форматирование даты
                    ->sortable(),
                
                // Отображение SEO полей в таблице
                Tables\Columns\TextColumn::make('SEO_key_words')
                    ->label('Ключевые слова SEO'),
                Tables\Columns\TextColumn::make('SEO_title')
                    ->label('Заголовок SEO'),
                Tables\Columns\TextColumn::make('SEO_description')
                    ->label('Описание SEO'),
            ])
            ->filters([
                // Добавьте фильтры, если необходимо
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CareerRelationManager::class,
            ColorRelationManager::class,
            TypeProfessionRelationManager::class,
            ProgressRelationManager::class,
            SkillsRelationManager::class,
            ReviewRelationManager::class,
            MentorRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ProfessionResource\Pages\ListProfessions::route('/'),
            'create' => ProfessionResource\Pages\CreateProfession::route('/create'),
            'edit' => ProfessionResource\Pages\EditProfession::route('/{record}/edit'),
        ];
    }
}
