<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('mata_pelajaran')) {
            Schema::create('mata_pelajaran', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('sekolah_id');

                $table->string('kode_mata_pelajaran')->nullable();
                $table->string('nama_mata_pelajaran');
                $table->string('kelompok')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_pelajaran');
    }
};