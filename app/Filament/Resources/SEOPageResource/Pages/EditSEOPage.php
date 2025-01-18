<?php

namespace App\Filament\Resources\SEOPageResource\Pages;

use App\Filament\Resources\SEOPageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSEOPage extends EditRecord
{
    protected static string $resource = SEOPageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
