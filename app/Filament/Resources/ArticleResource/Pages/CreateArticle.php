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

    protected function getActions(): array
    {
        return [
            // Переопределяем стандартную кнопку "Create"
            \Filament\Actions\Action::make('create')
                ->label('Добавить') // Новый текст для кнопки
                ->action(fn() => $this->create()),

            // Переопределяем кнопку "Create and Create Another"
            \Filament\Actions\Action::make('createAndCreateAnother')
                ->label('Добавить и создать еще') // Новый текст для кнопки
                ->action(fn() => $this->createAndCreateAnother()),

            // Переопределяем кнопку "Cancel"
            \Filament\Actions\Action::make('cancel')
                ->label('Отменить') // Новый текст для кнопки
                ->action(fn() => $this->cancel()),
        ];
    }
}
