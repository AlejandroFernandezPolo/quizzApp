<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rutas para preguntas
    Route::resource('question', QuestionController::class);

    // Rutas para respuestas
    Route::resource('answer', AnswerController::class);

    // Rutas para el quizz
    Route::get('quizz', [QuizzController::class, 'index'])->name('quizz.index');
    Route::get('quizz/start', [QuizzController::class, 'start'])->name('quizz.start');
    Route::post('quizz/submit', [QuizzController::class, 'submit'])->name('quizz.submit');

    // Rutas para los registros (records)
    // En tu archivo de rutas
    Route::get('/records/{alias}/details', [RecordController::class, 'showDetails'])->name('records.details');

    Route::resource('record', RecordController::class);
});

require __DIR__ . '/auth.php';
