<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;


Route::get('/course/{id}', [ProfessionController::class, 'show'])->name('professions.show');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/login', function () {
    return view('auth.login');
})->name('login');*/

Route::get('/feedback-form', function () {
    return view('feedback-form');
})->name('feedback.form');

Route::post('/submit-feedback', [FeedbackController::class, 'submitFeedback'])->name('feedback.submit');
Route::post('/submit-phone', [FeedbackController::class, 'submitPhone'])->name('phone.submit');

Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/article/{id}', [PageController::class, 'showArticle'])->name('article.show');

// Все статьи
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Статьи по профессии
Route::get('/articles/profession/{professionId}', [ArticleController::class, 'byProfession'])->name('articles.byProfession');

// Просмотр конкретной статьи
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');