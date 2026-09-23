@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">

```
<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Nilai Skill Passport
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Kelola nilai kompetensi dan keterampilan siswa pada Skill Passport.
    </p>
</div>


<!-- FILTER -->
<div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">

        <!-- PENCARIAN -->
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Cari Siswa
            </label>

            <div class="relative">

                <span class="absolute left-3 top-3 text-gray-400">
                    🔍
                </span>

                <input
                    type="text"
                    id="searchSiswa"
                    placeholder="Cari nama / NISN..."
                    class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

            </div>
        </div>


        <!-- TAHUN AJARAN -->
        <div>

            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Tahun Ajaran
            </label>

            <select
                id="filterTahun"
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

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


        <!-- SEMESTER -->
        <div>

            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Semester
            </label>

            <select
                id="filterSemester"
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

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


        <!-- KELAS -->
        <div>

            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Kelas
            </label>

            <select
                id="filterKelas"
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

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

            </select>

        </div>


        <!-- SKILL -->
        <div>

            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Kompetensi / Skill
            </label>

            <select
                id="filterSkill"
                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                <option value="">
                    Semua Skill
                </option>

                <option value="Pemrograman Web">
                    Pemrograman Web
                </option>

                <option value="Basis Data">
                    Basis Data
                </option>

                <option value="UI/UX Design">
                    UI/UX Design
                </option>

                <option value="Pemrograman Mobile">
                    Pemrograman Mobile
                </option>

                <option value="Jaringan Komputer">
                    Jaringan Komputer
                </option>

            </select>

        </div>

    </div>


    <!-- BUTTON -->
    <div class="mt-5 flex flex-wrap gap-3">

        <button
            onclick="filterData()"
            type="button"
            class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

            🔍 Cari

        </button>


        <button
            onclick="resetFilter()"
            type="button"
            class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

            ↻ Reset

        </button>


        <a
            href="{{ route('nilai-skill-passport-create') }}"
            class="ml-auto rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700">

            + Tambah Nilai

        </a>

    </div>

</div>



<!-- TABEL -->
<div class="overflow-hidden rounded-xl bg-white shadow-sm">

    <!-- HEADER TABEL -->
    <div class="border-b border-gray-200 px-6 py-4">

        <h2 class="text-lg font-bold text-gray-800">
            Daftar Nilai Skill Passport
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Data kompetensi dan keterampilan siswa.
        </p>

    </div>


    <!-- TABLE RESPONSIVE -->
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
                        Kompetensi / Skill
                    </th>

                    <th class="px-6 py-4 text-center">
                        Nilai
                    </th>

                    <th class="px-6 py-4 text-center">
                        Predikat
                    </th>

                    <th class="px-6 py-4 text-center">
                        Tahun Ajaran
                    </th>

                    <th class="px-6 py-4 text-center">
                        Semester
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody
                id="tabelSkill"
                class="divide-y divide-gray-200">


                <!-- ================================================= -->
                <!-- DATA 1 -->
                <!-- ================================================= -->

                <tr
                    data-nama="Ahmad Fauzan"
                    data-nisn="00654321"
                    data-tahun="2026/2027"
                    data-semester="Ganjil"
                    data-kelas="XI RPL 1"
                    data-skill="Pemrograman Web"
                    class="skill-row transition hover:bg-gray-50">

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


                    <!-- SKILL -->
                    <td class="px-6 py-5">

                        <span class="skill-text">
                            Pemrograman Web
                        </span>

                        <select
                            class="skill-input hidden w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                            <option value="Pemrograman Web">
                                Pemrograman Web
                            </option>

                            <option value="Basis Data">
                                Basis Data
                            </option>

                            <option value="UI/UX Design">
                                UI/UX Design
                            </option>

                            <option value="Pemrograman Mobile">
                                Pemrograman Mobile
                            </option>

                            <option value="Jaringan Komputer">
                                Jaringan Komputer
                            </option>

                        </select>

                    </td>


                    <!-- NILAI -->
                    <td class="px-6 py-5 text-center">

                        <span class="nilai-text font-bold text-green-600">
                            88
                        </span>

                        <input
                            type="number"
                            min="0"
                            max="100"
                            value="88"
                            class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-2 text-center font-semibold focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    </td>


                    <!-- PREDIKAT -->
                    <td class="px-6 py-5 text-center">

                        <span class="predikat-text rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Baik
                        </span>

                        <select
                            class="predikat-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                            <option value="Sangat Baik">
                                Sangat Baik
                            </option>

                            <option value="Baik" selected>
                                Baik
                            </option>

                            <option value="Cukup">
                                Cukup
                            </option>

                            <option value="Kurang">
                                Kurang
                            </option>

                        </select>

                    </td>


                    <!-- TAHUN -->
                    <td class="px-6 py-5 text-center">

                        <span class="tahun-text">
                            2026/2027
                        </span>

                        <select
                            class="tahun-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                            <option value="2025/2026">
                                2025/2026
                            </option>

                            <option value="2026/2027" selected>
                                2026/2027
                            </option>

                        </select>

                    </td>


                    <!-- SEMESTER -->
                    <td class="px-6 py-5 text-center">

                        <span class="semester-text">
                            Ganjil
                        </span>

                        <select
                            class="semester-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                            <option value="Ganjil" selected>
                                Ganjil
                            </option>

                            <option value="Genap">
                                Genap
                            </option>

                        </select>

                    </td>


                    <!-- AKSI -->
                    <td class="px-6 py-5 text-center">

                        <div class="flex justify-center gap-2">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white hover:bg-yellow-600">

                                ✏ Edit

                            </button>


                            <button
                                type="button"
                                onclick="saveData(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white hover:bg-green-700">

                                💾 Simpan

                            </button>


                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white hover:bg-gray-600">

                                ✕ Batal

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================================= -->
                <!-- DATA 2 -->
                <!-- ================================================= -->

                <tr
                    data-nama="Budi Santoso"
                    data-nisn="00654322"
                    data-tahun="2026/2027"
                    data-semester="Ganjil"
                    data-kelas="XI RPL 1"
                    data-skill="Basis Data"
                    class="skill-row transition hover:bg-gray-50">

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

                        <span class="skill-text">
                            Basis Data
                        </span>

                        <select
                            class="skill-input hidden w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Pemrograman Web">
                                Pemrograman Web
                            </option>

                            <option value="Basis Data" selected>
                                Basis Data
                            </option>

                            <option value="UI/UX Design">
                                UI/UX Design
                            </option>

                            <option value="Pemrograman Mobile">
                                Pemrograman Mobile
                            </option>

                            <option value="Jaringan Komputer">
                                Jaringan Komputer
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="nilai-text font-bold text-green-600">
                            92
                        </span>

                        <input
                            type="number"
                            min="0"
                            max="100"
                            value="92"
                            class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-2 text-center font-semibold">

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="predikat-text rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Sangat Baik
                        </span>

                        <select
                            class="predikat-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Sangat Baik" selected>
                                Sangat Baik
                            </option>

                            <option value="Baik">
                                Baik
                            </option>

                            <option value="Cukup">
                                Cukup
                            </option>

                            <option value="Kurang">
                                Kurang
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="tahun-text">
                            2026/2027
                        </span>

                        <select
                            class="tahun-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="2025/2026">
                                2025/2026
                            </option>

                            <option value="2026/2027" selected>
                                2026/2027
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="semester-text">
                            Ganjil
                        </span>

                        <select
                            class="semester-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Ganjil" selected>
                                Ganjil
                            </option>

                            <option value="Genap">
                                Genap
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <div class="flex justify-center gap-2">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white">

                                ✏ Edit

                            </button>

                            <button
                                type="button"
                                onclick="saveData(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white">

                                💾 Simpan

                            </button>

                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white">

                                ✕ Batal

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================================= -->
                <!-- DATA 3 -->
                <!-- ================================================= -->

                <tr
                    data-nama="Citra Lestari"
                    data-nisn="00654323"
                    data-tahun="2026/2027"
                    data-semester="Ganjil"
                    data-kelas="XI RPL 1"
                    data-skill="UI/UX Design"
                    class="skill-row transition hover:bg-gray-50">

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

                        <span class="skill-text">
                            UI/UX Design
                        </span>

                        <select
                            class="skill-input hidden w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Pemrograman Web">
                                Pemrograman Web
                            </option>

                            <option value="Basis Data">
                                Basis Data
                            </option>

                            <option value="UI/UX Design" selected>
                                UI/UX Design
                            </option>

                            <option value="Pemrograman Mobile">
                                Pemrograman Mobile
                            </option>

                            <option value="Jaringan Komputer">
                                Jaringan Komputer
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="nilai-text font-bold text-green-600">
                            90
                        </span>

                        <input
                            type="number"
                            min="0"
                            max="100"
                            value="90"
                            class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-2 text-center font-semibold">

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="predikat-text rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Sangat Baik
                        </span>

                        <select
                            class="predikat-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Sangat Baik" selected>
                                Sangat Baik
                            </option>

                            <option value="Baik">
                                Baik
                            </option>

                            <option value="Cukup">
                                Cukup
                            </option>

                            <option value="Kurang">
                                Kurang
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="tahun-text">
                            2026/2027
                        </span>

                        <select
                            class="tahun-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="2025/2026">
                                2025/2026
                            </option>

                            <option value="2026/2027" selected>
                                2026/2027
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="semester-text">
                            Ganjil
                        </span>

                        <select
                            class="semester-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Ganjil" selected>
                                Ganjil
                            </option>

                            <option value="Genap">
                                Genap
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <div class="flex justify-center gap-2">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white">

                                ✏ Edit

                            </button>

                            <button
                                type="button"
                                onclick="saveData(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white">

                                💾 Simpan

                            </button>

                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white">

                                ✕ Batal

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================================= -->
                <!-- DATA 4 -->
                <!-- ================================================= -->

                <tr
                    data-nama="Dimas Pratama"
                    data-nisn="00654324"
                    data-tahun="2026/2027"
                    data-semester="Genap"
                    data-kelas="XI RPL 2"
                    data-skill="Pemrograman Mobile"
                    class="skill-row transition hover:bg-gray-50">

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

                        <span class="skill-text">
                            Pemrograman Mobile
                        </span>

                        <select
                            class="skill-input hidden w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Pemrograman Web">
                                Pemrograman Web
                            </option>

                            <option value="Basis Data">
                                Basis Data
                            </option>

                            <option value="UI/UX Design">
                                UI/UX Design
                            </option>

                            <option value="Pemrograman Mobile" selected>
                                Pemrograman Mobile
                            </option>

                            <option value="Jaringan Komputer">
                                Jaringan Komputer
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="nilai-text font-bold text-green-600">
                            85
                        </span>

                        <input
                            type="number"
                            min="0"
                            max="100"
                            value="85"
                            class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-2 text-center font-semibold">

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="predikat-text rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Baik
                        </span>

                        <select
                            class="predikat-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Sangat Baik">
                                Sangat Baik
                            </option>

                            <option value="Baik" selected>
                                Baik
                            </option>

                            <option value="Cukup">
                                Cukup
                            </option>

                            <option value="Kurang">
                                Kurang
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="tahun-text">
                            2026/2027
                        </span>

                        <select
                            class="tahun-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="2025/2026">
                                2025/2026
                            </option>

                            <option value="2026/2027" selected>
                                2026/2027
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="semester-text">
                            Genap
                        </span>

                        <select
                            class="semester-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Ganjil">
                                Ganjil
                            </option>

                            <option value="Genap" selected>
                                Genap
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <div class="flex justify-center gap-2">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white">

                                ✏ Edit

                            </button>

                            <button
                                type="button"
                                onclick="saveData(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white">

                                💾 Simpan

                            </button>

                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white">

                                ✕ Batal

                            </button>

                        </div>

                    </td>

                </tr>



                <!-- ================================================= -->
                <!-- DATA 5 -->
                <!-- ================================================= -->

                <tr
                    data-nama="Eka Putri"
                    data-nisn="00654325"
                    data-tahun="2026/2027"
                    data-semester="Genap"
                    data-kelas="X RPL 1"
                    data-skill="Jaringan Komputer"
                    class="skill-row transition hover:bg-gray-50">

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
                            X RPL 1
                        </span>

                    </td>


                    <td class="px-6 py-5">

                        <span class="skill-text">
                            Jaringan Komputer
                        </span>

                        <select
                            class="skill-input hidden w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Pemrograman Web">
                                Pemrograman Web
                            </option>

                            <option value="Basis Data">
                                Basis Data
                            </option>

                            <option value="UI/UX Design">
                                UI/UX Design
                            </option>

                            <option value="Pemrograman Mobile">
                                Pemrograman Mobile
                            </option>

                            <option value="Jaringan Komputer" selected>
                                Jaringan Komputer
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="nilai-text font-bold text-green-600">
                            87
                        </span>

                        <input
                            type="number"
                            min="0"
                            max="100"
                            value="87"
                            class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-2 text-center font-semibold">

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="predikat-text rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Baik
                        </span>

                        <select
                            class="predikat-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Sangat Baik">
                                Sangat Baik
                            </option>

                            <option value="Baik" selected>
                                Baik
                            </option>

                            <option value="Cukup">
                                Cukup
                            </option>

                            <option value="Kurang">
                                Kurang
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="tahun-text">
                            2026/2027
                        </span>

                        <select
                            class="tahun-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="2025/2026">
                                2025/2026
                            </option>

                            <option value="2026/2027" selected>
                                2026/2027
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <span class="semester-text">
                            Genap
                        </span>

                        <select
                            class="semester-input hidden rounded-lg border border-gray-300 px-3 py-2 text-sm">

                            <option value="Ganjil">
                                Ganjil
                            </option>

                            <option value="Genap" selected>
                                Genap
                            </option>

                        </select>

                    </td>


                    <td class="px-6 py-5 text-center">

                        <div class="flex justify-center gap-2">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white">

                                ✏ Edit

                            </button>

                            <button
                                type="button"
                                onclick="saveData(this)"
                                class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white">

                                💾 Simpan

                            </button>

                            <button
                                type="button"
                                onclick="cancelEdit(this)"
                                class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white">

                                ✕ Batal

                            </button>

                        </div>

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

            data siswa

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

<!-- JAVASCRIPT -->

<!-- ========================================================= -->

<script>


// ============================================================
// FILTER DATA
// ============================================================

function filterData() {

    const search =
        document.getElementById('searchSiswa')
        .value
        .toLowerCase();

    const tahun =
        document.getElementById('filterTahun')
        .value;

    const semester =
        document.getElementById('filterSemester')
        .value;

    const kelas =
        document.getElementById('filterKelas')
        .value;

    const skill =
        document.getElementById('filterSkill')
        .value;


    const rows =
        document.querySelectorAll('#tabelSkill tr');


    let jumlah = 0;


    rows.forEach(row => {

        const nama =
            row.dataset.nama.toLowerCase();

        const nisn =
            row.dataset.nisn.toLowerCase();

        const rowTahun =
            row.dataset.tahun;

        const rowSemester =
            row.dataset.semester;

        const rowKelas =
            row.dataset.kelas;

        const rowSkill =
            row.dataset.skill;


        const cocokSearch =
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

        const cocokSkill =
            skill === '' ||
            rowSkill === skill;


        if (
            cocokSearch &&
            cocokTahun &&
            cocokSemester &&
            cocokKelas &&
            cocokSkill
        ) {

            row.style.display = '';

            jumlah++;

        } else {

            row.style.display = 'none';

        }

    });


    document.getElementById('jumlahData').innerText =
        jumlah;

}



// ============================================================
// RESET FILTER
// ============================================================

function resetFilter() {

    document.getElementById('searchSiswa').value = '';

    document.getElementById('filterTahun').value = '';

    document.getElementById('filterSemester').value = '';

    document.getElementById('filterKelas').value = '';

    document.getElementById('filterSkill').value = '';

    filterData();

}



// ============================================================
// EDIT DATA
// ============================================================

function editData(button) {

    const row = button.closest('tr');


    // Ambil semua input
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


    // Simpan data lama
    row.dataset.oldSkill =
        skillInput.value;

    row.dataset.oldNilai =
        nilaiInput.value;

    row.dataset.oldPredikat =
        predikatInput.value;

    row.dataset.oldTahun =
        tahunInput.value;

    row.dataset.oldSemester =
        semesterInput.value;


    // Tampilkan input
    skillInput.classList.remove('hidden');

    nilaiInput.classList.remove('hidden');

    predikatInput.classList.remove('hidden');

    tahunInput.classList.remove('hidden');

    semesterInput.classList.remove('hidden');


    // Sembunyikan text biasa
    row.querySelector('.skill-text')
        .classList.add('hidden');

    row.querySelector('.nilai-text')
        .classList.add('hidden');

    row.querySelector('.predikat-text')
        .classList.add('hidden');

    row.querySelector('.tahun-text')
        .classList.add('hidden');

    row.querySelector('.semester-text')
        .classList.add('hidden');


    // Tombol
    row.querySelector('.edit-btn')
        .classList.add('hidden');

    row.querySelector('.save-btn')
        .classList.remove('hidden');

    row.querySelector('.cancel-btn')
        .classList.remove('hidden');

}



// ============================================================
// SIMPAN DATA
// ============================================================

function saveData(button) {

    const row = button.closest('tr');


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


    // Validasi nilai
    if (
        nilaiInput.value === '' ||
        nilai < 0 ||
        nilai > 100
    ) {

        alert('Nilai harus berada di antara 0 sampai 100.');

        nilaiInput.focus();

        return;

    }


    // Update tampilan
    row.querySelector('.skill-text')
        .textContent = skillInput.value;

    row.querySelector('.nilai-text')
        .textContent = nilaiInput.value;

    row.querySelector('.predikat-text')
        .textContent = predikatInput.value;

    row.querySelector('.tahun-text')
        .textContent = tahunInput.value;

    row.querySelector('.semester-text')
        .textContent = semesterInput.value;


    // Update data filter
    row.dataset.tahun =
        tahunInput.value;

    row.dataset.semester =
        semesterInput.value;

    row.dataset.skill =
        skillInput.value;


    // Sembunyikan input
    skillInput.classList.add('hidden');

    nilaiInput.classList.add('hidden');

    predikatInput.classList.add('hidden');

    tahunInput.classList.add('hidden');

    semesterInput.classList.add('hidden');


    // Tampilkan text
    row.querySelector('.skill-text')
        .classList.remove('hidden');

    row.querySelector('.nilai-text')
        .classList.remove('hidden');

    row.querySelector('.predikat-text')
        .classList.remove('hidden');

    row.querySelector('.tahun-text')
        .classList.remove('hidden');

    row.querySelector('.semester-text')
        .classList.remove('hidden');


    // Tombol
    row.querySelector('.edit-btn')
        .classList.remove('hidden');

    row.querySelector('.save-btn')
        .classList.add('hidden');

    row.querySelector('.cancel-btn')
        .classList.add('hidden');


    // Hapus data sementara
    delete row.dataset.oldSkill;
    delete row.dataset.oldNilai;
    delete row.dataset.oldPredikat;
    delete row.dataset.oldTahun;
    delete row.dataset.oldSemester;


    alert('Data Skill Passport berhasil diubah.');

}



// ============================================================
// BATAL EDIT
// ============================================================

function cancelEdit(button) {

    const row = button.closest('tr');


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


    // Kembalikan nilai lama
    skillInput.value =
        row.dataset.oldSkill;

    nilaiInput.value =
        row.dataset.oldNilai;

    predikatInput.value =
        row.dataset.oldPredikat;

    tahunInput.value =
        row.dataset.oldTahun;

    semesterInput.value =
        row.dataset.oldSemester;


    // Sembunyikan input
    skillInput.classList.add('hidden');

    nilaiInput.classList.add('hidden');

    predikatInput.classList.add('hidden');

    tahunInput.classList.add('hidden');

    semesterInput.classList.add('hidden');


    // Tampilkan text
    row.querySelector('.skill-text')
        .classList.remove('hidden');

    row.querySelector('.nilai-text')
        .classList.remove('hidden');

    row.querySelector('.predikat-text')
        .classList.remove('hidden');

    row.querySelector('.tahun-text')
        .classList.remove('hidden');

    row.querySelector('.semester-text')
        .classList.remove('hidden');


    // Tombol
    row.querySelector('.edit-btn')
        .classList.remove('hidden');

    row.querySelector('.save-btn')
        .classList.add('hidden');

    row.querySelector('.cancel-btn')
        .classList.add('hidden');


    // Hapus data sementara
    delete row.dataset.oldSkill;
    delete row.dataset.oldNilai;
    delete row.dataset.oldPredikat;
    delete row.dataset.oldTahun;
    delete row.dataset.oldSemester;

}

</script>

@endsection
