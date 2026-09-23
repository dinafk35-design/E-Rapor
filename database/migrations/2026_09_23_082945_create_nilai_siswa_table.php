<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('nilai_siswa')) {
            Schema::create('nilai_siswa', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('siswa_id');
                $table->unsignedBigInteger('mata_pelajaran_id');
                $table->unsignedBigInteger('guru_id')->nullable();

                $table->string('tahun_ajaran')->default('2026/2027');
                $table->string('semester')->default('Ganjil');

                $table->decimal('nilai', 5, 2)->nullable();

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_siswa');
    }
};