<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{

protected $table = 'wali_kelas';
    protected $fillable = [
        'guru_id','rombel_id','sekolah_id',
    ];

    // Relasi ke Data Guru
    public function guru(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'guru_id');
    }

    // Relasi ke Rombel
    public function rombel(): BelongsTo
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }

    // Relasi ke Data Sekolah
    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(DataSekolah::class, 'sekolah_id');
    }
}
