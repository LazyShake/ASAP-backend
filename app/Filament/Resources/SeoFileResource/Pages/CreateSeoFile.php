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

    protected function getButtonLabel(): string
    {
        return 'Создать';
    }
}
