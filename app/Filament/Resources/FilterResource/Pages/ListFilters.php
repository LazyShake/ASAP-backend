<?php

namespace App\Filament\Resources\FilterResource\Pages;

use App\Filament\Resources\FilterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFilters extends ListRecords
{
    protected static string $resource = FilterResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
