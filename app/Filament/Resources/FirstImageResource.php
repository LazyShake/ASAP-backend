<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FirstImageResource\Pages;
use App\Models\FirstImage;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class FirstImageResource extends Resource
{
    protected static ?string $model = FirstImage::class;
    protected static ?string $navigationIcon = 'heroicon-o-photograph';
    protected static ?string $pluralLabel = 'Первые изображения';
    protected static ?string $navigationGroup = 'Главная';

    protected static ?string $modelLabel = 'Изображение';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->required()
                    ->image()
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск
                    ->directory('article')
                    ->default(fn($get) => $get('record.image')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение')
                    ->disk('public') // Указываем диск
                    ->url(fn($record) => asset('storage/' . $record->image)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFirstImages::route('/'),
            'edit' => Pages\EditFirstImage::route('/{record}/edit'),
            //'Создать' => Pages\CreateFirstImage::route('/create'),
        ];
    }
}
