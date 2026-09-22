@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 p-6">

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
                            🔍
                        </span>

                        <input type="text" placeholder="Cari nama siswa..."
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

                <button type="button"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                    🔍 Cari
                </button>

                <button type="button"
                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                    ↻ Reset
                </button>

                <button type="button"
                    class="ml-auto rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700">
                    <a href="{{ route('input-nilai-create') }}">
                        + Tambah Nilai
                    </a>
                </button>



            </div>
        </div>


        <!-- Tabel Nilai -->
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
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">NISN</th>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">Kelas</th>
                            <th class="px-6 py-4">Mata Pelajaran & Nilai</th>
                            <th class="px-6 py-4 text-center">Tahun Ajaran</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        <!-- SISWA 1 -->
                        <tr class="transition hover:bg-gray-50">

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
                                <div class="space-y-2">

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Pemrograman Web</span>
                                        <span class="font-bold text-green-600">
                                            88
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Basis Data</span>
                                        <span class="font-bold text-green-600">
                                            90
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Matematika</span>
                                        <span class="font-bold text-green-600">
                                            85
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Bahasa Indonesia</span>
                                        <span class="font-bold text-green-600">
                                            87
                                        </span>
                                    </div>

                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                2026/2027
                            </td>

                            <td class="px-6 py-5 text-center">
                                <button type="button"
                                    class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">
                                    ✏ Edit
                                </button>
                            </td>

                        </tr>


                        <!-- SISWA 2 -->
                        <tr class="transition hover:bg-gray-50">

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
                                        <span>Pemrograman Web</span>
                                        <span class="font-bold text-green-600">
                                            92
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Basis Data</span>
                                        <span class="font-bold text-green-600">
                                            87
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Matematika</span>
                                        <span class="font-bold text-green-600">
                                            89
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Bahasa Inggris</span>
                                        <span class="font-bold text-green-600">
                                            91
                                        </span>
                                    </div>

                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                2026/2027
                            </td>

                            <td class="px-6 py-5 text-center">
                                <button type="button"
                                    class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">
                                    ✏ Edit
                                </button>
                            </td>

                        </tr>


                        <!-- SISWA 3 -->
                        <tr class="transition hover:bg-gray-50">

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
                                        <span>Pemrograman Web</span>
                                        <span class="font-bold text-green-600">
                                            86
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Basis Data</span>
                                        <span class="font-bold text-green-600">
                                            90
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Matematika</span>
                                        <span class="font-bold text-green-600">
                                            88
                                        </span>
                                    </div>

                                    <div class="flex items-center justify-between gap-6">
                                        <span>Bahasa Indonesia</span>
                                        <span class="font-bold text-green-600">
                                            89
                                        </span>
                                    </div>

                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                2026/2027
                            </td>

                            <td class="px-6 py-5 text-center">
                                <button type="button"
                                    class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">
                                    ✏ Edit
                                </button>
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
                    <span class="font-semibold text-gray-700">3</span>
                    siswa
                </p>

                <div class="flex gap-2">

                    <button class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                        Sebelumnya
                    </button>

                    <button class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white">
                        1
                    </button>

                    <button class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
                        Berikutnya
                    </button>

                </div>

            </div>

        </div>

    </div>


    ```
@endsection
