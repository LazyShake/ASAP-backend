<?php

namespace App\Http\Controllers;

use App\Http\Resources\SEOPageResource;
use App\Http\Resources\FirstImageResource;
use App\Http\Resources\ProfessionGeneralResource;
use App\Http\Resources\MentorResource;
use App\Http\Resources\StatisticResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\TariffResource;
use App\Models\FirstImage;
use App\Models\Profession;
use App\Models\Tariff;
use App\Models\Mentor;
use App\Models\Statistic;
use App\Models\Review;
use App\Models\Partner;
use App\Models\Article;
use App\Models\SEOPage;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function seoData()
    {
        $seo = SEOPage::findOrFail(1);
        return new SEOPageResource($seo);
    }

    public function firstScreen()
    {
        $firstScreen = FirstImage::first();
        return new FirstImageResource($firstScreen);
    }

    public function professions()
    {
        $professions = Profession::all();
        return ProfessionGeneralResource::collection($professions);
    }

    public function tariffPrice()
{
    $tariffs = Tariff::all();  // Получаем все тарифы
    return TariffResource::collection($tariffs);  // Возвращаем коллекцию тарифов, преобразованную через ресурс
}

    public function professionImages($professionId)
    {
        $profession = Profession::findOrFail($professionId);
        return new ProfessionGeneralResource($profession);
    }

    public function mentors(Request $request)
    {
        $mentors = Mentor::where('status', true)
            ->paginate($request->get('recordsPerPage', 4));
        return MentorResource::collection($mentors);
    }

    public function statistics()
    {
        $statistics = Statistic::all();
        return StatisticResource::collection($statistics);
    }

    public function reviews(Request $request)
    {
        $reviews = Review::where('status', true)
            ->paginate($request->get('recordsPerPage', 2));
        return ReviewResource::collection($reviews);
    }

    public function partners()
    {
        $partners = Partner::all();
        return PartnerResource::collection($partners);
    }

    public function articles(Request $request)
    {
        $articles = Article::where('type_id', 1)
            ->latest('created_at')
            ->take(2)
            ->get();
        return ArticleResource::collection($articles);
    }

    public function referalPrice()
    {
        $referalPrice = config('settings.referal_price', '5000 р');
        return response()->json(['referal_price' => $referalPrice]);
    }
}
