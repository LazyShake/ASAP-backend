<?php

namespace App\Filament\Resources\FilterResource\Pages;

use App\Filament\Resources\FilterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFilter extends CreateRecord
{
    protected static string $resource = FilterResource::class;

    protected function getButtonLabel(): string
    {
        return 'Создать';
    }
}
