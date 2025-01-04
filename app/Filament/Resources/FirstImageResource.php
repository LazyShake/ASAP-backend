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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->directory('first_images')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Изображение'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFirstImages::route('/'),
            'create' => Pages\CreateFirstImage::route('/create'),
            'edit' => Pages\EditFirstImage::route('/{record}/edit'),
        ];
    }
}
