<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\FeedbackController;
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

