<?php

namespace App\Filament\Resources\ExampleLessonResource\Pages;

use App\Filament\Resources\ExampleLessonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExampleLesson extends CreateRecord
{
    protected static string $resource = ExampleLessonResource::class;
}
