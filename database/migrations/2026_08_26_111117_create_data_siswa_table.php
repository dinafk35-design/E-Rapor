<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('data_siswa')) {

            Schema::create('data_siswa', function (Blueprint $table) {

                $table->id();

                $table->string('nisn')->nullable()->unique();
                $table->string('nis')->nullable();

                $table->string('nama_siswa');

                $table->enum('jenis_kelamin', ['L', 'P'])->nullable();

                $table->string('tempat_lahir')->nullable();
                $table->date('tanggal_lahir')->nullable();

                $table->text('alamat')->nullable();

                $table->string('nama_ayah')->nullable();
                $table->string('nama_ibu')->nullable();

                $table->unsignedBigInteger('rombel_id')->nullable();

                $table->timestamps();
            });

        }
    }

    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};