<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MentorResource\Pages;
use App\Models\Mentor;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

class MentorResource extends Resource
{
    protected static ?string $model = Mentor::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $pluralLabel = 'Менторы';

    protected static ?string $modelLabel = 'Ментор';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_mentors')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),

                TextInput::make('description')
                    ->label('Описание')
                    ->required()
                    ->maxLength(1000),

                Forms\Components\FileUpload::make('picture')
                    ->label('Изображение')
                    
                    ->imagePreviewHeight(150)
            ->preserveFilenames()
            ->store(function ($file) {
                // Указываем, что файл нужно сохранить в public диск и папку 'after'
                return $file->store('mentor', 'public');
            })
                    ->image(),

                Toggle::make('status')
                    ->label('Отображать на главной')
                    ->default(false),

                Select::make('id_profession')
                    ->label('Профессия')
                    ->relationship('profession', 'name_profession')
                    ->required(),

                TextInput::make('workplace')
                    ->label('Место работы')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_mentors')
                    ->label('Имя')
                    ->searchable(),

                ImageColumn::make('picture')
                    ->label('Изображение')
                    ->size(50),

                TextColumn::make('workplace')
                    ->label('Место работы'),

                Tables\Columns\BooleanColumn::make('status')
                    ->label('На главной'),

                TextColumn::make('profession.name_profession')
                    ->label('Профессия')
                    ->sortable(),
            ])
            ->filters([
                // Добавьте фильтры, если требуется
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Укажите отношения, если они есть
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMentors::route('/'),
            'create' => Pages\CreateMentor::route('/create'),
            'edit' => Pages\EditMentor::route('/{record}/edit'),
        ];
    }
}
