<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_siswa', function (Blueprint $table) {

            $table->id();

            // Siswa
            $table->foreignId('siswa_id')
                ->constrained('data_siswa')
                ->cascadeOnDelete();

            // Mata Pelajaran
            $table->foreignId('mata_pelajaran_id')
                ->constrained('mata_pelajaran')
                ->cascadeOnDelete();

            // Guru
            $table->foreignId('guru_id')
                ->nullable()
                ->constrained('data_guru')
                ->nullOnDelete();

            // Tahun Ajaran
            $table->string('tahun_ajaran')
                ->default('2026/2027');

            // Semester
            $table->string('semester')
                ->default('Ganjil');

            // Nilai
            $table->decimal('nilai', 5, 2)
                ->nullable();

            $table->timestamps();

            // Unique index dengan nama pendek
            $table->unique(
                [
                    'siswa_id',
                    'mata_pelajaran_id',
                    'tahun_ajaran',
                    'semester'
                ],
                'nilai_siswa_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_siswa');
    }
};