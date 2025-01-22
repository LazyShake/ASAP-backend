<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\DetailedArticleResource;
use App\Http\Resources\ProfessionPreviewResource;
use App\Models\Article;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $articles = Article::with('type', 'profession')->paginate($perPage);
        return ArticleResource::collection($articles);
    }

    public function byProfession(Request $request, $professionId)
    {
        $query = Article::where('id_profession', $professionId);

        if ($request->has('type_id')) {
            $query->where('type_id', $request->get('type_id'));
        }

        $perPage = $request->get('per_page', 12);
        $articles = $query->with('type', 'profession')->paginate($perPage);

        return ArticleResource::collection($articles);
    }

    public function showArticle($id)
    {
        $article = Article::with('type', 'profession')->findOrFail($id);

        $relatedArticles = Article::where('type_id', $article->type->id_type)
            ->where('id_article', '!=', $id)
            ->take(3)
            ->get();

        $professions = Profession::all();

        return response()->json([
            'article' => new DetailedArticleResource($article),
            'related_articles' => ArticleResource::collection($relatedArticles),
            'professions' => ProfessionPreviewResource::collection($professions),
        ]);
    }

    public function sendToTelegram(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $response = Http::post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage', [
            'chat_id' => env('TELEGRAM_CHAT_ID'),
            'text' => $validated['message'],
        ]);

        if (!$response->successful()) {
            abort(500, 'Не удалось отправить сообщение в Telegram');
        }

        return response()->json(['success' => true, 'message' => 'Message sent to Telegram']);
    }
}
