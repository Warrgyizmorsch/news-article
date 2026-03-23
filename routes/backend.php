<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CRM\CategoryController;
use App\Http\Controllers\CRM\ArticleController;
use App\Http\Controllers\CRM\TagController;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    // Articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('/articles/update/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/delete/{id}', [ArticleController::class, 'destroy'])->name('articles.delete');

    Route::get('/articles/trashed', [ArticleController::class, 'trashed'])->name('articles.trashed');
    Route::post('/articles/restore/{id}', [ArticleController::class, 'restore'])->name('articles.restore');
    Route::delete('/articles/force-delete/{id}', [ArticleController::class, 'forceDelete'])->name('articles.forceDelete');

    // Tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/edit/{id}', [TagController::class, 'edit'])->name('tags.edit');
    Route::post('/tags/update/{id}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/delete/{id}', [TagController::class, 'destroy'])->name('tags.delete');
});