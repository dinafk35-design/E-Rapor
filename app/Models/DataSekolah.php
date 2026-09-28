<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    protected $table = 'data_sekolah';

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'kode_pos',
        'alamat',
        'telepon',
        'email',
        'website',
        'kepala_sekolah',
        'nip_kepala_sekolah',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function rombel()
    {
        return $this->hasMany(Rombel::class, 'sekolah_id');
    }

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'sekolah_id');
    }
}
