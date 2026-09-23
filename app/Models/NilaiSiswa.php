<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    protected $table = 'nilai_siswa';

    protected $fillable = [
        'siswa_id',
        'mata_pelajaran_id',
        'guru_id',
        'tahun_ajaran',
        'semester',
        'nilai',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KE DATA SISWA
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'siswa_id');
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI KE MATA PELAJARAN
    |--------------------------------------------------------------------------
    */

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI KE GURU
    |--------------------------------------------------------------------------
    */

    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'guru_id');
    }
}