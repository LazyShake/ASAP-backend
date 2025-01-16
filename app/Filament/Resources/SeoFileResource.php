<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoFileResource\Pages;
use App\Models\SeoFile;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Resources\Form;
use Filament\Resources\Table;

class SeoFileResource extends Resource
{
    protected static ?string $model = SeoFile::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'SEO Файлы';
    protected static ?string $navigationGroup = 'Управление';

    public static function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('file')
                ->label('Загрузить файл')
                ->required()
                ->disk('local')
                ->directory('seo-files')
                ->visibility('public'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('file_name')->label('Название файла'),
                TextColumn::make('path')->label('Путь к файлу'),
                IconColumn::make('action')
                    ->label('Удалить')
                    ->action(DeleteAction::class),
            ])
            ->filters([
                // Добавьте фильтры, если нужно
            ])
            ->actions([
                // Добавьте действия, если нужно
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeoFiles::route('/'),
            'create' => Pages\CreateSeoFile::route('/create'),
        ];
    }
}
