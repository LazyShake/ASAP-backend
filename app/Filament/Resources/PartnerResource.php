<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $pluralLabel = 'Партнеры';
    protected static ?string $navigationGroup = 'Главная';
    protected static ?string $modelLabel = 'Партнер';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_partners')
                    ->label('Название партнера')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('logo_partners')
                    ->label('Логотип')
                    
                    ->image()
                    ->imagePreviewHeight(150)
            ->preserveFilenames()
            ->disk('public') // Указываем диск
    ->directory('partner') 
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_partners')->label('Название партнера')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('logo_partners')->label('Логотип'),
            ])
            ->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'Создать' => Pages\CreatePartner::route('/create'),
            'Редактировать' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
