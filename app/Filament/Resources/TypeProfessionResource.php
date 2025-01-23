<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeProfessionResource\Pages;
use App\Models\TypeProfession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TypeProfessionResource extends Resource
{
    protected static ?string $model = TypeProfession::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $pluralLabel = 'Типы профессий';
    protected static ?string $modelLabel = 'Тип профессии';
    //protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_type')
                    ->label('Название типа')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_type')
                    ->label('Название типа'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                // Можно добавить фильтры, если необходимо
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
            'index' => Pages\ListTypeProfessions::route('/'),
            'create' => Pages\CreateTypeProfession::route('/create'),
            'edit' => Pages\EditTypeProfession::route('/{record}/edit'),
        ];
    }
}
