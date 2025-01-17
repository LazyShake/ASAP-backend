<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ProfessionResource;
use App\Models\Article;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    // 1. Вывод всех статей с пагинацией
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 12); // Количество статей на странице (по умолчанию 12)
            $articles = Article::with('type', 'profession')->paginate($perPage); // Пагинация
            return ArticleResource::collection($articles);
        } catch (\Exception $e) {
            Log::error('Ошибка при получении списка статей: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить статьи'], 500);
        }
    }

    // 2. Вывод статей по профессии с фильтрацией
    public function byProfession(Request $request, $professionId)
    {
        try {
            $query = Article::where('id_profession', $professionId);

            // Фильтрация по типу
            if ($request->has('type_id')) {
                $query->where('type_id', $request->get('type_id'));
            }

            // Пагинация
            $perPage = $request->get('per_page', 12);
            $articles = $query->with('type', 'profession')->paginate($perPage);

            return ArticleResource::collection($articles);
        } catch (\Exception $e) {
            Log::error('Ошибка при фильтрации статей: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить статьи для профессии'], 500);
        }
    }

    // 3. Вывод конкретной статьи
    public function showArticle($id)
    {
        try {
            // Получение данных статьи
            $article = Article::with('type', 'profession')->findOrFail($id);

            // Получение связанных статей (по типу или тегам)
            $relatedArticles = Article::where('type_id', $article->type->id_type)
                ->where('id_article', '!=', $id) // Исключаем текущую статью
                ->take(3)
                ->get();

            // Получение данных профессий
            $professions = Profession::all();

            // Возвращаем объединённые данные
            return response()->json([
                'article' => new ArticleResource($article),
                'related_articles' => ArticleResource::collection($relatedArticles),
                'professions' => ProfessionResource::collection($professions),
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Статья не найдена: ' . $e->getMessage());
            return response()->json(['error' => 'Статья не найдена'], 404);
        } catch (\Exception $e) {
            Log::error('Ошибка при загрузке статьи: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить статью'], 500);
        }
    }

    // API для CTA: Пересылка в Telegram
    public function sendToTelegram(Request $request)
    {
        try {
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

            Log::error('Ошибка отправки сообщения в Telegram: ' . $response->body());
            return response()->json(['success' => false, 'error' => 'Не удалось отправить сообщение в Telegram'], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Ошибка валидации: ' . $e->getMessage());
            return response()->json(['error' => 'Некорректные данные для отправки сообщения'], 422);
        } catch (\Exception $e) {
            Log::error('Ошибка при отправке сообщения в Telegram: ' . $e->getMessage());
            return response()->json(['error' => 'Произошла ошибка при отправке сообщения в Telegram'], 500);
        }
    }
}
