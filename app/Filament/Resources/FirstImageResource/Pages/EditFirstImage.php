<?php

namespace App\Filament\Resources\FirstImageResource\Pages;

use App\Filament\Resources\FirstImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFirstImage extends EditRecord
{
    protected static string $resource = FirstImageResource::class;

    protected function getActions(): array
    {
        return [
        ];
    }
}
