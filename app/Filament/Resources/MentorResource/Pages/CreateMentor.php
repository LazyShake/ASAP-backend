<?php

namespace App\Filament\Resources\MentorResource\Pages;

use App\Filament\Resources\MentorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMentor extends CreateRecord
{
    protected static string $resource = MentorResource::class;

    protected function getButtonLabel(): string
    {
        return 'Создать';
    }
}
