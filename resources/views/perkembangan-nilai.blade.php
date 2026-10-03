@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}
        <div
            class="overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Penilaian'],
                ['label' => 'Perkembangan Nilai'],
            ]" />

            <div class="flex items-start justify-between gap-4">

                <div>
                    <div class="mb-2 flex h-10 w-10 items-center justify-center rounded-lg bg-white/10">
                        <i class="ph ph-chart-line-up text-xl"></i>
                    </div>

                    <h1 class="text-xl font-bold sm:text-2xl">
                        Perkembangan Nilai
                    </h1>

                    <p class="mt-1 max-w-2xl text-sm text-[#d6d5ec]">
                        Pantau perkembangan dan perbandingan nilai siswa berdasarkan
                        tahun ajaran, semester, kelas, dan mata pelajaran.
                    </p>
                </div>

                <div class="hidden rounded-lg bg-white/10 px-4 py-3 text-right sm:block">
                    <p class="text-[10px] uppercase tracking-wide text-[#c7c6e4]">
                        Data Perkembangan
                    </p>

                    <p id="headerJumlahData" class="mt-1 text-2xl font-bold">
                        5
                    </p>

                    <p class="text-[11px] text-[#d6d5ec]">
                        data nilai
                    </p>
                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FILTER --}}
        {{-- ========================================================= --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex items-center justify-between gap-3">

                <div>
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-funnel"></i>
                        </div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Filter Data
                        </h2>
                    </div>

                    <p class="mt-1 text-xs text-slate-500">
                        Gunakan filter untuk melihat perkembangan nilai sesuai kebutuhan.
                    </p>
                </div>

                <button type="button" onclick="resetFilter()"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                    <i class="ph ph-arrow-counter-clockwise"></i>
                    Reset

                </button>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">

                {{-- PENCARIAN --}}
                <div>
                    <label for="searchSiswa" class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Cari Siswa
                    </label>

                    <div class="relative">

                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" id="searchSiswa" placeholder="Nama siswa..."
                            class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                    </div>
                </div>


                {{-- TAHUN AJARAN --}}
                <div>
                    <label for="tahunAjaran" class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Tahun Ajaran
                    </label>

                    <select id="tahunAjaran"
                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Tahun Ajaran
                        </option>

                        <option value="2025/2026">
                            2025/2026
                        </option>

                        <option value="2026/2027">
                            2026/2027
                        </option>

                    </select>
                </div>


                {{-- SEMESTER --}}
                <div>
                    <label for="semester" class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Semester
                    </label>

                    <select id="semester"
                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

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


                {{-- KELAS --}}
                <div>
                    <label for="kelas" class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Kelas
                    </label>

                    <select id="kelas"
                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Kelas
                        </option>

                        <option value="X RPL 1">
                            X RPL 1
                        </option>

                        <option value="X RPL 2">
                            X RPL 2
                        </option>

                        <option value="XI RPL 1">
                            XI RPL 1
                        </option>

                        <option value="XI RPL 2">
                            XI RPL 2
                        </option>

                        <option value="XII RPL 1">
                            XII RPL 1
                        </option>

                        <option value="XII RPL 2">
                            XII RPL 2
                        </option>

                    </select>
                </div>


                {{-- MATA PELAJARAN --}}
                <div>
                    <label for="mataPelajaran" class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Mata Pelajaran
                    </label>

                    <select id="mataPelajaran"
                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Mata Pelajaran
                        </option>

                        <option value="Matematika">
                            Matematika
                        </option>

                        <option value="Bahasa Indonesia">
                            Bahasa Indonesia
                        </option>

                        <option value="Bahasa Inggris">
                            Bahasa Inggris
                        </option>

                        <option value="Pemrograman Web">
                            Pemrograman Web
                        </option>

                        <option value="Basis Data">
                            Basis Data
                        </option>

                    </select>
                </div>

            </div>


            {{-- STATUS FILTER --}}
            <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">

                <p class="text-xs text-slate-500">
                    Menampilkan
                    <span id="jumlahData" class="font-bold text-slate-700">
                        5
                    </span>
                    data perkembangan nilai
                </p>

                <span id="filterStatus"
                    class="hidden items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-600">

                    <i class="ph ph-funnel"></i>
                    Filter aktif

                </span>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- RINGKASAN --}}
        {{-- ========================================================= --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- RATA-RATA --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Rata-rata Nilai
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                            88.2
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Rata-rata dari data yang tersedia
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-chart-line-up text-xl"></i>
                    </div>

                </div>

            </div>


            {{-- TERTINGGI --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Nilai Tertinggi
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-emerald-600">
                            92
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Nilai tertinggi yang tercatat
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <i class="ph ph-trend-up text-xl"></i>
                    </div>

                </div>

            </div>


            {{-- TERENDAH --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Nilai Terendah
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-rose-600">
                            85
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Nilai terendah yang tercatat
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-rose-50 text-rose-600">
                        <i class="ph ph-trend-down text-xl"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- TABEL --}}
        {{-- ========================================================= --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div
                class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-chart-line"></i>
                        </div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Data Perkembangan Nilai
                        </h2>

                    </div>

                    <p class="mt-1 text-xs text-slate-500">
                        Perbandingan nilai siswa antar semester pada setiap mata pelajaran.
                    </p>

                </div>

                <div class="flex items-center gap-2 text-xs text-slate-500">

                    <i class="ph ph-info text-indigo-500"></i>

                    <span>
                        Nilai dibandingkan berdasarkan semester
                    </span>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1200px] text-left text-sm">

                    <thead class="bg-slate-50 text-[10px] uppercase tracking-wide text-slate-500">

                        <tr>

                            <th class="px-5 py-3.5">
                                No
                            </th>

                            <th class="px-5 py-3.5">
                                NISN
                            </th>

                            <th class="px-5 py-3.5">
                                Siswa
                            </th>

                            <th class="px-5 py-3.5">
                                Kelas
                            </th>

                            <th class="px-5 py-3.5">
                                Mata Pelajaran
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                Semester Ganjil
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                Semester Genap
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                Perubahan
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody id="nilaiTable" class="divide-y divide-slate-100">

                        {{-- SISWA 1 --}}
                        <tr class="nilai-row transition hover:bg-slate-50" data-nama="Ahmad Fauzan"
                            data-tahun="2026/2027" data-semester="Ganjil" data-kelas="XI RPL 1"
                            data-mapel="Pemrograman Web">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                1
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-600">
                                00654321
                            </td>

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-600">
                                        AF
                                    </div>

                                    <div>
                                        <div class="font-semibold text-slate-800">
                                            Ahmad Fauzan
                                        </div>

                                        <div class="text-[11px] text-slate-400">
                                            Siswa
                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[11px] font-semibold text-indigo-600">
                                    <i class="ph ph-users-three"></i>
                                    XI RPL 1
                                </span>

                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                Pemrograman Web
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span class="font-semibold text-slate-700">
                                    84
                                </span>

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span class="font-semibold text-emerald-600">
                                    88
                                </span>

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span class="inline-flex items-center gap-1 font-semibold text-emerald-600">
                                    <i class="ph ph-arrow-up"></i>
                                    +4
                                </span>

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600">
                                    <i class="ph ph-trend-up"></i>
                                    Meningkat
                                </span>

                            </td>

                        </tr>


                        {{-- SISWA 2 --}}
                        <tr class="nilai-row transition hover:bg-slate-50" data-nama="Budi Santoso"
                            data-tahun="2026/2027" data-semester="Ganjil" data-kelas="XI RPL 1" data-mapel="Basis Data">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                2
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-600">
                                00654322
                            </td>

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-600">
                                        BS
                                    </div>

                                    <div>
                                        <div class="font-semibold text-slate-800">
                                            Budi Santoso
                                        </div>

                                        <div class="text-[11px] text-slate-400">
                                            Siswa
                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[11px] font-semibold text-indigo-600">
                                    <i class="ph ph-users-three"></i>
                                    XI RPL 1
                                </span>

                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                Basis Data
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-slate-700">
                                    85
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-emerald-600">
                                    87
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span class="inline-flex items-center gap-1 font-semibold text-emerald-600">
                                    <i class="ph ph-arrow-up"></i>
                                    +2
                                </span>

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600">
                                    <i class="ph ph-trend-up"></i>
                                    Meningkat
                                </span>

                            </td>

                        </tr>


                        {{-- SISWA 3 --}}
                        <tr class="nilai-row transition hover:bg-slate-50" data-nama="Citra Lestari"
                            data-tahun="2026/2027" data-semester="Ganjil" data-kelas="XI RPL 1" data-mapel="Matematika">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                3
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-600">
                                00654323
                            </td>

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-600">
                                        CL
                                    </div>

                                    <div>
                                        <div class="font-semibold text-slate-800">
                                            Citra Lestari
                                        </div>

                                        <div class="text-[11px] text-slate-400">
                                            Siswa
                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[11px] font-semibold text-indigo-600">
                                    <i class="ph ph-users-three"></i>
                                    XI RPL 1
                                </span>

                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                Matematika
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-slate-700">
                                    90
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-rose-600">
                                    88
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span class="inline-flex items-center gap-1 font-semibold text-rose-600">
                                    <i class="ph ph-arrow-down"></i>
                                    -2
                                </span>

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-semibold text-rose-600">
                                    <i class="ph ph-trend-down"></i>
                                    Menurun
                                </span>

                            </td>

                        </tr>


                        {{-- SISWA 4 --}}
                        <tr class="nilai-row transition hover:bg-slate-50" data-nama="Dimas Pratama"
                            data-tahun="2026/2027" data-semester="Ganjil" data-kelas="XI RPL 2"
                            data-mapel="Bahasa Indonesia">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                4
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-600">
                                00654324
                            </td>

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-600">
                                        DP
                                    </div>

                                    <div>
                                        <div class="font-semibold text-slate-800">
                                            Dimas Pratama
                                        </div>

                                        <div class="text-[11px] text-slate-400">
                                            Siswa
                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[11px] font-semibold text-indigo-600">
                                    <i class="ph ph-users-three"></i>
                                    XI RPL 2
                                </span>

                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                Bahasa Indonesia
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-slate-700">
                                    86
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-slate-700">
                                    86
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="inline-flex items-center gap-1 font-semibold text-slate-500">
                                    <i class="ph ph-minus"></i>
                                    0
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-600">
                                    <i class="ph ph-minus"></i>
                                    Tetap
                                </span>

                            </td>

                        </tr>


                        {{-- SISWA 5 --}}
                        <tr class="nilai-row transition hover:bg-slate-50" data-nama="Eka Putri" data-tahun="2026/2027"
                            data-semester="Ganjil" data-kelas="XII RPL 1" data-mapel="Bahasa Inggris">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                5
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-600">
                                00654325
                            </td>

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-600">
                                        EP
                                    </div>

                                    <div>
                                        <div class="font-semibold text-slate-800">
                                            Eka Putri
                                        </div>

                                        <div class="text-[11px] text-slate-400">
                                            Siswa
                                        </div>
                                    </div>

                                </div>

                            </td>

                            <td class="px-5 py-4">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[11px] font-semibold text-indigo-600">
                                    <i class="ph ph-users-three"></i>
                                    XII RPL 1
                                </span>

                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                Bahasa Inggris
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-slate-700">
                                    88
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <span class="font-semibold text-emerald-600">
                                    91
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span class="inline-flex items-center gap-1 font-semibold text-emerald-600">
                                    <i class="ph ph-arrow-up"></i>
                                    +3
                                </span>

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-600">
                                    <i class="ph ph-trend-up"></i>
                                    Meningkat
                                </span>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- EMPTY STATE --}}
            <div id="emptyState" class="hidden border-t border-slate-100 px-6 py-12 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                    <i class="ph ph-chart-line text-xl"></i>
                </div>

                <h3 class="mt-3 text-sm font-semibold text-slate-700">
                    Data tidak ditemukan
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Tidak ada data perkembangan nilai yang sesuai dengan filter.
                </p>

            </div>


            {{-- FOOTER --}}
            <div
                class="flex flex-col gap-3 border-t border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-xs text-slate-500">

                    Menampilkan
                    <span id="jumlahDataFooter" class="font-semibold text-slate-700">
                        5
                    </span>
                    data perkembangan nilai

                </p>

                <div class="flex items-center gap-1.5">

                    <button type="button"
                        class="rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-500 transition hover:bg-slate-50">

                        Sebelumnya

                    </button>

                    <button type="button" class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white">

                        1

                    </button>

                    <button type="button"
                        class="rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-500 transition hover:bg-slate-50">

                        Berikutnya

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const searchSiswa = document.getElementById('searchSiswa');
            const tahunAjaran = document.getElementById('tahunAjaran');
            const semester = document.getElementById('semester');
            const kelas = document.getElementById('kelas');
            const mataPelajaran = document.getElementById('mataPelajaran');

            const rows = document.querySelectorAll('.nilai-row');

            const jumlahData = document.getElementById('jumlahData');
            const jumlahDataFooter = document.getElementById('jumlahDataFooter');
            const headerJumlahData = document.getElementById('headerJumlahData');
            const filterStatus = document.getElementById('filterStatus');
            const emptyState = document.getElementById('emptyState');


            function filterData() {

                const search = searchSiswa.value.toLowerCase().trim();
                const tahun = tahunAjaran.value;
                const semesterValue = semester.value;
                const kelasValue = kelas.value;
                const mapelValue = mataPelajaran.value;

                let jumlah = 0;


                rows.forEach(function(row) {

                    const nama = row.dataset.nama.toLowerCase();
                    const rowTahun = row.dataset.tahun;
                    const rowSemester = row.dataset.semester;
                    const rowKelas = row.dataset.kelas;
                    const rowMapel = row.dataset.mapel;


                    const cocokNama =
                        search === '' ||
                        nama.includes(search);

                    const cocokTahun =
                        tahun === '' ||
                        rowTahun === tahun;

                    const cocokSemester =
                        semesterValue === '' ||
                        rowSemester === semesterValue;

                    const cocokKelas =
                        kelasValue === '' ||
                        rowKelas === kelasValue;

                    const cocokMapel =
                        mapelValue === '' ||
                        rowMapel === mapelValue;


                    const tampil =
                        cocokNama &&
                        cocokTahun &&
                        cocokSemester &&
                        cocokKelas &&
                        cocokMapel;


                    row.style.display = tampil ? '' : 'none';


                    if (tampil) {
                        jumlah++;
                    }

                });


                jumlahData.textContent = jumlah;
                jumlahDataFooter.textContent = jumlah;
                headerJumlahData.textContent = jumlah;


                const filterAktif =
                    search !== '' ||
                    tahun !== '' ||
                    semesterValue !== '' ||
                    kelasValue !== '' ||
                    mapelValue !== '';


                filterStatus.classList.toggle(
                    'hidden',
                    !filterAktif
                );

                filterStatus.classList.toggle(
                    'inline-flex',
                    filterAktif
                );


                emptyState.classList.toggle(
                    'hidden',
                    jumlah !== 0
                );

            }


            function resetFilter() {

                searchSiswa.value = '';
                tahunAjaran.value = '';
                semester.value = '';
                kelas.value = '';
                mataPelajaran.value = '';

                filterData();

            }


            searchSiswa.addEventListener(
                'input',
                filterData
            );

            tahunAjaran.addEventListener(
                'change',
                filterData
            );

            semester.addEventListener(
                'change',
                filterData
            );

            kelas.addEventListener(
                'change',
                filterData
            );

            mataPelajaran.addEventListener(
                'change',
                filterData
            );


            window.filterData = filterData;
            window.resetFilter = resetFilter;


            filterData();

        });
    </script>
@endsection
