<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingPlanResource\Pages;
use App\Filament\Resources\TrainingPlanResource\RelationManagers;
use App\Models\TrainingPlan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingPlanResource extends Resource
{
    protected static ?string $model = TrainingPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainingPlans::route('/'),
            'create' => Pages\CreateTrainingPlan::route('/create'),
            'edit' => Pages\EditTrainingPlan::route('/{record}/edit'),
        ];
    }    
}
