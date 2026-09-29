@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Backup &amp; Restore
        </h2>

        <p>
            Simpan salinan data E-Rapor secara berkala, ekspor tabel individual,
            dan kembalikan data dari file backup bila diperlukan.
        </p>

    </div>


    <!-- ============================= -->
    <!-- PESAN SISTEM -->
    <!-- ============================= -->

    @if (session('status'))

        <div class="mb-6 rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-800">
            <i class="ph ph-check-circle mr-1"></i>
            {{ session('status') }}
        </div>

    @endif

    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800">
            <i class="ph ph-warning-circle mr-1"></i>
            {{ $errors->first() }}
        </div>

    @endif


    <!-- ============================= -->
    <!-- INFORMASI DATABASE -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="ph ph-database"></i>

        Informasi Database

    </div>


    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-4 md:grid-cols-4">

        <div class="stat-card">
            <div class="stat-icon">
                <i class="ph ph-database"></i>
            </div>
            <div>
                <div class="stat-number">
                    {{ $totalBaris }}
                </div>
                <div class="stat-title">
                    Total Baris
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="ph ph-hard-drives"></i>
            </div>
            <div>
                <div class="stat-number text-base">
                    {{ strtoupper($driver) }}
                </div>
                <div class="stat-title">
                    Driver
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="ph ph-folder"></i>
            </div>
            <div>
                <div class="stat-number text-base">
                    {{ $namaDatabase }}
                </div>
                <div class="stat-title">
                    Nama Database
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="ph ph-clock"></i>
            </div>
            <div>
                <div class="stat-number text-base">
                    {{ now()->format('d M Y') }}
                </div>
                <div class="stat-title">
                    {{ now()->format('H:i') }} WIB
                </div>
            </div>
        </div>

    </div>


    <!-- ============================= -->
    <!-- BACKUP -->
    -->

    <div class="section-title">

        <i class="ph ph-download-simple"></i>

        Backup Data

    </div>


    <div class="mb-6 bg-white rounded-xl shadow p-6">

        <h3 class="font-bold text-gray-800">
            Backup Seluruh Database
        </h3>

        <p class="mt-1 text-sm text-gray-600">
            Unduh seluruh tabel aplikasi dalam satu file
            {{ $driver === 'sqlite' ? 'SQLite' : 'SQL' }}.
            Simpan file ini di tempat aman sebagai cadangan data.
        </p>

        <a
            href="{{ route('backup.download') }}"
            class="mt-4 inline-block px-5 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700"
        >

            <i class="ph ph-download-simple mr-1"></i>

            Unduh Backup Sekarang

        </a>

    </div>


    <!-- ============================= -->
    <!-- EKSPOR CSV PER TABEL -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="ph ph-export"></i>

        Ekspor per Tabel (CSV)

    </div>


    <div class="mb-6 bg-white rounded-xl shadow p-6 overflow-x-auto">

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-gray-100">

                    <th class="border px-4 py-3 text-left">
                        Tabel
                    </th>

                    <th class="border px-4 py-3 text-center">
                        Jumlah Baris
                    </th>

                    <th class="border px-4 py-3 text-center">
                        Ukuran
                    </th>

                    <th class="border px-4 py-3 text-left">
                        Kolom
                    </th>

                    <th class="border px-4 py-3 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($daftarTabel as $tabel)

                    <tr>

                        <td class="border px-4 py-3 font-medium text-gray-800">
                            <i class="ph ph-table mr-1 text-gray-400"></i>
                            {{ $tabel['nama'] }}
                        </td>

                        <td class="border px-4 py-3 text-center">

                            @if ($tabel['ada'])

                                <span class="font-semibold text-gray-800">
                                    {{ number_format($tabel['jumlah']) }}
                                </span>

                            @else

                                <span class="text-xs text-gray-400">
                                    -
                                </span>

                            @endif

                        </td>

                        <td class="border px-4 py-3 text-center text-sm text-gray-600">
                            {{ $tabel['ukuran'] }}
                        </td>

                        <td class="border px-4 py-3 text-sm text-gray-500">
                            {{ $tabel['ada'] ? implode(', ', $tabel['baris']) : 'Tabel belum tersedia' }}
                        </td>

                        <td class="border px-4 py-3 text-center">

                            @if ($tabel['ada'])

                                <a
                                    href="{{ route('backup.table', $tabel['nama']) }}"
                                    class="px-3 py-2 inline-block rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                                >

                                    <i class="ph ph-file-csv"></i>

                                    Ekspor

                                </a>

                            @else

                                <span class="text-xs text-gray-400">
                                    Tidak tersedia
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="border px-4 py-6 text-center text-gray-500">
                            Belum ada tabel yang dapat diekspor.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- ============================= -->
    <!-- DAFTAR FILE BACKUP -->
    -->

    <div class="section-title">

        <i class="ph ph-folder-open"></i>

        File Backup Tersimpan

    </div>


    <div class="mb-6 bg-white rounded-xl shadow p-6 overflow-x-auto">

        @if (count($daftarFile) > 0)

            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="border px-4 py-3 text-left">
                            Nama File
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tipe
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Ukuran
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Dibuat
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($daftarFile as $file)

                        <tr>

                            <td class="border px-4 py-3 font-medium text-gray-800">
                                <i class="ph ph-file mr-1 text-gray-400"></i>
                                {{ $file['nama'] }}
                            </td>

                            <td class="border px-4 py-3 text-sm text-gray-600">
                                {{ $file['tipe'] }}
                            </td>

                            <td class="border px-4 py-3 text-center text-sm text-gray-600">
                                {{ $file['ukuran'] }}
                            </td>

                            <td class="border px-4 py-3 text-center text-sm text-gray-600">
                                {{ $file['waktu'] }}
                            </td>

                            <td class="border px-4 py-3 text-center">

                                <form
                                    method="POST"
                                    action="{{ route('backup.destroy', $file['nama']) }}"
                                    onsubmit="return konfirmasiHapus()"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="px-3 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600"
                                    >

                                        <i class="ph ph-trash"></i>

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="py-8 text-center">

                <i class="ph ph-folder-open text-4xl text-gray-300"></i>

                <p class="mt-3 text-sm text-gray-500">
                    Belum ada file backup tersimpan. Klik
                    <span class="font-semibold">Unduh Backup Sekarang</span>
                    untuk membuat cadangan pertama.
                </p>

            </div>

        @endif

    </div>


    <!-- ============================= -->
    <!-- RESTORE -->
    -->

    <div class="section-title">

        <i class="ph ph-upload-simple"></i>

        Restore Data

    </div>


    <div class="mb-6 rounded-lg border border-yellow-300 bg-yellow-50 p-4 text-sm text-yellow-800">

        <i class="ph ph-warning mr-1"></i>

        <span class="font-semibold">Perhatian:</span>
        Restore akan menimpa data yang ada saat ini. Sistem otomatis menyimpan
        cadangan pengaman sebelum proses restore dijalankan.

    </div>


    <div class="bg-white rounded-xl shadow p-6">

        <form
            method="POST"
            action="{{ route('backup.restore') }}"
            enctype="multipart/form-data"
            onsubmit="return konfirmasiRestore()"
        >

            @csrf

            <label class="block font-semibold mb-2">
                Pilih File Backup
            </label>

            <input
                type="file"
                name="file_backup"
                id="file_backup"
                accept=".sql,.txt"
                onchange="ubahLabelFile()"
                class="w-full border rounded-lg px-4 py-2 bg-white"
            >

            <p class="mt-2 text-xs text-gray-500">
                Format yang didukung: <span class="font-semibold">.sql</span> atau
                <span class="font-semibold">.txt</span> (maksimal 50 MB).
            </p>

            <div class="mt-6 flex flex-wrap gap-3">

                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                >

                    <i class="ph ph-upload-simple mr-1"></i>

                    Jalankan Restore

                </button>


                <a
                    href="{{ url('/dashboard') }}"
                    class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300"
                >
                    <i class="ph ph-arrow-left mr-1"></i>
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>


/* ============================= */
/* UBAH LABEL FILE */
/* ============================= */

function ubahLabelFile() {

    const input =
        document.getElementById('file_backup');

    if (!input.files.length) {

        return;

    }

    if (!confirm('File yang dipilih: ' + input.files[0].name + '\nLanjutkan?')) {

        input.value = '';

    }

}


/* ============================= */
/* KONFIRMASI RESTORE */
/* ============================= */

function konfirmasiRestore() {

    return confirm(
        'Restore akan menimpa seluruh data yang ada saat ini.\n' +
        'Pastikan Anda sudah membuat backup terlebih dahulu.\n\n' +
        'Lanjutkan proses restore?'
    );

}


/* ============================= */
/* KONFIRMASI HAPUS FILE */
/* ============================= */

function konfirmasiHapus() {

    return confirm('File backup ini akan dihapus permanen. Lanjutkan?');

}

</script>


@endsection
