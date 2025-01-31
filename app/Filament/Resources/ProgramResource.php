<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';
    protected static ?string $pluralLabel = 'Программы';
    protected static ?string $modelLabel = 'Программа';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_module')
                    ->label('Название модуля')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Repeater::make('content_module')
                    ->label('Контент модуля')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('text')
                            ->label('Текст')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Repeater::make('sub_items')
                            ->label('Подэлементы')
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->label('Текст')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->createItemButtonLabel('Добавить подэлемент')
                            ->columns(1), // Вложенные элементы тоже идут в столбик
                    ])
                    ->columns(1) // Основные элементы в столбик
                    ->createItemButtonLabel('Добавить модуль'),
                Forms\Components\Select::make('id_profession')
                    ->label('Профессия')
                    ->options(Profession::all()->pluck('name_profession', 'id_profession'))
                    ->required()
                    ->searchable()
                    ->placeholder('Выберите профессию'),
                Forms\Components\TextInput::make('number_module')
                    ->label('Номер модуля')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_module')
                    ->label('Название модуля')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('profession.name_profession')
                    ->label('Профессия')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_module')
                    ->label('Номер модуля')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
