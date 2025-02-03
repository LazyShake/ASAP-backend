<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['slug'])) {
            $data['slug'] = \App\Models\Article::generateUniqueSlug($data['name_article']);
        }

        return $data;
    }

    protected function getFooterActions(): array
{
    return [
        Filament\Actions\Action::make('create')
            ->label('Добавить'),
        
        Filament\Actions\Action::make('createAndCreateAnother')
            ->label('Добавить и создать еще'),

        Filament\Actions\Action::make('cancel')
            ->label('Отменить'),
    ];
}
}
