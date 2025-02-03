<?php

namespace App\Filament\Resources\ReferalResource\Pages;

use App\Filament\Resources\ReferalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReferals extends ListRecords
{
    protected static string $resource = ReferalResource::class;

    protected function getActions(): array
    {
        return [

        ];
    }
}
