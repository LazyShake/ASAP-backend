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
            'seo' => new SEOPageResource(SEOPage::find(1)),
            'first_screen' => new FirstImageResource(FirstImage::first()),
            'professions' => ProfessionGeneralResource::collection(Profession::all()),
            

            'mentors' => MentorResource::collection(
                Mentor::where('status', true)->get()
            ),
            'statistics' => StatisticResource::collection(Statistic::all()),
            'reviews' => ReviewResource::collection(
                Review::where('status', true)->paginate($request->get('recordsPerPage', 2))
            ),
            'partners' => PartnerResource::collection(Partner::all()),
            'articles' => ArticleResource::collection(
                Article::where('type_id', 1)->latest('created_at')->take(2)->get()
            ),
            'referal_price' => new ReferalResource(Referal::first()),
        ]);
    }
}