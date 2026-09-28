@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Perkembangan Nilai
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Melihat perkembangan nilai siswa berdasarkan tahun ajaran, semester, kelas, dan mata pelajaran.
        </p>
    </div>


    <!-- FILTER & PENCARIAN -->
    <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">

            <!-- PENCARIAN -->
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
                        id="searchSiswa"
                        placeholder="Cari nama siswa..."
                        class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    >
                </div>
            </div>


            <!-- TAHUN AJARAN -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Tahun Ajaran
                </label>

                <select
                    id="tahunAjaran"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <option value="">Semua Tahun Ajaran</option>
                    <option value="2025/2026">2025/2026</option>
                    <option value="2026/2027">2026/2027</option>

                </select>
            </div>


            <!-- SEMESTER -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Semester
                </label>

                <select
                    id="semester"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <option value="">Semua Semester</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>

                </select>
            </div>


            <!-- KELAS -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Kelas
                </label>

                <select
                    id="kelas"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <option value="">Semua Kelas</option>
                    <option value="X RPL 1">X RPL 1</option>
                    <option value="X RPL 2">X RPL 2</option>
                    <option value="XI RPL 1">XI RPL 1</option>
                    <option value="XI RPL 2">XI RPL 2</option>
                    <option value="XII RPL 1">XII RPL 1</option>
                    <option value="XII RPL 2">XII RPL 2</option>

                </select>
            </div>


            <!-- MATA PELAJARAN -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Mata Pelajaran
                </label>

                <select
                    id="mataPelajaran"
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


        <!-- TOMBOL -->
        <div class="mt-5 flex flex-wrap gap-3">

            <button
                type="button"
                onclick="filterData()"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                <i class="ph ph-magnifying-glass mr-1"></i>
                Cari

            </button>


            <button
                type="button"
                onclick="resetFilter()"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                Reset

            </button>

        </div>

    </div>


    <!-- RINGKASAN -->
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">

        <!-- RATA-RATA -->
        <div class="rounded-xl bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Rata-rata Nilai
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-blue-600">
                        88.2
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                    <i class="ph ph-chart-line-up text-2xl text-blue-600"></i>
                </div>

            </div>

        </div>


        <!-- NILAI TERTINGGI -->
        <div class="rounded-xl bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Nilai Tertinggi
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-green-600">
                        92
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                    <i class="ph ph-trend-up text-2xl text-green-600"></i>
                </div>

            </div>

        </div>


        <!-- NILAI TERENDAH -->
        <div class="rounded-xl bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Nilai Terendah
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-red-600">
                        85
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                    <i class="ph ph-trend-down text-2xl text-red-600"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- TABEL PERKEMBANGAN NILAI -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">

        <!-- HEADER -->
        <div class="border-b border-gray-200 px-6 py-4">

            <h2 class="text-lg font-bold text-gray-800">
                Data Perkembangan Nilai Siswa
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Perbandingan nilai siswa berdasarkan semester.
            </p>

        </div>


        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1200px] text-left text-sm">

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
                            Mata Pelajaran
                        </th>

                        <th class="px-6 py-4 text-center">
                            Semester Ganjil
                        </th>

                        <th class="px-6 py-4 text-center">
                            Semester Genap
                        </th>

                        <th class="px-6 py-4 text-center">
                            Perubahan
                        </th>

                        <th class="px-6 py-4 text-center">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody
                    id="nilaiTable"
                    class="divide-y divide-gray-200">


                    <!-- SISWA 1 -->
                    <tr
                        class="nilai-row transition hover:bg-gray-50"
                        data-nama="Ahmad Fauzan"
                        data-tahun="2026/2027"
                        data-semester="Ganjil"
                        data-kelas="XI RPL 1"
                        data-mapel="Pemrograman Web"
                    >

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

                        <td class="px-6 py-5">
                            Pemrograman Web
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-gray-700">
                            84
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-green-600">
                            88
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-green-600">
                            +4
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                <i class="ph ph-trend-up"></i>

                                Meningkat

                            </span>

                        </td>

                    </tr>


                    <!-- SISWA 2 -->
                    <tr
                        class="nilai-row transition hover:bg-gray-50"
                        data-nama="Budi Santoso"
                        data-tahun="2026/2027"
                        data-semester="Ganjil"
                        data-kelas="XI RPL 1"
                        data-mapel="Basis Data"
                    >

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
                            Basis Data
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-gray-700">
                            85
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-green-600">
                            87
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-green-600">
                            +2
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                <i class="ph ph-trend-up"></i>

                                Meningkat

                            </span>

                        </td>

                    </tr>


                    <!-- SISWA 3 -->
                    <tr
                        class="nilai-row transition hover:bg-gray-50"
                        data-nama="Citra Lestari"
                        data-tahun="2026/2027"
                        data-semester="Ganjil"
                        data-kelas="XI RPL 1"
                        data-mapel="Matematika"
                    >

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
                            Matematika
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-gray-700">
                            90
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-red-600">
                            88
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-red-600">
                            -2
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">

                                <i class="ph ph-trend-down"></i>

                                Menurun

                            </span>

                        </td>

                    </tr>


                    <!-- SISWA 4 -->
                    <tr
                        class="nilai-row transition hover:bg-gray-50"
                        data-nama="Dimas Pratama"
                        data-tahun="2026/2027"
                        data-semester="Ganjil"
                        data-kelas="XI RPL 2"
                        data-mapel="Bahasa Indonesia"
                    >

                        <td class="px-6 py-5">
                            4
                        </td>

                        <td class="px-6 py-5 font-medium text-gray-700">
                            00654324
                        </td>

                        <td class="px-6 py-5">

                            <div class="font-semibold text-gray-800">
                                Dimas Pratama
                            </div>

                        </td>

                        <td class="px-6 py-5">

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                XI RPL 2
                            </span>

                        </td>

                        <td class="px-6 py-5">
                            Bahasa Indonesia
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-gray-700">
                            86
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-green-600">
                            86
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-gray-500">
                            0
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">

                                <i class="ph ph-minus"></i>

                                Tetap

                            </span>

                        </td>

                    </tr>


                    <!-- SISWA 5 -->
                    <tr
                        class="nilai-row transition hover:bg-gray-50"
                        data-nama="Eka Putri"
                        data-tahun="2026/2027"
                        data-semester="Ganjil"
                        data-kelas="XII RPL 1"
                        data-mapel="Bahasa Inggris"
                    >

                        <td class="px-6 py-5">
                            5
                        </td>

                        <td class="px-6 py-5 font-medium text-gray-700">
                            00654325
                        </td>

                        <td class="px-6 py-5">

                            <div class="font-semibold text-gray-800">
                                Eka Putri
                            </div>

                        </td>

                        <td class="px-6 py-5">

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                XII RPL 1
                            </span>

                        </td>

                        <td class="px-6 py-5">
                            Bahasa Inggris
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-gray-700">
                            88
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-green-600">
                            91
                        </td>

                        <td class="px-6 py-5 text-center font-semibold text-green-600">
                            +3
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">

                                <i class="ph ph-trend-up"></i>

                                Meningkat

                            </span>

                        </td>

                    </tr>


                </tbody>

            </table>

        </div>


        <!-- FOOTER -->
        <div class="flex flex-col gap-3 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-sm text-gray-500">

                Menampilkan

                <span
                    id="jumlahData"
                    class="font-semibold text-gray-700">
                    5
                </span>

                data perkembangan nilai

            </p>


            <div class="flex gap-2">

                <button
                    type="button"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">

                    Sebelumnya

                </button>


                <button
                    type="button"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white">

                    1

                </button>


                <button
                    type="button"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">

                    Berikutnya

                </button>

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- JAVASCRIPT FILTER -->
<!-- ========================================================= -->

