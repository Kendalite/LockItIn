<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\GameBuilderController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\QuestionController;

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

Route::view('/', 'welcome');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])->name('admin.')->prefix('/admin')->group(function () {

    Route::get('/', fn () => redirect('/admin/dashboard'));
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

    Route::resources([
        'answer' => AnswerController::class,
        'question' => QuestionController::class,
        'game' => GameController::class,
        'gamebuilder' => GameBuilderController::class,
    ]);

});

require __DIR__.'/auth.php';
