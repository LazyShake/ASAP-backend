<?php

namespace App\Filament\Resources\TrackerResource\Pages;

use App\Filament\Resources\TrackerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrackers extends ListRecords
{
    protected static string $resource = TrackerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
