<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DataGuruController;


Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');


Route::resource(
    'data-sekolah',
    DataSekolahController::class
);


Route::resource(
    'data-guru',
    DataGuruController::class
);
