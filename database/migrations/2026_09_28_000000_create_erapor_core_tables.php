<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel inti yang dirujuk oleh halaman E-Rapor namun belum pernah dibuat.
     */
    public function up(): void
    {
        // ---------------------------------------------------------
        // DATA SEKOLAH
        // ---------------------------------------------------------

        if (! Schema::hasTable('data_sekolah')) {
            Schema::create('data_sekolah', function (Blueprint $table): void {
                $table->id();

                $table->string('nama_sekolah');
                $table->string('npsn')->nullable();
                $table->string('kode_pos')->nullable();
                $table->text('alamat')->nullable();
                $table->string('telepon')->nullable();
                $table->string('email')->nullable();
                $table->string('website')->nullable();
                $table->string('kepala_sekolah')->nullable();
                $table->string('nip_kepala_sekolah')->nullable();

                $table->timestamps();
            });
        }


        // ---------------------------------------------------------
        // ROMBEL
        // ---------------------------------------------------------

        if (! Schema::hasTable('rombel')) {
            Schema::create('rombel', function (Blueprint $table): void {
                $table->id();

                $table->string('nama_rombel');
                $table->string('tingkat')->nullable();
                $table->unsignedBigInteger('sekolah_id')->nullable();
                $table->unsignedBigInteger('wali_kelas_id')->nullable();

                $table->timestamps();
            });
        }


        // ---------------------------------------------------------
        // ANGGOTA ROMBEL
        // ---------------------------------------------------------

        if (! Schema::hasTable('anggota_rombel')) {
            Schema::create('anggota_rombel', function (Blueprint $table): void {
                $table->id();

                $table->unsignedBigInteger('rombel_id');
                $table->unsignedBigInteger('siswa_id');

                $table->string('tahun_ajaran')->nullable();
                $table->string('semester')->nullable();

                $table->timestamps();

                $table->unique(
                    ['rombel_id', 'siswa_id', 'tahun_ajaran', 'semester'],
                    'anggota_rombel_unik'
                );
            });
        }


        // ---------------------------------------------------------
        // GURU MENGAJAR
        // ---------------------------------------------------------

        if (! Schema::hasTable('guru_mengajar')) {
            Schema::create('guru_mengajar', function (Blueprint $table): void {
                $table->id();

                $table->unsignedBigInteger('guru_id');
                $table->unsignedBigInteger('mata_pelajaran_id');
                $table->unsignedBigInteger('rombel_id');

                $table->string('tahun_ajaran')->nullable();
                $table->string('semester')->nullable();

                $table->timestamps();

                $table->unique(
                    ['guru_id', 'mata_pelajaran_id', 'rombel_id', 'tahun_ajaran', 'semester'],
                    'guru_mengajar_unik'
                );
            });
        }


        // ---------------------------------------------------------
        // WALI KELAS
        // ---------------------------------------------------------

        if (! Schema::hasTable('wali_kelas')) {
            Schema::create('wali_kelas', function (Blueprint $table): void {
                $table->id();

                $table->unsignedBigInteger('guru_id');
                $table->unsignedBigInteger('rombel_id');

                $table->string('tahun_ajaran')->nullable();
                $table->string('semester')->nullable();

                $table->timestamps();

                $table->unique(
                    ['guru_id', 'rombel_id', 'tahun_ajaran', 'semester'],
                    'wali_kelas_unik'
                );
            });
        }


        // ---------------------------------------------------------
        // INDEKS PENDUKUNG
        // ---------------------------------------------------------

        // Mempercepat pencarian nilai siswa per kelas / mata pelajaran.
        // Dijaga hasIndex supaya aman dijalankan ulang pada database lama
        // yang sudah punya indeks tersebut.
        if (
            Schema::hasTable('nilai_siswa') &&
            ! Schema::hasIndex('nilai_siswa', 'nilai_siswa_cari')
        ) {
            Schema::table('nilai_siswa', function (Blueprint $table): void {
                $table->index(
                    ['siswa_id', 'mata_pelajaran_id', 'tahun_ajaran', 'semester'],
                    'nilai_siswa_cari'
                );
            });
        }
    }

    public function down(): void
    {
        if (
            Schema::hasTable('nilai_siswa') &&
            Schema::hasIndex('nilai_siswa', 'nilai_siswa_cari')
        ) {
            Schema::table('nilai_siswa', function (Blueprint $table): void {
                $table->dropIndex('nilai_siswa_cari');
            });
        }

        Schema::dropIfExists('wali_kelas');
        Schema::dropIfExists('guru_mengajar');
        Schema::dropIfExists('anggota_rombel');
        Schema::dropIfExists('rombel');
        Schema::dropIfExists('data_sekolah');
    }
};
