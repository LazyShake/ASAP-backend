<?php

namespace App\Filament\Resources\StatisticResource\Pages;

use App\Filament\Resources\StatisticResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatistic extends EditRecord
{
    protected static string $resource = StatisticResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
