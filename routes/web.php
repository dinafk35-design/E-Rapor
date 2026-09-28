<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DataSiswaController;
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

    return redirect()->route(match ($user->role) {
        'admin' => 'admin.dashboard',
        'guru' => 'guru.dashboard',
        'siswa' => 'siswa.dashboard',
        default => 'dashboard',
    });
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::put('/profile/password', [AuthController::class, 'updatePassword'])
        ->name('profile.password.update');

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

    /*
    |--------------------------------------------------------------------------
    | DATA SEKOLAH
    |--------------------------------------------------------------------------
    */

    Route::get('/data-sekolah', [DataSekolahController::class, 'index'])->name('data-sekolah');
    Route::get('/data-sekolah/create', [DataSekolahController::class, 'create'])->name('data-sekolah.create');
    Route::post('/data-sekolah', [DataSekolahController::class, 'store'])->name('data-sekolah.store');
    Route::get('/data-sekolah/{sekolah}/edit', [DataSekolahController::class, 'edit'])->name('data-sekolah.edit');
    Route::put('/data-sekolah/{sekolah}', [DataSekolahController::class, 'update'])->name('data-sekolah.update');
    Route::delete('/data-sekolah/{sekolah}', [DataSekolahController::class, 'destroy'])->name('data-sekolah.destroy');

    /*
    |--------------------------------------------------------------------------
    | DATA GURU
    |--------------------------------------------------------------------------
    */

    Route::get('/data-guru', [DataGuruController::class, 'index'])->name('data-guru');
    Route::get('/data-guru/create', [DataGuruController::class, 'create'])->name('data-guru.create');
    Route::post('/data-guru', [DataGuruController::class, 'store'])->name('data-guru.store');
    Route::get('/data-guru/{guru}/edit', [DataGuruController::class, 'edit'])->name('data-guru.edit');
    Route::put('/data-guru/{guru}', [DataGuruController::class, 'update'])->name('data-guru.update');
    Route::delete('/data-guru/{guru}', [DataGuruController::class, 'destroy'])->name('data-guru.destroy');

    /*
    |--------------------------------------------------------------------------
    | DATA SISWA
    |--------------------------------------------------------------------------
    */

    Route::get('/data-siswa', [DataSiswaController::class, 'index'])->name('data-siswa');
    Route::get('/data-siswa/create', [DataSiswaController::class, 'create'])->name('data-siswa.create');
    Route::post('/data-siswa', [DataSiswaController::class, 'store'])->name('data-siswa.store');
    Route::get('/data-siswa/{siswa}/edit', [DataSiswaController::class, 'edit'])->name('data-siswa.edit');
    Route::put('/data-siswa/{siswa}', [DataSiswaController::class, 'update'])->name('data-siswa.update');
    Route::delete('/data-siswa/{siswa}', [DataSiswaController::class, 'destroy'])->name('data-siswa.destroy');

    /*
    |--------------------------------------------------------------------------
    | MATA PELAJARAN + GURU MENGAJAR
    |--------------------------------------------------------------------------
    */

    Route::get('/mata-pelajaran', [MataPelajaranController::class, 'index'])->name('mata-pelajaran');
    Route::get('/mata-pelajaran/create', [MataPelajaranController::class, 'create'])->name('mata-pelajaran.create');
    Route::post('/mata-pelajaran', [MataPelajaranController::class, 'store'])->name('mata-pelajaran.store');
    Route::get('/mata-pelajaran/{mata_pelajaran}/edit', [MataPelajaranController::class, 'edit'])->name('mata-pelajaran.edit');
    Route::put('/mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'update'])->name('mata-pelajaran.update');
    Route::delete('/mata-pelajaran/{mata_pelajaran}', [MataPelajaranController::class, 'destroy'])->name('mata-pelajaran.destroy');

    /*
    |--------------------------------------------------------------------------
    | ROMBEL + ANGGOTA ROMBEL
    |--------------------------------------------------------------------------
    */

    Route::get('/rombel', [RombelController::class, 'index'])->name('rombel');
    Route::get('/rombel/create', [RombelController::class, 'create'])->name('rombel.create');
    Route::post('/rombel', [RombelController::class, 'store'])->name('rombel.store');
    Route::get('/rombel/{rombel}/edit', [RombelController::class, 'edit'])->name('rombel.edit');
    Route::put('/rombel/{rombel}', [RombelController::class, 'update'])->name('rombel.update');
    Route::delete('/rombel/{rombel}', [RombelController::class, 'destroy'])->name('rombel.destroy');

    /*
    |--------------------------------------------------------------------------
    | WALI KELAS
    |--------------------------------------------------------------------------
    */

    Route::get('/wali-kelas', [WaliKelasController::class, 'index'])->name('wali-kelas');
    Route::get('/wali-kelas/create', [WaliKelasController::class, 'create'])->name('wali-kelas.create');
    Route::post('/wali-kelas', [WaliKelasController::class, 'store'])->name('wali-kelas.store');
    Route::get('/wali-kelas/{wali_kelas}/edit', [WaliKelasController::class, 'edit'])->name('wali-kelas.edit');
    Route::put('/wali-kelas/{wali_kelas}', [WaliKelasController::class, 'update'])->name('wali-kelas.update');
    Route::delete('/wali-kelas/{wali_kelas}', [WaliKelasController::class, 'destroy'])->name('wali-kelas.destroy');

    /*
    |--------------------------------------------------------------------------
    | INPUT NILAI
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | BACKUP & RESTORE
    |--------------------------------------------------------------------------
    */

    Route::prefix('backup')->name('backup.')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('index');

        Route::get('download', [BackupController::class, 'download'])->name('download');

        Route::get('table/{table}', [BackupController::class, 'table'])->name('table');

        Route::post('restore', [BackupController::class, 'restore'])->name('restore');

        Route::delete('{file}', [BackupController::class, 'destroy'])->name('destroy');
    });

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

require __DIR__.'/auth.php';
