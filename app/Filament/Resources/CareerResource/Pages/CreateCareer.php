<?php

namespace App\Filament\Resources\CareerResource\Pages;

use App\Filament\Resources\CareerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCareer extends CreateRecord
{
    protected static string $resource = CareerResource::class;

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
