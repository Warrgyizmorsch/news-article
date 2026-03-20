<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/news', [HomeController::class, 'newsIndex'])->name('news.index');
Route::get('/news/{slug}', [HomeController::class, 'show'])->name('news.show');

Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.show');
Route::get('/tag/{slug}', [HomeController::class, 'tag'])->name('tag.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__ . '/backend.php';
