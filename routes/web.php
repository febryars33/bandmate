<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});

Route::resource('/artists', ArtistController::class);

Route::get('/login', function () {
    return Inertia::render('auth/Login');
})
    ->middleware(['guest'])
    ->name('login');

Route::middleware(['auth'])->group(function () {
    //
});
