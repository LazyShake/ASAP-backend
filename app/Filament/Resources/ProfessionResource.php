<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionResource\RelationManagers\CareerRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\ColorRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\TypeProfessionRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\ProgressRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\SkillsRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\ReviewRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\MentorRelationManager;
use App\Filament\Resources\ProfessionResource\RelationManagers\ProgramsRelationManager;
use App\Models\Profession;
use App\Models\Skill;
use App\Models\Tariff; // Добавлено
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class ProfessionResource extends Resource
{
    protected static ?string $model = Profession::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $pluralLabel = 'Профессии';
    protected static ?string $navigationGroup = 'Профессии';
    protected static ?string $modelLabel = 'Профессия';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_profession')
                    ->label('Название профессии')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled(fn($record) => $record !== null), // Запрет изменения после создания
                Forms\Components\TextInput::make('price')
                    ->label('Стоимость обучения')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('place')
                    ->label('Количество мест')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('period')
                    ->label('Период обучения')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_of_training')
                    ->label('Дата начала обучения')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->label('Описание')
                    ->required()
                    ->maxLength(500),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->imagePreviewHeight(150)
            ->preserveFilenames()
                    ->image()
                    ->disk('public') // Указываем диск
    ->directory('profession_image') ,
                Forms\Components\FileUpload::make('miniimage')
                    ->label('Мини-изображение')
                    ->imagePreviewHeight(150)
            ->preserveFilenames()
                    ->image()
                    ->disk('public') // Указываем диск
    ->directory('profession_mini_image'),
                /*Forms\Components\BelongsToSelect::make('id_career')
                    ->relationship('career', 'name')
                    ->label('Карьера')
                    ->required(),*/
                Forms\Components\BelongsToSelect::make('id_color')
                    ->relationship('color', 'name')
                    ->label('Цвет')
                    ->required(),
                Forms\Components\Select::make('skills')
                    ->label('Навыки')
                    ->multiple() // Поддержка нескольких тегов
                    ->relationship('skills', 'name') // Используйте связь с моделью
                    ->searchable() // Включаем поиск
                    ->getSearchResultsUsing(function (string $query) {
                        return Skill::where('name', 'like', "%{$query}%")
                            ->pluck('name', 'id_skills');
                    })
                    ->placeholder('Выберите навык или создайте новый')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ]),
                Forms\Components\BelongsToSelect::make('id_type')
                    ->relationship('typeProfession', 'name_type')
                    ->label('Тип профессии')
                    ->required(),
                Forms\Components\TextInput::make('skilltext')
                    ->label('Текст навыков')
                    ->required()
                    ->maxLength(500)
                    ->placeholder('Введите описание навыков'),
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
                    ->date('d.m.Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('skills.name')
                    ->label('Навыки')
                    ->sortable()
                    ->searchable()
                    ->limit(50)
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state),
                // Новое поле skilltext в таблице
                Tables\Columns\TextColumn::make('skilltext')
                    ->label('Текст навыков')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('SEO_key_words')
                    ->label('Ключевые слова SEO'),
                Tables\Columns\TextColumn::make('SEO_title')
                    ->label('Заголовок SEO'),
                Tables\Columns\TextColumn::make('SEO_description')
                    ->label('Описание SEO'),
                // Колонка для тарифа,
            ])
            ->filters([
                // Добавьте фильтры, если необходимо
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                ->label('Удалить'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CareerRelationManager::class,
            ProgressRelationManager::class,
            //SkillsRelationManager::class,
            ReviewRelationManager::class,
            MentorRelationManager::class,
            ProgramsRelationManager::class,
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
