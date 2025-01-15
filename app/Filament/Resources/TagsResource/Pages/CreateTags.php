<?php

namespace App\Filament\Resources\TagsResource\Pages;

use App\Filament\Resources\TagsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTags extends CreateRecord
{
    protected static string $resource = TagsResource::class;
}
