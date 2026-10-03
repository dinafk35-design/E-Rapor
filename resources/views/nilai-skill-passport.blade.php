@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div
            class="overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            {{-- Breadcrumb --}}
            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Penilaian'],
                ['label' => 'Nilai Skill Passport', 'icon' => 'ph-identification-card'],
            ]" />

            <div class="mt-3 flex items-start justify-between gap-4">

                <div class="flex items-start gap-4">

                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                        <i class="ph ph-identification-card text-2xl"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold tracking-tight">
                            Nilai Skill Passport
                        </h1>

                        <p class="mt-1 max-w-2xl text-xs leading-5 text-indigo-100">
                            Kelola nilai kompetensi dan keterampilan siswa pada Skill Passport
                            berdasarkan tahun ajaran, semester, rombel, dan kompetensi.
                        </p>
                    </div>

                </div>

                {{-- Tambah Data --}}
                <a href="{{ route('nilai-skill-passport-create') }}"
                    class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-xs font-semibold text-[#37367a] shadow-sm transition hover:bg-indigo-50">

                    <i class="ph ph-plus-circle text-base"></i>

                    <span>Tambah Nilai</span>

                </a>

            </div>
        </div>


        {{-- =========================================================
            RINGKASAN
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            {{-- Total Data --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                            Total Nilai
                        </p>

                        <p id="jumlahData" class="mt-1 text-2xl font-bold text-slate-800">
                            0
                        </p>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Data Skill Passport
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <i class="ph ph-identification-card text-xl"></i>
                    </div>

                </div>

            </div>


            {{-- Sangat Baik --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                            Sangat Baik
                        </p>

                        <p id="jumlahSangatBaik" class="mt-1 text-2xl font-bold text-green-600">
                            0
                        </p>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Kompetensi sangat baik
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50 text-green-600">
                        <i class="ph ph-medal text-xl"></i>
                    </div>

                </div>

            </div>


            {{-- Baik --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                            Baik
                        </p>

                        <p id="jumlahBaik" class="mt-1 text-2xl font-bold text-blue-600">
                            0
                        </p>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Kompetensi baik
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i class="ph ph-check-circle text-xl"></i>
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
                        Gunakan filter untuk menampilkan data Skill Passport tertentu.
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
                <div class="lg:col-span-1">

                    <label for="searchSiswa" class="mb-1.5 block text-[11px] font-medium text-slate-600">
                        Cari Siswa
                    </label>

                    <div class="relative">

                        <i
                            class="ph ph-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" id="searchSiswa" placeholder="Nama atau NISN..."
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-xs text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                    </div>

                </div>


                {{-- Tahun Ajaran --}}
                <div>

                    <label for="tahunAjaran" class="mb-1.5 block text-[11px] font-medium text-slate-600">
                        Tahun Ajaran
                    </label>

                    <select id="tahunAjaran"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">Semua Tahun</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>

                    </select>

                </div>


                {{-- Semester --}}
                <div>

                    <label for="semester" class="mb-1.5 block text-[11px] font-medium text-slate-600">
                        Semester
                    </label>

                    <select id="semester"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">Semua Semester</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>

                    </select>

                </div>


                {{-- Kelas --}}
                <div>

                    <label for="kelas" class="mb-1.5 block text-[11px] font-medium text-slate-600">
                        Kelas / Rombel
                    </label>

                    <select id="kelas"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">Semua Kelas</option>
                        <option value="X RPL 1">X RPL 1</option>
                        <option value="X RPL 2">X RPL 2</option>
                        <option value="XI RPL 1">XI RPL 1</option>
                        <option value="XI RPL 2">XI RPL 2</option>
                        <option value="XII RPL 1">XII RPL 1</option>

                    </select>

                </div>


                {{-- Kompetensi --}}
                <div>

                    <label for="skill" class="mb-1.5 block text-[11px] font-medium text-slate-600">
                        Kompetensi / Skill
                    </label>

                    <select id="skill"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-xs text-slate-700 outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                        <option value="">Semua Kompetensi</option>
                        <option value="Pemrograman Web">Pemrograman Web</option>
                        <option value="Basis Data">Basis Data</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="Pemrograman Mobile">Pemrograman Mobile</option>
                        <option value="Jaringan Komputer">Jaringan Komputer</option>

                    </select>

                </div>

            </div>


            {{-- Filter status --}}
            <div id="filterStatus"
                class="mt-4 hidden items-center justify-between gap-3 rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-2.5">

                <div class="flex items-center gap-2 text-[11px] text-indigo-700">

                    <i class="ph ph-funnel"></i>

                    <span>
                        Filter aktif.
                        Menampilkan
                        <strong id="jumlahHasil">0</strong>
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

                        <i class="ph ph-list-dashes text-indigo-500"></i>

                        Daftar Nilai Skill Passport

                    </h2>

                    <p class="mt-1 text-[11px] text-slate-400">
                        Data kompetensi dan keterampilan siswa yang telah dinilai.
                    </p>
                </div>

                <div
                    class="hidden items-center gap-1.5 rounded-lg bg-slate-50 px-3 py-2 text-[11px] text-slate-500 sm:flex">

                    <i class="ph ph-info"></i>

                    Klik <strong>Edit</strong> untuk mengubah data.

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1200px] text-left">

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
                                Kompetensi / Skill
                            </th>

                            <th class="px-4 py-3 text-center">
                                Nilai
                            </th>

                            <th class="px-4 py-3 text-center">
                                Predikat
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


                    <tbody id="skillTableBody" class="divide-y divide-slate-100 text-xs">

                        {{-- =================================================
                            DATA DUMMY
                            Ganti dengan foreach dari database ketika backend
                            Skill Passport sudah tersedia.
                        ================================================== --}}

                        @php
                            $dataSkill = [
                                [
                                    'nisn' => '00654321',
                                    'nama' => 'Ahmad Fauzan',
                                    'kelas' => 'XI RPL 1',
                                    'skill' => 'Pemrograman Web',
                                    'nilai' => 88,
                                    'predikat' => 'Baik',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Ganjil',
                                ],
                                [
                                    'nisn' => '00654322',
                                    'nama' => 'Budi Santoso',
                                    'kelas' => 'XI RPL 1',
                                    'skill' => 'Basis Data',
                                    'nilai' => 92,
                                    'predikat' => 'Sangat Baik',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Ganjil',
                                ],
                                [
                                    'nisn' => '00654323',
                                    'nama' => 'Citra Lestari',
                                    'kelas' => 'XI RPL 1',
                                    'skill' => 'UI/UX Design',
                                    'nilai' => 90,
                                    'predikat' => 'Sangat Baik',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Ganjil',
                                ],
                                [
                                    'nisn' => '00654324',
                                    'nama' => 'Dimas Pratama',
                                    'kelas' => 'XI RPL 2',
                                    'skill' => 'Pemrograman Mobile',
                                    'nilai' => 75,
                                    'predikat' => 'Cukup',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Genap',
                                ],
                                [
                                    'nisn' => '00654325',
                                    'nama' => 'Eka Putri',
                                    'kelas' => 'X RPL 1',
                                    'skill' => 'Jaringan Komputer',
                                    'nilai' => 65,
                                    'predikat' => 'Kurang',
                                    'tahun' => '2026/2027',
                                    'semester' => 'Genap',
                                ],
                            ];
                        @endphp


                        @foreach ($dataSkill as $index => $item)
                            <tr class="skill-row transition hover:bg-slate-50" data-nama="{{ strtolower($item['nama']) }}"
                                data-nisn="{{ strtolower($item['nisn']) }}" data-kelas="{{ strtolower($item['kelas']) }}"
                                data-skill="{{ strtolower($item['skill']) }}" data-tahun="{{ $item['tahun'] }}"
                                data-semester="{{ $item['semester'] }}" data-predikat="{{ $item['predikat'] }}">

                                {{-- No --}}
                                <td class="px-4 py-4 text-center">

                                    <span class="text-[11px] font-medium text-slate-400">
                                        {{ $index + 1 }}
                                    </span>

                                </td>


                                {{-- Siswa --}}
                                <td class="px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                                            <i class="ph ph-student text-lg"></i>

                                        </div>

                                        <div>

                                            <p class="font-semibold text-slate-700">
                                                {{ $item['nama'] }}
                                            </p>

                                            <p class="mt-0.5 text-[10px] text-slate-400">
                                                NISN {{ $item['nisn'] }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Kelas --}}
                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2.5 py-1 text-[10px] font-medium text-slate-600">

                                        <i class="ph ph-users-three"></i>

                                        {{ $item['kelas'] }}

                                    </span>

                                </td>


                                {{-- Skill --}}
                                <td class="px-4 py-4">

                                    <span class="skill-text font-medium text-slate-700">
                                        {{ $item['skill'] }}
                                    </span>

                                    <select
                                        class="skill-input hidden w-full rounded-lg border border-slate-200 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                        <option value="Pemrograman Web"
                                            {{ $item['skill'] === 'Pemrograman Web' ? 'selected' : '' }}>
                                            Pemrograman Web
                                        </option>

                                        <option value="Basis Data"
                                            {{ $item['skill'] === 'Basis Data' ? 'selected' : '' }}>
                                            Basis Data
                                        </option>

                                        <option value="UI/UX Design"
                                            {{ $item['skill'] === 'UI/UX Design' ? 'selected' : '' }}>
                                            UI/UX Design
                                        </option>

                                        <option value="Pemrograman Mobile"
                                            {{ $item['skill'] === 'Pemrograman Mobile' ? 'selected' : '' }}>
                                            Pemrograman Mobile
                                        </option>

                                        <option value="Jaringan Komputer"
                                            {{ $item['skill'] === 'Jaringan Komputer' ? 'selected' : '' }}>
                                            Jaringan Komputer
                                        </option>

                                    </select>

                                </td>


                                {{-- Nilai --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="nilai-text inline-flex min-w-[42px] items-center justify-center rounded-lg bg-indigo-50 px-2.5 py-1.5 font-bold text-indigo-700">
                                        {{ $item['nilai'] }}
                                    </span>

                                    <input type="number" min="0" max="100" value="{{ $item['nilai'] }}"
                                        class="nilai-input hidden w-20 rounded-lg border border-slate-200 px-2.5 py-2 text-center text-xs font-semibold outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                </td>


                                {{-- Predikat --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="predikat-text inline-flex items-center gap-1 rounded-full px-3 py-1 text-[10px] font-semibold">
                                        {{ $item['predikat'] }}
                                    </span>

                                    <select
                                        class="predikat-input hidden rounded-lg border border-slate-200 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                        <option value="Sangat Baik"
                                            {{ $item['predikat'] === 'Sangat Baik' ? 'selected' : '' }}>
                                            Sangat Baik
                                        </option>

                                        <option value="Baik" {{ $item['predikat'] === 'Baik' ? 'selected' : '' }}>
                                            Baik
                                        </option>

                                        <option value="Cukup" {{ $item['predikat'] === 'Cukup' ? 'selected' : '' }}>
                                            Cukup
                                        </option>

                                        <option value="Kurang" {{ $item['predikat'] === 'Kurang' ? 'selected' : '' }}>
                                            Kurang
                                        </option>

                                    </select>

                                </td>


                                {{-- Tahun --}}
                                <td class="px-4 py-4">

                                    <span class="tahun-text text-slate-600">
                                        {{ $item['tahun'] }}
                                    </span>

                                    <select
                                        class="tahun-input hidden rounded-lg border border-slate-200 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                        <option value="2025/2026" {{ $item['tahun'] === '2025/2026' ? 'selected' : '' }}>
                                            2025/2026
                                        </option>

                                        <option value="2026/2027" {{ $item['tahun'] === '2026/2027' ? 'selected' : '' }}>
                                            2026/2027
                                        </option>

                                    </select>

                                </td>


                                {{-- Semester --}}
                                <td class="px-4 py-4">

                                    <span class="semester-text text-slate-600">
                                        {{ $item['semester'] }}
                                    </span>

                                    <select
                                        class="semester-input hidden rounded-lg border border-slate-200 bg-white px-2.5 py-2 text-xs outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                        <option value="Ganjil" {{ $item['semester'] === 'Ganjil' ? 'selected' : '' }}>
                                            Ganjil
                                        </option>

                                        <option value="Genap" {{ $item['semester'] === 'Genap' ? 'selected' : '' }}>
                                            Genap
                                        </option>

                                    </select>

                                </td>


                                {{-- Aksi --}}
                                <td class="px-4 py-4">

                                    <div class="flex items-center justify-center gap-1.5">

                                        {{-- Edit --}}
                                        <button type="button" onclick="editData(this)"
                                            class="edit-button inline-flex items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-2.5 py-2 text-[10px] font-semibold text-indigo-600 transition hover:border-indigo-300 hover:bg-indigo-100">

                                            <i class="ph ph-pencil-simple"></i>

                                            Edit

                                        </button>


                                        {{-- Simpan --}}
                                        <button type="button" onclick="saveData(this)"
                                            class="save-button hidden inline-flex items-center gap-1.5 rounded-lg border border-green-200 bg-green-50 px-2.5 py-2 text-[10px] font-semibold text-green-600 transition hover:border-green-300 hover:bg-green-100">

                                            <i class="ph ph-check"></i>

                                            Simpan

                                        </button>


                                        {{-- Batal --}}
                                        <button type="button" onclick="cancelEdit(this)"
                                            class="cancel-button hidden inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-2 text-[10px] font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-100">

                                            <i class="ph ph-x"></i>

                                            Batal

                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforeach


                        {{-- Empty State --}}
                        <tr id="emptyState" class="hidden">

                            <td colspan="9" class="px-6 py-14 text-center">

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


            {{-- Table Footer --}}
            <div
                class="flex flex-col gap-2 border-t border-slate-100 px-5 py-3 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-[11px] text-slate-400">

                    Menampilkan
                    <span id="footerJumlahData" class="font-semibold text-slate-600">
                        0
                    </span>
                    data Skill Passport

                </p>

                <p class="text-[10px] text-slate-400">
                    Data dapat diedit langsung melalui tombol Edit.
                </p>

            </div>

        </div>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const searchSiswa = document.getElementById('searchSiswa');
            const tahunAjaran = document.getElementById('tahunAjaran');
            const semester = document.getElementById('semester');
            const kelas = document.getElementById('kelas');
            const skill = document.getElementById('skill');

            /*
             * ---------------------------------------------------------
             * WARNA PREDIKAT
             * ---------------------------------------------------------
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

                        break;

                }

            }


            /*
             * ---------------------------------------------------------
             * UPDATE WARNA SEMUA PREDIKAT SAAT LOAD
             * ---------------------------------------------------------
             */

            document.querySelectorAll('.skill-row').forEach(function(row) {

                const predikatText =
                    row.querySelector('.predikat-text');

                if (predikatText) {

                    updatePredikatStyle(
                        predikatText,
                        predikatText.textContent.trim()
                    );

                }

            });


            /*
             * ---------------------------------------------------------
             * FILTER DATA
             * ---------------------------------------------------------
             */

            window.filterData = function() {

                const search =
                    searchSiswa.value.toLowerCase().trim();

                const tahun =
                    tahunAjaran.value;

                const semesterValue =
                    semester.value;

                const kelasValue =
                    kelas.value.toLowerCase();

                const skillValue =
                    skill.value.toLowerCase();


                const rows =
                    document.querySelectorAll('.skill-row');


                let jumlah = 0;
                let sangatBaik = 0;
                let baik = 0;

                let filterAktif =
                    search !== '' ||
                    tahun !== '' ||
                    semesterValue !== '' ||
                    kelasValue !== '' ||
                    skillValue !== '';


                rows.forEach(function(row) {

                    const nama =
                        row.dataset.nama || '';

                    const nisn =
                        row.dataset.nisn || '';

                    const rowKelas =
                        row.dataset.kelas || '';

                    const rowSkill =
                        row.dataset.skill || '';

                    const rowTahun =
                        row.dataset.tahun || '';

                    const rowSemester =
                        row.dataset.semester || '';

                    const rowPredikat =
                        row.dataset.predikat || '';


                    const cocokSearch =
                        search === '' ||
                        nama.includes(search) ||
                        nisn.includes(search);


                    const cocokTahun =
                        tahun === '' ||
                        rowTahun === tahun;


                    const cocokSemester =
                        semesterValue === '' ||
                        rowSemester === semesterValue;


                    const cocokKelas =
                        kelasValue === '' ||
                        rowKelas === kelasValue;


                    const cocokSkill =
                        skillValue === '' ||
                        rowSkill === skillValue;


                    const tampil =
                        cocokSearch &&
                        cocokTahun &&
                        cocokSemester &&
                        cocokKelas &&
                        cocokSkill;


                    row.style.display =
                        tampil ? '' : 'none';


                    if (tampil) {

                        jumlah++;


                        if (rowPredikat === 'Sangat Baik') {
                            sangatBaik++;
                        }

                        if (rowPredikat === 'Baik') {
                            baik++;
                        }

                    }

                });


                /*
                 * -----------------------------------------------------
                 * UPDATE STATISTIK
                 * -----------------------------------------------------
                 */

                document.getElementById('jumlahData').textContent =
                    jumlah;

                document.getElementById('jumlahSangatBaik').textContent =
                    sangatBaik;

                document.getElementById('jumlahBaik').textContent =
                    baik;


                document.getElementById('footerJumlahData').textContent =
                    jumlah;


                const jumlahHasil =
                    document.getElementById('jumlahHasil');

                if (jumlahHasil) {
                    jumlahHasil.textContent = jumlah;
                }


                /*
                 * -----------------------------------------------------
                 * FILTER STATUS
                 * -----------------------------------------------------
                 */

                const filterStatus =
                    document.getElementById('filterStatus');


                if (filterStatus) {

                    filterStatus.classList.toggle(
                        'hidden',
                        !filterAktif
                    );

                    filterStatus.classList.toggle(
                        'flex',
                        filterAktif
                    );

                }


                /*
                 * -----------------------------------------------------
                 * EMPTY STATE
                 * -----------------------------------------------------
                 */

                const emptyState =
                    document.getElementById('emptyState');


                if (emptyState) {

                    emptyState.classList.toggle(
                        'hidden',
                        jumlah !== 0
                    );

                }

            };


            /*
             * ---------------------------------------------------------
             * RESET FILTER
             * ---------------------------------------------------------
             */

            window.resetFilter = function() {

                searchSiswa.value = '';
                tahunAjaran.value = '';
                semester.value = '';
                kelas.value = '';
                skill.value = '';

                filterData();

            };


            /*
             * ---------------------------------------------------------
             * EVENT FILTER
             * ---------------------------------------------------------
             */

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

            skill.addEventListener(
                'change',
                filterData
            );


            /*
             * ---------------------------------------------------------
             * EDIT DATA
             * ---------------------------------------------------------
             */

            window.editData = function(button) {

                const row =
                    button.closest('.skill-row');


                /*
                 * Simpan nilai lama
                 */

                row.dataset.oldSkill =
                    row.querySelector('.skill-input').value;

                row.dataset.oldNilai =
                    row.querySelector('.nilai-input').value;

                row.dataset.oldPredikat =
                    row.querySelector('.predikat-input').value;

                row.dataset.oldTahun =
                    row.querySelector('.tahun-input').value;

                row.dataset.oldSemester =
                    row.querySelector('.semester-input').value;


                /*
                 * Tampilkan input
                 */

                row.querySelector('.skill-text')
                    .classList.add('hidden');

                row.querySelector('.skill-input')
                    .classList.remove('hidden');


                row.querySelector('.nilai-text')
                    .classList.add('hidden');

                row.querySelector('.nilai-input')
                    .classList.remove('hidden');


                row.querySelector('.predikat-text')
                    .classList.add('hidden');

                row.querySelector('.predikat-input')
                    .classList.remove('hidden');


                row.querySelector('.tahun-text')
                    .classList.add('hidden');

                row.querySelector('.tahun-input')
                    .classList.remove('hidden');


                row.querySelector('.semester-text')
                    .classList.add('hidden');

                row.querySelector('.semester-input')
                    .classList.remove('hidden');


                /*
                 * Tombol
                 */

                row.querySelector('.edit-button')
                    .classList.add('hidden');

                row.querySelector('.save-button')
                    .classList.remove('hidden');

                row.querySelector('.cancel-button')
                    .classList.remove('hidden');

            };


            /*
             * ---------------------------------------------------------
             * SIMPAN DATA
             * ---------------------------------------------------------
             */

            window.saveData = function(button) {

                const row =
                    button.closest('.skill-row');


                const skillInput =
                    row.querySelector('.skill-input');

                const nilaiInput =
                    row.querySelector('.nilai-input');

                const predikatInput =
                    row.querySelector('.predikat-input');

                const tahunInput =
                    row.querySelector('.tahun-input');

                const semesterInput =
                    row.querySelector('.semester-input');


                const nilai =
                    Number(nilaiInput.value);


                /*
                 * Validasi nilai
                 */

                if (
                    nilaiInput.value === '' ||
                    nilai < 0 ||
                    nilai > 100
                ) {

                    alert(
                        'Nilai harus berada di antara 0 sampai 100.'
                    );

                    nilaiInput.focus();

                    return;

                }


                /*
                 * Update text
                 */

                row.querySelector('.skill-text')
                    .textContent =
                    skillInput.value;


                row.querySelector('.nilai-text')
                    .textContent =
                    nilai;


                const predikatText =
                    row.querySelector('.predikat-text');


                predikatText.textContent =
                    predikatInput.value;


                row.querySelector('.tahun-text')
                    .textContent =
                    tahunInput.value;


                row.querySelector('.semester-text')
                    .textContent =
                    semesterInput.value;


                /*
                 * Update dataset
                 */

                row.dataset.skill =
                    skillInput.value.toLowerCase();

                row.dataset.nilai =
                    nilai;

                row.dataset.predikat =
                    predikatInput.value;

                row.dataset.tahun =
                    tahunInput.value;

                row.dataset.semester =
                    semesterInput.value;


                /*
                 * Update warna predikat
                 */

                updatePredikatStyle(
                    predikatText,
                    predikatInput.value
                );


                /*
                 * Kembalikan tampilan normal
                 */

                row.querySelector('.skill-text')
                    .classList.remove('hidden');

                skillInput.classList.add('hidden');


                row.querySelector('.nilai-text')
                    .classList.remove('hidden');

                nilaiInput.classList.add('hidden');


                predikatText
                    .classList.remove('hidden');

                predikatInput.classList.add('hidden');


                row.querySelector('.tahun-text')
                    .classList.remove('hidden');

                tahunInput.classList.add('hidden');


                row.querySelector('.semester-text')
                    .classList.remove('hidden');

                semesterInput.classList.add('hidden');


                /*
                 * Tombol
                 */

                row.querySelector('.edit-button')
                    .classList.remove('hidden');

                row.querySelector('.save-button')
                    .classList.add('hidden');

                row.querySelector('.cancel-button')
                    .classList.add('hidden');


                /*
                 * Refresh statistik/filter
                 */

                filterData();


                alert(
                    'Data Skill Passport berhasil diubah.'
                );

            };


            /*
             * ---------------------------------------------------------
             * BATAL EDIT
             * ---------------------------------------------------------
             */

            window.cancelEdit = function(button) {

                const row =
                    button.closest('.skill-row');


                /*
                 * Ambil nilai lama
                 */

                const oldSkill =
                    row.dataset.oldSkill;

                const oldNilai =
                    row.dataset.oldNilai;

                const oldPredikat =
                    row.dataset.oldPredikat;

                const oldTahun =
                    row.dataset.oldTahun;

                const oldSemester =
                    row.dataset.oldSemester;


                /*
                 * Kembalikan input
                 */

                row.querySelector('.skill-input')
                    .value = oldSkill;

                row.querySelector('.nilai-input')
                    .value = oldNilai;

                row.querySelector('.predikat-input')
                    .value = oldPredikat;

                row.querySelector('.tahun-input')
                    .value = oldTahun;

                row.querySelector('.semester-input')
                    .value = oldSemester;


                /*
                 * Kembalikan text
                 */

                row.querySelector('.skill-text')
                    .textContent = oldSkill;


                row.querySelector('.nilai-text')
                    .textContent = oldNilai;


                const predikatText =
                    row.querySelector('.predikat-text');


                predikatText.textContent =
                    oldPredikat;


                row.querySelector('.tahun-text')
                    .textContent = oldTahun;


                row.querySelector('.semester-text')
                    .textContent = oldSemester;


                /*
                 * Kembalikan dataset
                 */

                row.dataset.skill =
                    oldSkill.toLowerCase();

                row.dataset.nilai =
                    oldNilai;

                row.dataset.predikat =
                    oldPredikat;

                row.dataset.tahun =
                    oldTahun;

                row.dataset.semester =
                    oldSemester;


                /*
                 * Kembalikan warna predikat
                 */

                updatePredikatStyle(
                    predikatText,
                    oldPredikat
                );


                /*
                 * Kembalikan tampilan normal
                 */

                row.querySelector('.skill-text')
                    .classList.remove('hidden');

                row.querySelector('.skill-input')
                    .classList.add('hidden');


                row.querySelector('.nilai-text')
                    .classList.remove('hidden');

                row.querySelector('.nilai-input')
                    .classList.add('hidden');


                predikatText
                    .classList.remove('hidden');

                row.querySelector('.predikat-input')
                    .classList.add('hidden');


                row.querySelector('.tahun-text')
                    .classList.remove('hidden');

                row.querySelector('.tahun-input')
                    .classList.add('hidden');


                row.querySelector('.semester-text')
                    .classList.remove('hidden');

                row.querySelector('.semester-input')
                    .classList.add('hidden');


                /*
                 * Tombol
                 */

                row.querySelector('.edit-button')
                    .classList.remove('hidden');

                row.querySelector('.save-button')
                    .classList.add('hidden');

                row.querySelector('.cancel-button')
                    .classList.add('hidden');

            };


            /*
             * ---------------------------------------------------------
             * FILTER PERTAMA KALI
             * ---------------------------------------------------------
             */

            filterData();

        });
    </script>
@endsection
