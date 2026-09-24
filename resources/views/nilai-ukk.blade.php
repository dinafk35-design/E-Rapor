@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Nilai UKK
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Kelola nilai Uji Kompetensi Keahlian (UKK) siswa.
        </p>
    </div>


    <!-- FILTER -->
    <div class="mb-6 rounded-2xl bg-white p-5 shadow-sm">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">

            <!-- SEARCH SISWA -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Cari Siswa
                </label>

                <input
                    type="text"
                    id="searchSiswa"
                    placeholder="Nama / NISN..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    onkeyup="filterData()"
                >
            </div>


            <!-- TAHUN AJARAN -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Tahun Ajaran
                </label>

                <select
                    id="filterTahun"
                    onchange="filterData()"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

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


            <!-- SEMESTER -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Semester
                </label>

                <select
                    id="filterSemester"
                    onchange="filterData()"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

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
                    onchange="filterData()"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

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


            <!-- KONSENTRASI -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Konsentrasi Keahlian
                </label>

                <select
                    id="filterKonsentrasi"
                    onchange="filterData()"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

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


        <!-- BUTTON -->
        <div class="mt-5 flex flex-wrap items-center justify-between gap-3">

            <div class="flex gap-2">

                <button
                    type="button"
                    onclick="filterData()"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                    <i class="ph ph-magnifying-glass"></i> Cari

                </button>


                <button
                    type="button"
                    onclick="resetFilter()"
                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                    Reset

                </button>

            </div>


            <!-- TAMBAH NILAI -->
            <a
                href="{{ route('nilai-ukk-create') }}"
                class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700">

                + Tambah Nilai

            </a>

        </div>

    </div>


    <!-- TABLE -->
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table
                class="w-full min-w-[1300px] text-left text-sm"
                id="tabelUKK">

                <!-- TABLE HEADER -->
                <thead class="bg-gray-50 text-xs uppercase text-gray-500">

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
                            Konsentrasi Keahlian
                        </th>

                        <th class="px-6 py-4">
                            Nilai UKK
                        </th>

                        <th class="px-6 py-4">
                            Predikat
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4">
                            Tahun Ajaran
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <!-- TABLE BODY -->
                <tbody
                    class="divide-y divide-gray-100"
                    id="bodyUKK">


                    <!-- DATA 1 -->
                    <tr
                        data-nama="Ahmad Fauzan"
                        data-nisn="00654321"
                        data-kelas="XII RPL 1"
                        data-konsentrasi="Rekayasa Perangkat Lunak"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            1
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-700">
                            00654321
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">
                                Ahmad Fauzan
                            </div>
                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                XII RPL 1
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            Rekayasa Perangkat Lunak
                        </td>

                        <td class="px-6 py-4">

                            <span class="font-bold text-green-600">
                                90
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Sangat Baik
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            2026/2027
                        </td>

                        <td class="px-6 py-4 text-center">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>

                        </td>

                    </tr>


                    <!-- DATA 2 -->
                    <tr
                        data-nama="Budi Santoso"
                        data-nisn="00654322"
                        data-kelas="XII RPL 1"
                        data-konsentrasi="Rekayasa Perangkat Lunak"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            2
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-700">
                            00654322
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">
                                Budi Santoso
                            </div>
                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                XII RPL 1
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            Rekayasa Perangkat Lunak
                        </td>

                        <td class="px-6 py-4">

                            <span class="font-bold text-green-600">
                                86
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Baik
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            2026/2027
                        </td>

                        <td class="px-6 py-4 text-center">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>

                        </td>

                    </tr>


                    <!-- DATA 3 -->
                    <tr
                        data-nama="Citra Lestari"
                        data-nisn="00654323"
                        data-kelas="XII RPL 2"
                        data-konsentrasi="Rekayasa Perangkat Lunak"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            3
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-700">
                            00654323
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">
                                Citra Lestari
                            </div>
                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                XII RPL 2
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            Rekayasa Perangkat Lunak
                        </td>

                        <td class="px-6 py-4">

                            <span class="font-bold text-green-600">
                                94
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Sangat Baik
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            2026/2027
                        </td>

                        <td class="px-6 py-4 text-center">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>

                        </td>

                    </tr>


                    <!-- DATA 4 -->
                    <tr
                        data-nama="Dimas Pratama"
                        data-nisn="00654324"
                        data-kelas="XII TKJ 1"
                        data-konsentrasi="Teknik Komputer Jaringan"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            4
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-700">
                            00654324
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">
                                Dimas Pratama
                            </div>
                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                XII TKJ 1
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            Teknik Komputer Jaringan
                        </td>

                        <td class="px-6 py-4">

                            <span class="font-bold text-yellow-600">
                                78
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                Cukup
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            2026/2027
                        </td>

                        <td class="px-6 py-4 text-center">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>

                        </td>

                    </tr>


                    <!-- DATA 5 -->
                    <tr
                        data-nama="Eka Putri"
                        data-nisn="00654325"
                        data-kelas="XII TKJ 2"
                        data-konsentrasi="Teknik Komputer Jaringan"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        class="hover:bg-gray-50">

                        <td class="px-6 py-4">
                            5
                        </td>

                        <td class="px-6 py-4 font-medium text-gray-700">
                            00654325
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-800">
                                Eka Putri
                            </div>
                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                XII TKJ 2
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            Teknik Komputer Jaringan
                        </td>

                        <td class="px-6 py-4">

                            <span class="font-bold text-green-600">
                                89
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Baik
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-4">
                            2026/2027
                        </td>

                        <td class="px-6 py-4 text-center">

                            <button
                                type="button"
                                onclick="editData(this)"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                <i class="ph ph-pencil-simple"></i> Edit

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        <!-- FOOTER -->
        <div class="border-t border-gray-100 px-6 py-4">

            <p class="text-sm text-gray-500">

                Menampilkan
                <span
                    id="jumlahData"
                    class="font-semibold text-gray-800">
                    5
                </span>
                data nilai UKK.

            </p>

        </div>

    </div>

