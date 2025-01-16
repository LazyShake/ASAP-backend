<?php

namespace App\Filament\Resources\ExampleResource\Pages;

use App\Filament\Resources\ExampleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExamples extends ListRecords
{
    protected static string $resource = ExampleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
