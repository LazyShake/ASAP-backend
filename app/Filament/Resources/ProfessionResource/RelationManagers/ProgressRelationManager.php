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

    protected static ?string $title = 'Прогресс';
protected static ?string $pluralTitle = 'Прогресс';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('before')
                ->label('До')
                    ->required()
                    ->image(),
                    Forms\Components\FileUpload::make('after')
                    ->label('После')
                    ->required()
                    ->image(),
                    /*Forms\Components\Select::make('profession') // Поле для выбора нескольких тегов
                    ->label('профессия')
                    ->options(Profession::query()->pluck('name_profession', 'id_profession')) // Список тегов
                    ->searchable() // Позволяет искать по тегам
                    ->placeholder('Выберите профессии'),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('before')->label('До')->size(50),
                Tables\Columns\ImageColumn::make('after')->label('После')->size(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Создать'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Удалить'),
            ]);
    }    
}
