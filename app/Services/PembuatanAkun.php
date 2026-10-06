<?php

namespace App\Services;

use App\Models\DataGuru;
use App\Models\DataSiswa;
use App\Models\User;
use Illuminate\Support\Str;

class PembuatanAkun
{
    /*
    |--------------------------------------------------------------------------
    | BUAT AKUN SISWA
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | BUAT AKUN GURU
    |--------------------------------------------------------------------------
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
    | MEMBUAT USER
    |--------------------------------------------------------------------------
    */

    protected function buat(array $data): array
    {
        $passwordDipilih = trim((string) ($data['password'] ?? ''));

        $dibuatSistem = $passwordDipilih === '';

        $password = $dibuatSistem
            ? Str::password(8)
            : $passwordDipilih;


        /*
        |--------------------------------------------------------------------------
        | SIAPKAN USER
        |--------------------------------------------------------------------------
        */

        $user = new User();

        $user->name = $data['name'] ?: 'Pengguna';

        $user->username = $this->usernameUnik(
            $data['username'] ?? null,
            $data['name'] ?? null
        );

        $user->email = $this->emailTersedia(
            $data['email'] ?? null
        );

        $user->password = $password;

        $user->role = $data['role'];


        /*
        |--------------------------------------------------------------------------
        | SIMPAN USER
        |--------------------------------------------------------------------------
        */

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | AMBIL ULANG DARI DATABASE
        |--------------------------------------------------------------------------
        |
        | Penting untuk memastikan ID benar-benar sudah ada di tabel users.
        |
        */

        $userId = $user->getKey();

        $user = User::query()->find($userId);

        if (!$user) {
            throw new \RuntimeException(
                'Akun berhasil dibuat tetapi data User tidak ditemukan kembali di database.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | KEMBALIKAN HASIL
        |--------------------------------------------------------------------------
        */

        return [
            'user' => $user,
            'password' => $dibuatSistem ? $password : null,
            'dibuatSistem' => $dibuatSistem,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | USERNAME UNIK
    |--------------------------------------------------------------------------
    */

    public function usernameUnik(
        ?string $username,
        ?string $nama = null
    ): string {

        $dasar = Str::lower(
            trim((string) $username)
        );

        if ($dasar === '') {
            $dasar = Str::slug(
                (string) $nama
            ) ?: 'pengguna';
        }

        $dasar = Str::limit(
            $dasar,
            200,
            ''
        );

        $kandidat = $dasar;

        $urutan = 1;

        while (
            User::where(
                'username',
                $kandidat
            )->exists()
        ) {

            $urutan++;

            $kandidat = $dasar . '-' . $urutan;
        }

        return $kandidat;
    }


    /*
    |--------------------------------------------------------------------------
    | EMAIL UNIK
    |--------------------------------------------------------------------------
    */

    protected function emailTersedia(?string $email): ?string
    {
        $email = trim(
            (string) $email
        );

        if (
            $email === '' ||
            User::where(
                'email',
                $email
            )->exists()
        ) {
            return null;
        }

        return $email;
    }
}