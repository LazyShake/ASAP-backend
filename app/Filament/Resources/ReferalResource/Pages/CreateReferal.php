<?php

namespace App\Filament\Resources\ReferalResource\Pages;

use App\Filament\Resources\ReferalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReferal extends CreateRecord
{
    protected static string $resource = ReferalResource::class;

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
