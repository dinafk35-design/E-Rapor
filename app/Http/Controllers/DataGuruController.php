<?php

namespace App\Http\Controllers;

use App\Exceptions\DataGuruMasihDipakai;
use App\Models\DataGuru;
use App\Models\User;
use App\Services\PembuatanAkun;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DataGuruController extends Controller
{
    public function index()
    {
        $guru = DataGuru::with(['guruMengajar.mataPelajaran', 'waliKelas', 'rombelDiampu'])
            ->withCount(['guruMengajar', 'waliKelas', 'rombelDiampu'])
            ->orderBy('id')
            ->get();

        return view('data-guru.index', compact('guru'));
    }

    public function create(): View
    {
        return view('data-guru.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules());

        // Data guru dan akun login-nya harus tersimpan bersama.
        // Kalau pembuatan akun gagal, data guru ikut dibatalkan.
        $akun = DB::transaction(function () use ($data, $request) {
            $guru = DataGuru::create($data);

            $hasil = app(PembuatanAkun::class)->untukGuru($guru, [
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);

            $guru->forceFill(['user_id' => $hasil['user']->id])->save();

            return $hasil;
        });

        return redirect()
            ->route('data-guru.index')
            ->with('status', 'Data Guru berhasil disimpan. ' . $this->pesanAkun($akun));
    }

    public function edit(DataGuru $data_guru): View
    {
        return view('data-guru.edit', [
            'guru' => $data_guru,
        ]);
    }

    public function update(Request $request, DataGuru $data_guru): RedirectResponse
    {
        $data = $request->validate($this->rules());

        $data_guru->update($data);

        // Nama akun ikut diperbarui agar tetap sama dengan data guru.
        $data_guru->user
            ?->forceFill([
                'name' => $data_guru->nama_guru,
            ])
            ->save();

        return redirect()->route('data-guru.index')->with('status', 'Data Guru berhasil diperbarui.');
    }

    /**
     * Halaman relasi data guru.
     *
     * Menampilkan mata pelajaran yang masih diajar guru tersebut sehingga
     * admin bisa melepas relasinya atau menggantinya dengan guru lain.
     */
    public function relasi(DataGuru $data_guru): View
    {
        $data_guru->loadCount(['guruMengajar', 'waliKelas', 'rombelDiampu']);

        return view('data-guru.relasi', [
            'guru' => $data_guru,
            'pengajar' => $data_guru->mapelDiajar(),
            'penghalang' => $data_guru->relasiPenghalang(),
        ]);
    }

    public function destroy(DataGuru $data_guru): RedirectResponse
    {
        // Validasi utama: guru yang masih mengajar mata pelajaran (atau masih
        // dipakai sebagai wali kelas) tidak boleh dihapus.
        if ($data_guru->relasiPenghalang() !== []) {
            return $this->kembaliDenganAlasanGagal($data_guru);
        }

        // Akun ikut dihapus supaya tidak ada akun yatim yang masih bisa
        // masuk ke sistem setelah data gurunya dihapus.
        $userId = $data_guru->user_id;

        try {
            DB::transaction(function () use ($data_guru, $userId): void {
                $data_guru->delete();

                if ($userId !== null) {
                    User::whereKey($userId)->delete();
                }
            });
        } catch (DataGuruMasihDipakai) {
            // Relasi baru muncul di antara pengecekan dan penghapusan.
            return $this->kembaliDenganAlasanGagal($data_guru);
        } catch (QueryException) {
            // Foreign key di database menolak penghapusan. Error SQL-nya
            // tidak pernah ditampilkan ke admin, hanya penjelasannya.
            return redirect()
                ->route('data-guru.relasi', $data_guru->id)
                ->withErrors([
                    'guru' => 'Data Guru tidak dapat dihapus karena masih digunakan oleh data lain. ' . 'Lepaskan atau ganti relasinya terlebih dahulu.',
                ]);
        }

        return redirect()->route('data-guru.index')->with('status', 'Data Guru dan akun loginnya berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | BANTUAN
    |--------------------------------------------------------------------------
    */

    /**
     * Kembalikan admin ke halaman relasi guru sambil perplexed kenapa
     * penghapusan ditolak.
     */
    protected function kembaliDenganAlasanGagal(DataGuru $data_guru): RedirectResponse
    {
        return redirect()
            ->route('data-guru.relasi', $data_guru->id)
            ->withErrors([
                'guru' => $data_guru->alasanTidakBisaDihapus(),
            ]);
    }

    /**
     * Aturan validasi data guru.
     *
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'nip' => ['nullable', 'string', 'max:30'],
            'nama_guru' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:30'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
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
        $pesan = 'Akun login "' . $akun['user']->username . '" juga telah dibuat untuk guru ini.';

        if ($akun['dibuatSistem']) {
            $pesan .= ' Password awal: ' . $akun['password'] . ' (simpan catatan ini, password hanya ditampilkan sekali).';
        }

        return $pesan;
    }
}
