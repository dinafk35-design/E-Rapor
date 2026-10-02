<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Menjaga integritas relasi data guru di level database.
 *
 * Sebelumnya tabel guru_mengajar, wali_kelas, rombel, dan nilai_siswa hanya
 * menyimpan kolom id tanpa foreign key, sehingga data guru bisa dihapus
 * walau masih dipakai. Akibatnya muncul baris yatim, contoh: guru_mengajar
 * yang menunjuk ke guru yang sudah dihapus.
 *
 * Migrasi ini tidak membuat tabel baru. Ia hanya:
 *  1. membersihkan baris yatim yang sudah terlanjur rusak,
 *  2. memasang foreign key dengan aturan penghapusan yang sesuai.
 *
 * Aturan penghapusan:
 *  - guru_mengajar.guru_id      -> restrictOnDelete (guru tidak boleh dihapus)
 *  - wali_kelas.guru_id         -> restrictOnDelete (guru tidak boleh dihapus)
 *  - rombel.wali_kelas_id       -> restrictOnDelete (guru tidak boleh dihapus)
 *  - nilai_siswa.guru_id        -> nullOnDelete (nilai siswa tetap utuh, hanya
 *                                  nama guru penilai yang dilepas)
 *
 * Nilai siswa sengaja tidak ikut terhapus agar hasil penilaian siswa tetap
 * utuh, hanya kolom guru_id yang dilepas menjadi NULL.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('data_guru')) {
            return;
        }

        $this->bersihkanRelasiYatim();

        // ---------------------------------------------------------
        // GURU MENGAJAR
        // ---------------------------------------------------------
        // Index sudah tersedia lewat unique guru_mengajar_unik karena
        // guru_id adalah kolom paling kiri, jadi tidak perlu index baru.

        if (Schema::hasTable('guru_mengajar') && ! $this->sudahPakaiForeignKey('guru_mengajar', 'guru_id')) {
            Schema::table('guru_mengajar', function (Blueprint $table): void {
                $table->foreign('guru_id')
                    ->references('id')
                    ->on('data_guru')
                    ->restrictOnDelete();
            });
        }

        // ---------------------------------------------------------
        // WALI KELAS
        // ---------------------------------------------------------
        // Index tersedia lewat unique wali_kelas_unik.

        if (Schema::hasTable('wali_kelas') && ! $this->sudahPakaiForeignKey('wali_kelas', 'guru_id')) {
            Schema::table('wali_kelas', function (Blueprint $table): void {
                $table->foreign('guru_id')
                    ->references('id')
                    ->on('data_guru')
                    ->restrictOnDelete();
            });
        }

        // ---------------------------------------------------------
        // ROMBEL
        // ---------------------------------------------------------
        // Kolom wali_kelas_id belum punya index, jadi dibuatkan dulu.

        if (Schema::hasTable('rombel')) {
            $this->pastikanIndex('rombel', ['wali_kelas_id'], 'rombel_wali_kelas_id_index');

            if (! $this->sudahPakaiForeignKey('rombel', 'wali_kelas_id')) {
                Schema::table('rombel', function (Blueprint $table): void {
                    $table->foreign('wali_kelas_id')
                        ->references('id')
                        ->on('data_guru')
                        ->restrictOnDelete();
                });
            }
        }

        // ---------------------------------------------------------
        // NILAI SISWA
        // ---------------------------------------------------------

        if (Schema::hasTable('nilai_siswa')) {
            $this->pastikanIndex('nilai_siswa', ['guru_id'], 'nilai_siswa_guru_id_index');

            if (! $this->sudahPakaiForeignKey('nilai_siswa', 'guru_id')) {
                Schema::table('nilai_siswa', function (Blueprint $table): void {
                    $table->foreign('guru_id')
                        ->references('id')
                        ->on('data_guru')
                        ->nullOnDelete();
                });
            }
        }
    }

    public function down(): void
    {
        $daftar = [
            ['tabel' => 'nilai_siswa', 'kolom' => 'guru_id', 'index' => 'nilai_siswa_guru_id_index'],
            ['tabel' => 'rombel', 'kolom' => 'wali_kelas_id', 'index' => 'rombel_wali_kelas_id_index'],
            ['tabel' => 'wali_kelas', 'kolom' => 'guru_id', 'index' => null],
            ['tabel' => 'guru_mengajar', 'kolom' => 'guru_id', 'index' => null],
        ];

        foreach ($daftar as $item) {

            if (! Schema::hasTable($item['tabel'])) {
                continue;
            }

            if ($this->sudahPakaiForeignKey($item['tabel'], $item['kolom'])) {
                Schema::table($item['tabel'], function (Blueprint $table) use ($item): void {
                    $table->dropForeign([$item['kolom']]);
                });
            }

            if ($item['index'] !== null && Schema::hasIndex($item['tabel'], $item['index'])) {
                Schema::table($item['tabel'], function (Blueprint $table) use ($item): void {
                    $table->dropIndex($item['index']);
                });
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | BANTUAN
    |--------------------------------------------------------------------------
    */

    /**
     * Buang atau lepaskan baris yang menunjuk ke guru yang sudah tidak ada.
     *
     * - guru_mengajar & wali_kelas: penugasan tanpa guru tidak bermakna,
     *   jadi barisnya dihapus (data Mata Pelajaran & Rombel tetap utuh).
     * - rombel.wali_kelas_id & nilai_siswa.guru_id: kolomnya nullable, jadi
     *   cukup dilepas menjadi NULL agar data induknya tidak ikut hilang.
     */
    protected function bersihkanRelasiYatim(): void
    {
        $idGuru = DB::table('data_guru')->select('id');

        foreach (['guru_mengajar', 'wali_kelas'] as $tabel) {

            if (! Schema::hasTable($tabel)) {
                continue;
            }

            DB::table($tabel)
                ->whereNotNull('guru_id')
                ->whereNotIn('guru_id', $idGuru)
                ->delete();
        }

        if (Schema::hasTable('rombel') && Schema::hasColumn('rombel', 'wali_kelas_id')) {
            DB::table('rombel')
                ->whereNotNull('wali_kelas_id')
                ->whereNotIn('wali_kelas_id', $idGuru)
                ->update(['wali_kelas_id' => null]);
        }

        if (Schema::hasTable('nilai_siswa') && Schema::hasColumn('nilai_siswa', 'guru_id')) {
            DB::table('nilai_siswa')
                ->whereNotNull('guru_id')
                ->whereNotIn('guru_id', $idGuru)
                ->update(['guru_id' => null]);
        }
    }

    /**
     * Sudah ada foreign key untuk kolom tersebut atau belum.
     */
    protected function sudahPakaiForeignKey(string $tabel, string $kolom): bool
    {
        foreach (Schema::getForeignKeys($tabel) as $foreign) {

            if (($foreign['columns'] ?? []) === [$kolom]) {
                return true;
            }
        }

        return false;
    }

    /**
     * Tambahkan index hanya bila belum ada (aman untuk dijalankan ulang).
     *
     * @param  array<int, string>  $kolom
     */
    protected function pastikanIndex(string $tabel, array $kolom, string $nama): void
    {
        if (Schema::hasColumn($tabel, $kolom[0]) && ! Schema::hasIndex($tabel, $kolom)) {
            Schema::table($tabel, function (Blueprint $table) use ($kolom, $nama): void {
                $table->index($kolom, $nama);
            });
        }
    }
};