<?php

namespace App\Filament\Resources\ProgressResource\Pages;

use App\Filament\Resources\ProgressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgress extends ListRecords
{
    protected static string $resource = ProgressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Создать'),
        ];
    }
}
