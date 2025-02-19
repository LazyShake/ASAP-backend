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
                    ->disabled()
                    ->default(fn($record) => $record?->name_profession ? Str::slug($record->name_profession) : ''),
                Forms\Components\TextInput::make('place')
                    ->label('Количество мест')
                    ->required()
                    ->numeric()
                    ->integer() // Запрещает дробные числа
                    ->minValue(0), // Запрещает отрицательные числа
                Forms\Components\TextInput::make('period')
                    ->label('Период обучения')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_of_training')
                    ->label('Дата начала обучения')
                    ->required(),
                Forms\Components\TextArea::make('description')
                    ->label('Описание')
                    ->required()
                    ->maxLength(500),
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->required()
                    ->preserveFilenames()
                    ->image()
                    ->disk('public') // Указываем диск
                    ->directory('article'),
                Forms\Components\FileUpload::make('miniimage')
                    ->label('Мини-изображение')
                    ->required()
                    ->preserveFilenames()
                    ->image()
                    ->disk('public') // Указываем диск
                    ->directory('article'),
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
                    ->getSearchResultsUsing(function (string $query, callable $get) {
                        $selectedSkills = $get('skills') ?? []; // Получаем выбранные ID
                        if (!is_array($selectedSkills)) {
                            $selectedSkills = [$selectedSkills];
                        }
                        return Skill::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%'])
                            ->whereNotIn('id_skills', $selectedSkills) // Исключаем выбранные навыки
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
                    ->required()
                    ->default(fn($get) => $get('record.id_type') ?? 1), // Укажите нужный ID по умолчанию
                Forms\Components\TextArea::make('skilltext')
                    ->label('Текст навыков')
                    ->required()
                    ->maxLength(500)
                    ->placeholder('Введите описание навыков'),
                // SEO поля
                Forms\Components\TextArea::make('SEO_key_words')
                    ->label('Ключевые слова SEO'),
                Forms\Components\TextArea::make('SEO_title')
                    ->label('Заголовок SEO'),
                Forms\Components\Textarea::make('SEO_description')
                    ->label('Описание SEO'),
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
