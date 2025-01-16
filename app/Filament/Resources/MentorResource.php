<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MentorResource\Pages;
use App\Filament\Resources\MentorResource\RelationManagers;
use App\Models\Mentor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\BadgeColumn;

class MentorResource extends Resource
{
    protected static ?string $model = Mentor::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Mentors';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name_mentors')
                ->label('Name')
                ->required()
                ->maxLength(255),
                
            Textarea::make('description')
                ->label('Description')
                ->required()
                ->maxLength(1000),
                
            TextInput::make('picture')
                ->label('Picture URL')
                ->maxLength(255),
                
            Select::make('role')
                ->label('Role')
                ->options([
                    'mentor' => 'Mentor',
                    'tracker' => 'Tracker',
                ])
                ->required(),
                
            Select::make('id_profession')
                ->label('Profession')
                ->relationship('profession', 'name_profession')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name_mentors')
                ->label('Name')
                ->searchable(),
                
            ImageColumn::make('picture')
                ->label('Picture')
                ->size(50),
                
            badgeColumn::make('role')
            ->label('Role')
            ->enum([
                'mentor' => 'Mentor',
                'tracker' => 'Tracker',
            ])
            ->colors([
                'success' => 'mentor',
                'warning' => 'tracker',
            ]),

                
            TextColumn::make('profession.name_profession')
                ->label('Profession')
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMentors::route('/'),
            'create' => Pages\CreateMentor::route('/create'),
            'edit' => Pages\EditMentor::route('/{record}/edit'),
        ];
    }    

    
}
