<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/dashboard', function () {
    return view('dashboard');
    })->name('dashboard');

Route::post('/login', function (Request $request) {

    $credentials = [
        'username' => $request->username,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        // Jika ADMIN
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Jika GURU
        if ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        }

        // Jika SISWA
        if ($user->role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }
    }

    return redirect()
        ->route('login')
        ->with('error', 'Username atau password salah.');

})->name('login.post');


Route::get('/profile', function () {
    return view('profile');
})->name('profile');


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

