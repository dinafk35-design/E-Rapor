<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\Rombel;
use App\Models\User;
use App\Services\PembuatanAkun;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DataSiswaController extends Controller
{
    public function index(): View
    {
        return view('data-siswa.index', [
            'siswa' => DataSiswa::with(['rombel', 'user'])
                ->orderBy('id')
                ->get(),
            'rombelList' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function create(): View
    {
        return view('data-siswa.create', [
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());

        // Data siswa dan akun login-nya harus tersimpan bersama.
        // Kalau pembuatan akun gagal, data siswa ikut dibatalkan.
        $akun = DB::transaction(function () use ($data, $request) {
            $siswa = DataSiswa::create($data);

            $hasil = app(PembuatanAkun::class)->untukSiswa($siswa, [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]);

            $siswa->forceFill(['user_id' => $hasil['user']->id])->save();

            return $hasil;
        });

        return redirect()
            ->route('data-siswa')
            ->with('status', 'Data Siswa berhasil disimpan. ' . $this->pesanAkun($akun));
    }

    public function show(DataSiswa $data_siswa): View
    {
        return view('data-siswa.show', [
            'siswa' => $data_siswa->load(['rombel', 'user']),
        ]);
    }

    public function edit(DataSiswa $data_siswa): View
    {
        return view('data-siswa.edit', [
            'siswa' => $data_siswa,
            'rombel' => Rombel::orderBy('nama_rombel')->get(),
        ]);
    }

    public function update(Request $request, DataSiswa $data_siswa): RedirectResponse
    {
        $data = $request->validate($this->rules());

        $data_siswa->update($data);

        // Nama akun ikut diperbarui agar tetap sama dengan data siswa.
        $data_siswa->user
            ?->forceFill([
                'name' => $data_siswa->nama_siswa,
            ])
            ->save();

        return redirect()->route('data-siswa')->with('status', 'Data Siswa berhasil diperbarui.');
    }

    public function destroy(DataSiswa $data_siswa): RedirectResponse
    {
        // Akun ikut dihapus supaya tidak ada akun yatim yang masih bisa
        // masuk ke sistem setelah data siswanya dihapus.
        $userId = $data_siswa->user_id;

        $data_siswa->delete();

        if ($userId !== null) {
            User::whereKey($userId)->delete();
        }

        return redirect()->route('data-siswa')->with('status', 'Data Siswa dan akun loginnya berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | BANTUAN
    |--------------------------------------------------------------------------
    */

    /**
     * Aturan validasi data siswa.
     *
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'nisn' => ['required', 'string', 'max:30', 'unique:data_siswa,nisn'],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'rombel_id' => ['nullable', 'integer', 'exists:rombel,id'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }

    protected function messages(): array
{
    return [
        'nisn.required' => 'NISN wajib diisi.',
        'nisn.unique' => 'NISN telah digunakan.',
        'nisn.max' => 'NISN maksimal 30 karakter.',
        
        'nama_siswa.required' => 'Nama siswa wajib diisi.',
        
        'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        
        'rombel_id.exists' => 'Rombel yang dipilih tidak tersedia.',
    ];
}

    /**
     * Informasikan username akun yang baru dibuat kepada admin.
     *
     * Password awal hanya ditampilkan bila sistem yang menetapkannya.
     *
     * @param  array{user: User, password: ?string, dibuatSistem: bool}  $akun
     */
    protected function pesanAkun(array $akun): string
    {
        $pesan = 'Akun login "' . $akun['user']->username . '" juga telah dibuat untuk siswa ini.';

        if ($akun['dibuatSistem']) {
            $pesan .= ' Password awal: ' . $akun['password'] . ' (simpan catatan ini, password hanya ditampilkan sekali).';
        }

        return $pesan;
    }
}
