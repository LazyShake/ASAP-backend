<?php

namespace App\Filament\Resources\ProgressResource\Pages;

use App\Filament\Resources\ProgressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProgress extends CreateRecord
{
    protected static string $resource = ProgressResource::class;

    protected function getCreateButtonLabel(): string
    {
        return 'Добавить';
    }

    protected function getCreateAnotherButtonLabel(): string
    {
        return 'Добавить и создать еще';
    }

    protected function getCancelButtonLabel(): string
    {
        return 'Отменить';
    }
}
