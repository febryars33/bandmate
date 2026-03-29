<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecruitmentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/@{username}', ProfileController::class)
    ->name('profile')
    ->where('username', '[A-Za-z0-9_.]+');

Route::get('/', HomeController::class)->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::resource('/artists', ArtistController::class);
Route::resource('/recruitments', RecruitmentController::class);
Route::resource('/events', EventController::class);

Route::middleware(['auth'])->group(function () {
    Route::patch('/@{username}', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->where('username', '[A-Za-z0-9_.]+');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', LoginController::class)
        ->name('login');

    Route::get('/register', RegisterController::class)
        ->name('register');

    Route::get('/forgot-password', ForgotPasswordController::class)
        ->name('forgot-password');

    Route::prefix('auth')->name('auth.')->group(function () {
        Route::get('{provider}/redirect', [SocialiteController::class, 'redirect'])->name('social.redirect');
        Route::get('{provider}/callback', [SocialiteController::class, 'callback'])->name('social.callback');
    });
});
