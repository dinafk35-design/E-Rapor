<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table = 'rombel';

    protected $fillable = [
        'nama_rombel',
        'tingkat',
        'sekolah_id',
        'wali_kelas_id',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function sekolah()
    {
        return $this->belongsTo(DataSekolah::class, 'sekolah_id');
    }

    public function siswa()
    {
        return $this->hasMany(DataSiswa::class, 'rombel_id');
    }

    public function anggota()
    {
        return $this->hasMany(AnggotaRombel::class, 'rombel_id');
    }

    public function guruMengajar()
    {
        return $this->hasMany(GuruMengajar::class, 'rombel_id');
    }

    public function waliKelas()
    {
        return $this->hasMany(WaliKelas::class, 'rombel_id');
    }

    public function wali()
    {
        return $this->belongsTo(DataGuru::class, 'wali_kelas_id');
    }


    /*
    |--------------------------------------------------------------------------
    | JUMLAH ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function jumlahAnggota(): int
    {
        return $this->anggota()->count();
    }
}
