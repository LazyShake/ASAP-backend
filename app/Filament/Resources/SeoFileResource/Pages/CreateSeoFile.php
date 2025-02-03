<?php

namespace App\Filament\Resources\SeoFileResource\Pages;

use App\Filament\Resources\SeoFileResource;
use App\Models\SeoFile;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeoFile extends CreateRecord
{
    protected static string $resource = SeoFileResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Обработка данных перед созданием записи
        return $data;
    }

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
