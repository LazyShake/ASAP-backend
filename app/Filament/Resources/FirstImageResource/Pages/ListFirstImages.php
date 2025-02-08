<?php

namespace App\Filament\Resources\FirstImageResource\Pages;

use App\Filament\Resources\FirstImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFirstImages extends ListRecords
{
    protected static string $resource = FirstImageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Создать'),
        ];
    }
}
