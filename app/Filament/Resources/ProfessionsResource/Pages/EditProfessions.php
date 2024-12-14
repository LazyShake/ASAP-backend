<?php

namespace App\Filament\Resources\ProfessionsResource\Pages;

use App\Filament\Resources\ProfessionsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessions extends EditRecord
{
    protected static string $resource = ProfessionsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
