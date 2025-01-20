<?php

namespace App\Filament\Resources\ProgressResource\Pages;

use App\Filament\Resources\ProgressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgress extends EditRecord
{
    protected static string $resource = ProgressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
