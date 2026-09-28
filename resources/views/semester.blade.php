@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Semester
        </h2>

        <p>
            Kelola periode semester dan tahun ajaran pada sistem E-Rapor SMK.
        </p>
    </div>


    <!-- RINGKASAN -->
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">

        <!-- TOTAL SEMESTER -->
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Semester
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-blue-600">
                        6
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                    <i class="ph ph-calendar-dots text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>


        <!-- SEMESTER AKTIF -->
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Semester Aktif
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-green-600">
                        Ganjil
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                    <i class="ph ph-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
        </div>


        <!-- TAHUN AJARAN -->
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Tahun Ajaran Aktif
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                        2026/2027
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100">
                    <i class="ph ph-calendar text-2xl text-indigo-600"></i>
                </div>
            </div>
        </div>

    </div>


    <!-- FILTER -->
    <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <!-- TAHUN AJARAN -->
            <div>
                <label for="filterTahun" class="mb-2 block text-sm font-semibold text-gray-700">
                    Tahun Ajaran
                </label>

                <select
                    id="filterTahun"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <option value="">Semua Tahun Ajaran</option>
                    <option value="2026/2027">2026/2027</option>
                    <option value="2025/2026">2025/2026</option>

                </select>
            </div>


            <!-- SEMESTER -->
            <div>
                <label for="filterSemester" class="mb-2 block text-sm font-semibold text-gray-700">
                    Semester
                </label>

                <select
                    id="filterSemester"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <option value="">Semua Semester</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>

                </select>
            </div>


            <!-- STATUS -->
            <div>
                <label for="filterStatus" class="mb-2 block text-sm font-semibold text-gray-700">
                    Status
                </label>

                <select
                    id="filterStatus"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="terjadwal">Terjadwal</option>
                    <option value="selesai">Selesai</option>

                </select>
            </div>

        </div>


        <div class="mt-5 flex flex-wrap gap-3">

            <button
                type="button"
                onclick="applySemesterFilter()"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                <i class="ph ph-magnifying-glass mr-1"></i>
                Tampilkan

            </button>


            <button
                type="button"
                onclick="resetSemesterFilter()"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                Reset

            </button>

        </div>

    </div>


    <!-- TABEL SEMESTER -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">

        <div class="flex flex-col gap-2 border-b border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    Daftar Semester
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Daftar periode semester yang tersedia dalam sistem.
                </p>
            </div>

            <span id="semesterResultCount" class="text-sm text-gray-500">
                4 data ditampilkan
            </span>
        </div>


        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left text-sm">

                <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Semester</th>
                        <th class="px-6 py-4">Tahun Ajaran</th>
                        <th class="px-6 py-4">Periode</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>


                <tbody id="semesterTableBody" class="divide-y divide-gray-200">

                    <!-- SEMESTER GANJIL 2026/2027 -->
                    <tr
                        data-semester-row
                        data-year="2026/2027"
                        data-semester="Ganjil"
                        data-status="aktif"
                        class="transition hover:bg-gray-50">

                        <td class="px-6 py-5">1</td>
                        <td class="px-6 py-5">
                            <div class="font-semibold text-gray-800">Ganjil</div>
                        </td>
                        <td class="px-6 py-5">2026/2027</td>
                        <td class="px-6 py-5">01 Juli 2026 - 19 Desember 2026</td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                <i class="ph ph-check-circle"></i>
                                Aktif
                            </span>
                        </td>
                    </tr>


                    <!-- SEMESTER GENAP 2026/2027 -->
                    <tr
                        data-semester-row
                        data-year="2026/2027"
                        data-semester="Genap"
                        data-status="terjadwal"
                        class="transition hover:bg-gray-50">

                        <td class="px-6 py-5">2</td>
                        <td class="px-6 py-5">
                            <div class="font-semibold text-gray-800">Genap</div>
                        </td>
                        <td class="px-6 py-5">2026/2027</td>
                        <td class="px-6 py-5">04 Januari 2027 - 30 Juni 2027</td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                <i class="ph ph-clock"></i>
                                Terjadwal
                            </span>
                        </td>
                    </tr>


                    <!-- SEMESTER GANJIL 2025/2026 -->
                    <tr
                        data-semester-row
                        data-year="2025/2026"
                        data-semester="Ganjil"
                        data-status="selesai"
                        class="transition hover:bg-gray-50">

                        <td class="px-6 py-5">3</td>
                        <td class="px-6 py-5">
                            <div class="font-semibold text-gray-800">Ganjil</div>
                        </td>
                        <td class="px-6 py-5">2025/2026</td>
                        <td class="px-6 py-5">01 Juli 2025 - 19 Desember 2025</td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                <i class="ph ph-check"></i>
                                Selesai
                            </span>
                        </td>
                    </tr>


                    <!-- SEMESTER GENAP 2025/2026 -->
                    <tr
                        data-semester-row
                        data-year="2025/2026"
                        data-semester="Genap"
                        data-status="selesai"
                        class="transition hover:bg-gray-50">

                        <td class="px-6 py-5">4</td>
                        <td class="px-6 py-5">
                            <div class="font-semibold text-gray-800">Genap</div>
                        </td>
                        <td class="px-6 py-5">2025/2026</td>
                        <td class="px-6 py-5">05 Januari 2026 - 30 Juni 2026</td>
                        <td class="px-6 py-5 text-center">
                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                <i class="ph ph-check"></i>
                                Selesai
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>


        <div id="semesterEmptyState" class="hidden px-6 py-10 text-center">
            <i class="ph ph-magnifying-glass text-3xl text-gray-400"></i>
            <p class="mt-2 text-sm text-gray-500">Data semester tidak ditemukan.</p>
        </div>


        <div class="border-t border-gray-200 px-6 py-4">
            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center rounded-lg bg-gray-500 px-5 py-2 text-sm font-semibold text-white transition hover:bg-gray-600">

                <i class="ph ph-arrow-left mr-1"></i>
                Kembali ke Dashboard

            </a>
        </div>

    </div>

</div>

<script>
    function applySemesterFilter() {
        const year = document.getElementById('filterTahun').value;
        const semester = document.getElementById('filterSemester').value;
        const status = document.getElementById('filterStatus').value;
        const rows = document.querySelectorAll('[data-semester-row]');
        const emptyState = document.getElementById('semesterEmptyState');
        const resultCount = document.getElementById('semesterResultCount');

        let visibleRows = 0;

        rows.forEach((row) => {
            const matchesYear = !year || row.dataset.year === year;
            const matchesSemester = !semester || row.dataset.semester === semester;
            const matchesStatus = !status || row.dataset.status === status;
            const isVisible = matchesYear && matchesSemester && matchesStatus;

            row.classList.toggle('hidden', !isVisible);

            if (isVisible) {
                visibleRows++;
            }
        });

        emptyState.classList.toggle('hidden', visibleRows !== 0);
        resultCount.textContent = `${visibleRows} data ditampilkan`;
    }

    function resetSemesterFilter() {
        document.getElementById('filterTahun').value = '';
        document.getElementById('filterSemester').value = '';
        document.getElementById('filterStatus').value = '';

        applySemesterFilter();
    }
</script>

@endsection
