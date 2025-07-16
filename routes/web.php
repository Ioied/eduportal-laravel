<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// Articles (только для авторизованных)
Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])
         ->name('articles.create');
    Route::post('/articles/generate', [ArticleController::class, 'generate'])
         ->name('articles.generate');
    Route::get('/articles', [ArticleController::class, 'index'])
         ->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])
         ->name('articles.show');
    Route::post('/articles/{article}/publish', [ArticleController::class, 'togglePublish'])
         ->name('articles.publish');
});

// Публичный каталог
Route::get('/catalog', [ArticleController::class, 'catalog'])
     ->name('articles.catalog');

// Статические страницы
Route::get('/', fn() => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))
     ->middleware(['auth','verified'])
     ->name('dashboard');

// Профиль и аутентификация
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
         ->name('profile.destroy');
});

require __DIR__.'/auth.php';
