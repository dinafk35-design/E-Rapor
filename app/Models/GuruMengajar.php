<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruMengajar extends Model
{
    protected $table = 'guru_mengajar';

    protected $fillable = [
        'guru_id',
        'mata_pelajaran_id',
        'rombel_id',
        'tahun_ajaran',
        'semester',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'guru_id');
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
}
