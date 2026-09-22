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

    public function siswa()
    {
        return $this->hasMany(DataSiswa::class, 'rombel_id');
    }
}