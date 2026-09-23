<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('data_guru')) {
            Schema::create('data_guru', function (Blueprint $table) {
                $table->id();
                $table->string('nip')->nullable();
                $table->string('nama_guru')->nullable();
                $table->string('nik')->nullable();
                $table->string('email')->nullable();
                $table->string('no_telepon')->nullable();
                $table->string('jenis_kelamin')->nullable();
                $table->string('tempat_lahir')->nullable();
                $table->date('tanggal_lahir')->nullable();
                $table->text('alamat')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('data_guru');
    }
};