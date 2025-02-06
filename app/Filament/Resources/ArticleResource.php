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
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\EditRecord;



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
                    ->reactive()
                    ->default(fn($get) => $get('record.name_article')) // Привязка к значению из модели
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled(fn($record) => $record !== null) // Запрет изменения после создания
                    ->helperText('Будет автоматически создан из названия.')
                    ->default(fn($get) => $get('record.slug')),

                Forms\Components\Textarea::make('short_text')
                    ->label('Краткий текст')
                    ->required()
                    ->maxLength(500)
                    ->default(fn($get) => $get('record.short_text')),

                Forms\Components\RichEditor::make('content')
                    ->label('Контент')
                    ->required()
                    ->default(fn($get) => $get('record.content')),

                Forms\Components\FileUpload::make('picture')
                    ->label('Изображение')
                    ->required()
                    ->image()
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск
                    ->directory('article')
                    ->default(fn($get) => $get('record.picture')),

                Select::make('type_id')
                    ->label('Тип статьи')
                    ->options(Type::query()->pluck('name_type', 'id_type'))
                    ->searchable()
                    ->placeholder('Выберите тип')
                    ->required()
                    ->reactive()
                    ->default(fn($get) => $get('record.type_id')) // Привязка к значению из модели
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state === 1 || $state === 2) {
                            $set('filter_id', Filter::first()->id);
                            $set('filter_disabled', true);
                        } else {
                            $set('filter_id', null);
                            $set('filter_disabled', false);
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
                    ->reactive()
                    ->visible(function (callable $get) {
                        $typeId = $get('type_id');
                        return $typeId == 4;
                    })
                    ->disabled(function (callable $get) {
                        return $get('filter_disabled');
                    })
                    ->default(fn($get) => $get('record.filter_id')), // Привязка к значению из модели

                Select::make('id_profession')
                    ->label('Профессия')
                    ->options(function () {
                        return Profession::query()->pluck('name_profession', 'id_profession')->toArray();
                    })
                    ->searchable()
                    ->placeholder('Выберите профессии')
                    ->nullable()
                    ->reactive()
                    ->visible(function (callable $get) {
                        $typeId = $get('type_id');
                        return $typeId == 4;
                    })
                    ->disabled(function (callable $get) {
                        return $get('profession_disabled');
                    })
                    ->default(fn($get) => $get('record.id_profession')), // Привязка к значению из модели

                Select::make('tags')
                    ->label('Теги')
                    ->multiple()
                    ->relationship('tags', 'name_tag')
                    ->searchable()
                    ->getSearchResultsUsing(function (string $query) {
                        return Tags::where('name_tag', 'like', "%{$query}%")
                            ->pluck('name_tag', 'id_tag');
                    })
                    ->placeholder('Выберите теги или создайте новый')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name_tag')->required(),
                    ]),
                //->default(fn($get) => $get('record.tags')->pluck('id_tag')->toArray()), // Привязка к значениям из модели

                Forms\Components\TextInput::make('link')
                    ->label('Ссылка')
                    ->url()
                    ->maxLength(255)
                    ->nullable()
                    ->reactive()
                    ->visible(function (callable $get) {
                        $typeId = $get('type_id');
                        return $typeId == 3;
                    })
                    ->disabled(function (callable $get) {
                        return $get('link_disabled');
                    })
                    ->default(fn($get) => $get('record.link')),

                Forms\Components\TextInput::make('owner_name')
                    ->label('Имя автора')
                    ->maxLength(255)
                    ->default(fn($get) => $get('record.owner_name')),

                Forms\Components\Textarea::make('owner_description')
                    ->label('Описание автора')
                    ->maxLength(500)
                    ->default(fn($get) => $get('record.owner_description')),

                Forms\Components\FileUpload::make('owner_picture')
                    ->label('Фото автора')
                    ->required()
                    ->image()
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск
                    ->directory('article')
                    ->default(fn($get) => $get('record.owner_picture')),
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
                    ->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Удалить'),
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
