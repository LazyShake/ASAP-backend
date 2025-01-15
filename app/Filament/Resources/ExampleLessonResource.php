<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExampleResource\Pages;
use App\Models\ExampleLesson;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;

class ExampleLessonResource extends Resource
{
    protected static ?string $model = ExampleLesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $pluralLabel = 'Примерные уроки';
    protected static ?string $modelLabel = 'Примерный урок';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_example_lesson')
                    ->label('Название урока')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->label('Ссылка на урок')
                    ->url()
                    ->required()
                    ->maxLength(255),
                Select::make('id_profession')
                    ->label('Профессия')
                    ->relationship('profession', 'name_profession')
                    ->required()
                    ->searchable()
                    ->placeholder('Выберите профессию'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_example_lesson')
                    ->label('Название урока')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Ссылка на урок')
                    ->url(fn ($record) => $record->link) // Открывает ссылку
                    ->urlLabel('Открыть'),
                Tables\Columns\TextColumn::make('profession.name_profession')
                    ->label('Профессия')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
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
            'index' => Pages\ListExamples::route('/'),
            'create' => Pages\CreateExample::route('/create'),
            'edit' => Pages\EditExample::route('/{record}/edit'),
        ];
    }
}
