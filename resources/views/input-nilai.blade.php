@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">

```
<!-- Header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Input Nilai Siswa
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Kelola nilai siswa berdasarkan tahun ajaran, kelas, dan mata pelajaran.
    </p>
</div>


<!-- Filter & Pencarian -->
<div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

        <!-- Pencarian -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Cari Siswa
            </label>

            <div class="relative">
                <span class="absolute left-3 top-3 text-gray-400">
                    <i class="ph ph-magnifying-glass"></i>
                </span>

                <input
                    type="text"
                    placeholder="Cari nama siswa..."
                    class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
            </div>
        </div>


        <!-- Tahun Ajaran -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Tahun Ajaran
            </label>

            <select
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                <option value="">Semua Tahun Ajaran</option>
                <option value="2025/2026">2025/2026</option>
                <option value="2026/2027">2026/2027</option>

            </select>
        </div>


        <!-- Kelas -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Kelas
            </label>

            <select
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                <option value="">Semua Kelas</option>
                <option value="X RPL 1">X RPL 1</option>
                <option value="X RPL 2">X RPL 2</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XII RPL 1">XII RPL 1</option>

            </select>
        </div>


        <!-- Mata Pelajaran -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Mata Pelajaran
            </label>

            <select
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                <option value="">Semua Mata Pelajaran</option>
                <option value="Matematika">Matematika</option>
                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                <option value="Bahasa Inggris">Bahasa Inggris</option>
                <option value="Pemrograman Web">Pemrograman Web</option>
                <option value="Basis Data">Basis Data</option>

            </select>
        </div>

    </div>


    <!-- Tombol -->
    <div class="mt-5 flex flex-wrap gap-3">

        <button
            type="button"
            class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

            <i class="ph ph-magnifying-glass"></i> Cari

        </button>


        <button
            type="button"
            class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

            <i class="ph ph-arrow-counter-clockwise"></i> Reset

        </button>


        <a
            href="{{ route('input-nilai-create') }}"
            class="ml-auto rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700">

            + Tambah Nilai

        </a>

    </div>

</div>


<!-- Tabel Nilai -->
<div class="overflow-hidden rounded-xl bg-white shadow-sm">

    <!-- Header tabel -->
    <div class="border-b border-gray-200 px-6 py-4">

        <h2 class="text-lg font-bold text-gray-800">
            Daftar Nilai Siswa
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Setiap siswa dapat memiliki beberapa mata pelajaran dan nilai.
        </p>

    </div>


    <!-- Responsive Table -->
    <div class="overflow-x-auto">

        <table class="w-full min-w-[1100px] text-left text-sm">

            <thead class="bg-gray-50 text-xs uppercase text-gray-600">

                <tr>

                    <th class="px-6 py-4">
                        No
                    </th>

                    <th class="px-6 py-4">
                        NISN
                    </th>

                    <th class="px-6 py-4">
                        Nama Siswa
                    </th>

                    <th class="px-6 py-4">
                        Kelas
                    </th>

                    <th class="px-6 py-4">
                        Mata Pelajaran & Nilai
                    </th>

                    <th class="px-6 py-4 text-center">
                        Tahun Ajaran
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200">


                <!-- ================================================= -->
                <!-- SISWA 1 -->
                <!-- ================================================= -->

                <tr
                    class="nilai-row transition hover:bg-gray-50"
                    data-row="1">

                    <td class="px-6 py-5">
                        1
                    </td>


                    <td class="px-6 py-5 font-medium text-gray-700">
                        00654321
                    </td>


                    <td class="px-6 py-5">

                        <div class="font-semibold text-gray-800">
                            Ahmad Fauzan
                        </div>

                    </td>


                    <td class="px-6 py-5">

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                            XI RPL 1
                        </span>

                    </td>


                    <!-- NILAI -->
                    <td class="px-6 py-5">

                        <div class="space-y-2">

                            <!-- Pemrograman Web -->
                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Pemrograman Web
                                </span>

                                <div class="nilai-container">

                                    <span
                                        class="nilai-text font-bold text-green-600">
                                        88
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="88"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <!-- Basis Data -->
                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Basis Data
                                </span>

                                <div class="nilai-container">

                                    <span
                                        class="nilai-text font-bold text-green-600">
                                        90
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="90"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <!-- Matematika -->
                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Matematika
                                </span>

                                <div class="nilai-container">

                                    <span
                                        class="nilai-text font-bold text-green-600">
                                        85
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="85"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <!-- Bahasa Indonesia -->
                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Bahasa Indonesia
                                </span>

                                <div class="nilai-container">

                                    <span
                                        class="nilai-text font-bold text-green-600">
                                        87
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="87"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>

                        </div>

                    </td>


                    <td class="px-6 py-5 text-center">
                        2026/2027
                    </td>


                    <!-- AKSI -->
                    <td class="px-6 py-5 text-center">

                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                onclick="editNilai(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>


                            <button
                                type="button"
                                onclick="saveNilai(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-green-700">

                                <i class="ph ph-floppy-disk"></i> Simpan

                            </button>


                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-gray-600">

                                <i class="ph ph-x"></i> Batal

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================================= -->
                <!-- SISWA 2 -->
                <!-- ================================================= -->

                <tr
                    class="nilai-row transition hover:bg-gray-50"
                    data-row="2">

                    <td class="px-6 py-5">
                        2
                    </td>


                    <td class="px-6 py-5 font-medium text-gray-700">
                        00654322
                    </td>


                    <td class="px-6 py-5">

                        <div class="font-semibold text-gray-800">
                            Budi Santoso
                        </div>

                    </td>


                    <td class="px-6 py-5">

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                            XI RPL 1
                        </span>

                    </td>


                    <td class="px-6 py-5">

                        <div class="space-y-2">

                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Pemrograman Web
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        92
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="92"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Basis Data
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        87
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="87"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Matematika
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        89
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="89"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Bahasa Inggris
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        91
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="91"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>

                        </div>

                    </td>


                    <td class="px-6 py-5 text-center">
                        2026/2027
                    </td>


                    <td class="px-6 py-5 text-center">

                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                onclick="editNilai(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>


                            <button
                                type="button"
                                onclick="saveNilai(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-green-700">

                                <i class="ph ph-floppy-disk"></i> Simpan

                            </button>


                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-gray-600">

                                <i class="ph ph-x"></i> Batal

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================================= -->
                <!-- SISWA 3 -->
                <!-- ================================================= -->

                <tr
                    class="nilai-row transition hover:bg-gray-50"
                    data-row="3">

                    <td class="px-6 py-5">
                        3
                    </td>


                    <td class="px-6 py-5 font-medium text-gray-700">
                        00654323
                    </td>


                    <td class="px-6 py-5">

                        <div class="font-semibold text-gray-800">
                            Citra Lestari
                        </div>

                    </td>


                    <td class="px-6 py-5">

                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                            XI RPL 1
                        </span>

                    </td>


                    <td class="px-6 py-5">

                        <div class="space-y-2">

                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Pemrograman Web
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        86
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="86"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Basis Data
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        90
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="90"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Matematika
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        88
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="88"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>


                            <div class="flex items-center justify-between gap-6">

                                <span>
                                    Bahasa Indonesia
                                </span>

                                <div class="nilai-container">

                                    <span class="nilai-text font-bold text-green-600">
                                        89
                                    </span>

                                    <input
                                        type="number"
                                        min="0"
                                        max="100"
                                        value="89"
                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                </div>

                            </div>

                        </div>

                    </td>


                    <td class="px-6 py-5 text-center">
                        2026/2027
                    </td>


                    <td class="px-6 py-5 text-center">

                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                onclick="editNilai(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>


                            <button
                                type="button"
                                onclick="saveNilai(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-green-700">

                                <i class="ph ph-floppy-disk"></i> Simpan

                            </button>


                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-gray-600">

                                <i class="ph ph-x"></i> Batal

                            </button>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    <!-- Footer -->
    <div
        class="flex flex-col gap-3 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

        <p class="text-sm text-gray-500">

            Menampilkan
            <span class="font-semibold text-gray-700">
                3
            </span>
            siswa

        </p>


        <div class="flex gap-2">

            <button
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">

                Sebelumnya

            </button>


            <button
                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white">

                1

            </button>


            <button
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">

                Berikutnya

            </button>

        </div>

    </div>

</div>
```

