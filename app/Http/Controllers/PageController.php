<?php

namespace App\Http\Controllers;

use App\Http\Resources\{EventArticleResource, FilterResource, ArticleResource, ProfessionPreviewResource, DetailedArticleResource, SEOPageResource};
use Illuminate\Http\Request;
use App\Models\{Article, Filter, Profession, SEOPage};

class PageController extends Controller
{
    public function index()
    {
        $eventArticles = Article::where('type_id', 3)->get();
        $filters = Filter::all();
        $articles = Article::where('type_id', '!=', 3)->get();
        $professions = Profession::all();
        $seoPage = SEOPage::find(1);

        return response()->json([
            'event_articles' => EventArticleResource::collection($eventArticles),
            'filters' => FilterResource::collection($filters),
            'articles' => ArticleResource::collection($articles),
            'professions' => ProfessionPreviewResource::collection($professions),
            'seo_page' => $seoPage ? new SEOPageResource($seoPage) : null,
        ]);
    }

    public function getArticle(Article $article)
    {
        $main_article = $article;
        $relatedArticles = Article::where('id_article', '!=', $article->id_article)->latest()->take(3)->get();
        $professions = Profession::all();
        $seoPage = SEOPage::find(2);

        return response()->json([
            'article' => new ArticleResource($main_article),
            'related_articles' => ArticleResource::collection($relatedArticles),
            'professions' => ProfessionPreviewResource::collection($professions),
            'seo_page' => $seoPage ? new SEOPageResource($seoPage) : null,
        ]);
    }

    public function getRecentArticles()
    {
        $recentArticles = Article::latest()->take(3)->get();

        return response()->json([
            'articles' => ArticleResource::collection($recentArticles),
        ]);
    }

    public function getProfessions()
    {
        $professions = Profession::all();

        return response()->json([
            'professions' => ProfessionPreviewResource::collection($professions),
        ]);
    }
}
