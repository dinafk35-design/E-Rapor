<?php

namespace Database\Seeders;

use App\Models\DataGuru;
use App\Models\DataSekolah;
use App\Models\DataSiswa;
use App\Models\MataPelajaran;
use App\Models\Rombel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EraporSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);

        $this->buatPengguna();

        // ---------------------------------------------------------
        // SEKOLAH
        // ---------------------------------------------------------

        $sekolah = DataSekolah::updateOrCreate(
            ['npsn' => '12345678'],
            [
                'nama_sekolah' => 'SMK E-Rapor',
                'kode_pos' => '30123',
                'alamat' => 'Jl. Contoh No. 10, Palembang',
                'telepon' => '0711-123456',
                'email' => 'info@smkerapor.sch.id',
                'website' => 'https://smkerapor.sch.id',
                'kepala_sekolah' => 'Drs. Bambang Suryanto',
                'nip_kepala_sekolah' => '196805121994031005',
            ]
        );


        // ---------------------------------------------------------
        // GURU
        // ---------------------------------------------------------

        $daftarGuru = [
            ['198501012010011001', 'Budi Santoso, S.Pd.', 'L', 'budi@smkerapor.sch.id'],
            ['198502022010011002', 'Siti Aminah, S.Pd.', 'P', 'siti@smkerapor.sch.id'],
            ['198503032010011003', 'Andi Saputra, S.Kom.', 'L', 'andi@smkerapor.sch.id'],
            ['198504042010011004', 'Rina Wulandari, S.Kom.', 'P', 'rina@smkerapor.sch.id'],
        ];

        $guru = [];

        foreach ($daftarGuru as [$nip, $nama, $jk, $email]) {

            $guru[$nip] = DataGuru::updateOrCreate(
                ['nip' => $nip],
                [
                    'nama_guru' => $nama,
                    'nik' => $nip,
                    'email' => $email,
                    'no_telepon' => '0812' . substr($nip, -8),
                    'jenis_kelamin' => $jk,
                    'tempat_lahir' => 'Palembang',
                    'tanggal_lahir' => '1985-01-01',
                    'alamat' => 'Palembang, Sumatera Selatan',
                ]
            );
        }


        // ---------------------------------------------------------
        // ROMBEL
        // ---------------------------------------------------------

        $daftarRombel = ['X RPL 1', 'X RPL 2', 'XI RPL 1', 'XI RPL 2', 'XII RPL 1', 'XII RPL 2'];

        $rombel = [];

        foreach ($daftarRombel as $index => $nama) {

            $tingkat = explode(' ', $nama)[0];

            $rombel[$nama] = Rombel::updateOrCreate(
                ['nama_rombel' => $nama],
                [
                    'tingkat' => $tingkat,
                    'sekolah_id' => $sekolah->id,
                    'wali_kelas_id' => null,
                ]
            );
        }


        // ---------------------------------------------------------
        // MATA PELAJARAN
        // ---------------------------------------------------------

        $daftarMapel = [
            ['RPL001', 'Matematika', 'A'],
            ['RPL002', 'Bahasa Indonesia', 'A'],
            ['RPL003', 'Bahasa Inggris', 'A'],
            ['RPL004', 'Pendidikan Agama', 'A'],
            ['RPL005', 'PPKn', 'B'],
            ['RPL006', 'Informatika', 'B'],
            ['RPL007', 'Pemrograman Web', 'C'],
            ['RPL008', 'Pemrograman Berorientasi Objek', 'C'],
            ['RPL009', 'Basis Data', 'C'],
            ['RPL010', 'Produk Kreatif dan Kewirausahaan', 'C'],
        ];

        foreach ($daftarMapel as [$kode, $nama, $kelompok]) {

            MataPelajaran::updateOrCreate(
                ['kode_mata_pelajaran' => $kode],
                [
                    'nama_mata_pelajaran' => $nama,
                    'kelompok' => $kelompok,
                    'sekolah_id' => $sekolah->id,
                ]
            );
        }


        // ---------------------------------------------------------
        // SISWA
        // ---------------------------------------------------------

        $daftarSiswa = [
            ['00654321', 'Ahmad Fauzan', 'L', 'XI RPL 1'],
            ['00765432', 'Budi Santoso', 'L', 'XI RPL 1'],
            ['00876543', 'Citra Lestari', 'P', 'XI RPL 1'],
            ['00987654', 'Dimas Pratama', 'L', 'XI RPL 2'],
            ['00123456', 'Eka Putri', 'P', 'XI RPL 2'],
        ];

        foreach ($daftarSiswa as [$nisn, $nama, $jk, $rombelNama]) {

            DataSiswa::updateOrCreate(
                ['nisn' => $nisn],
                [
                    'nama_siswa' => $nama,
                    'jenis_kelamin' => $jk,
                    'tempat_lahir' => 'Palembang',
                    'tanggal_lahir' => '2009-05-12',
                    'rombel_id' => $rombel[$rombelNama]->id,
                    'alamat' => 'Jl. Contoh No. 10 Palembang',
                ]
            );
        }
    }


    /**
     * Buat akun admin, guru, dan siswa tanpa menimpa yang sudah ada.
     */
    protected function buatPengguna(): void
    {
        $daftar = [
            ['admin', 'Administrator', 'admin@erapor.test', 'admin123', 'admin'],
            ['guru', 'Guru E-Rapor', 'guru@erapor.test', 'guru123', 'guru'],
            ['siswa', 'Siswa E-Rapor', 'siswa@erapor.test', 'siswa123', 'siswa'],
        ];

        foreach ($daftar as [$username, $name, $email, $password, $role]) {

            if (User::where('username', $username)->exists()) {
                continue;
            }

            User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role,
            ]);
        }
    }
}
