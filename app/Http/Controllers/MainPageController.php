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
use App\Http\Resources\ReferalResource;
use App\Models\FirstImage;
use App\Models\Profession;
use App\Models\Tariff;
use App\Models\Mentor;
use App\Models\Statistic;
use App\Models\Review;
use App\Models\Partner;
use App\Models\Article;
use App\Models\SEOPage;
use App\Models\Referal;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function mainPageData(Request $request)
    {
        return response()->json([
            'seo' => SEOPage::find(2) ? new SEOPageResource(SEOPage::find(2)) : null,
            'first_screen' => FirstImage::first() ? new FirstImageResource(FirstImage::first()) : null,
            'professions' => Profession::all() ? ProfessionGeneralResource::collection(Profession::all()) : [],
            'tariffs' => Tariff::all() ? TariffResource::collection(Tariff::all()) : [],
            'mentors' => Mentor::where('status', true)->exists() ? MentorResource::collection(Mentor::where('status', true)->get()) : [],
            'statistics' => Statistic::all() ? StatisticResource::collection(Statistic::all()) : [],
            'reviews' => Review::where('status', true)->exists()
                ? ReviewResource::collection(Review::where('status', true)->get())
                : [],
            'partners' => Partner::all() ? PartnerResource::collection(Partner::all()) : [],
            'articles' => Article::where('type_id', 1)->latest('created_at')->take(2)->exists() ? ArticleResource::collection(Article::where('type_id', 1)->latest('created_at')->take(2)->get()) : [],
            'referal_price' => Referal::first() ? new ReferalResource(Referal::first()) : null,
        ]);
    }
}
