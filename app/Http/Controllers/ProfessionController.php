<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Referal;
use App\Models\Tracker;
use App\Models\Tariff; // Добавляем модель для тарифов
use Illuminate\Http\Request;
use App\Http\Resources\ProfessionResource;
use App\Http\Resources\ReferalResource;
use App\Http\Resources\TariffResource;
use App\Http\Resources\TrackerResource;

class ProfessionController extends Controller
{
    /**
     * Возвращает список профессий с пагинацией.
     */
    public function index()
    {
        return ProfessionResource::collection(
            Profession::with([
                'career',
                'typeProfession',
                'color',
                'skills',
                'mentors',
                'reviews',
                'progress',
                'articles',
            ])->paginate(10)
        );
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

        return [
            'profession' => new ProfessionResource($profession),
            'trackers' => TrackerResource::collection($trackers),
            'referals' => ReferalResource::collection($referals),
            'tariffs' => TariffResource::collection($tariffs),
        ];
    }
}
