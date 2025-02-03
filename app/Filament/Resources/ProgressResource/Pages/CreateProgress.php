<?php

namespace App\Filament\Resources\ProgressResource\Pages;

use App\Filament\Resources\ProgressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProgress extends CreateRecord
{
    protected static string $resource = ProgressResource::class;

    protected function getButtonLabel(): string
    {
        return 'Создать';
    }
}
