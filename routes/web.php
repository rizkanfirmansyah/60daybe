<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChallengeDetailController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SectionController;
use App\Models\Challenge;
use App\Models\Question;
use Database\Factories\ChallengeDetailFactory;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $challenge = Challenge::all();
    $questions = Question::all();
    $challenges = Challenge::all()->take(3);
    return view('contents.pages.home', compact('challenge', 'questions', 'challenges'));
});

Route::get('/c', [ChallengeController::class, 'query'])->name('home-challenge');

Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login/post', [AuthController::class, 'login'])->name('login-in');
Route::get('/auth/logout', [AuthController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', function () {
    return view('contents.dashboard.index');
})->name('dashboard');

    Route::prefix('section')->group(function () {
        Route::get('/', [SectionController::class, 'index'])->name('section');
        Route::get('/{id}', [SectionController::class, 'edit'])->name('section-edit')->where('id', '[0-9]+');
        Route::get('/create', [SectionController::class, 'create'])->name('section-create');
        Route::get('/show', [SectionController::class, 'show'])->name('section-show');
        Route::post('/', [SectionController::class, 'store'])->name('section-store');
        Route::post('/{id}', [SectionController::class, 'update'])->name('section-update')->where('id', '[0-9]+');
        Route::delete('/', [SectionController::class, 'destroy'])->name('section-destroy');
        Route::put('/change/status', [SectionController::class, 'change'])->name('section-change');
    });

    Route::prefix('challenge')->group(function () {
        Route::get('/', [ChallengeController::class, 'index'])->name('challenge');
        Route::get('/{id}', [ChallengeController::class, 'edit'])->name('challenge-edit')->where('id', '[0-9]+');
        Route::get('/create', [ChallengeController::class, 'create'])->name('challenge-create');
        Route::get('/show', [ChallengeController::class, 'show'])->name('challenge-show');
        Route::post('/', [ChallengeController::class, 'store'])->name('challenge-store');
        Route::post('/{id}', [ChallengeController::class, 'update'])->name('challenge-update')->where('id', '[0-9]+');
        Route::delete('/', [ChallengeController::class, 'destroy'])->name('challenge-destroy');
    });

    Route::prefix('question')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('question');
        Route::get('/{id}', [QuestionController::class, 'edit'])->name('question-edit')->where('id', '[0-9]+');
        Route::get('/create', [QuestionController::class, 'create'])->name('question-create');
        Route::get('/show', [QuestionController::class, 'show'])->name('question-show');
        Route::post('/', [QuestionController::class, 'store'])->name('question-store');
        Route::post('/{id}', [QuestionController::class, 'update'])->name('question-update')->where('id', '[0-9]+');
        Route::delete('/', [QuestionController::class, 'destroy'])->name('question-destroy');
    });

    Route::prefix('challenge-detail')->group(function () {
        Route::get('/', [ChallengeDetailController::class, 'index'])->name('challenge-detail');
        Route::get('/{id}', [ChallengeDetailController::class, 'edit'])->name('challenge-detail-edit')->where('id', '[0-9]+');
        Route::get('/create', [ChallengeDetailController::class, 'create'])->name('challenge-detail-create');
        Route::get('/show', [ChallengeDetailController::class, 'show'])->name('challenge-detail-show');
        Route::post('/', [ChallengeDetailController::class, 'store'])->name('challenge-detail-store');
        Route::post('/{id}', [ChallengeDetailController::class, 'update'])->name('challenge-detail-update')->where('id', '[0-9]+');
        Route::delete('/', [ChallengeDetailController::class, 'destroy'])->name('challenge-detail-destroy');
    });
});
