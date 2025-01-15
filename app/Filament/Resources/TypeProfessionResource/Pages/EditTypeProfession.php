<?php

namespace App\Filament\Resources\TypeProfessionResource\Pages;

use App\Filament\Resources\TypeProfessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeProfession extends EditRecord
{
    protected static string $resource = TypeProfessionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
