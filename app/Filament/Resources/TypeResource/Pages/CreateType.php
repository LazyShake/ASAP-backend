<?php

namespace App\Filament\Resources\TypeResource\Pages;

use App\Filament\Resources\TypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateType extends CreateRecord
{
    protected static string $resource = TypeResource::class;

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
