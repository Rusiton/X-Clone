<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use App\Http\Middleware\EnsureUserRegisterIsCompleted;
use App\Http\Middleware\SaveLastUrl;
use App\Http\Middleware\UserIsAdmin;
use App\Livewire\NewPost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

Route::middleware([EnsureUserRegisterIsCompleted::class])->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/profile/{name}', [ProfileController::class, 'index'])->name('profile')->middleware(SaveLastUrl::class);

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware(SaveLastUrl::class);
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings');

    Route::get('/new-post', NewPost::class)->name('new-post');
    Route::get('/post/{id}', [PostController::class, 'index'])->name('post')->middleware(SaveLastUrl::class);

    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(UserIsAdmin::class);
});
