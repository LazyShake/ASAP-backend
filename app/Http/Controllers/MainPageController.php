<?php

namespace App\Http\Controllers;

use App\Http\Resources\FirstImageResource;
use App\Http\Resources\ProfessionGeneralResource;
use App\Http\Resources\MentorResource;
use App\Http\Resources\StatisticResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\ArticleResource;
use App\Models\FirstImage;
use App\Models\Profession;
use App\Models\Tariff;
use App\Models\Mentor;
use App\Models\Statistic;
use App\Models\Review;
use App\Models\Partner;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainPageController extends Controller
{
    public function firstScreen()
    {
        try {
            $firstScreen = FirstImage::first();
            return new FirstImageResource($firstScreen);
        } catch (\Exception $e) {
            Log::error('Ошибка получения первого экрана: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить данные первого экрана'], 500);
        }
    }

    public function professions()
    {
        try {
            $professions = Profession::all();
            return ProfessionGeneralResource::collection($professions);
        } catch (\Exception $e) {
            Log::error('Ошибка получения профессий: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить профессии'], 500);
        }
    }

    public function tariffPrice()
    {
        try {
            $price = Tariff::max('price');
            return response()->json(['price' => $price]);
        } catch (\Exception $e) {
            Log::error('Ошибка получения цены тарифа: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить цену тарифа'], 500);
        }
    }

    public function professionImages($professionId)
    {
        try {
            $profession = Profession::findOrFail($professionId);
            return new ProfessionGeneralResource($profession);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Профессия не найдена: ' . $e->getMessage());
            return response()->json(['error' => 'Профессия не найдена'], 404);
        } catch (\Exception $e) {
            Log::error('Ошибка получения изображения профессии: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить данные профессии'], 500);
        }
    }

    public function mentors(Request $request)
    {
        try {
            $mentors = Mentor::where('status', true)
                ->paginate($request->get('recordsPerPage', 4));
            return MentorResource::collection($mentors);
        } catch (\Exception $e) {
            Log::error('Ошибка получения списка менторов: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить список менторов'], 500);
        }
    }

    public function statistics()
    {
        try {
            $statistics = Statistic::all();
            return StatisticResource::collection($statistics);
        } catch (\Exception $e) {
            Log::error('Ошибка получения статистики: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить статистику'], 500);
        }
    }

    public function reviews(Request $request)
    {
        try {
            $reviews = Review::where('status', true)
                ->paginate($request->get('recordsPerPage', 2));
            return ReviewResource::collection($reviews);
        } catch (\Exception $e) {
            Log::error('Ошибка получения отзывов: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить отзывы'], 500);
        }
    }

    public function partners()
    {
        try {
            $partners = Partner::all();
            return PartnerResource::collection($partners);
        } catch (\Exception $e) {
            Log::error('Ошибка получения партнеров: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить партнеров'], 500);
        }
    }

    public function articles(Request $request)
    {
        try {
            $articles = Article::where('type_id', null)
                ->latest('created_at')
                ->take(2)
                ->get();
            return ArticleResource::collection($articles);
        } catch (\Exception $e) {
            Log::error('Ошибка получения статей: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить статьи'], 500);
        }
    }

    public function referalPrice()
    {
        try {
            $referalPrice = config('settings.referal_price', '5000 р');
            return response()->json(['referal_price' => $referalPrice]);
        } catch (\Exception $e) {
            Log::error('Ошибка получения цены рефералов: ' . $e->getMessage());
            return response()->json(['error' => 'Не удалось загрузить цену рефералов'], 500);
        }
    }
}
