<?php

namespace App\Filament\Resources\FilterResource\Pages;

use App\Filament\Resources\FilterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFilter extends CreateRecord
{
    protected static string $resource = FilterResource::class;

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
