<?php

namespace App\Filament\Resources\TrackerResource\Pages;

use App\Filament\Resources\TrackerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTracker extends EditRecord
{
    protected static string $resource = TrackerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
