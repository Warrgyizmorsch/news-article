<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CRM\CategoryController;
use App\Http\Controllers\CRM\ArticleController;
use App\Http\Controllers\CRM\TagController;
use App\Http\Controllers\CRM\PlanController;
use App\Http\Controllers\CRM\UserSubscriptionController;

Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {

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

    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::post('/plans/store', [PlanController::class, 'store'])->name('plans.store');
    Route::get('/plans/edit/{id}', [PlanController::class, 'edit'])->name('plans.edit');
    Route::post('/plans/update/{id}', [PlanController::class, 'update'])->name('plans.update');
    Route::delete('/plans/delete/{id}', [PlanController::class, 'destroy'])->name('plans.delete');

    // User Subscriptions
    Route::get('/user-subscriptions', [UserSubscriptionController::class, 'index'])->name('user-subscriptions.index');
    Route::get('/user-subscriptions/create', [UserSubscriptionController::class, 'create'])->name('user-subscriptions.create');
    Route::post('/user-subscriptions/store', [UserSubscriptionController::class, 'store'])->name('user-subscriptions.store');
    Route::get('/user-subscriptions/edit/{id}', [UserSubscriptionController::class, 'edit'])->name('user-subscriptions.edit');
    Route::post('/user-subscriptions/update/{id}', [UserSubscriptionController::class, 'update'])->name('user-subscriptions.update');
    Route::delete('/user-subscriptions/delete/{id}', [UserSubscriptionController::class, 'destroy'])->name('user-subscriptions.delete');

    Route::post('/user-subscriptions/approve/{id}', [UserSubscriptionController::class, 'approve'])->name('user-subscriptions.approve');

    Route::post('/user-subscriptions/reject/{id}', [UserSubscriptionController::class, 'reject'])->name('user-subscriptions.reject');
});