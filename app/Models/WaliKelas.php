<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'wali_kelas';

    protected $fillable = [
        'guru_id',
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

    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
}
