<?php

namespace App\Filament\Resources\SEOPageResource\Pages;

use App\Filament\Resources\SEOPageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSEOPages extends ListRecords
{
    protected static string $resource = SEOPageResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make()->label('Создать'),
        ];
    }
}
