<?php

namespace App\Filament\Resources\TypeProfessionResource\Pages;

use App\Filament\Resources\TypeProfessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeProfessions extends ListRecords
{
    protected static string $resource = TypeProfessionResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make()->label('Создать'),
        ];
    }
}
