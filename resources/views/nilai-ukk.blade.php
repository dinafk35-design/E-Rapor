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
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

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
        <div class="mt-5 flex flex-wrap gap-3">

            <button
                type="button"
                onclick="filterData()"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                🔍 Cari

            </button>


            <button
                type="button"
                onclick="resetFilter()"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                ↻ Reset

            </button>

            <button type="button"
                    class="ml-auto rounded-lg bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700">
                    <a href="{{ route('nilai-ukk-create') }}">
                        + Tambah Nilai
                    </a>
                </button>

        </div>

    </div>



    <!-- TABEL NILAI UKK -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">

        <!-- HEADER TABEL -->
        <div class="border-b border-gray-200 px-6 py-4">

            <h2 class="text-lg font-bold text-gray-800">
                Daftar Nilai UKK Siswa
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Data hasil Uji Kompetensi Keahlian siswa.
            </p>

        </div>


        <!-- RESPONSIVE TABLE -->
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
                            Konsentrasi Keahlian
                        </th>

                        <th class="px-6 py-4 text-center">
                            Nilai UKK
                        </th>

                        <th class="px-6 py-4 text-center">
                            Predikat
                        </th>

                        <th class="px-6 py-4 text-center">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center">
                            Tahun Ajaran
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody
                    id="tabelUKK"
                    class="divide-y divide-gray-200">


                    <!-- DATA 1 -->
                    <tr
                        data-nama="Ahmad Fauzan"
                        data-nisn="00654321"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        data-kelas="XII RPL 1"
                        data-konsentrasi="Rekayasa Perangkat Lunak"
                        class="transition hover:bg-gray-50">

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
                                XII RPL 1
                            </span>

                        </td>

                        <td class="px-6 py-5">
                            Rekayasa Perangkat Lunak
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="font-bold text-green-600">
                                90
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Sangat Baik
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">
                            2026/2027
                        </td>

                        <td class="px-6 py-5 text-center">

                            <button
                                type="button"
                                onclick="editData('Ahmad Fauzan')"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                ✏ Edit

                            </button>

                        </td>

                    </tr>



                    <!-- DATA 2 -->
                    <tr
                        data-nama="Budi Santoso"
                        data-nisn="00654322"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        data-kelas="XII RPL 1"
                        data-konsentrasi="Rekayasa Perangkat Lunak"
                        class="transition hover:bg-gray-50">

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
                                XII RPL 1
                            </span>

                        </td>

                        <td class="px-6 py-5">
                            Rekayasa Perangkat Lunak
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="font-bold text-green-600">
                                86
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Baik
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">
                            2026/2027
                        </td>

                        <td class="px-6 py-5 text-center">

                            <button
                                type="button"
                                onclick="editData('Budi Santoso')"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                ✏ Edit

                            </button>

                        </td>

                    </tr>



                    <!-- DATA 3 -->
                    <tr
                        data-nama="Citra Lestari"
                        data-nisn="00654323"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        data-kelas="XII RPL 2"
                        data-konsentrasi="Rekayasa Perangkat Lunak"
                        class="transition hover:bg-gray-50">

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
                                XII RPL 2
                            </span>

                        </td>

                        <td class="px-6 py-5">
                            Rekayasa Perangkat Lunak
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="font-bold text-green-600">
                                94
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Sangat Baik
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">
                            2026/2027
                        </td>

                        <td class="px-6 py-5 text-center">

                            <button
                                type="button"
                                onclick="editData('Citra Lestari')"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                ✏ Edit

                            </button>

                        </td>

                    </tr>



                    <!-- DATA 4 -->
                    <tr
                        data-nama="Dimas Pratama"
                        data-nisn="00654324"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        data-kelas="XII TKJ 1"
                        data-konsentrasi="Teknik Komputer Jaringan"
                        class="transition hover:bg-gray-50">

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
                                XII TKJ 1
                            </span>

                        </td>

                        <td class="px-6 py-5">
                            Teknik Komputer Jaringan
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="font-bold text-yellow-600">
                                78
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                Cukup
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">
                            2026/2027
                        </td>

                        <td class="px-6 py-5 text-center">

                            <button
                                type="button"
                                onclick="editData('Dimas Pratama')"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                ✏ Edit

                            </button>

                        </td>

                    </tr>



                    <!-- DATA 5 -->
                    <tr
                        data-nama="Eka Putri"
                        data-nisn="00654325"
                        data-tahun="2026/2027"
                        data-semester="Genap"
                        data-kelas="XII TKJ 2"
                        data-konsentrasi="Teknik Komputer Jaringan"
                        class="transition hover:bg-gray-50">

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
                                XII TKJ 2
                            </span>

                        </td>

                        <td class="px-6 py-5">
                            Teknik Komputer Jaringan
                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="font-bold text-green-600">
                                89
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Baik
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Lulus
                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">
                            2026/2027
                        </td>

                        <td class="px-6 py-5 text-center">

                            <button
                                type="button"
                                onclick="editData('Eka Putri')"
                                class="rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                ✏ Edit

                            </button>

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



<!-- JAVASCRIPT -->
<script>

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
        document.querySelectorAll('#tabelUKK tr');


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


    document.getElementById('jumlahData').innerText =
        jumlah;

}



function resetFilter() {

    document.getElementById('searchSiswa').value = '';

    document.getElementById('filterTahun').value = '';

    document.getElementById('filterSemester').value = '';

    document.getElementById('filterKelas').value = '';

    document.getElementById('filterKonsentrasi').value = '';

    filterData();

}



function editData(nama) {

    alert(
        'Edit nilai UKK untuk siswa: ' +
        nama
    );

}

</script>

@endsection