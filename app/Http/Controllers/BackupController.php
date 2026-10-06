<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class BackupController extends Controller
{
    /**
     * Tabel aplikasi yang boleh di-backup / restore.
     *
     * @var array<int, string>
     */
    protected array $tables = [
        'users',
        'data_sekolah',
        'data_guru',
        'data_siswa',
        'rombel',
        'mata_pelajaran',
        'nilai_siswa',
    ];

    /**
     * Nama folder penyimpanan file backup.
     */
    protected string $folder = 'backups';


    /*
    |--------------------------------------------------------------------------
    | HALAMAN BACKUP & RESTORE
    |--------------------------------------------------------------------------
    */

    public function index(): Response
    {
        $driver = DB::connection()->getDriverName();

        return response()->view('backup.index', [
            'driver' => $driver,
            'namaDatabase' => DB::connection()->getDatabaseName(),
            'daftarTabel' => $this->ringkasanTabel(),
            'daftarFile' => $this->daftarFileBackup(),
            'totalBaris' => $this->totalBaris(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | UNDUH BACKUP SELURUH DATABASE
    |--------------------------------------------------------------------------
    */

    public function download(): Response
    {
        $driver = DB::connection()->getDriverName();

        $namaFile = $this->namaFile('erapor-backup-' . $driver);

        // SQLite cukup disalin langsung (kecuali database in-memory)

        if ($driver === 'sqlite' && $this->bisaDisalin()) {

            return response()->download(
                DB::connection()->getDatabaseName(),
                $namaFile . '.sqlite'
            );
        }


        // MySQL / MariaDB / SQLite in-memory: bangun dump dari PHP

        $path = $this->folderPath() . DIRECTORY_SEPARATOR . $namaFile . '.sql';

        File::put($path, $this->buatSqlDump());

        return response()->download($path, $namaFile . '.sql')->deleteFileAfterSend();
    }


    /*
    |--------------------------------------------------------------------------
    | EKSPOR SATU TABEL KE CSV
    |--------------------------------------------------------------------------
    */

    public function table(string $table): Response
    {
        if (! in_array($table, $this->tables, true) || ! Schema::hasTable($table)) {

            abort(404, 'Tabel tidak ditemukan.');
        }

        $namaFile = $this->namaFile($table) . '.csv';

        $baris = DB::table($table)->get();

        $isi = $this->buatCsv($baris);

        return response($isi, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $namaFile . '"',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | RESTORE DARI FILE SQL
    |--------------------------------------------------------------------------
    */

    public function restore(Request $request): RedirectResponse
    {
        $request->validate([
            'file_backup' => [
                'required',
                'file',
                'max:51200',
            ],
        ]);

        $upload = $request->file('file_backup');

        $ekstensi = strtolower($upload->getClientOriginalExtension());

        if (! in_array($ekstensi, ['sql', 'txt'], true)) {

            return back()
                ->withErrors([
                    'file_backup' => 'Hanya file .sql atau .txt yang diizinkan.',
                ]);
        }


        // Simpan cadangan pengaman sebelum menimpa data

        $cadangan = $this->simpanCadanganOtomatis();


        try {

            $sql = File::get($upload->getRealPath());

            $pernyataan = $this->pecahSql($sql);

            DB::transaction(function () use ($pernyataan) {

                DB::unprepared($this->perintahForeignKey('0'));

                foreach ($pernyataan as $satu) {

                    DB::unprepared($satu);
                }

                DB::unprepared($this->perintahForeignKey('1'));

            });

        } catch (Throwable $e) {

            return back()
                ->withErrors([
                    'file_backup' => 'Restore gagal: ' . $e->getMessage(),
                ])
                ->with('status', 'Cadangan data lama tersimpan di: ' . $cadangan);

        }


        return back()
            ->with('status', 'Restore berhasil. Data telah dikembalikan dari file backup.');
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS FILE BACKUP
    |--------------------------------------------------------------------------
    */

    public function destroy(string $file): RedirectResponse
    {
        $path = $this->folderPath() . DIRECTORY_SEPARATOR . basename($file);

        if (! File::exists($path)) {

            return back()
                ->withErrors([
                    'file_backup' => 'File backup tidak ditemukan.',
                ]);
        }

        File::delete($path);

        return back()
            ->with('status', 'File backup berhasil dihapus.');
    }


    /*
    |--------------------------------------------------------------------------
    | BANTUAN
    |--------------------------------------------------------------------------
    */

    /**
     * Ringkasan jumlah baris tiap tabel aplikasi.
     */
    protected function ringkasanTabel(): array
    {
        $hasil = [];

        foreach ($this->tables as $table) {

            if (! Schema::hasTable($table)) {

                $hasil[] = [
                    'nama' => $table,
                    'ada' => false,
                    'jumlah' => 0,
                    'ukuran' => '-',
                    'baris' => [],
                ];

                continue;
            }

            $jumlah = DB::table($table)->count();

            $hasil[] = [
                'nama' => $table,
                'ada' => true,
                'jumlah' => $jumlah,
                'ukuran' => $this->ukuranTabel($table),
                'baris' => Schema::getColumnListing($table),
            ];
        }

        return $hasil;
    }


    /**
     * Total seluruh baris pada tabel yang tersedia.
     */
    protected function totalBaris(): int
    {
        return collect($this->ringkasanTabel())
            ->where('ada', true)
            ->sum('jumlah');
    }


    /**
     * Perkiraan ukuran tabel dalam kilobyte.
     */
    protected function ukuranTabel(string $table): string
    {
        try {

            $baris = DB::selectOne(
                'SELECT (data_length + index_length) / 1024 AS ukuran
                 FROM information_schema.TABLES
                 WHERE table_schema = DATABASE() AND table_name = ?',
                [$table]
            );

            if ($baris && $baris->ukuran !== null) {

                return number_format((float) $baris->ukuran, 1) . ' KB';
            }

        } catch (Throwable) {
            // abaikan, misal driver tidak mendukung information_schema
        }

        return '-';
    }


    /**
     * Daftar file backup yang tersimpan.
     */
    protected function daftarFileBackup(): array
    {
        $folder = $this->folderPath();

        if (! File::isDirectory($folder)) {

            File::makeDirectory($folder, 0755, true);

            return [];
        }

        $files = [];

        foreach (File::files($folder) as $file) {

            $files[] = [
                'nama' => $file->getFilename(),
                'ukuran' => $this->formatBytes($file->getSize()),
                'waktu' => date('d M Y H:i', $file->getMTime()),
                'tipe' => strtoupper($file->getExtension()),
            ];
        }


        // File terbaru di atas

        usort($files, fn ($a, $b) => strcmp($b['nama'], $a['nama']));

        return $files;
    }


    /**
     * Simpan cadangan otomatis sebelum restore.
     */
    protected function simpanCadanganOtomatis(): string
    {
        try {

            $driver = DB::connection()->getDriverName();

            if ($driver === 'sqlite' && $this->bisaDisalin()) {

                $sumber = DB::connection()->getDatabaseName();

                $tujuan = $this->folderPath() . DIRECTORY_SEPARATOR . $this->namaFile('pra-restore-sqlite') . '.sqlite';

                File::copy($sumber, $tujuan);

                return basename($tujuan);
            }

            $nama = $this->namaFile('pra-restore') . '.sql';

            $path = $this->folderPath() . DIRECTORY_SEPARATOR . $nama;

            File::put($path, $this->buatSqlDump());

            return $nama;

        } catch (Throwable) {
            return '-';
        }
    }


    /**
     * Bangun dump SQL seluruh database.
     */
    protected function buatSqlDump(): string
    {
        $sql = '';

        $sql .= '-- =====================================================' . PHP_EOL;
        $sql .= '-- BACKUP DATABASE E-RAPOR' . PHP_EOL;
        $sql .= '-- Dibuat: ' . date('d-m-Y H:i:s') . PHP_EOL;
        $sql .= '-- Database: ' . DB::connection()->getDatabaseName() . PHP_EOL;
        $sql .= '-- =====================================================' . PHP_EOL;
        $sql .= PHP_EOL;

        $sql .= $this->perintahForeignKey('0') . PHP_EOL;

        if (DB::connection()->getDriverName() !== 'sqlite') {
            $sql .= 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";' . PHP_EOL;
        }

        $sql .= PHP_EOL;

        // Klausa foreign key sengaja dibuang dari CREATE TABLE lalu dipasang
        // kembali di akhir file lewat ALTER TABLE._dump dari phpMyAdmin atau
        // MySQL Workbench menyortir tabel secara alfabetis, sehingga
        // `data_guru` dibuat sebelum `users` dan MySQL menolak dengan
        // errno 150 "Foreign key constraint is incorrectly formed".

        $foreign = [];

        foreach ($this->urutkanTabel($foreign) as $tabel) {

            $sql .= $this->dumpTabel($tabel, $foreign);
        }

        foreach ($foreign as $perintah) {

            $sql .= $perintah;
        }

        $sql .= PHP_EOL;

        $sql .= $this->perintahForeignKey('1') . PHP_EOL;

        return $sql;
    }


    /**
     * Urutkan tabel sehingga tabel yang dirujuk selalu muncul lebih dulu.
     *
     * @param  array<int, string>  $foreign  tempat dikumpulkan ALTER TABLE
     *                                         ADD CONSTRAINT
     */
    protected function urutkanTabel(array &$foreign = []): array
    {
        $tabel = $this->daftarTabelFisik();

        $dependensi = [];

        foreach ($tabel as $nama) {

            $dependensi[$nama] = $this->tabelYangDirujuk($nama, $tabel);
        }

        $hasil = [];
        $sisa = $tabel;

        while ($sisa !== []) {

            $siap = array_values(array_filter(
                $sisa,
                fn (string $nama) => array_diff($dependensi[$nama], $hasil, $sisa) === []
            ));

            // Penjaga bila ada relasi melingkar, agar tidak looping selamanya.
            if ($siap === []) {

                $siap = [reset($sisa)];
            }

            foreach ($siap as $nama) {

                $hasil[] = $nama;
            }

            $sisa = array_values(array_diff($sisa, $siap));
        }

        return $hasil;
    }


    /**
     * Daftar tabel yang dirujuk oleh foreign key milik satu tabel.
     *
     * @param  array<int, string>  $ada
     * @return array<int, string>
     */
    protected function tabelYangDirujuk(string $tabel, array $ada): array
    {
        try {

            $foreign = Schema::getForeignKeys($tabel);

        } catch (Throwable) {
            return [];
        }

        return collect($foreign)
            ->pluck('foreign_table')
            ->filter(fn ($nama) => is_string($nama) && in_array($nama, $ada, true))
            ->unique()
            ->values()
            ->all();
    }


    /**
     * Perintah untuk mengaktifkan / menonaktifkan foreign key.
     */
    protected function perintahForeignKey(string $status): string
    {
        if (DB::connection()->getDriverName() === 'sqlite') {

            return 'PRAGMA foreign_keys = ' . ($status === '1' ? 'ON' : 'OFF') . ';';
        }

        return 'SET FOREIGN_KEY_CHECKS = ' . $status . ';';
    }


    /**
     * Apakah file database sqlite dapat disalin langsung.
     */
    protected function bisaDisalin(): bool
    {
        $path = DB::connection()->getDatabaseName();

        return $path !== ':memory:' && File::isFile($path);
    }


    /**
     * Seluruh tabel fisik pada database.
     */
    protected function daftarTabelFisik(): array
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {

            return collect(
                DB::select("SELECT name FROM sqlite_master WHERE type = 'table' AND name NOT LIKE 'sqlite_%'")
            )->pluck('name')->all();
        }

        $database = DB::connection()->getDatabaseName();

        return collect(
            DB::select('SHOW FULL TABLES WHERE Table_type = "BASE TABLE"')
        )->map(fn ($baris) => array_values((array) $baris)[0])
            ->reject(fn ($nama) => $nama === 'phpmyadmin' || Str::startsWith($nama, 'pma_'))
            ->all();
    }


    /**
     * Dump definisi dan data satu tabel.
     *
     * @param  array<int, string>  $foreign  dikumpulkan perintah ALTER TABLE
     *                                        ADD CONSTRAINT
     */
    protected function dumpTabel(string $tabel, array &$foreign = []): string
    {
        $sql = PHP_EOL . '-- --------------------' . PHP_EOL;
        $sql .= '-- Tabel: ' . $tabel . PHP_EOL;
        $sql .= '-- --------------------' . PHP_EOL;

        $sql .= 'DROP TABLE IF EXISTS `' . $tabel . '`;' . PHP_EOL;

        $sql .= $this->perintahBuatTabel($tabel, $foreign) . ';' . PHP_EOL;

        $kolom = Schema::getColumnListing($tabel);

        $baris = DB::table($tabel)->get();

        if ($baris->isNotEmpty()) {

            $sql .= 'INSERT INTO `' . $tabel . '` (`' . implode('`, `', $kolom) . '`) VALUES' . PHP_EOL;

            $sql .= $baris
                ->map(function ($baris) use ($kolom) {

                    $nilai = collect($kolom)
                        ->map(fn ($kolom) => $this->nilaiSql($baris->{$kolom}))
                        ->implode(', ');

                    return '  (' . $nilai . ')';
                })
                ->implode(',' . PHP_EOL);

            $sql .= ';' . PHP_EOL;
        }

        return $sql;
    }


    /**
     * Perintah CREATE TABLE sesuai driver database.
     *
     * Klausa CONSTRAINT ... FOREIGN KEY dicabut dari badan CREATE TABLE lalu
     * dikembalikan lewat $foreign supaya dipasang kembali sebagai
     * ALTER TABLE ... ADD CONSTRAINT di akhir file.
     *
     * @param  array<int, string>  $foreign
     */
    protected function perintahBuatTabel(string $tabel, array &$foreign = []): string
    {
        if (DB::connection()->getDriverName() === 'sqlite') {

            $baris = DB::selectOne(
                "SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ?",
                [$tabel]
            );

            return (string) $baris->sql;
        }

        $baris = DB::selectOne('SHOW CREATE TABLE `' . $tabel . '`');

        $create = array_values((array) $baris)[1];

        $create = preg_replace_callback(
            '/^[ \t]*CONSTRAINT\b.*?FOREIGN KEY\b.*?$/mi',
            function (array $cocok) use ($tabel, &$foreign): string {

                $klausa = rtrim(trim($cocok[0]), ',');

                $foreign[] = PHP_EOL
                    . '-- Foreign key untuk tabel `' . $tabel . '`' . PHP_EOL
                    . 'ALTER TABLE `' . $tabel . '` ADD ' . $klausa . ';' . PHP_EOL;

                return '';
            },
            $create
        );

        // Melepas klausa terakhir meninggalkan koma menggantung sebelum ")",
        // yang tidak sah di MySQL.
        return preg_replace('/,(\s*)\)/', '$1)', $create);
    }


    /**
     * Ubah satu nilai menjadi literal SQL.
     */
    protected function nilaiSql(mixed $nilai): string
    {
        if ($nilai === null) {
            return 'NULL';
        }

        if (is_bool($nilai)) {
            return $nilai ? '1' : '0';
        }

        if (is_int($nilai) || is_float($nilai)) {
            return (string) $nilai;
        }

        return "'" . str_replace(
            ["\\", "'", "\n", "\r", "\032"],
            ["\\\\", "\\'", "\\n", "\\r", "\\Z"],
            (string) $nilai
        ) . "'";
    }


    /**
     * Pecah file SQL menjadi daftar pernyataan.
     */
    protected function pecahSql(string $sql): array
    {
        $sql = preg_replace('/^\s*--.*$/m', '', $sql);

        $pernyataan = [];
        $buffer = '';
        $dalamKutip = false;
        $kutip = '';
        $panjang = strlen($sql);

        for ($i = 0; $i < $panjang; $i++) {

            $karakter = $sql[$i];
            $sebelumnya = $i > 0 ? $sql[$i - 1] : '';

            // Baris komentar

            if (! $dalamKutip && $karakter === '-' && $sebelumnya === '-' && ($sql[$i + 1] ?? '') === '-') {

                while ($i < $panjang && $sql[$i] !== PHP_EOL) {
                    $i++;
                }

                continue;
            }

            // Kutip tunggal / ganda / backtick

            if ($karakter === "'" || $karakter === '"' || $karakter === '`') {

                if (! $dalamKutip) {

                    $dalamKutip = true;
                    $kutip = $karakter;

                } elseif ($karakter === $kutip && $sebelumnya !== '\\') {

                    $dalamKutip = false;
                }
            }

            // Pemisah pernyataan

            if ($karakter === ';' && ! $dalamKutip) {

                $pernyataan[] = trim($buffer);

                $buffer = '';

                continue;
            }

            $buffer .= $karakter;
        }

        if (trim($buffer) !== '') {

            $pernyataan[] = trim($buffer);
        }

        return array_values(array_filter($pernyataan));
    }


    /**
     * Susun isi CSV dari sekumpulan baris.
     */
    protected function buatCsv(mixed $baris): string
    {
        if (is_iterable($baris)) {
            $baris = collect($baris);
        }

        if ($baris->isEmpty()) {

            return '';
        }

        $isi = '';

        $isi .= $this->buatCsvBaris(array_keys((array) $baris->first()));

        foreach ($baris as $satu) {

            $isi .= $this->buatCsvBaris((array) $satu);
        }

        return $isi;
    }


    /**
     * Satu baris CSV.
     */
    protected function buatCsvBaris(array $data): string
    {
        $isi = '';

        foreach ($data as $nilai) {

            if ($nilai === null) {
                $nilai = '';
            }

            if (is_bool($nilai)) {
                $nilai = $nilai ? '1' : '0';
            }

            $isi .= '"' . str_replace('"', '""', (string) $nilai) . '",';

        }

        return rtrim($isi, ',') . PHP_EOL;
    }


    /**
     * Lokasi folder penyimpanan backup.
     */
    protected function folderPath(): string
    {
        return storage_path('app/' . $this->folder);
    }


    /**
     * Nama file backup unik.
     */
    protected function namaFile(string $prefix): string
    {
        return $prefix . '-' . date('Ymd-His');
    }


    /**
     * Format ukuran berkas yang mudah dibaca.
     */
    protected function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1) . ' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1) . ' KB';
        }

        return $bytes . ' B';
    }
}
