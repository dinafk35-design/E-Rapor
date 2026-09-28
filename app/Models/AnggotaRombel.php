<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnggotaRombel extends Model
{
    protected $table = 'anggota_rombel';

    protected $fillable = [
        'rombel_id',
        'siswa_id',
        'tahun_ajaran',
        'semester',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }

    public function siswa()
    {
        return $this->belongsTo(DataSiswa::class, 'siswa_id');
    }
}
