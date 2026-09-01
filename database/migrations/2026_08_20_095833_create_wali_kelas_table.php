<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wali_kelas', function (Blueprint $table) {
    $table->id();

    $table->foreignId('guru_id')
          ->constrained('data_guru')
          ->cascadeOnDelete();

    $table->foreignId('rombel_id')
          ->constrained('rombel')
          ->cascadeOnDelete();

    $table->foreignId('sekolah_id')
          ->constrained('data_sekolah')
          ->cascadeOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_kelas');
    }
};
