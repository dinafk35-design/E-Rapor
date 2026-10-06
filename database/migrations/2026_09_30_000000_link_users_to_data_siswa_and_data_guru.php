<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menghubungkan data siswa dan data guru ke tabel users.
 */
return new class extends Migration
{
    public function up(): void
    {
        // =========================================================
        // DATA SISWA
        // =========================================================

        if (
            Schema::hasTable('data_siswa') &&
            !Schema::hasColumn('data_siswa', 'user_id')
        ) {
            Schema::table('data_siswa', function (Blueprint $table): void {
                $table->foreignId('user_id')
                    ->nullable()
                    ->unique()
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }

        // =========================================================
        // DATA GURU
        // =========================================================
        //
        // TIDAK DITAMBAHKAN DI SINI karena user_id + foreign key
        // sudah dibuat pada migration create_data_guru_table.
        //
    }

    public function down(): void
    {
        // Hapus relasi user_id dari data_siswa
        if (
            Schema::hasTable('data_siswa') &&
            Schema::hasColumn('data_siswa', 'user_id')
        ) {
            Schema::table('data_siswa', function (Blueprint $table): void {
                $table->dropForeign(['user_id']);
                $table->dropUnique('data_siswa_user_id_unique');
                $table->dropColumn('user_id');
            });
        }
    }
};