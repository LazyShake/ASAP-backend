<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgressResource\Pages;
use App\Models\Progress;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class ProgressResource extends Resource
{
    protected static ?string $model = Progress::class;

    protected static ?string $navigationIcon = 'heroicon-o-trending-up';
    protected static ?string $pluralLabel = 'Прогресс';

    protected static ?string $modelLabel = 'Прогресс';
    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('before')
                    ->label('До')
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск

                    ->image(),

                FileUpload::make('after')
                    ->label('После')
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск

                    ->image(),

                Select::make('id_profession')
                    ->label('Профессия')
                    ->relationship('profession', 'name_profession')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('profession.name_profession')
                    ->label('Профессия')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Добавьте фильтры, если нужно
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Удалить'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Добавьте связи, если нужно
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgress::route('/'),
            'Создать' => Pages\CreateProgress::route('/create'),
            'Редактировать' => Pages\EditProgress::route('/{record}/edit'),
        ];
    }
}
