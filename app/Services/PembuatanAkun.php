<?php

namespace App\Services;

use App\Models\DataGuru;
use App\Models\DataSiswa;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * Membuat akun login untuk data siswa atau data guru.
 *
 * Akun dibuat bersamaan dengan data induknya dalam satu transaksi,
 * sehingga tidak mungkin ada siswa / guru tanpa akun.
 *
 * Username memakai NISN / NIP bila tersedia. Password dibuat sistem
 * bila admin tidak mengisinya, dan password itu dikembalikan agar bisa
 * ditampilkan satu kali kepada admin.
 */
class PembuatanAkun
{
    /*
    |--------------------------------------------------------------------------
    | BUAT AKUN
    |--------------------------------------------------------------------------
    */

    /**
     * Buat akun untuk satu siswa.
     *
     * @param  array<string, mixed>  $opsi  username / password pilihan admin
     * @return array{user: User, password: ?string, dibuatSistem: bool}
     */
    public function untukSiswa(DataSiswa $siswa, array $opsi = []): array
    {
        return $this->buat([
            'name' => $siswa->nama_siswa,
            'username' => $opsi['username'] ?? $siswa->nisn,
            'email' => null,
            'password' => $opsi['password'] ?? null,
            'role' => 'siswa',
        ]);
    }

    /**
     * Buat akun untuk satu guru.
     *
     * @param  array<string, mixed>  $opsi  username / password pilihan admin
     * @return array{user: User, password: ?string, dibuatSistem: bool}
     */
    public function untukGuru(DataGuru $guru, array $opsi = []): array
    {
        return $this->buat([
            'name' => $guru->nama_guru,
            'username' => $opsi['username'] ?? $guru->nip,
            'email' => $opsi['email'] ?? $guru->email,
            'password' => $opsi['password'] ?? null,
            'role' => 'guru',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PENYUSUNAN AKUN
    |--------------------------------------------------------------------------
    */

    /**
     * Bangun dan simpan baris users.
     *
     * @param  array<string, mixed>  $data
     * @return array{user: User, password: ?string, dibuatSistem: bool}
     */
    protected function buat(array $data): array
    {
        $passwordDipilih = trim((string) ($data['password'] ?? ''));

        // Password awal hanya perlu dikembalikan ke admin ketika sistem
        // yang menetapkannya. Kalau admin sendiri yang mengetik, admin
        // sudah tahu passwordnya.
        $dibuatSistem = $passwordDipilih === '';

        $password = $dibuatSistem ? Str::password(8) : $passwordDipilih;

        $user = new User;

        $user->forceFill([
            'name' => $data['name'] ?: 'Pengguna',
            'username' => $this->usernameUnik($data['username'] ?? null, $data['name'] ?? null),
            'email' => $this->emailTersedia($data['email'] ?? null),
            'password' => $password,
            'role' => $data['role'],
        ]);

        $user->save();

        return [
            'user' => $user,
            'password' => $dibuatSistem ? $password : null,
            'dibuatSistem' => $dibuatSistem,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | BANTUAN
    |--------------------------------------------------------------------------
    */

    /**
     * Pastikan username terisi dan belum dipakai pengguna lain.
     *
     * Username adalah kolom unique, sehingga NISN / NIP yang sama tidak
     * boleh dipakai dua akun. Username kosong diturunkan dari nama, dan
     * bila tetap bentrok diberi akhiran angka.
     */
    public function usernameUnik(?string $username, ?string $nama = null): string
    {
        $dasar = Str::lower(trim((string) $username));

        if ($dasar === '') {
            $dasar = Str::slug((string) $nama) ?: 'pengguna';
        }

        // Batasi panjang agar tidak melewati kolom users.username.
        $dasar = Str::limit($dasar, 200, '');

        $kandidat = $dasar;
        $urutan = 1;

        while (User::where('username', $kandidat)->exists()) {
            $urutan++;
            $kandidat = $dasar . '-' . $urutan;
        }

        return $kandidat;
    }

    /**
     * Email juga unique di tabel users, jadi email yang sudah dipakai
     * akun lain disimpan kosong agar tidak menggagalkan pembuatan akun.
     */
    protected function emailTersedia(?string $email): ?string
    {
        $email = trim((string) $email);

        if ($email === '' || User::where('email', $email)->exists()) {
            return null;
        }

        return $email;
    }
}
