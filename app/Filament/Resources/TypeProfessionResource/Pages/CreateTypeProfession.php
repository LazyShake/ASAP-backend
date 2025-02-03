<?php

namespace App\Filament\Resources\TypeProfessionResource\Pages;

use App\Filament\Resources\TypeProfessionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeProfession extends CreateRecord
{
    protected static string $resource = TypeProfessionResource::class;

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
