<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    protected $fillable = [
        'nama_mata_pelajaran','kode_mata_pelajaran', 'kelompok','sekolah_id',
    ];

    // Relasi ke Data Sekolah
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(DataSekolah::class, 'sekolah_id');
    }

    // Relasi ke Guru Mengajar
    public function guruMengajar(): HasMany
    {
        return $this->hasMany(GuruMengajar::class, 'mata_pelajaran_id');
    }
}
