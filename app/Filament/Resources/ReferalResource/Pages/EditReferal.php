<?php

namespace App\Filament\Resources\ReferalResource\Pages;

use App\Filament\Resources\ReferalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReferal extends EditRecord
{
    protected static string $resource = ReferalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
