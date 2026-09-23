<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    protected $table = 'data_siswa';

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rombel_id',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KE ROMBEL
    |--------------------------------------------------------------------------
    */

    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI KE NILAI SISWA
    |--------------------------------------------------------------------------
    */

    public function nilai()
    {
        return $this->hasMany(NilaiSiswa::class, 'siswa_id');
    }
}