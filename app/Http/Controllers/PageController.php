<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventArticleResource;
use App\Http\Resources\FilterResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ProfessionPreviewResource;
use App\Http\Resources\DetailedArticleResource;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Filter;
use App\Models\Profession;

class PageController extends Controller
{
    // Главная страница блога
    public function index()
    {
        $eventArticles = Article::where('type', 'Мероприятие')->get();
        $filters = Filter::all();
        $articles = Article::where('type', '!=', 'Мероприятие')->paginate(9);
        $professions = Profession::all();

        return response()->json([
            'event_articles' => EventArticleResource::collection($eventArticles),
            'filters' => FilterResource::collection($filters),
            'articles' => ArticleResource::collection($articles),
            'professions' => ProfessionPreviewResource::collection($professions),
        ]);
    }

    // Получить конкретную статью
    public function getArticle(int $articleId)
    {
        $article = Article::findOrFail($articleId);
        $relatedArticles = Article::where('id', '!=', $articleId)->latest()->take(3)->get();
        $professions = Profession::all();

        return response()->json([
            'article' => new DetailedArticleResource($article),
            'related_articles' => ArticleResource::collection($relatedArticles),
            'professions' => ProfessionPreviewResource::collection($professions),
        ]);
    }

    // Получить список из 3 последних статей
    public function getRecentArticles()
    {
        $recentArticles = Article::latest()->take(3)->get();

        return response()->json([
            'articles' => ArticleResource::collection($recentArticles),
        ]);
    }

    // Получить список всех профессий
    public function getProfessions()
    {
        $professions = Profession::all();

        return response()->json([
            'professions' => ProfessionPreviewResource::collection($professions),
        ]);
    }
}