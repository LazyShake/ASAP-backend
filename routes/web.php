<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionController;
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

Route::post('/submit-feedback', function (Request $request) {
    // Валидация данных
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    // Логика обработки, например, сохранение в БД или отправка письма
    //Mail::to('admin@example.com')->send(new FeedbackMail($validated));

    return back()->with('success', 'Спасибо! Мы свяжемся с вами в ближайшее время.');
})->name('feedback.submit');

Route::post('/submit-phone', function (Request $request) {
    // Валидация данных
    $validated = $request->validate([
        'phone' => 'required|phone:RU',
    ]);

    // Логика обработки, например, сохранение в БД или отправка письма
    //Mail::to('admin@example.com')->send(new FeedbackMail($validated));

    return back()->with('success', 'Спасибо! Мы свяжемся с вами в ближайшее время.');
})->name('phone.submit');