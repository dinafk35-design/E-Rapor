<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruMengajar extends Model
{
     protected $table = 'Guru_Mengajar';
    protected $fillable = [
        'guru_id','mata_pelajaran_id','rombel_id', 'sekolah_id',  
    ];
    public function guru(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'guru_id');
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function rombel(): BelongsTo
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(DataSekolah::class, 'sekolah_id');
    }
}
   
