<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Profession;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    // 1. Вывод всех статей с пагинацией
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12); // Количество статей на странице (по умолчанию 10)
        $articles = Article::with('type', 'profession')->paginate($perPage); // Пагинация
        return ArticleResource::collection($articles);
    }

    // 2. Вывод статей по профессии с фильтрацией
    public function byProfession(Request $request, $professionId)
    {
        $query = Article::where('id_profession', $professionId);

        // Фильтрация по типу
        if ($request->has('type_id')) {
            $query->where('type_id', $request->get('type_id'));
        }

        // Пагинация
        $perPage = $request->get('per_page', 12);
        $articles = $query->with('type', 'profession')->paginate($perPage);

        return ArticleResource::collection($articles);
    }

    // 3. Вывод конкретной статьи
    public function showArticle($id)
    {
        $article = Article::with('type', 'profession')->findOrFail($id);
        return new ArticleResource($article);
    }

    // API для блока "Это интересно"
    public function getRelatedArticles($id)
    {
        $article = Article::findOrFail($id);

        $relatedArticles = Article::where('type', $article->type)
            ->where('id_article', '!=', $id)
            ->take(3)
            ->get();

        return ArticleResource::collection($relatedArticles);
    }

    // API для блока "Профессии"
    public function getProfessions()
    {
        $professions = Profession::all();

        return response()->json($professions->map(function ($profession) {
            return [
                'id' => $profession->id_profession,
                'name' => $profession->name,
                'description' => $profession->description,
                'picture' => asset('storage/' . $profession->picture),
                'link' => route('professions.show', $profession->id_profession),
            ];
        }));
    }

    // API для CTA: Пересылка в Telegram
    public function sendToTelegram(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $response = Http::post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage', [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => $validated['message'],
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Message sent to Telegram']);
        }

        return response()->json(['success' => false, 'error' => 'Failed to send message'], 500);
    }
}