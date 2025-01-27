<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Article;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    public function mount($record): void
    {
        // Проверяем, является ли $record slug или ID
        $this->record = Article::where('slug', $record)->orWhere('id', $record)->firstOrFail();

        // Вызываем родительский метод с ID найденной записи
        parent::mount($this->record->getKey());
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
