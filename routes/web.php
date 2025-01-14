<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserAuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get(
    '/csrf-cookie',
    CsrfCookieController::class.'@show'
)->middleware('web')->name('sanctum.csrf-cookie');

Route::get('/feedback-form', function () {
    return view('feedback-form');
})->name('feedback.form');

Route::post('/submit-feedback', [FeedbackController::class, 'submitFeedback'])->name('feedback.submit');
Route::post('/submit-phone', [FeedbackController::class, 'submitPhone'])->name('phone.submit');

// Просмотр конкретной статьи
Route::get('/articles/{id}', [ArticleController::class, 'showArticle']); // Показ статьи
Route::post('/cta', [ArticleController::class, 'sendToTelegram']); // API для CTA

Route::get('/course/{id}', [ProfessionController::class, 'show'])->name('profession.show');

Route::get('/blog', [PageController::class, 'index']);

// Получить конкретную статью
Route::get('/blog/articles/{articleId}', [PageController::class, 'getArticle']);

// Получить 3 последние статьи
Route::get('/articles', [PageController::class, 'getRecentArticles']);

// Получить список профессий
Route::get('/professions', [PageController::class, 'getProfessions']);