@extends('layouts.app')

@section('content')

    <div class="content">

        {{-- HEADER --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-5 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Manajemen Sistem'],
                ['label' => 'Backup & Restore'],
            ]" />

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10">
                    <i class="ph ph-database text-2xl"></i>
                </div>

                <div>
                    <h1 class="text-lg font-bold">
                        Backup &amp; Restore
                    </h1>

                    <p class="mt-1 max-w-2xl text-xs leading-relaxed text-indigo-100">
                        Kelola cadangan database, ekspor data per tabel, dan
                        pulihkan data E-Rapor SMK dari file backup.
                    </p>
                </div>

            </div>

        </div>


        {{-- PESAN SISTEM --}}
        @if (session('status'))
            <div
                class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800 shadow-sm">

                <i class="ph ph-check-circle mt-0.5 text-lg text-emerald-600"></i>

                <div>
                    <p class="font-semibold">
                        Proses berhasil
                    </p>

                    <p class="mt-0.5 text-xs text-emerald-700">
                        {{ session('status') }}
                    </p>
                </div>

            </div>
        @endif


        @if ($errors->any())
            <div
                class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800 shadow-sm">

                <i class="ph ph-warning-circle mt-0.5 text-lg text-red-600"></i>

                <div>
                    <p class="font-semibold">
                        Terjadi kesalahan
                    </p>

                    <p class="mt-0.5 text-xs text-red-700">
                        {{ $errors->first() }}
                    </p>
                </div>

            </div>
        @endif


        {{-- INFORMASI DATABASE --}}
        <div class="mb-3 flex items-center gap-2">

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50">
                <i class="ph ph-database text-indigo-600"></i>
            </div>

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Informasi Database
                </h2>

                <p class="text-[11px] text-slate-500">
                    Ringkasan kondisi database yang sedang digunakan.
                </p>
            </div>

        </div>


        {{-- DATABASE STATS --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- TOTAL BARIS --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Total Baris
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                            {{ $totalBaris }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Seluruh data tabel
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50">
                        <i class="ph ph-database text-xl text-indigo-600"></i>
                    </div>

                </div>

            </div>


            {{-- DRIVER --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Database Driver
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-violet-600">
                            {{ strtoupper($driver) }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Engine database
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <i class="ph ph-hard-drives text-xl text-violet-600"></i>
                    </div>

                </div>

            </div>


            {{-- NAMA DATABASE --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div class="min-w-0">

                        <p class="text-xs font-medium text-slate-500">
                            Nama Database
                        </p>

                        <h3 class="mt-1 truncate text-lg font-bold text-blue-600" title="{{ $namaDatabase }}">

                            {{ $namaDatabase }}

                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Database aktif
                        </p>

                    </div>

                    <div class="ml-3 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50">
                        <i class="ph ph-folder text-xl text-blue-600"></i>
                    </div>

                </div>

            </div>


            {{-- WAKTU --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Waktu Sistem
                        </p>

                        <h3 class="mt-1 text-lg font-bold text-emerald-600">
                            {{ now()->format('d M Y') }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            {{ now()->format('H:i') }} WIB
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                        <i class="ph ph-clock text-xl text-emerald-600"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- BACKUP DATA --}}
        <div class="mb-3 flex items-center gap-2">

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50">
                <i class="ph ph-download-simple text-emerald-600"></i>
            </div>

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Backup Data
                </h2>

                <p class="text-[11px] text-slate-500">
                    Buat salinan seluruh database untuk keperluan keamanan data.
                </p>
            </div>

        </div>


        <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50">
                        <i class="ph ph-database text-lg text-emerald-600"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">
                            Backup Seluruh Database
                        </h3>

                        <p class="mt-1 max-w-2xl text-xs leading-relaxed text-slate-500">
                            Unduh seluruh tabel aplikasi dalam satu file
                            {{ $driver === 'sqlite' ? 'SQLite' : 'SQL' }}.
                            Simpan file tersebut di tempat yang aman sebagai
                            cadangan data.
                        </p>
                    </div>

                </div>


                <a href="{{ route('backup.download') }}"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-emerald-700">

                    <i class="ph ph-download-simple"></i>
                    Unduh Backup

                </a>

            </div>

        </div>


        {{-- EKSPOR PER TABEL --}}
        <div class="mb-3 flex items-center gap-2">

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50">
                <i class="ph ph-export text-blue-600"></i>
            </div>

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Ekspor per Tabel
                </h2>

                <p class="text-[11px] text-slate-500">
                    Ekspor data dari tabel tertentu dalam format CSV.
                </p>
            </div>

        </div>


        <div class="mb-6 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">

                <div>

                    <h3 class="text-sm font-bold text-slate-800">
                        Daftar Tabel Database
                    </h3>

                    <p class="mt-1 text-[11px] text-slate-500">
                        Pilih tabel yang ingin diekspor.
                    </p>

                </div>

                <span
                    class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold text-slate-600">

                    <i class="ph ph-table"></i>

                    {{ count($daftarTabel) }} tabel

                </span>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px] text-left text-sm">

                    <thead class="bg-slate-50 text-[10px] uppercase tracking-wide text-slate-500">

                        <tr>

                            <th class="px-5 py-3.5 font-semibold">
                                Tabel
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Jumlah Baris
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Ukuran
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Kolom
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($daftarTabel as $tabel)
                            <tr class="transition hover:bg-slate-50">

                                {{-- TABEL --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-2">

                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100">
                                            <i class="ph ph-table text-slate-500"></i>
                                        </div>

                                        <span class="text-xs font-semibold text-slate-800">
                                            {{ $tabel['nama'] }}
                                        </span>

                                    </div>

                                </td>


                                {{-- BARIS --}}
                                <td class="px-5 py-4 text-center">

                                    @if ($tabel['ada'])
                                        <span class="text-xs font-semibold text-slate-700">
                                            {{ number_format($tabel['jumlah']) }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            -
                                        </span>
                                    @endif

                                </td>


                                {{-- UKURAN --}}
                                <td class="px-5 py-4 text-center">

                                    <span class="text-xs text-slate-600">
                                        {{ $tabel['ukuran'] }}
                                    </span>

                                </td>


                                {{-- KOLOM --}}
                                <td class="max-w-[400px] px-5 py-4">

                                    @if ($tabel['ada'])
                                        <span class="block truncate text-xs text-slate-500"
                                            title="{{ implode(', ', $tabel['baris']) }}">

                                            {{ implode(', ', $tabel['baris']) }}

                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            Tabel belum tersedia
                                        </span>
                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-5 py-4 text-center">

                                    @if ($tabel['ada'])
                                        <a href="{{ route('backup.table', $tabel['nama']) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-blue-600 px-3 py-2 text-[11px] font-semibold text-white transition hover:bg-blue-700">

                                            <i class="ph ph-file-csv"></i>
                                            Ekspor

                                        </a>
                                    @else
                                        <span class="text-[11px] text-slate-400">
                                            Tidak tersedia
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-12 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">
                                        <i class="ph ph-table text-xl text-slate-400"></i>
                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-600">
                                        Belum ada tabel
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Belum ada tabel yang dapat diekspor.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- FILE BACKUP --}}
        <div class="mb-3 flex items-center gap-2">

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-violet-50">
                <i class="ph ph-folder-open text-violet-600"></i>
            </div>

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    File Backup Tersimpan
                </h2>

                <p class="text-[11px] text-slate-500">
                    Kelola file backup yang tersimpan pada sistem.
                </p>
            </div>

        </div>


        <div class="mb-6 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            @if (count($daftarFile) > 0)
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[800px] text-left text-sm">

                        <thead class="bg-slate-50 text-[10px] uppercase tracking-wide text-slate-500">

                            <tr>

                                <th class="px-5 py-3.5 font-semibold">
                                    Nama File
                                </th>

                                <th class="px-5 py-3.5 font-semibold">
                                    Tipe
                                </th>

                                <th class="px-5 py-3.5 text-center font-semibold">
                                    Ukuran
                                </th>

                                <th class="px-5 py-3.5 text-center font-semibold">
                                    Dibuat
                                </th>

                                <th class="px-5 py-3.5 text-center font-semibold">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($daftarFile as $file)
                                <tr class="transition hover:bg-slate-50">

                                    {{-- FILE --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-2">

                                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-violet-50">
                                                <i class="ph ph-file text-violet-600"></i>
                                            </div>

                                            <div class="min-w-0">

                                                <div class="max-w-[350px] truncate text-xs font-semibold text-slate-800">
                                                    {{ $file['nama'] }}
                                                </div>

                                                <div class="mt-0.5 text-[10px] text-slate-400">
                                                    File backup
                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- TIPE --}}
                                    <td class="px-5 py-4">

                                        <span
                                            class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-semibold text-slate-600">
                                            {{ $file['tipe'] }}
                                        </span>

                                    </td>


                                    {{-- UKURAN --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="text-xs text-slate-600">
                                            {{ $file['ukuran'] }}
                                        </span>

                                    </td>


                                    {{-- WAKTU --}}
                                    <td class="px-5 py-4 text-center">

                                        <div class="flex items-center justify-center gap-1.5 text-xs text-slate-600">

                                            <i class="ph ph-clock text-slate-400"></i>

                                            {{ $file['waktu'] }}

                                        </div>

                                    </td>


                                    {{-- HAPUS --}}
                                    <td class="px-5 py-4 text-center">

                                        <form method="POST" action="{{ route('backup.destroy', $file['nama']) }}"
                                            onsubmit="return konfirmasiHapus()">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-2 text-[11px] font-semibold text-red-600 transition hover:bg-red-100">

                                                <i class="ph ph-trash"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            @else
                <div class="px-6 py-12 text-center">

                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">
                        <i class="ph ph-folder-open text-xl text-slate-400"></i>
                    </div>

                    <p class="mt-3 text-sm font-semibold text-slate-600">
                        Belum ada file backup
                    </p>

                    <p class="mx-auto mt-1 max-w-md text-xs leading-relaxed text-slate-400">
                        Klik tombol <span class="font-semibold">Unduh Backup</span>
                        untuk membuat cadangan database pertama.
                    </p>

                </div>
            @endif

        </div>


        {{-- RESTORE --}}
        <div class="mb-3 flex items-center gap-2">

            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50">
                <i class="ph ph-upload-simple text-amber-600"></i>
            </div>

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Restore Data
                </h2>

                <p class="text-[11px] text-slate-500">
                    Pulihkan database menggunakan file backup yang tersedia.
                </p>
            </div>

        </div>


        {{-- WARNING --}}
        <div class="mb-4 flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 px-5 py-4">

            <i class="ph ph-warning mt-0.5 text-lg text-amber-600"></i>

            <div>

                <p class="text-xs font-bold text-amber-800">
                    Perhatian sebelum melakukan restore
                </p>

                <p class="mt-1 text-xs leading-relaxed text-amber-700">
                    Restore akan menimpa data yang ada saat ini.
                    Sistem otomatis menyimpan cadangan pengaman sebelum proses
                    restore dijalankan. Pastikan file backup yang digunakan benar.
                </p>

            </div>

        </div>


        {{-- RESTORE FORM --}}
        <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <form method="POST" action="{{ route('backup.restore') }}" enctype="multipart/form-data"
                onsubmit="return konfirmasiRestore()">

                @csrf

                <div class="mb-5">

                    <label for="file_backup" class="mb-2 block text-xs font-semibold text-slate-700">

                        Pilih File Backup

                    </label>

                    <div class="relative">

                        <i
                            class="ph ph-file-arrow-up pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="file" name="file_backup" id="file_backup" accept=".sql,.txt"
                            onchange="ubahLabelFile()"
                            class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-600 outline-none transition file:mr-3 file:rounded-md file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-indigo-700 hover:border-indigo-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    </div>

                    <p class="mt-2 flex items-center gap-1 text-[11px] text-slate-400">

                        <i class="ph ph-info"></i>

                        Format yang didukung:
                        <span class="font-semibold text-slate-500">.sql</span>
                        atau
                        <span class="font-semibold text-slate-500">.txt</span>.
                        Maksimal 50 MB.

                    </p>

                </div>


                <div class="flex flex-wrap gap-3">

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-indigo-700">

                        <i class="ph ph-upload-simple"></i>
                        Jalankan Restore

                    </button>


                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                        <i class="ph ph-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>


    <script>
        /* ============================= */
        /* PILIH FILE BACKUP */
        /* ============================= */

        function ubahLabelFile() {

            const input =
                document.getElementById('file_backup');


            if (!input.files.length) {
                return;
            }


            const namaFile =
                input.files[0].name;


            if (
                !confirm(
                    'File yang dipilih:\n\n' +
                    namaFile +
                    '\n\nLanjutkan menggunakan file ini?'
                )
            ) {

                input.value = '';

            }

        }


        /* ============================= */
        /* KONFIRMASI RESTORE */
        /* ============================= */

        function konfirmasiRestore() {

            const input =
                document.getElementById('file_backup');


            if (!input.files.length) {

                alert(
                    'Silakan pilih file backup terlebih dahulu.'
                );

                return false;

            }


            return confirm(
                'Restore akan menimpa seluruh data yang ada saat ini.\n\n' +
                'Pastikan Anda sudah membuat backup terbaru terlebih dahulu.\n\n' +
                'Lanjutkan proses restore?'
            );

        }


        /* ============================= */
        /* KONFIRMASI HAPUS FILE */
        /* ============================= */

        function konfirmasiHapus() {

            return confirm(
                'File backup ini akan dihapus permanen.\n\n' +
                'Lanjutkan menghapus file?'
            );

        }
    </script>

@endsection
