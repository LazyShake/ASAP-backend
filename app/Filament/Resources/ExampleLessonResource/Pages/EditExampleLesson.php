<?php

namespace App\Filament\Resources\ExampleLessonResource\Pages;

use App\Filament\Resources\ExampleLessonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExampleLesson extends EditRecord
{
    protected static string $resource = ExampleLessonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Удалить'),
        ];
    }
}
