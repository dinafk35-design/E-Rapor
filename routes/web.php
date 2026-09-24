<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return $request->user()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:login')
        ->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::put('/profile/password', [AuthController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::get('/input-nilai', function () {
        return view('input-nilai');
    })->name('input-nilai');

    Route::get('/input-nilai/create', function () {
        return view('input-nilai.create');
    })->name('input-nilai-create');

    Route::get('/nilai-skill-passport', function () {
        return view('nilai-skill-passport');
    })->name('nilai-skill-passport');

    Route::get('/nilai-skill-passport/create', function () {
        return view('nilai-skill-passport.create');
    })->name('nilai-skill-passport-create');

    Route::get('/nilai-ukk', function () {
        return view('nilai-ukk');
    })->name('nilai-ukk');

    Route::get('/nilai-ukk/create', function () {
        return view('nilai-ukk.create');
    })->name('nilai-ukk-create');

    Route::get('/data-sekolah', function () {
        return view('data-sekolah');
    })->name('data-sekolah');

    Route::get('/data-guru', function () {
        return view('data-guru');
    })->name('data-guru');

    Route::get('/data-siswa', function () {
        return view('data-siswa');
    })->name('data-siswa');

    Route::get('/mata-pelajaran', function () {
        return view('mata-pelajaran');
    })->name('mata-pelajaran');

    Route::get('/rombel', function () {
        return view('rombel');
    })->name('rombel');

    Route::get('/penilaian', function () {
        return view('penilaian');
    })->name('penilaian');

    Route::get('/admin-dashboard', function () {
        return view('dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/guru-dashboard', function () {
        return view('dashboard');
    })->middleware('role:guru')->name('guru.dashboard');

    Route::get('/siswa-dashboard', function () {
        return view('dashboard');
    })->middleware('role:siswa')->name('siswa.dashboard');
});
