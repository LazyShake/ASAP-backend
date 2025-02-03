<?php

namespace App\Filament\Resources\SeoFileResource\Pages;

use App\Filament\Resources\SeoFileResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeoFile extends EditRecord
{
    protected static string $resource = SeoFileResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Удалить'),
        ];
    }
}
