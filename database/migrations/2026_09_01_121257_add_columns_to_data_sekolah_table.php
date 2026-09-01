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
        if (!Schema::hasColumn('data_sekolah', 'nama_sekolah')) {
            Schema::table('data_sekolah', function (Blueprint $table) {
                $table->string('nama_sekolah')->after('id');
            });
        }

        if (!Schema::hasColumn('data_sekolah', 'alamat')) {
            Schema::table('data_sekolah', function (Blueprint $table) {
                $table->text('alamat')->after('nama_sekolah');
            });
        }

        if (!Schema::hasColumn('data_sekolah', 'email')) {
            Schema::table('data_sekolah', function (Blueprint $table) {
                $table->string('email')->nullable()->after('alamat');
            });
        }

        if (!Schema::hasColumn('data_sekolah', 'telepon')) {
            Schema::table('data_sekolah', function (Blueprint $table) {
                $table->string('telepon')->nullable()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak menghapus kolom untuk menjaga data yang sudah ada.
    }
};