@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- =========================================================
        HEADER
    ========================================================== --}}
        <div
            class="overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Penilaian'],
                ['label' => 'Nilai UKK', 'icon' => 'ph-medal'],
            ]" />

            <div class="mt-3 flex items-start justify-between gap-4">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">

                        <i class="ph ph-medal text-2xl"></i>

                    </div>

                    <div>

                        <h1 class="text-xl font-bold tracking-tight">
                            Nilai UKK
                        </h1>

                        <p class="mt-1 max-w-2xl text-xs leading-5 text-indigo-100">
                            Kelola nilai Uji Kompetensi Keahlian (UKK) siswa
                            berdasarkan konsentrasi keahlian, kelas, dan tahun ajaran.
                        </p>

                    </div>

                </div>


                {{-- Tambah Nilai --}}
                <a href="{{ route('nilai-ukk-create') }}"
                    class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-semibold text-[#37367a] shadow-sm transition hover:bg-indigo-50">

                    <i class="ph ph-plus-circle text-base"></i>

                    <span>
                        Tambah Nilai
                    </span>

                </a>

            </div>

        </div>



        {{-- =========================================================
        STATISTIK
    ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Total --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                            Total Siswa
                        </p>

                        <p id="totalData" class="mt-1 text-2xl font-bold text-slate-800">
                            0
                        </p>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Data nilai UKK
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                        <i class="ph ph-student text-xl"></i>

                    </div>

                </div>

            </div>


            {{-- Lulus --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                            Lulus
                        </p>

                        <p id="jumlahLulus" class="mt-1 text-2xl font-bold text-green-600">
                            0
                        </p>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Siswa dinyatakan lulus
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-600">

                        <i class="ph ph-check-circle text-xl"></i>

                    </div>

                </div>

            </div>


            {{-- Tidak Lulus --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                            Tidak Lulus
                        </p>

                        <p id="jumlahTidakLulus" class="mt-1 text-2xl font-bold text-red-600">
                            0
                        </p>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Perlu tindak lanjut
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600">

                        <i class="ph ph-x-circle text-xl"></i>

                    </div>

                </div>

            </div>


            {{-- Rata-rata --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                            Rata-rata
                        </p>

                        <p id="rataRata" class="mt-1 text-2xl font-bold text-blue-600">
                            0
                        </p>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Nilai UKK
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">

                        <i class="ph ph-chart-line-up text-xl"></i>

                    </div>

                </div>

            </div>

        </div>



        {{-- =========================================================
        FILTER
    ========================================================== --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex items-center justify-between gap-3">

                <div>

                    <h2 class="flex items-center gap-2 text-sm font-semibold text-slate-800">

                        <i class="ph ph-funnel text-indigo-500"></i>

                        Filter Data

                    </h2>

                    <p class="mt-1 text-[11px] text-slate-400">
                        Gunakan filter untuk mencari data nilai UKK tertentu.
                    </p>

                </div>


                <button type="button" onclick="resetFilter()"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-[11px] font-medium text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">

                    <i class="ph ph-arrow-counter-clockwise"></i>

                    Reset

                </button>

            </div>


            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-5">

                {{-- Search --}}
                <div>

                    <label for="searchSiswa" class="mb-1.5 block text-[11px] font-medium text-slate-600">

                        Cari Siswa

                    </label>

                    <div class="relative">

                        <i
                            class="ph ph-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                        </i>

                        <input type="text" id="searchSiswa" placeholder="Nama atau NISN..."
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-xs text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                    </div>

                </div>


                {{-- Tahun --}}
                <div>

                    <label for="filterTahun" class="mb-1.5 block text-[11px] font-medium text-slate-600">

                        Tahun Ajaran

                    </label>

                    <select id="filterTahun"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Tahun
                        </option>

                        <option value="2025/2026">
                            2025/2026
                        </option>

                        <option value="2026/2027">
                            2026/2027
                        </option>

                    </select>

                </div>


                {{-- Semester --}}
                <div>

                    <label for="filterSemester" class="mb-1.5 block text-[11px] font-medium text-slate-600">

                        Semester

                    </label>

                    <select id="filterSemester"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Semester
                        </option>

                        <option value="Ganjil">
                            Ganjil
                        </option>

                        <option value="Genap">
                            Genap
                        </option>

                    </select>

                </div>


                {{-- Kelas --}}
                <div>

                    <label for="filterKelas" class="mb-1.5 block text-[11px] font-medium text-slate-600">

                        Kelas

                    </label>

                    <select id="filterKelas"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Kelas
                        </option>

                        <option value="XII RPL 1">
                            XII RPL 1
                        </option>

                        <option value="XII RPL 2">
                            XII RPL 2
                        </option>

                        <option value="XII TKJ 1">
                            XII TKJ 1
                        </option>

                        <option value="XII TKJ 2">
                            XII TKJ 2
                        </option>

                    </select>

                </div>


                {{-- Konsentrasi --}}
                <div>

                    <label for="filterKonsentrasi" class="mb-1.5 block text-[11px] font-medium text-slate-600">

                        Konsentrasi Keahlian

                    </label>

                    <select id="filterKonsentrasi"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Konsentrasi
                        </option>

                        <option value="Rekayasa Perangkat Lunak">
                            Rekayasa Perangkat Lunak
                        </option>

                        <option value="Teknik Komputer Jaringan">
                            Teknik Komputer Jaringan
                        </option>

                    </select>

                </div>

            </div>


            {{-- Filter Status --}}
            <div id="filterStatus"
                class="mt-4 hidden items-center justify-between gap-3 rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-2.5">

                <div class="flex items-center gap-2 text-[11px] text-indigo-700">

                    <i class="ph ph-funnel"></i>

                    <span>
                        Filter aktif.
                        Menampilkan
                        <strong id="jumlahHasil">
                            0
                        </strong>
                        data.
                    </span>

                </div>


                <button type="button" onclick="resetFilter()"
                    class="text-[11px] font-semibold text-indigo-600 hover:text-indigo-800">

                    Hapus filter

                </button>

            </div>

        </div>



        {{-- =========================================================
        TABLE
    ========================================================== --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Table Header --}}
            <div class="flex items-center justify-between gap-4 border-b border-slate-100 px-5 py-4">

                <div>

                    <h2 class="flex items-center gap-2 text-sm font-semibold text-slate-800">

                        <i class="ph ph-medal text-indigo-500"></i>

                        Daftar Nilai UKK

                    </h2>

                    <p class="mt-1 text-[11px] text-slate-400">
                        Data hasil Uji Kompetensi Keahlian siswa.
                    </p>

                </div>


                <div
                    class="hidden items-center gap-1.5 rounded-lg bg-slate-50 px-3 py-2 text-[11px] text-slate-500 sm:flex">

                    <i class="ph ph-info"></i>

                    Klik <strong>Edit</strong> untuk mengubah data.

                </div>

            </div>


            <div class="overflow-x-auto">

                <table id="tabelUKK" class="w-full min-w-[1350px] text-left">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr class="text-[10px] font-semibold uppercase tracking-wider text-slate-500">

                            <th class="px-4 py-3 text-center">
                                No
                            </th>

                            <th class="px-4 py-3">
                                Siswa
                            </th>

                            <th class="px-4 py-3">
                                Kelas
                            </th>

                            <th class="px-4 py-3">
                                Konsentrasi Keahlian
                            </th>

                            <th class="px-4 py-3 text-center">
                                Nilai UKK
                            </th>

                            <th class="px-4 py-3 text-center">
                                Predikat
                            </th>

                            <th class="px-4 py-3 text-center">
                                Status
                            </th>

                            <th class="px-4 py-3">
                                Tahun Ajaran
                            </th>

                            <th class="px-4 py-3">
                                Semester
                            </th>

                            <th class="px-4 py-3 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="bodyUKK" class="divide-y divide-slate-100 text-xs">


                        {{-- =================================================
                        DATA DUMMY
                    ================================================== --}}

                        @php

                            $dataUKK = [
                                [
                                    'nisn' => '00654321',
                                    'nama' => 'Ahmad Fauzan',
                                    'kelas' => 'XII RPL 1',
                                    'konsentrasi' => 'Rekayasa Perangkat Lunak',
                                    'nilai' => 90,
                                    'predikat' => 'Sangat Baik',
                                    'status' => 'Lulus',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Genap',
                                ],

                                [
                                    'nisn' => '00654322',
                                    'nama' => 'Budi Santoso',
                                    'kelas' => 'XII RPL 1',
                                    'konsentrasi' => 'Rekayasa Perangkat Lunak',
                                    'nilai' => 86,
                                    'predikat' => 'Baik',
                                    'status' => 'Lulus',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Genap',
                                ],

                                [
                                    'nisn' => '00654323',
                                    'nama' => 'Citra Lestari',
                                    'kelas' => 'XII RPL 2',
                                    'konsentrasi' => 'Rekayasa Perangkat Lunak',
                                    'nilai' => 94,
                                    'predikat' => 'Sangat Baik',
                                    'status' => 'Lulus',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Genap',
                                ],

                                [
                                    'nisn' => '00654324',
                                    'nama' => 'Dimas Pratama',
                                    'kelas' => 'XII TKJ 1',
                                    'konsentrasi' => 'Teknik Komputer Jaringan',
                                    'nilai' => 78,
                                    'predikat' => 'Cukup',
                                    'status' => 'Lulus',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Genap',
                                ],

                                [
                                    'nisn' => '00654325',
                                    'nama' => 'Eka Putri',
                                    'kelas' => 'XII TKJ 2',
                                    'konsentrasi' => 'Teknik Komputer Jaringan',
                                    'nilai' => 65,
                                    'predikat' => 'Kurang',
                                    'status' => 'Tidak Lulus',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Genap',
                                ],
                            ];

                        @endphp


                        @foreach ($dataUKK as $index => $item)
                            <tr class="ukk-row transition hover:bg-slate-50" data-nama="{{ strtolower($item['nama']) }}"
                                data-nisn="{{ strtolower($item['nisn']) }}" data-kelas="{{ strtolower($item['kelas']) }}"
                                data-konsentrasi="{{ strtolower($item['konsentrasi']) }}"
                                data-tahun="{{ $item['tahun'] }}" data-semester="{{ $item['semester'] }}"
                                data-nilai="{{ $item['nilai'] }}" data-predikat="{{ $item['predikat'] }}"
                                data-status="{{ $item['status'] }}">


                                {{-- NO --}}
                                <td class="px-4 py-4 text-center">

                                    <span class="text-[11px] font-medium text-slate-400">

                                        {{ $index + 1 }}

                                    </span>

                                </td>


                                {{-- SISWA --}}
                                <td class="px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                                            <i class="ph ph-student text-lg"></i>

                                        </div>

                                        <div>

                                            <p class="nama-text font-semibold text-slate-700">

                                                {{ $item['nama'] }}

                                            </p>

                                            <p class="mt-0.5 text-[10px] text-slate-400">

                                                NISN {{ $item['nisn'] }}

                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- KELAS --}}
                                <td class="px-4 py-4">

                                    <span
                                        class="kelas-badge inline-flex items-center gap-1 rounded-lg bg-indigo-50 px-2.5 py-1 text-[10px] font-semibold text-indigo-700">

                                        <i class="ph ph-users-three"></i>

                                        {{ $item['kelas'] }}

                                    </span>

                                </td>


                                {{-- KONSENTRASI --}}
                                <td class="px-4 py-4">

                                    <span class="konsentrasi-text font-medium text-slate-600">

                                        {{ $item['konsentrasi'] }}

                                    </span>

                                </td>


                                {{-- NILAI --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="nilai-text inline-flex min-w-[44px] items-center justify-center rounded-lg bg-indigo-50 px-2.5 py-1.5 text-sm font-bold text-indigo-700">

                                        {{ $item['nilai'] }}

                                    </span>

                                </td>


                                {{-- PREDIKAT --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="predikat-text inline-flex items-center rounded-full px-3 py-1 text-[10px] font-semibold">

                                        {{ $item['predikat'] }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="status-text inline-flex items-center gap-1 rounded-full px-3 py-1 text-[10px] font-semibold">

                                        {{ $item['status'] }}

                                    </span>

                                </td>


                                {{-- TAHUN --}}
                                <td class="px-4 py-4">

                                    <span class="tahun-text text-slate-600">

                                        {{ $item['tahun'] }}

                                    </span>

                                </td>


                                {{-- SEMESTER --}}
                                <td class="px-4 py-4">

                                    <span class="semester-text text-slate-600">

                                        {{ $item['semester'] }}

                                    </span>

                                </td>


                                {{-- AKSI --}}
                                <td class="px-4 py-4 text-center">

                                    <div class="flex items-center justify-center gap-1.5">

                                        <button type="button" onclick="editData(this)"
                                            class="edit-button inline-flex items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-2.5 py-2 text-[10px] font-semibold text-indigo-600 transition hover:border-indigo-300 hover:bg-indigo-100">

                                            <i class="ph ph-pencil-simple"></i>

                                            Edit

                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforeach


                        {{-- EMPTY STATE --}}
                        <tr id="emptyState" class="hidden">

                            <td colspan="10" class="px-6 py-14 text-center">

                                <div
                                    class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

                                    <i class="ph ph-magnifying-glass text-xl"></i>

                                </div>

                                <p class="mt-3 text-sm font-semibold text-slate-600">

                                    Data tidak ditemukan

                                </p>

                                <p class="mt-1 text-xs text-slate-400">

                                    Coba ubah kata kunci atau filter yang digunakan.

                                </p>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- TABLE FOOTER --}}
            <div
                class="flex flex-col gap-2 border-t border-slate-100 px-5 py-3 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-[11px] text-slate-400">

                    Menampilkan

                    <span id="jumlahData" class="font-semibold text-slate-600">

                        0

                    </span>

                    data nilai UKK.

                </p>


                <p class="text-[10px] text-slate-400">

                    Data dapat diedit langsung melalui tombol Edit.

                </p>

            </div>

        </div>

    </div>



    <script>
        /*
            |--------------------------------------------------------------------------
            | WARNA PREDIKAT
            |--------------------------------------------------------------------------
            */

        function updatePredikatStyle(element, predikat) {

            if (!element) return;

            element.classList.remove(
                'bg-green-100',
                'text-green-700',
                'bg-blue-100',
                'text-blue-700',
                'bg-yellow-100',
                'text-yellow-700',
                'bg-red-100',
                'text-red-700',
                'bg-slate-100',
                'text-slate-600'
            );


            switch (predikat) {

                case 'Sangat Baik':

                    element.classList.add(
                        'bg-green-100',
                        'text-green-700'
                    );

                    break;


                case 'Baik':

                    element.classList.add(
                        'bg-blue-100',
                        'text-blue-700'
                    );

                    break;


                case 'Cukup':

                    element.classList.add(
                        'bg-yellow-100',
                        'text-yellow-700'
                    );

                    break;


                case 'Kurang':

                    element.classList.add(
                        'bg-red-100',
                        'text-red-700'
                    );

                    break;


                default:

                    element.classList.add(
                        'bg-slate-100',
                        'text-slate-600'
                    );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | WARNA STATUS
        |--------------------------------------------------------------------------
        */

        function updateStatusStyle(element, status) {

            if (!element) return;

            element.classList.remove(
                'bg-green-100',
                'text-green-700',
                'bg-red-100',
                'text-red-700',
                'bg-slate-100',
                'text-slate-600'
            );


            if (status === 'Lulus') {

                element.classList.add(
                    'bg-green-100',
                    'text-green-700'
                );

                element.innerHTML =
                    '<i class="ph ph-check-circle"></i> Lulus';

            } else {

                element.classList.add(
                    'bg-red-100',
                    'text-red-700'
                );

                element.innerHTML =
                    '<i class="ph ph-x-circle"></i> Tidak Lulus';

            }

        }



        /*
        |--------------------------------------------------------------------------
        | WARNA NILAI
        |--------------------------------------------------------------------------
        */

        function updateNilaiStyle(element, nilai) {

            if (!element) return;

            element.classList.remove(
                'bg-green-50',
                'text-green-700',
                'bg-blue-50',
                'text-blue-700',
                'bg-yellow-50',
                'text-yellow-700',
                'bg-red-50',
                'text-red-700',
                'bg-indigo-50',
                'text-indigo-700'
            );


            if (nilai >= 90) {

                element.classList.add(
                    'bg-green-50',
                    'text-green-700'
                );

            } else if (nilai >= 80) {

                element.classList.add(
                    'bg-blue-50',
                    'text-blue-700'
                );

            } else if (nilai >= 70) {

                element.classList.add(
                    'bg-yellow-50',
                    'text-yellow-700'
                );

            } else {

                element.classList.add(
                    'bg-red-50',
                    'text-red-700'
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | INISIALISASI BADGE
        |--------------------------------------------------------------------------
        */

        document.addEventListener('DOMContentLoaded', function() {

            document
                .querySelectorAll('.ukk-row')
                .forEach(function(row) {

                    const predikat =
                        row.dataset.predikat;

                    const status =
                        row.dataset.status;

                    const nilai =
                        Number(row.dataset.nilai);


                    updatePredikatStyle(
                        row.querySelector('.predikat-text'),
                        predikat
                    );


                    updateStatusStyle(
                        row.querySelector('.status-text'),
                        status
                    );


                    updateNilaiStyle(
                        row.querySelector('.nilai-text'),
                        nilai
                    );

                });


            filterData();

        });



        /*
        |--------------------------------------------------------------------------
        | FILTER DATA
        |--------------------------------------------------------------------------
        */

        function filterData() {

            const search =
                document
                .getElementById('searchSiswa')
                .value
                .toLowerCase()
                .trim();


            const tahun =
                document
                .getElementById('filterTahun')
                .value;


            const semester =
                document
                .getElementById('filterSemester')
                .value;


            const kelas =
                document
                .getElementById('filterKelas')
                .value
                .toLowerCase();


            const konsentrasi =
                document
                .getElementById('filterKonsentrasi')
                .value
                .toLowerCase();


            const rows =
                document.querySelectorAll('.ukk-row');


            let jumlah = 0;

            let lulus = 0;

            let tidakLulus = 0;

            let totalNilai = 0;


            rows.forEach(function(row) {

                const nama =
                    row.dataset.nama || '';

                const nisn =
                    row.dataset.nisn || '';

                const rowTahun =
                    row.dataset.tahun || '';

                const rowSemester =
                    row.dataset.semester || '';

                const rowKelas =
                    row.dataset.kelas || '';

                const rowKonsentrasi =
                    row.dataset.konsentrasi || '';

                const rowStatus =
                    row.dataset.status || '';

                const nilai =
                    Number(row.dataset.nilai || 0);


                const cocokSearch =
                    search === '' ||
                    nama.includes(search) ||
                    nisn.includes(search);


                const cocokTahun =
                    tahun === '' ||
                    rowTahun === tahun;


                const cocokSemester =
                    semester === '' ||
                    rowSemester === semester;


                const cocokKelas =
                    kelas === '' ||
                    rowKelas === kelas;


                const cocokKonsentrasi =
                    konsentrasi === '' ||
                    rowKonsentrasi === konsentrasi;


                const tampil =
                    cocokSearch &&
                    cocokTahun &&
                    cocokSemester &&
                    cocokKelas &&
                    cocokKonsentrasi;


                row.style.display =
                    tampil ? '' : 'none';


                if (tampil) {

                    jumlah++;

                    totalNilai += nilai;


                    if (rowStatus === 'Lulus') {

                        lulus++;

                    } else {

                        tidakLulus++;

                    }

                }

            });


            /*
            |--------------------------------------------------------------------------
            | UPDATE STATISTIK
            |--------------------------------------------------------------------------
            */

            document
                .getElementById('jumlahData')
                .textContent = jumlah;


            document
                .getElementById('totalData')
                .textContent = jumlah;


            document
                .getElementById('jumlahLulus')
                .textContent = lulus;


            document
                .getElementById('jumlahTidakLulus')
                .textContent = tidakLulus;


            const rataRata =
                jumlah > 0 ?
                (totalNilai / jumlah).toFixed(1) :
                '0';


            document
                .getElementById('rataRata')
                .textContent = rataRata;


            /*
            |--------------------------------------------------------------------------
            | FILTER STATUS
            |--------------------------------------------------------------------------
            */

            const filterAktif =
                search !== '' ||
                tahun !== '' ||
                semester !== '' ||
                kelas !== '' ||
                konsentrasi !== '';


            const filterStatus =
                document.getElementById('filterStatus');


            filterStatus.classList.toggle(
                'hidden',
                !filterAktif
            );


            filterStatus.classList.toggle(
                'flex',
                filterAktif
            );


            document
                .getElementById('jumlahHasil')
                .textContent = jumlah;


            /*
            |--------------------------------------------------------------------------
            | EMPTY STATE
            |--------------------------------------------------------------------------
            */

            const emptyState =
                document.getElementById('emptyState');


            emptyState.classList.toggle(
                'hidden',
                jumlah !== 0
            );

        }



        /*
        |--------------------------------------------------------------------------
        | RESET FILTER
        |--------------------------------------------------------------------------
        */

        function resetFilter() {

            document
                .getElementById('searchSiswa')
                .value = '';


            document
                .getElementById('filterTahun')
                .value = '';


            document
                .getElementById('filterSemester')
                .value = '';


            document
                .getElementById('filterKelas')
                .value = '';


            document
                .getElementById('filterKonsentrasi')
                .value = '';


            filterData();

        }



        /*
        |--------------------------------------------------------------------------
        | EVENT FILTER
        |--------------------------------------------------------------------------
        */

        document
            .getElementById('searchSiswa')
            .addEventListener(
                'input',
                filterData
            );


        document
            .getElementById('filterTahun')
            .addEventListener(
                'change',
                filterData
            );


        document
            .getElementById('filterSemester')
            .addEventListener(
                'change',
                filterData
            );


        document
            .getElementById('filterKelas')
            .addEventListener(
                'change',
                filterData
            );


        document
            .getElementById('filterKonsentrasi')
            .addEventListener(
                'change',
                filterData
            );



        /*
        |--------------------------------------------------------------------------
        | EDIT DATA
        |--------------------------------------------------------------------------
        */

        function editData(button) {

            const row =
                button.closest('.ukk-row');

            const cells =
                row.querySelectorAll('td');


            /*
            |--------------------------------------------------------------------------
            | Ambil data lama
            |--------------------------------------------------------------------------
            */

            const nama =
                row.dataset.nama;

            const nisn =
                row.dataset.nisn;

            const kelas =
                row.dataset.kelas;

            const konsentrasi =
                row.dataset.konsentrasi;

            const nilai =
                row.dataset.nilai;

            const predikat =
                row.dataset.predikat;

            const status =
                row.dataset.status;

            const tahun =
                row.dataset.tahun;

            const semester =
                row.dataset.semester;


            /*
            |--------------------------------------------------------------------------
            | Simpan data lama
            |--------------------------------------------------------------------------
            */

            row.dataset.oldNama =
                nama;

            row.dataset.oldKelas =
                kelas;

            row.dataset.oldKonsentrasi =
                konsentrasi;

            row.dataset.oldNilai =
                nilai;

            row.dataset.oldPredikat =
                predikat;

            row.dataset.oldStatus =
                status;

            row.dataset.oldTahun =
                tahun;

            row.dataset.oldSemester =
                semester;


            row.classList.add(
                'bg-indigo-50/30'
            );


            /*
            |--------------------------------------------------------------------------
            | SISWA
            |--------------------------------------------------------------------------
            */

            cells[1].innerHTML = `

        <div class="flex items-center gap-3">

            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                <i class="ph ph-student text-lg"></i>

            </div>

            <div>

                <p class="font-semibold text-slate-700">
                    ${nama}
                </p>

                <p class="mt-0.5 text-[10px] text-slate-400">
                    NISN ${nisn}
                </p>

            </div>

        </div>

    `;


            /*
            |--------------------------------------------------------------------------
            | KELAS
            |--------------------------------------------------------------------------
            */

            cells[2].innerHTML = `

        <select
            class="w-36 rounded-lg border border-indigo-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

            <option value="XII RPL 1"
                ${kelas === 'xii rpl 1' ? 'selected' : ''}>
                XII RPL 1
            </option>

            <option value="XII RPL 2"
                ${kelas === 'xii rpl 2' ? 'selected' : ''}>
                XII RPL 2
            </option>

            <option value="XII TKJ 1"
                ${kelas === 'xii tkj 1' ? 'selected' : ''}>
                XII TKJ 1
            </option>

            <option value="XII TKJ 2"
                ${kelas === 'xii tkj 2' ? 'selected' : ''}>
                XII TKJ 2
            </option>

        </select>

    `;


            /*
            |--------------------------------------------------------------------------
            | KONSENTRASI
            |--------------------------------------------------------------------------
            */

            cells[3].innerHTML = `

        <select
            class="w-60 rounded-lg border border-indigo-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

            <option value="Rekayasa Perangkat Lunak"
                ${konsentrasi === 'rekayasa perangkat lunak' ? 'selected' : ''}>
                Rekayasa Perangkat Lunak
            </option>

            <option value="Teknik Komputer Jaringan"
                ${konsentrasi === 'teknik komputer jaringan' ? 'selected' : ''}>
                Teknik Komputer Jaringan
            </option>

        </select>

    `;


            /*
            |--------------------------------------------------------------------------
            | NILAI
            |--------------------------------------------------------------------------
            */

            cells[4].innerHTML = `

        <input
            type="number"
            min="0"
            max="100"
            value="${nilai}"
            class="w-20 rounded-lg border border-indigo-300 bg-white px-2.5 py-2 text-center text-xs font-bold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

    `;


            /*
            |--------------------------------------------------------------------------
            | PREDIKAT
            |--------------------------------------------------------------------------
            */

            cells[5].innerHTML = `

        <select
            class="w-32 rounded-lg border border-indigo-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

            <option value="Sangat Baik"
                ${predikat === 'Sangat Baik' ? 'selected' : ''}>
                Sangat Baik
            </option>

            <option value="Baik"
                ${predikat === 'Baik' ? 'selected' : ''}>
                Baik
            </option>

            <option value="Cukup"
                ${predikat === 'Cukup' ? 'selected' : ''}>
                Cukup
            </option>

            <option value="Kurang"
                ${predikat === 'Kurang' ? 'selected' : ''}>
                Kurang
            </option>

        </select>

    `;


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            cells[6].innerHTML = `

        <select
            class="w-32 rounded-lg border border-indigo-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

            <option value="Lulus"
                ${status === 'Lulus' ? 'selected' : ''}>
                Lulus
            </option>

            <option value="Tidak Lulus"
                ${status === 'Tidak Lulus' ? 'selected' : ''}>
                Tidak Lulus
            </option>

        </select>

    `;


            /*
            |--------------------------------------------------------------------------
            | TAHUN
            |--------------------------------------------------------------------------
            */

            cells[7].innerHTML = `

        <select
            class="w-32 rounded-lg border border-indigo-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

            <option value="2025/2026"
                ${tahun === '2025/2026' ? 'selected' : ''}>
                2025/2026
            </option>

            <option value="2026/2027"
                ${tahun === '2026/2027' ? 'selected' : ''}>
                2026/2027
            </option>

        </select>

    `;


            /*
            |--------------------------------------------------------------------------
            | SEMESTER
            |--------------------------------------------------------------------------
            */

            cells[8].innerHTML = `

        <select
            class="w-28 rounded-lg border border-indigo-300 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

            <option value="Ganjil"
                ${semester === 'Ganjil' ? 'selected' : ''}>
                Ganjil
            </option>

            <option value="Genap"
                ${semester === 'Genap' ? 'selected' : ''}>
                Genap
            </option>

        </select>

    `;


            /*
            |--------------------------------------------------------------------------
            | AKSI
            |--------------------------------------------------------------------------
            */

            cells[9].innerHTML = `

        <div class="flex items-center justify-center gap-1.5">

            <button
                type="button"
                onclick="simpanData(this)"
                class="inline-flex items-center gap-1.5 rounded-lg border border-green-200 bg-green-50 px-2.5 py-2 text-[10px] font-semibold text-green-600 transition hover:border-green-300 hover:bg-green-100">

                <i class="ph ph-check"></i>

                Simpan

            </button>


            <button
                type="button"
                onclick="batalEdit(this)"
                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-2 text-[10px] font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-100">

                <i class="ph ph-x"></i>

                Batal

            </button>

        </div>

    `;

        }



        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA
        |--------------------------------------------------------------------------
        */

        function simpanData(button) {

            const row =
                button.closest('.ukk-row');

            const cells =
                row.querySelectorAll('td');


            const kelas =
                cells[2]
                .querySelector('select')
                .value;

            const konsentrasi =
                cells[3]
                .querySelector('select')
                .value;

            const nilai =
                cells[4]
                .querySelector('input')
                .value;

            const predikat =
                cells[5]
                .querySelector('select')
                .value;

            const status =
                cells[6]
                .querySelector('select')
                .value;

            const tahun =
                cells[7]
                .querySelector('select')
                .value;

            const semester =
                cells[8]
                .querySelector('select')
                .value;


            /*
            |--------------------------------------------------------------------------
            | VALIDASI NILAI
            |--------------------------------------------------------------------------
            */

            if (
                nilai === '' ||
                Number(nilai) < 0 ||
                Number(nilai) > 100
            ) {

                alert(
                    'Nilai UKK harus berada antara 0 sampai 100.'
                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE DATASET
            |--------------------------------------------------------------------------
            */

            row.dataset.kelas =
                kelas.toLowerCase();

            row.dataset.konsentrasi =
                konsentrasi.toLowerCase();

            row.dataset.nilai =
                nilai;

            row.dataset.predikat =
                predikat;

            row.dataset.status =
                status;

            row.dataset.tahun =
                tahun;

            row.dataset.semester =
                semester;


            /*
            |--------------------------------------------------------------------------
            | KELAS
            |--------------------------------------------------------------------------
            */

            cells[2].innerHTML = `

        <span
            class="kelas-badge inline-flex items-center gap-1 rounded-lg bg-indigo-50 px-2.5 py-1 text-[10px] font-semibold text-indigo-700">

            <i class="ph ph-users-three"></i>

            ${kelas}

        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | KONSENTRASI
            |--------------------------------------------------------------------------
            */

            cells[3].innerHTML = `

        <span class="konsentrasi-text font-medium text-slate-600">
            ${konsentrasi}
        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | NILAI
            |--------------------------------------------------------------------------
            */

            cells[4].innerHTML = `

        <span
            class="nilai-text inline-flex min-w-[44px] items-center justify-center rounded-lg px-2.5 py-1.5 text-sm font-bold">

            ${nilai}

        </span>

    `;


            updateNilaiStyle(
                cells[4].querySelector('.nilai-text'),
                Number(nilai)
            );


            /*
            |--------------------------------------------------------------------------
            | PREDIKAT
            |--------------------------------------------------------------------------
            */

            cells[5].innerHTML = `

        <span
            class="predikat-text inline-flex items-center rounded-full px-3 py-1 text-[10px] font-semibold">

            ${predikat}

        </span>

    `;


            updatePredikatStyle(
                cells[5].querySelector('.predikat-text'),
                predikat
            );


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            cells[6].innerHTML = `

        <span
            class="status-text inline-flex items-center gap-1 rounded-full px-3 py-1 text-[10px] font-semibold">

            ${status}

        </span>

    `;


            updateStatusStyle(
                cells[6].querySelector('.status-text'),
                status
            );


            /*
            |--------------------------------------------------------------------------
            | TAHUN
            |--------------------------------------------------------------------------
            */

            cells[7].innerHTML = `

        <span class="tahun-text text-slate-600">
            ${tahun}
        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | SEMESTER
            |--------------------------------------------------------------------------
            */

            cells[8].innerHTML = `

        <span class="semester-text text-slate-600">
            ${semester}
        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | AKSI
            |--------------------------------------------------------------------------
            */

            cells[9].innerHTML = `

        <button
            type="button"
            onclick="editData(this)"
            class="edit-button inline-flex items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-2.5 py-2 text-[10px] font-semibold text-indigo-600 transition hover:border-indigo-300 hover:bg-indigo-100">

            <i class="ph ph-pencil-simple"></i>

            Edit

        </button>

    `;


            row.classList.remove(
                'bg-indigo-50/30'
            );


            filterData();


            alert(
                'Data nilai UKK berhasil diubah.'
            );

        }



        /*
        |--------------------------------------------------------------------------
        | BATAL EDIT
        |--------------------------------------------------------------------------
        */

        function batalEdit(button) {

            const row =
                button.closest('.ukk-row');

            const cells =
                row.querySelectorAll('td');


            /*
            |--------------------------------------------------------------------------
            | Ambil data lama
            |--------------------------------------------------------------------------
            */

            const kelas =
                row.dataset.oldKelas;

            const konsentrasi =
                row.dataset.oldKonsentrasi;

            const nilai =
                row.dataset.oldNilai;

            const predikat =
                row.dataset.oldPredikat;

            const status =
                row.dataset.oldStatus;

            const tahun =
                row.dataset.oldTahun;

            const semester =
                row.dataset.oldSemester;


            /*
            |--------------------------------------------------------------------------
            | Kelas
            |--------------------------------------------------------------------------
            */

            cells[2].innerHTML = `

        <span
            class="kelas-badge inline-flex items-center gap-1 rounded-lg bg-indigo-50 px-2.5 py-1 text-[10px] font-semibold text-indigo-700">

            <i class="ph ph-users-three"></i>

            ${kelas}

        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | Konsentrasi
            |--------------------------------------------------------------------------
            */

            cells[3].innerHTML = `

        <span class="konsentrasi-text font-medium text-slate-600">
            ${konsentrasi}
        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | Nilai
            |--------------------------------------------------------------------------
            */

            cells[4].innerHTML = `

        <span
            class="nilai-text inline-flex min-w-[44px] items-center justify-center rounded-lg px-2.5 py-1.5 text-sm font-bold">

            ${nilai}

        </span>

    `;


            updateNilaiStyle(
                cells[4].querySelector('.nilai-text'),
                Number(nilai)
            );


            /*
            |--------------------------------------------------------------------------
            | Predikat
            |--------------------------------------------------------------------------
            */

            cells[5].innerHTML = `

        <span
            class="predikat-text inline-flex items-center rounded-full px-3 py-1 text-[10px] font-semibold">

            ${predikat}

        </span>

    `;


            updatePredikatStyle(
                cells[5].querySelector('.predikat-text'),
                predikat
            );


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            cells[6].innerHTML = `

        <span
            class="status-text inline-flex items-center gap-1 rounded-full px-3 py-1 text-[10px] font-semibold">

            ${status}

        </span>

    `;


            updateStatusStyle(
                cells[6].querySelector('.status-text'),
                status
            );


            /*
            |--------------------------------------------------------------------------
            | Tahun
            |--------------------------------------------------------------------------
            */

            cells[7].innerHTML = `

        <span class="tahun-text text-slate-600">
            ${tahun}
        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | Semester
            |--------------------------------------------------------------------------
            */

            cells[8].innerHTML = `

        <span class="semester-text text-slate-600">
            ${semester}
        </span>

    `;


            /*
            |--------------------------------------------------------------------------
            | Tombol
            |--------------------------------------------------------------------------
            */

            cells[9].innerHTML = `

        <button
            type="button"
            onclick="editData(this)"
            class="edit-button inline-flex items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-2.5 py-2 text-[10px] font-semibold text-indigo-600 transition hover:border-indigo-300 hover:bg-indigo-100">

            <i class="ph ph-pencil-simple"></i>

            Edit

        </button>

    `;


            row.classList.remove(
                'bg-indigo-50/30'
            );

        }
    </script>
@endsection
