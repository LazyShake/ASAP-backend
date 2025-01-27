<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Article;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    public function mount($slug): void
    {
        // Ищем запись по slug
        $article = Article::where('slug', $slug)->firstOrFail();

        // Передаем ID записи в родительский метод
        parent::mount($article->getKey());
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
