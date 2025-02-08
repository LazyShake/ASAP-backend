<?php

namespace App\Filament\Resources\SeoFileResource\Pages;

use App\Filament\Resources\SeoFileResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;

class ListSeoFiles extends ListRecords
{
    protected static string $resource = SeoFileResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Создать'),
        ];
    }
}
