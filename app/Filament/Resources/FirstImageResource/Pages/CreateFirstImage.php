<?php

namespace App\Filament\Resources\FirstImageResource\Pages;

use App\Filament\Resources\FirstImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFirstImage extends CreateRecord
{
    protected static string $resource = FirstImageResource::class;
}