</div>



<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->

<script>

/*
|--------------------------------------------------------------------------
| FILTER DATA
|--------------------------------------------------------------------------
*/

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

    const konsentrasi =
        document.getElementById('filterKonsentrasi')
        .value;


    const rows =
        document.querySelectorAll('#bodyUKK tr');


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

        const rowKonsentrasi =
            row.dataset.konsentrasi;


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

        const cocokKonsentrasi =
            konsentrasi === '' ||
            rowKonsentrasi === konsentrasi;


        if (
            cocokSearch &&
            cocokTahun &&
            cocokSemester &&
            cocokKelas &&
            cocokKonsentrasi
        ) {

            row.style.display = '';

            jumlah++;

        } else {

            row.style.display = 'none';

        }

    });


    document.getElementById('jumlahData')
        .innerText = jumlah;

}



/*
|--------------------------------------------------------------------------
| RESET FILTER
|--------------------------------------------------------------------------
*/

function resetFilter() {

    document.getElementById('searchSiswa').value = '';

    document.getElementById('filterTahun').value = '';

    document.getElementById('filterSemester').value = '';

    document.getElementById('filterKelas').value = '';

    document.getElementById('filterKonsentrasi').value = '';

    filterData();

}



/*
|--------------------------------------------------------------------------
| EDIT DATA
|--------------------------------------------------------------------------
*/

