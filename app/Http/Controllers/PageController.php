<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PageController extends Controller
{
    public function blog()
    {
        $articles = Article::all(); // Получаем все статьи из базы данных

        return view('blog', [
            'articles' => $articles,
        ]);
    }

    public function showArticle($id)
    {
        $article = Article::findOrFail($id); // Получаем статью по ID или выдаем 404

        return view('article', [
            'article' => $article,
        ]);
    }
}