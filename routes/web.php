<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use Illuminate\Support\Facades\Route;

// Public frontend
Route::get('/', [FrontendBlogController::class, 'index'])->name('home');
Route::get('/blog/{slug}', [FrontendBlogController::class, 'show'])->name('blog.show');

// Admin panel (auth required)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('blogs', AdminBlogController::class);
    Route::resource('users', AdminUserController::class);

    // AJAX blog status toggle
    Route::patch('blogs/{blog}/status', [AdminBlogController::class, 'toggleStatus'])
        ->name('blogs.toggleStatus');
});
