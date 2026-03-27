<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/login', LoginController::class)
    ->middleware(['guest'])
    ->name('login');

Route::middleware(['auth'])->group(function () {
    //
});