<script>

function filterData() {

    const search =
        document.getElementById('searchSiswa').value
        .toLowerCase();

    const tahun =
        document.getElementById('tahunAjaran').value;

    const semester =
        document.getElementById('semester').value;

    const kelas =
        document.getElementById('kelas').value;

    const mapel =
        document.getElementById('mataPelajaran').value;


    const rows =
        document.querySelectorAll('.nilai-row');

    let jumlah = 0;


    rows.forEach(function(row) {

        const nama =
            row.dataset.nama.toLowerCase();

        const rowTahun =
            row.dataset.tahun;

        const rowSemester =
            row.dataset.semester;

        const rowKelas =
            row.dataset.kelas;

        const rowMapel =
            row.dataset.mapel;


        const cocokNama =
            nama.includes(search);

        const cocokTahun =
            tahun === "" ||
            rowTahun === tahun;

        const cocokSemester =
            semester === "" ||
            rowSemester === semester;

        const cocokKelas =
            kelas === "" ||
            rowKelas === kelas;

        const cocokMapel =
            mapel === "" ||
            rowMapel === mapel;


        if (
            cocokNama &&
            cocokTahun &&
            cocokSemester &&
            cocokKelas &&
            cocokMapel
        ) {

            row.style.display = "";

            jumlah++;

        } else {

            row.style.display = "none";

        }

    });


    document.getElementById('jumlahData').textContent =
        jumlah;

}


function resetFilter() {

    document.getElementById('searchSiswa').value = "";

    document.getElementById('tahunAjaran').value = "";

    document.getElementById('semester').value = "";

    document.getElementById('kelas').value = "";

    document.getElementById('mataPelajaran').value = "";


    const rows =
        document.querySelectorAll('.nilai-row');


    rows.forEach(function(row) {

        row.style.display = "";

    });


    document.getElementById('jumlahData').textContent =
        rows.length;

}

</script>

@endsection