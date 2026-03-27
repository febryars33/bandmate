<?php

use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\Regional\RegencyController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('/regional')->group(function () {
    Route::get('/regencies', RegencyController::class)->name('regencies');
})->name('regional.');

Route::get('/genres', GenreController::class)->name('genre');
