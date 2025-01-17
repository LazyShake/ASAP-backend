<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Referal;
use App\Models\Tracker;
use App\Models\Tariff;
use Illuminate\Http\Request;
use App\Http\Resources\ProfessionResource;
use App\Http\Resources\ReferalResource;
use App\Http\Resources\TariffResource;
use App\Http\Resources\TrackerResource;
use Illuminate\Support\Facades\Log;

class ProfessionController extends Controller
{
    /**
     * Возвращает список профессий с пагинацией.
     */
    public function index()
    {
        try {
            $professions = Profession::with([
                'career',
                'typeProfession',
                'color',
                'skills',
                'mentors',
                'reviews',
                'progress',
                'articles',
            ])->paginate(10);

            return ProfessionResource::collection($professions);
        } catch (\Exception $e) {
            Log::error('Ошибка при получении списка профессий: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить список профессий'], 500);
        }
    }

    /**
     * Возвращает данные о конкретной профессии и связанных сущностях,
     * а также добавляет трекеры, тарифы и рефералы из соответствующих таблиц.
     *
     * @param int $id
     * @return array
     */
    public function show(int $id)
    {
        try {
            // Получаем данные о профессии и её связях
            $profession = Profession::with([
                'career',
                'typeProfession',
                'color',
                'skills',
                'mentors',
                'reviews',
                'progress',
                'articles',
            ])->findOrFail($id);

            // Получаем трекеры, тарифы и рефералы
            $trackers = Tracker::all(); // Все трекеры
            $referals = Referal::all(); // Все рефералы
            $tariffs = Tariff::all(); // Все тарифы

            return response()->json([
                'profession' => new ProfessionResource($profession),
                'trackers' => TrackerResource::collection($trackers),
                'referals' => ReferalResource::collection($referals),
                'tariffs' => TariffResource::collection($tariffs),
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning("Профессия с ID {$id} не найдена: " . $e->getMessage());
            return response()->json(['error' => 'Профессия не найдена'], 404);
        } catch (\Exception $e) {
            Log::error('Ошибка при получении данных профессии: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить данные профессии'], 500);
        }
    }
}
