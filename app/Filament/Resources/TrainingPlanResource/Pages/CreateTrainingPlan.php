<?php

namespace App\Filament\Resources\TrainingPlanResource\Pages;

use App\Filament\Resources\TrainingPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrainingPlan extends CreateRecord
{
    protected static string $resource = TrainingPlanResource::class;

    protected function getButtonLabel(): string
    {
        return 'Создать';
    }
}
