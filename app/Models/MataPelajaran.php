<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'sekolah_id',
        'kode_mata_pelajaran',
        'nama_mata_pelajaran',
        'kelompok',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KE NILAI SISWA
    |--------------------------------------------------------------------------
    */

    public function nilai()
    {
        return $this->hasMany(
            NilaiSiswa::class,
            'mata_pelajaran_id'
        );
    }
}