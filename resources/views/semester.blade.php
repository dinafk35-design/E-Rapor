@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- HEADER --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-5 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Semester'],
            ]" />

            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10">
                    <i class="ph ph-calendar-dots text-2xl"></i>
                </div>

                <div>
                    <h1 class="text-lg font-bold">
                        Semester
                    </h1>

                    <p class="mt-1 max-w-2xl text-xs leading-relaxed text-indigo-100">
                        Kelola periode semester dan tahun ajaran yang digunakan
                        dalam proses akademik dan penilaian E-Rapor SMK.
                    </p>
                </div>
            </div>

        </div>


        {{-- RINGKASAN --}}
        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- TOTAL SEMESTER --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Total Semester
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                            4
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Periode tersedia
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50">
                        <i class="ph ph-calendar-dots text-xl text-indigo-600"></i>
                    </div>

                </div>
            </div>


            {{-- SEMESTER AKTIF --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Semester Aktif
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-emerald-600">
                            Ganjil
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Sedang berlangsung
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                        <i class="ph ph-check-circle text-xl text-emerald-600"></i>
                    </div>

                </div>
            </div>


            {{-- TAHUN AJARAN --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Tahun Ajaran Aktif
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-blue-600">
                            2026/2027
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Periode akademik aktif
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50">
                        <i class="ph ph-calendar text-xl text-blue-600"></i>
                    </div>

                </div>
            </div>

        </div>


        {{-- FILTER --}}
        <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-sm font-bold text-slate-800">
                        Filter Semester
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Gunakan filter untuk menampilkan periode semester tertentu.
                    </p>
                </div>

                <span id="filterStatus"
                    class="hidden inline-flex w-fit items-center gap-1 rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-600">

                    <i class="ph ph-funnel"></i>
                    Filter aktif

                </span>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                {{-- TAHUN AJARAN --}}
                <div>
                    <label for="filterTahun" class="mb-2 block text-xs font-semibold text-slate-700">

                        Tahun Ajaran

                    </label>

                    <div class="relative">
                        <i class="ph ph-calendar absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <select id="filterTahun"
                            class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-9 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                Semua Tahun Ajaran
                            </option>

                            <option value="2026/2027">
                                2026/2027
                            </option>

                            <option value="2025/2026">
                                2025/2026
                            </option>

                        </select>

                        <i
                            class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    </div>
                </div>


                {{-- SEMESTER --}}
                <div>
                    <label for="filterSemester" class="mb-2 block text-xs font-semibold text-slate-700">

                        Semester

                    </label>

                    <div class="relative">
                        <i class="ph ph-books absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <select id="filterSemester"
                            class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-9 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

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

                        <i
                            class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    </div>
                </div>


                {{-- STATUS --}}
                <div>
                    <label for="filterStatusSemester" class="mb-2 block text-xs font-semibold text-slate-700">

                        Status

                    </label>

                    <div class="relative">
                        <i class="ph ph-activity absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <select id="filterStatusSemester"
                            class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-9 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="aktif">
                                Aktif
                            </option>

                            <option value="terjadwal">
                                Terjadwal
                            </option>

                            <option value="selesai">
                                Selesai
                            </option>

                        </select>

                        <i
                            class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                    </div>
                </div>

            </div>


            {{-- RESET --}}
            <div class="mt-4 flex justify-end">

                <button type="button" onclick="resetSemesterFilter()"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">

                    <i class="ph ph-arrow-counter-clockwise"></i>
                    Reset Filter

                </button>

            </div>

        </div>


        {{-- TABEL --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div
                class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50">
                            <i class="ph ph-calendar-dots text-indigo-600"></i>
                        </div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Daftar Semester
                        </h2>

                    </div>

                    <p class="mt-1 text-xs text-slate-500">
                        Daftar periode semester yang tersedia dalam sistem E-Rapor.
                    </p>
                </div>


                <div class="flex items-center gap-2">

                    <span id="semesterResultCount"
                        class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold text-slate-600">

                        <i class="ph ph-list-dashes"></i>
                        4 data ditampilkan

                    </span>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px] text-left text-sm">

                    <thead class="bg-slate-50 text-[10px] uppercase tracking-wide text-slate-500">

                        <tr>
                            <th class="px-5 py-3.5 font-semibold">
                                No
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Semester
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Tahun Ajaran
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Periode
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Status
                            </th>
                        </tr>

                    </thead>


                    <tbody id="semesterTableBody" class="divide-y divide-slate-100">

                        {{-- GANJIL 2026/2027 --}}
                        <tr data-semester-row data-year="2026/2027" data-semester="Ganjil" data-status="aktif"
                            class="transition hover:bg-slate-50">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                1
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50">
                                        <i class="ph ph-calendar-check text-sm text-indigo-600"></i>
                                    </div>

                                    <div>
                                        <div class="text-xs font-semibold text-slate-800">
                                            Ganjil
                                        </div>

                                        <div class="mt-0.5 text-[10px] text-slate-400">
                                            Semester 1
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                2026/2027
                            </td>

                            <td class="px-5 py-4 text-xs text-slate-600">
                                01 Juli 2026 - 19 Desember 2026
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold text-emerald-700">
                                    <i class="ph ph-check-circle"></i>
                                    Aktif
                                </span>

                            </td>

                        </tr>


                        {{-- GENAP 2026/2027 --}}
                        <tr data-semester-row data-year="2026/2027" data-semester="Genap" data-status="terjadwal"
                            class="transition hover:bg-slate-50">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                2
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50">
                                        <i class="ph ph-calendar text-sm text-blue-600"></i>
                                    </div>

                                    <div>
                                        <div class="text-xs font-semibold text-slate-800">
                                            Genap
                                        </div>

                                        <div class="mt-0.5 text-[10px] text-slate-400">
                                            Semester 2
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                2026/2027
                            </td>

                            <td class="px-5 py-4 text-xs text-slate-600">
                                04 Januari 2027 - 30 Juni 2027
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-[11px] font-semibold text-blue-700">
                                    <i class="ph ph-clock"></i>
                                    Terjadwal
                                </span>

                            </td>

                        </tr>


                        {{-- GANJIL 2025/2026 --}}
                        <tr data-semester-row data-year="2025/2026" data-semester="Ganjil" data-status="selesai"
                            class="transition hover:bg-slate-50">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                3
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100">
                                        <i class="ph ph-calendar-x text-sm text-slate-500"></i>
                                    </div>

                                    <div>
                                        <div class="text-xs font-semibold text-slate-800">
                                            Ganjil
                                        </div>

                                        <div class="mt-0.5 text-[10px] text-slate-400">
                                            Semester 1
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                2025/2026
                            </td>

                            <td class="px-5 py-4 text-xs text-slate-600">
                                01 Juli 2025 - 19 Desember 2025
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold text-slate-600">
                                    <i class="ph ph-check"></i>
                                    Selesai
                                </span>

                            </td>

                        </tr>


                        {{-- GENAP 2025/2026 --}}
                        <tr data-semester-row data-year="2025/2026" data-semester="Genap" data-status="selesai"
                            class="transition hover:bg-slate-50">

                            <td class="px-5 py-4 text-xs text-slate-500">
                                4
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100">
                                        <i class="ph ph-calendar-x text-sm text-slate-500"></i>
                                    </div>

                                    <div>
                                        <div class="text-xs font-semibold text-slate-800">
                                            Genap
                                        </div>

                                        <div class="mt-0.5 text-[10px] text-slate-400">
                                            Semester 2
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                2025/2026
                            </td>

                            <td class="px-5 py-4 text-xs text-slate-600">
                                05 Januari 2026 - 30 Juni 2026
                            </td>

                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold text-slate-600">
                                    <i class="ph ph-check"></i>
                                    Selesai
                                </span>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- EMPTY STATE --}}
            <div id="semesterEmptyState" class="hidden border-t border-slate-100 px-6 py-12 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">
                    <i class="ph ph-calendar-x text-xl text-slate-400"></i>
                </div>

                <p class="mt-3 text-sm font-semibold text-slate-600">
                    Data semester tidak ditemukan
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Coba ubah kombinasi filter yang digunakan.
                </p>

            </div>


            {{-- FOOTER --}}
            <div class="flex justify-between border-t border-slate-100 px-5 py-4">

                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                    <i class="ph ph-arrow-left"></i>
                    Kembali ke Dashboard

                </a>

            </div>

        </div>

    </div>


    <script>
        const filterTahun = document.getElementById('filterTahun');
        const filterSemester = document.getElementById('filterSemester');
        const filterStatusSemester = document.getElementById('filterStatusSemester');

        function applySemesterFilter() {

            const year = filterTahun.value;
            const semester = filterSemester.value;
            const status = filterStatusSemester.value;

            const rows = document.querySelectorAll('[data-semester-row]');
            const emptyState = document.getElementById('semesterEmptyState');
            const resultCount = document.getElementById('semesterResultCount');
            const filterStatus = document.getElementById('filterStatus');

            let visibleRows = 0;

            rows.forEach(function(row) {

                const matchesYear = !year ||
                    row.dataset.year === year;

                const matchesSemester = !semester ||
                    row.dataset.semester === semester;

                const matchesStatus = !status ||
                    row.dataset.status === status;

                const isVisible =
                    matchesYear &&
                    matchesSemester &&
                    matchesStatus;

                row.classList.toggle('hidden', !isVisible);

                if (isVisible) {
                    visibleRows++;
                }

            });


            // JUMLAH HASIL
            resultCount.innerHTML = `
            <i class="ph ph-list-dashes"></i>
            ${visibleRows} data ditampilkan
        `;


            // EMPTY STATE
            emptyState.classList.toggle(
                'hidden',
                visibleRows !== 0
            );


            // STATUS FILTER
            const filterAktif =
                year !== '' ||
                semester !== '' ||
                status !== '';

            filterStatus.classList.toggle(
                'hidden',
                !filterAktif
            );

        }


        function resetSemesterFilter() {

            filterTahun.value = '';
            filterSemester.value = '';
            filterStatusSemester.value = '';

            applySemesterFilter();

        }


        // FILTER OTOMATIS
        filterTahun.addEventListener(
            'change',
            applySemesterFilter
        );

        filterSemester.addEventListener(
            'change',
            applySemesterFilter
        );

        filterStatusSemester.addEventListener(
            'change',
            applySemesterFilter
        );


        // LOAD AWAL
        applySemesterFilter();
    </script>
@endsection
