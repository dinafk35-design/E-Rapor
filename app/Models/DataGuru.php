<?php

namespace App\Models;

use App\Exceptions\DataGuruMasihDipakai;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    protected $table = 'data_guru';

    protected $fillable = [
        'nip',
        'nama_guru',
        'nik',
        'email',
        'no_telepon',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'user_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KE USER
    |--------------------------------------------------------------------------
    */

    /**
     * Akun login milik guru ini.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI KE NILAI SISWA
    |--------------------------------------------------------------------------
    */

    public function nilai()
    {
        return $this->hasMany(
            NilaiSiswa::class,
            'guru_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI KE GURU MENGAJAR
    |--------------------------------------------------------------------------
    */

    /**
     * Mata pelajaran yang masih diajar oleh guru ini.
     *
     * Relasi inilah yang membuat data guru tidak boleh dihapus selama
     * guru masih tercatat sebagai pengajar suatu mata pelajaran.
     */
    public function guruMengajar()
    {
        return $this->hasMany(GuruMengajar::class, 'guru_id');
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI KE WALI KELAS
    |--------------------------------------------------------------------------
    */

    /**
     * Penugasan wali kelas milik guru ini.
     */
    public function waliKelas()
    {
        return $this->hasMany(WaliKelas::class, 'guru_id');
    }

    /**
     * Rombel yang diampu oleh guru ini sebagai wali kelas.
     *
     * Disimpan pada kolom rombel.wali_kelas_id yang menunjuk ke data_guru.id.
     */
    public function rombelDiampu()
    {
        return $this->hasMany(Rombel::class, 'wali_kelas_id');
    }


    /*
    |--------------------------------------------------------------------------
    | ATURAN PENGHAPUSAN DATA GURU
    |--------------------------------------------------------------------------
    */

    /**
     * Daftar mata pelajaran yang masih diajar guru ini.
     *
     * Sudah membawa data Mata Pelajaran, Rombel, dan periode teachingsnya
     * supaya halaman relasi tidak perlu query tambahan.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, GuruMengajar>
     */
    public function mapelDiajar()
    {
        return $this->guruMengajar()
            ->with(['mataPelajaran', 'rombel'])
            ->orderBy('mata_pelajaran_id')
            ->orderBy('rombel_id')
            ->get();
    }

    /**
     * Relasi yang masih memakai data guru ini sehingga guru tidak boleh
     * dihapus.
     *
     * @return array<int, array{relasi: string, label: string, jumlah: int, pesan: string}>
     */
    public function relasiPenghalang(): array
    {
        $penghalang = [];

        $jumlahMapel = $this->guruMengajar()->count();

        if ($jumlahMapel > 0) {
            $penghalang[] = [
                'relasi' => 'mata_pelajaran',
                'label' => 'Mata Pelajaran yang diajar',
                'jumlah' => $jumlahMapel,
                'pesan' => 'Data Guru tidak dapat dihapus karena masih memiliki relasi dengan '
                    . 'Mata Pelajaran yang diajar.',
            ];
        }

        $jumlahWaliKelas = $this->waliKelas()->count();

        if ($jumlahWaliKelas > 0) {
            $penghalang[] = [
                'relasi' => 'wali_kelas',
                'label' => 'Penugasan Wali Kelas',
                'jumlah' => $jumlahWaliKelas,
                'pesan' => 'Data Guru tidak dapat dihapus karena masih tercatat sebagai Wali Kelas '
                    . 'pada sebanyak ' . $jumlahWaliKelas . ' rombongan belajar.',
            ];
        }

        $jumlahRombel = $this->rombelDiampu()->count();

        if ($jumlahRombel > 0) {
            $penghalang[] = [
                'relasi' => 'rombel',
                'label' => 'Rombel yang diampu sebagai Wali Kelas',
                'jumlah' => $jumlahRombel,
                'pesan' => 'Data Guru tidak dapat dihapus karena masih menjadi Wali Kelas dari '
                    . 'sebanyak ' . $jumlahRombel . ' rombongan belajar.',
            ];
        }

        return $penghalang;
    }

    /**
     * Pesan singkat yang menjelaskan kenapa guru tidak boleh dihapus.
     *
     * Mengembalikan null bila guru sudah aman dihapus.
     */
    public function alasanTidakBisaDihapus(): ?string
    {
        $penghalang = $this->relasiPenghalang();

        $pesan = array_column($penghalang, 'pesan');

        return $penghalang === [] ? null : implode(' ', $pesan);
    }

    /**
     * Jaga integritas data di level model.
     *
     * Selain pengecekan di controller, penghapusan data guru juga
     * diblokir di sini supaya tidak bisa dilakukan diam-diam dari
     * places lain (seeder, konsol, dsb). Pesan error dibungkus pada
     * exception yang bisa dikenali pemanggil.
     */
    protected static function booted(): void
    {
        static::deleting(function (self $guru): void {

            $alasan = $guru->alasanTidakBisaDihapus();

            if ($alasan !== null) {
                throw DataGuruMasihDipakai::dariAlasan($alasan);
            }
        });
    }
}