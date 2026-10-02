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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $user = $request->user();

    if ($user === null) {
        return redirect()->route('login');
    }

    return redirect()->route(
        match ($user->role) {
            'admin' => 'admin.dashboard',
            'guru' => 'guru.dashboard',
            'siswa' => 'siswa.dashboard',
            default => 'dashboard',
        },
    );
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/input-nilai/create', function () {
        return view('input-nilai.create');
    })->name('input-nilai-create');

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

    // Route::get('/status-penilaian/create', function () {
    //     return view('status-penilaian.create');
    // })->name('status-penilaian-create');

    Route::get('/perkembangan-nilai', function () {
        return view('perkembangan-nilai');
    })->name('perkembangan-nilai');

    // Route::get('/perkembangan-nilai/create', function () {
    //     return view('perkembangan-nilai.create');
    // })->name('perkembangan-nilai-create');

    Route::resource('data-sekolah', DataSekolahController::class)
        ->except(['show'])
        ->names('data-sekolah');

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

    Route::get('/admin-dashboard', function () {
        return view('dashboard');
    })
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/guru-dashboard', function () {
        return view('dashboard');
    })
        ->middleware('role:guru')
        ->name('guru.dashboard');

    Route::get('/siswa-dashboard', function () {
        return view('dashboard');
    })
        ->middleware('role:siswa')
        ->name('siswa.dashboard');
});

require __DIR__ . '/auth.php';