</div>

<!-- ========================================================= -->

<!-- JAVASCRIPT EDIT NILAI -->

<!-- ========================================================= -->

<script>

    /*
    |--------------------------------------------------------------------------
    | Tombol EDIT
    |--------------------------------------------------------------------------
    */

    function editNilai(button) {

        // Mengambil baris siswa
        const row = button.closest('.nilai-row');

        // Cari semua text nilai
        const nilaiText = row.querySelectorAll('.nilai-text');

        // Cari semua input nilai
        const nilaiInput = row.querySelectorAll('.nilai-input');

        // Tampilkan input
        nilaiInput.forEach(function(input) {

            input.classList.remove('hidden');

        });

        // Sembunyikan angka biasa
        nilaiText.forEach(function(text) {

            text.classList.add('hidden');

        });


        // Simpan nilai awal
        row.dataset.originalValues = JSON.stringify(
            Array.from(nilaiInput).map(input => input.value)
        );


        // Tampilkan tombol Simpan
        row.querySelector('.save-btn').classList.remove('hidden');

        // Tampilkan tombol Batal
        row.querySelector('.cancel-btn').classList.remove('hidden');

        // Sembunyikan tombol Edit
        row.querySelector('.edit-btn').classList.add('hidden');

    }



    /*
    |--------------------------------------------------------------------------
    | Tombol SIMPAN
    |--------------------------------------------------------------------------
    */

    function saveNilai(button) {

        const row = button.closest('.nilai-row');

        const nilaiText = row.querySelectorAll('.nilai-text');

        const nilaiInput = row.querySelectorAll('.nilai-input');


        // Validasi nilai
        let valid = true;

        nilaiInput.forEach(function(input) {

            let nilai = Number(input.value);

            if (nilai < 0 || nilai > 100 || input.value === '') {

                valid = false;

                input.classList.add('border-red-500');

            } else {

                input.classList.remove('border-red-500');

            }

        });


        // Jika nilai tidak valid
        if (!valid) {

            alert('Nilai harus diisi antara 0 sampai 100.');

            return;

        }


        // Pindahkan nilai input ke tampilan
        nilaiInput.forEach(function(input, index) {

            nilaiText[index].textContent = input.value;

        });


        // Sembunyikan input
        nilaiInput.forEach(function(input) {

            input.classList.add('hidden');

        });


        // Tampilkan angka
        nilaiText.forEach(function(text) {

            text.classList.remove('hidden');

        });


        // Tampilkan tombol Edit
        row.querySelector('.edit-btn').classList.remove('hidden');

        // Sembunyikan tombol Simpan
        row.querySelector('.save-btn').classList.add('hidden');

        // Sembunyikan tombol Batal
        row.querySelector('.cancel-btn').classList.add('hidden');


        // Hapus data nilai lama
        delete row.dataset.originalValues;


        alert('Nilai berhasil diubah.');

    }



    /*
    |--------------------------------------------------------------------------
    | Tombol BATAL
    |--------------------------------------------------------------------------
    */

    function cancelEdit(button) {

        const row = button.closest('.nilai-row');

        const nilaiText = row.querySelectorAll('.nilai-text');

        const nilaiInput = row.querySelectorAll('.nilai-input');


        // Ambil nilai sebelum diedit
        const originalValues = JSON.parse(
            row.dataset.originalValues || '[]'
        );


        // Kembalikan nilai awal
        nilaiInput.forEach(function(input, index) {

            if (originalValues[index] !== undefined) {

                input.value = originalValues[index];

            }

        });


        // Sembunyikan input
        nilaiInput.forEach(function(input) {

            input.classList.add('hidden');

        });


        // Tampilkan angka
        nilaiText.forEach(function(text) {

            text.classList.remove('hidden');

        });


        // Tampilkan tombol Edit
        row.querySelector('.edit-btn').classList.remove('hidden');

        // Sembunyikan tombol Simpan
        row.querySelector('.save-btn').classList.add('hidden');

        // Sembunyikan tombol Batal
        row.querySelector('.cancel-btn').classList.add('hidden');


        // Hapus penyimpanan sementara
        delete row.dataset.originalValues;

    }

</script>

@endsection
