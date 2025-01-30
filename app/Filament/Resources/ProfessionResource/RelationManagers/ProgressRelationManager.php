<?php

namespace App\Filament\Resources\ProfessionResource\RelationManagers;

use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgressRelationManager extends RelationManager
{
    protected static string $relationship = 'progress';

    protected static ?string $recordTitleAttribute = 'before';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('before')
                    ->required()
                    ->image()
                    ->maxLength(255),
                    Forms\Components\FileUpload::make('after')
                    ->required()
                    ->image()
                    ->maxLength(255),
                    Forms\Components\Select::make('profession') // Поле для выбора нескольких тегов
                    ->label('профессия')
                    ->options(Profession::query()->pluck('name_profession', 'id_profession')) // Список тегов
                    ->searchable() // Позволяет искать по тегам
                    ->placeholder('Выберите профессии'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('before'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
