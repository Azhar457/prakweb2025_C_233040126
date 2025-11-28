<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/about', function () {
    return view('about');
});
Route::get('/welcome', function (){
    return view('welcome');
});

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/blog', [PageController::class, 'blog']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create']);
Route::get('categories', [CategoryController::class, 'index'])->name('Category.index');