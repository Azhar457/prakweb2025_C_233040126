<?php

use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function (){
    return view('welcome');
});

// Route Public
Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/blog', [PageController::class, 'blog']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('categories', [CategoryController::class, 'index'])->name('Category.index');

// Route Posts (Public)
Route::get('posts', [PostController::class, 'index'])->middleware('auth')->name('posts.index');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->middleware('auth')->name('posts.show');

// Route Guest
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// Route Logout
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


// --- ROUTE DASHBOARD ---
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Categories (WAJIB DI ATAS agar tidak dianggap sebagai slug post)
    Route::resource('/dashboard/categories', CategoryController::class);

    // 2. Dashboard Posts (Resource utama dashboard)
    Route::resource('/dashboard', DashboardPostController::class)
        ->parameters(['dashboard' => 'post']); // Parameter jadi {post}
});