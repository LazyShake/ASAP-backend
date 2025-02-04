<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingPlanResource\Pages;
use App\Models\TrainingPlan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TrainingPlanResource extends Resource
{
    protected static ?string $model = TrainingPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $pluralLabel = 'Учебные планы';
    protected static ?string $modelLabel = 'Учебный план';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Изображение')
                    ->image()
                    ->preserveFilenames()
                    ->disk('public') // Указываем диск
    ->directory('training_plan') ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Изображение'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                // Можно добавить фильтры, если необходимо
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingPlans::route('/'),
            'Редактировать' => Pages\EditTrainingPlan::route('/{record}/edit'),
        ];
    }
}
