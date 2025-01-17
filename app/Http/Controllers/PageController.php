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
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    // Главная страница блога
    public function index()
    {
        try {
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
        } catch (\Exception $e) {
            Log::error('Ошибка загрузки главной страницы блога: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить данные'], 500);
        }
    }

    // Получить конкретную статью
    public function getArticle(int $articleId)
    {
        try {
            $article = Article::findOrFail($articleId);
            $relatedArticles = Article::where('id', '!=', $articleId)->latest()->take(3)->get();
            $professions = Profession::all();

            return response()->json([
                'article' => new DetailedArticleResource($article),
                'related_articles' => ArticleResource::collection($relatedArticles),
                'professions' => ProfessionPreviewResource::collection($professions),
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning("Статья с ID {$articleId} не найдена: " . $e->getMessage());
            return response()->json(['error' => 'Статья не найдена'], 404);
        } catch (\Exception $e) {
            Log::error('Ошибка загрузки статьи: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить статью'], 500);
        }
    }

    // Получить список из 3 последних статей
    public function getRecentArticles()
    {
        try {
            $recentArticles = Article::latest()->take(3)->get();

            return response()->json([
                'articles' => ArticleResource::collection($recentArticles),
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка получения последних статей: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить статьи'], 500);
        }
    }

    // Получить список всех профессий
    public function getProfessions()
    {
        try {
            $professions = Profession::all();

            return response()->json([
                'professions' => ProfessionPreviewResource::collection($professions),
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка загрузки списка профессий: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить список профессий'], 500);
        }
    }
}
