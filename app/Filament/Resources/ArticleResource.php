<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Type;
use App\Models\Profession;
use App\Models\Tags;
use App\Models\Filter;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\Str;


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
                    ->maxLength(255)
                    ->reactive() // Чтобы отслеживать изменения в поле
                    /*->afterStateUpdated(function ($state, callable $set) {
                        // Преобразуем название в слаг, используя str_slug (или аналогичную функцию)
                        $slug = Str::slug($state);
                        $set('slug', $slug); // Устанавливаем слаг в поле
                    })*/,

                Forms\Components\TextInput::make('slug')
                    ->label('Слаг')
                    ->required()
                    ->unique(Article::class, 'slug'),
                    //->disabled(),

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
                    ->options(Type::query()->pluck('name_type', 'id_type'))
                    ->searchable()
                    ->placeholder('Выберите тип')
                    ->required()
                    ->reactive() // Обработка изменения значения
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Если тип равен "Кейс" или "Другое", выбираем первый фильтр и отключаем выбор
                        if ($state === 1 || $state === 2) {
                            $set('filter_id', Filter::first()->id); // Устанавливаем первый фильтр
                            $set('filter_disabled', true); // Отключаем поле фильтра
                        } else {
                            $set('filter_id', null); // Сбрасываем фильтр
                            $set('filter_disabled', false); // Включаем возможность выбора фильтра
                        }
                    }),


                Select::make('filter_id')
                    ->label('Фильтр')
                    ->options(function () {
                        return Filter::query()->pluck('name_filter', 'filter_id')->toArray();
                    })
                    ->searchable()
                    ->placeholder('Выберите фильтр')
                    ->nullable()
                    ->reactive() // Делаем поле реактивным
                    ->visible(function (callable $get) {
                        // Получаем название типа статьи
                        $typeId = $get('type_id'); // Получаем ID типа статьи
                        return $typeId == 4; // Показываем поле, если тип статьи "Для профессии"
                    })
                    ->disabled(function (callable $get) {
                        // Отключаем поле, если оно не должно быть доступным
                        return $get('filter_disabled');
                    }),

                Select::make('id_profession')
                    ->label('Профессия')
                    ->options(function () {
                        return Profession::query()->pluck('name_profession', 'id_profession')->toArray();
                    })
                    ->searchable()
                    ->placeholder('Выберите профессии')
                    ->nullable()
                    ->reactive() // Делаем поле реактивным
                    ->visible(function (callable $get) {
                        // Получаем название типа статьи
                        $typeId = $get('type_id'); // Получаем ID типа статьи
                        return $typeId == 4; // Показываем поле, если тип статьи "Для профессии"
                    })
                    ->disabled(function (callable $get) {
                        // Отключаем поле, если оно не должно быть доступным
                        return $get('profession_disabled');
                    }),

                Select::make('tags')
                    ->label('Теги')
                    ->multiple() // Поддержка нескольких тегов
                    ->relationship('tags', 'name_tag') // Указываем связь
                    ->searchable() // Включаем поиск
                    ->getSearchResultsUsing(function (string $query) {
                        // Фильтрация списка тегов
                        return Tags::where('name_tag', 'like', "%{$query}%")
                            ->pluck('name_tag', 'id_tag');
                    })
                    ->placeholder('Выберите теги или создайте новый')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name_tag')
                            ->required(),
                    ]),


                Forms\Components\TextInput::make('link')
                    ->label('Ссылка')
                    ->url()
                    ->maxLength(255)
                    ->nullable()
                    ->reactive() // Делаем поле реактивным
                    ->visible(function (callable $get) {
                        // Получаем название типа статьи
                        $typeId = $get('type_id'); // Получаем ID типа статьи
                        return $typeId == 3; // Показываем поле, если тип статьи "Для профессии"
                    })
                    ->disabled(function (callable $get) {
                        // Отключаем поле, если оно не должно быть доступным
                        return $get('link_disabled');
                    }),
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
                Tables\Columns\TextColumn::make('type.name_type')
                    ->label('Тип статьи')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('profession.name_profession')
                    ->label('Профессия')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('filter.name_filter')
                    ->label('Фильтр')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tags') // или другое имя поля
                    ->label('Теги')
                    ->formatStateUsing(function ($state) {
                        // Если $state является коллекцией тегов, соединяем их имена через запятую
                        if ($state instanceof \Illuminate\Database\Eloquent\Collection) {
                            return $state->pluck('name_tag')->implode(', ');
                        }
                        return ''; // Возвращаем пустую строку, если нет тегов
                    }),


                Tables\Columns\TextColumn::make('owner_name')
                    ->label('Имя автора'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type_id')
                    ->label('Тип статьи')
                    ->relationship('type', 'name_type'),
                Tables\Filters\SelectFilter::make('id_profession')
                    ->label('Профессия')
                    ->relationship('profession', 'name_profession'),
                Tables\Filters\SelectFilter::make('filter_ids')
                    ->label('Фильтры')
                    ->relationship('filter', 'name_filter'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn($record) => route('filament.resources.articles.edit', $record->slug)), // Используем slug для ссылки

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
            'edit' => Pages\EditArticle::route('/{slug}/edit'),
        ];
    }
}
