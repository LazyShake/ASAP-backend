<?php

namespace App\Filament\Resources\FirstImageResource\Pages;

use App\Filament\Resources\FirstImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFirstImage extends CreateRecord
{
    protected static string $resource = FirstImageResource::class;

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
