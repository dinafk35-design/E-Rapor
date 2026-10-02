<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menghubungkan data siswa dan data guru ke tabel users.
 *
 * Kolom `user_id` sengaja nullable karena data siswa / guru yang sudah
 * ada sebelum migrasi ini belum memiliki akun login. Akun untuk data
 * baru dibuat otomatis oleh DataSiswaController / DataGuruController.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ---------------------------------------------------------
        // KOLOM user_id
        // ---------------------------------------------------------

        if (Schema::hasTable('data_siswa') && ! Schema::hasColumn('data_siswa', 'user_id')) {
            Schema::table('data_siswa', function (Blueprint $table): void {
                $table->unsignedBigInteger('user_id')->nullable();
            });
        }

        if (Schema::hasTable('data_guru') && ! Schema::hasColumn('data_guru', 'user_id')) {
            Schema::table('data_guru', function (Blueprint $table): void {
                $table->unsignedBigInteger('user_id')->nullable();
            });
        }


        // ---------------------------------------------------------
        // INDEX + FOREIGN KEY
        //
        // Ditambahkan terpisah dari penambahan kolom agar aman dijalankan
        // pada SQLite (test) maupun MySQL (produksi). Nilai NULL yang
        // sudah ada tetap valid, dan user_id yang dihapus jadi NULL
        // alih-alih ikut terhapus.
        // ---------------------------------------------------------

        if (Schema::hasTable('data_siswa') && Schema::hasColumn('data_siswa', 'user_id')) {
            Schema::table('data_siswa', function (Blueprint $table): void {
                $table->unique('user_id', 'data_siswa_user_id_unik');
                $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            });
        }

        if (Schema::hasTable('data_guru') && Schema::hasColumn('data_guru', 'user_id')) {
            Schema::table('data_guru', function (Blueprint $table): void {
                $table->unique('user_id', 'data_guru_user_id_unik');
                $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Foreign key harus dilepas sebelum kolomnya dihapus.
        // Diabaikan bila tabel / constraint tidak ada.
        foreach (['data_siswa', 'data_guru'] as $tabel) {

            if (! Schema::hasTable($tabel) || ! Schema::hasColumn($tabel, 'user_id')) {
                continue;
            }

            Schema::table($tabel, function (Blueprint $table) use ($tabel): void {
                $table->dropForeign(['user_id']);
                $table->dropUnique($tabel . '_user_id_unik');
                $table->dropColumn('user_id');
            });
        }
    }
};
