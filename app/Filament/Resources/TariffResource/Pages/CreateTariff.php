<?php

namespace App\Filament\Resources\TariffResource\Pages;

use App\Filament\Resources\TariffResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTariff extends CreateRecord
{
    protected static string $resource = TariffResource::class;

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
