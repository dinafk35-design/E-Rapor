<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom ke tabel data_guru.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('data_guru', 'nip')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->string('nip')->nullable()->after('id');
            });
        }

        if (!Schema::hasColumn('data_guru', 'nama_guru')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->string('nama_guru')->nullable()->after('nip');
            });
        }

        if (!Schema::hasColumn('data_guru', 'nik')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->string('nik')->nullable()->after('nama_guru');
            });
        }

        if (!Schema::hasColumn('data_guru', 'email')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->string('email')->nullable()->after('nik');
            });
        }

        if (!Schema::hasColumn('data_guru', 'no_telepon')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->string('no_telepon')->nullable()->after('email');
            });
        }

        if (!Schema::hasColumn('data_guru', 'jenis_kelamin')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->string('jenis_kelamin')->nullable()->after('no_telepon');
            });
        }

        if (!Schema::hasColumn('data_guru', 'tempat_lahir')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            });
        }

        if (!Schema::hasColumn('data_guru', 'tanggal_lahir')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            });
        }

        if (!Schema::hasColumn('data_guru', 'alamat')) {
            Schema::table('data_guru', function (Blueprint $table) {
                $table->text('alamat')->nullable()->after('tanggal_lahir');
            });
        }
    }

    /**
     * Membatalkan perubahan migration.
     */
    public function down(): void
    {
        Schema::table('data_guru', function (Blueprint $table) {
            $table->dropColumn([
                'nip',
                'nama_guru',
                'nik',
                'email',
                'no_telepon',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'alamat',
            ]);
        });
    }
};