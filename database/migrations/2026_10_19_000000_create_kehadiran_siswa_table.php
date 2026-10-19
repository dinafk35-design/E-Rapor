<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Rekapitulasi kehadiran siswa per tahun ajaran dan semester.
 *
 * Izin, sakit, dan alpa dihitung untuk satu periode, bukan per mata
 * pelajaran, jadi disimpan terpisah dari tabel nilai_siswa.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('kehadiran_siswa')) {
            return;
        }

        Schema::create('kehadiran_siswa', function (Blueprint $table): void {
            $table->id();

            $table->unsignedBigInteger('siswa_id');
            $table->string('tahun_ajaran')->default('2026/2027');
            $table->string('semester')->default('Ganjil');

            $table->unsignedInteger('izin')->default(0);
            $table->unsignedInteger('sakit')->default(0);
            $table->unsignedInteger('alpa')->default(0);

            $table->timestamps();

            // Satu siswa hanya punya satu rekap per periode.
            $table->unique(
                ['siswa_id', 'tahun_ajaran', 'semester'],
                'kehadiran_siswa_periode_unik'
            );

            $table->index(
                ['tahun_ajaran', 'semester'],
                'kehadiran_siswa_periode_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kehadiran_siswa');
    }
};