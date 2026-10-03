<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\GuruMengajarController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\WaliKelasController;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $user = $request->user();
    if ($user === null) {
        return redirect()->route('login');
    } else {
        return view('dashboard', ['user' => $user]);
    }
})->name('home');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Profile and Password Update Routes
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password.update');

    // Data Sekolah
    Route::resource('data-sekolah', DataSekolahController::class);

    // Input Nilai
    Route::resource('input-nilai', NilaiController::class);

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

    Route::get('/status-penilaian', function () {
        return view('status-penilaian');
    })->name('status-penilaian');

    Route::get('/perkembangan-nilai', function () {
        return view('perkembangan-nilai');
    })->name('perkembangan-nilai');



    Route::resource('data-guru', DataGuruController::class)
        ->except(['show'])
        ->names('data-guru');

    Route::resource('data-siswa', DataSiswaController::class)->names('data-siswa');

    Route::resource('mata-pelajaran', MataPelajaranController::class)
        ->except(['show'])
        ->names('mata-pelajaran');

    Route::post('/mata-pelajaran/{mataPelajaran}/guru', [MataPelajaranController::class, 'tambahGuru'])->name('mata-pelajaran.guru.store');
    Route::put('/mata-pelajaran/{mataPelajaran}/guru/{guruMengajar}', [MataPelajaranController::class, 'updateGuru'])->name('mata-pelajaran.guru.update');
    Route::delete('/mata-pelajaran/{mataPelajaran}/guru/{guruMengajar}', [MataPelajaranController::class, 'hapusGuru'])->name('mata-pelajaran.guru.delete');

    Route::resource('guru-mengajar', GuruMengajarController::class)
        ->except(['show'])
        ->names('guru-mengajar');

    Route::resource('rombel', RombelController::class)->names('rombel');

    Route::resource('wali-kelas', WaliKelasController::class)
        ->except(['show'])
        ->names('wali-kelas');

    Route::get('/input-nilai', [NilaiController::class, 'index'])->name('input-nilai');
    Route::post('/input-nilai', [NilaiController::class, 'store'])->name('input-nilai.store');

    Route::get('/penilaian', function () {
        return view('penilaian');
    })->name('penilaian');

    Route::get('/cetak-nilai', function () {
        return view('cetak-nilai.index');
    })->name('cetak-nilai');

    Route::get('/cetak-nilai/create', function () {
        return view('cetak-nilai.create');
    })->name('cetak-nilai.create');

    Route::get('/semester', function () {
        return view('semester');
    })->name('semester');

    Route::get('/pengguna', function () {
        return view('pengguna', [
            'users' => User::latest()->get(),
        ]);
    })->name('pengguna');

    Route::controller(BackupController::class)
        ->prefix('backup')
        ->name('backup.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/download', 'download')->name('download');
            Route::get('/table/{table}', 'table')->name('table');
            Route::post('/restore', 'restore')->name('restore');
            Route::delete('/{file}', 'destroy')->name('destroy');
        });
});

require __DIR__ . '/auth.php';
