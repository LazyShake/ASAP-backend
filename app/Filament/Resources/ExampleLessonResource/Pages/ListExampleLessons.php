<?php

namespace App\Filament\Resources\ExampleLessonResource\Pages;

use App\Filament\Resources\ExampleLessonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExampleLessons extends ListRecords
{
    protected static string $resource = ExampleLessonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
