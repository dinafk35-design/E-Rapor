<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'nama_mata_pelajaran',
        'kode_mata_pelajaran',
        'kelompok',
        'sekolah_id',
    ];

    public function nilaiSiswa()
    {
        return $this->hasMany(
            NilaiSiswa::class,
            'mata_pelajaran_id'
        );
    }
}