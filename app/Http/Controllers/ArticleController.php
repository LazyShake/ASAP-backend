<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Вывод всех статей
    public function index()
    {
        $articles = Article::with('type', 'profession')->get(); // Загрузка статей с типами и профессиями
        return ArticleResource::collection($articles);
    }

    // Вывод статей по профессии
    public function byProfession($professionId)
    {
        $articles = Article::getArticlesByProfession($professionId);
        return ArticleResource::collection($articles);
    }

    // Вывод конкретной статьи
    public function show($id)
    {
        $article = Article::with('type', 'profession')->findOrFail($id);
        return new ArticleResource($article);
    }
}