<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use App\Models\Profession;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $pluralLabel = 'Навыки';
    protected static ?string $modelLabel = 'Навык';
    protected static ?string $navigationGroup = 'Профессии';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название навыка')
                    ->required()
                    ->maxLength(255),
                /*Forms\Components\Select::make('profession_id')
                    ->label('Профессия')
                    ->options(Profession::all()->pluck('name_profession', 'id_profession')->toArray())
                    ->required()
                    ->searchable()
                    ->nullable(),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название'),
                /*Tables\Columns\TextColumn::make('profession.name_profession')
                    ->label('Профессия'),*/
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                /*Tables\Filters\SelectFilter::make('profession_id')
                    ->label('Профессия')
                    ->options(Profession::all()->pluck('name_profession', 'id')->toArray()),*/
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Удалить'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkills::route('/'),
            'Создать' => Pages\CreateSkill::route('/create'),
            'Редактировать' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
