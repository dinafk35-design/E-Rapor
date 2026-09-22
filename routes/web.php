<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('login');
})->name('login');


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


/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


/*
|--------------------------------------------------------------------------
| DASHBOARD GURU
|--------------------------------------------------------------------------
*/

Route::get('/guru-dashboard', function () {
    return view('guru.dashboard');
})->name('guru.dashboard');


/*
|--------------------------------------------------------------------------
| DASHBOARD SISWA
|--------------------------------------------------------------------------
*/

Route::get('/siswa-dashboard', function () {
    return view('siswa.dashboard');
})->name('siswa.dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::get('/profile', function () {
    return view('profile');
})->name('profile');


Route::get('/input-nilai', function () {
    return view('input-nilai');
})->name('input-nilai');

Route::get('/input-nilai/create', function () {
    return view('input-nilai.create');
})->name('input-nilai-create');

/*
|--------------------------------------------------------------------------
| User data
|--------------------------------------------------------------------------
*/
Route::get('/user-data', function () {
    return view('user-data');
})->name('user-data');

Route::get('/user-data/create', function () {
    return view('user-data-create');
})->name('user-data.create');

Route::post('/user-data/store', function (\Illuminate\Http\Request $request) {

    $users = session()->get('users', []);

    $users[] = [
        'nama' => $request->nama,
        'username' => $request->username,
        'password' => $request->password,
        'role' => $request->role,
    ];

    session()->put('users', $users);
    return redirect()->route('user-data');
})->name('user-data.store');