function editData(button) {

    const row =
        button.closest('tr');

    const cells =
        row.querySelectorAll('td');


    /*
    |--------------------------------------------------------------------------
    | Ambil data lama
    |--------------------------------------------------------------------------
    */

    const nama =
        row.dataset.nama;

    const kelas =
        row.dataset.kelas;

    const konsentrasi =
        row.dataset.konsentrasi;

    const nilai =
        cells[5].innerText.trim();

    const predikat =
        cells[6].innerText.trim();

    const status =
        cells[7].innerText.trim();

    const tahun =
        row.dataset.tahun;


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


    row.classList.add('sedang-edit');


    /*
    |--------------------------------------------------------------------------
    | NAMA SISWA
    |--------------------------------------------------------------------------
    */

    cells[2].innerHTML = `
        <input
            type="text"
            value="${nama}"
            class="w-48 rounded-lg border border-blue-400 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-200">
    `;


    /*
    |--------------------------------------------------------------------------
    | KELAS
    |--------------------------------------------------------------------------
    */

    cells[3].innerHTML = `

        <select
            class="w-40 rounded-lg border border-blue-400 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-200">

            <option value="XII RPL 1"
                ${kelas === 'XII RPL 1' ? 'selected' : ''}>
                XII RPL 1
            </option>

            <option value="XII RPL 2"
                ${kelas === 'XII RPL 2' ? 'selected' : ''}>
                XII RPL 2
            </option>

            <option value="XII TKJ 1"
                ${kelas === 'XII TKJ 1' ? 'selected' : ''}>
                XII TKJ 1
            </option>

            <option value="XII TKJ 2"
                ${kelas === 'XII TKJ 2' ? 'selected' : ''}>
                XII TKJ 2
            </option>

        </select>

    `;


    /*
    |--------------------------------------------------------------------------
    | KONSENTRASI
    |--------------------------------------------------------------------------
    */

    cells[4].innerHTML = `

        <select
            class="w-60 rounded-lg border border-blue-400 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-200">

            <option value="Rekayasa Perangkat Lunak"
                ${konsentrasi === 'Rekayasa Perangkat Lunak' ? 'selected' : ''}>
                Rekayasa Perangkat Lunak
            </option>

            <option value="Teknik Komputer Jaringan"
                ${konsentrasi === 'Teknik Komputer Jaringan' ? 'selected' : ''}>
                Teknik Komputer Jaringan
            </option>

        </select>

    `;


    /*
    |--------------------------------------------------------------------------
    | NILAI UKK
    |--------------------------------------------------------------------------
    */

    cells[5].innerHTML = `

        <input
            type="number"
            min="0"
            max="100"
            value="${nilai}"
            class="nilai-ukk w-24 rounded-lg border border-blue-400 px-3 py-2 text-center text-sm font-bold outline-none focus:ring-2 focus:ring-blue-200">

    `;


    /*
    |--------------------------------------------------------------------------
    | PREDIKAT
    |--------------------------------------------------------------------------
    */

    cells[6].innerHTML = `

        <select
            class="w-36 rounded-lg border border-blue-400 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-200">

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

    cells[7].innerHTML = `

        <select
            class="w-36 rounded-lg border border-blue-400 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-200">

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
    | TAHUN AJARAN
    |--------------------------------------------------------------------------
    */

    cells[8].innerHTML = `

        <select
            class="w-36 rounded-lg border border-blue-400 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-200">

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
    | TOMBOL AKSI
    |--------------------------------------------------------------------------
    */

    cells[9].innerHTML = `

        <div class="flex justify-center gap-2">

            <button
                type="button"
                onclick="simpanData(this)"
                class="rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-green-700">

                <i class="ph ph-check"></i> Simpan

            </button>

            <button
                type="button"
                onclick="batalEdit(this)"
                class="rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-gray-600">

                <i class="ph ph-x"></i> Batal

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
        button.closest('tr');

    const cells =
        row.querySelectorAll('td');


    /*
    |--------------------------------------------------------------------------
    | Ambil nilai input
    |--------------------------------------------------------------------------
    */

    const nama =
        cells[2]
        .querySelector('input')
        .value
        .trim();

    const kelas =
        cells[3]
        .querySelector('select')
        .value;

    const konsentrasi =
        cells[4]
        .querySelector('select')
        .value;

    const nilai =
        cells[5]
        .querySelector('input')
        .value;

    const predikat =
        cells[6]
        .querySelector('select')
        .value;

    const status =
        cells[7]
        .querySelector('select')
        .value;

    const tahun =
        cells[8]
        .querySelector('select')
        .value;


    /*
    |--------------------------------------------------------------------------
    | VALIDASI NAMA
    |--------------------------------------------------------------------------
    */

    if (nama === '') {

        alert(
            'Nama siswa tidak boleh kosong.'
        );

        return;

    }


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
    | Update Dataset
    |--------------------------------------------------------------------------
    */

    row.dataset.nama =
        nama;

    row.dataset.kelas =
        kelas;

    row.dataset.konsentrasi =
        konsentrasi;

    row.dataset.tahun =
        tahun;


    /*
    |--------------------------------------------------------------------------
    | NAMA
    |--------------------------------------------------------------------------
    */

    cells[2].innerHTML = `

        <div class="font-semibold text-gray-800">
            ${nama}
        </div>

    `;


    /*
    |--------------------------------------------------------------------------
    | KELAS
    |--------------------------------------------------------------------------
    */

    cells[3].innerHTML = `

        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
            ${kelas}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | KONSENTRASI
    |--------------------------------------------------------------------------
    */

    cells[4].innerText =
        konsentrasi;


    /*
    |--------------------------------------------------------------------------
    | WARNA NILAI
    |--------------------------------------------------------------------------
    */

    let warnaNilai =
        'text-green-600';


    if (Number(nilai) < 80) {

        warnaNilai =
            'text-yellow-600';

    }


    if (Number(nilai) < 70) {

        warnaNilai =
            'text-red-600';

    }


    /*
    |--------------------------------------------------------------------------
    | NILAI
    |--------------------------------------------------------------------------
    */

    cells[5].innerHTML = `

        <span class="font-bold ${warnaNilai}">
            ${nilai}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | WARNA PREDIKAT
    |--------------------------------------------------------------------------
    */

    let warnaPredikat =
        'bg-green-100 text-green-700';


    if (predikat === 'Cukup') {

        warnaPredikat =
            'bg-yellow-100 text-yellow-700';

    }


    if (predikat === 'Kurang') {

        warnaPredikat =
            'bg-red-100 text-red-700';

    }


    /*
    |--------------------------------------------------------------------------
    | PREDIKAT
    |--------------------------------------------------------------------------
    */

    cells[6].innerHTML = `

        <span class="rounded-full ${warnaPredikat} px-3 py-1 text-xs font-semibold">
            ${predikat}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | WARNA STATUS
    |--------------------------------------------------------------------------
    */

    let warnaStatus =
        'bg-green-100 text-green-700';


    if (status === 'Tidak Lulus') {

        warnaStatus =
            'bg-red-100 text-red-700';

    }


    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    cells[7].innerHTML = `

        <span class="rounded-full ${warnaStatus} px-3 py-1 text-xs font-semibold">
            ${status}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | TAHUN
    |--------------------------------------------------------------------------
    */

    cells[8].innerText =
        tahun;


    /*
    |--------------------------------------------------------------------------
    | TOMBOL EDIT KEMBALI
    |--------------------------------------------------------------------------
    */

    cells[9].innerHTML = `

        <button
            type="button"
            onclick="editData(this)"
            class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

            <i class="ph ph-pencil-simple"></i> Edit

        </button>

    `;


    row.classList.remove('sedang-edit');


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
        button.closest('tr');

    const cells =
        row.querySelectorAll('td');


    /*
    |--------------------------------------------------------------------------
    | Ambil data lama
    |--------------------------------------------------------------------------
    */

    const nama =
        row.dataset.oldNama;

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


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Nama
    |--------------------------------------------------------------------------
    */

    cells[2].innerHTML = `

        <div class="font-semibold text-gray-800">
            ${nama}
        </div>

    `;


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Kelas
    |--------------------------------------------------------------------------
    */

    cells[3].innerHTML = `

        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
            ${kelas}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Konsentrasi
    |--------------------------------------------------------------------------
    */

    cells[4].innerText =
        konsentrasi;


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Nilai
    |--------------------------------------------------------------------------
    */

    let warnaNilai =
        Number(nilai) >= 80
            ? 'text-green-600'
            : 'text-yellow-600';


    if (Number(nilai) < 70) {

        warnaNilai =
            'text-red-600';

    }


    cells[5].innerHTML = `

        <span class="font-bold ${warnaNilai}">
            ${nilai}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Predikat
    |--------------------------------------------------------------------------
    */

    let warnaPredikat =
        'bg-green-100 text-green-700';


    if (predikat === 'Cukup') {

        warnaPredikat =
            'bg-yellow-100 text-yellow-700';

    }


    if (predikat === 'Kurang') {

        warnaPredikat =
            'bg-red-100 text-red-700';

    }


    cells[6].innerHTML = `

        <span class="rounded-full ${warnaPredikat} px-3 py-1 text-xs font-semibold">
            ${predikat}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Status
    |--------------------------------------------------------------------------
    */

    let warnaStatus =
        'bg-green-100 text-green-700';


    if (status === 'Tidak Lulus') {

        warnaStatus =
            'bg-red-100 text-red-700';

    }


    cells[7].innerHTML = `

        <span class="rounded-full ${warnaStatus} px-3 py-1 text-xs font-semibold">
            ${status}
        </span>

    `;


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Tahun
    |--------------------------------------------------------------------------
    */

    cells[8].innerText =
        tahun;


    /*
    |--------------------------------------------------------------------------
    | Kembalikan Tombol Edit
    |--------------------------------------------------------------------------
    */

    cells[9].innerHTML = `

        <button
            type="button"
            onclick="editData(this)"
            class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

            <i class="ph ph-pencil-simple"></i> Edit

        </button>

    `;


    row.classList.remove('sedang-edit');

}

</script>

@endsection


