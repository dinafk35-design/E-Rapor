@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Penilaian
        </h2>

        <p>
            Kelola data penilaian siswa dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- FORM INPUT PENILAIAN -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-pencil-simple"></i>
        Input Penilaian
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ url('/penilaian') }}"
            onsubmit="simpanData(event)"
        >
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- TAHUN AJARAN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Tahun Ajaran
                    </label>

                    <select
                        name="tahun_ajaran"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Tahun Ajaran --
                        </option>

                        <option value="2025/2026">
                            2025/2026
                        </option>

                        <option value="2026/2027">
                            2026/2027
                        </option>

                        <option value="2027/2028">
                            2027/2028
                        </option>

                    </select>

                </div>


                <!-- SEMESTER -->
                <div>

                    <label class="block font-semibold mb-2">
                        Semester
                    </label>

                    <select
                        name="semester"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Semester --
                        </option>

                        <option value="Ganjil">
                            Ganjil
                        </option>

                        <option value="Genap">
                            Genap
                        </option>

                    </select>

                </div>


                <!-- KELAS / ROMBEL -->
                <div>

                    <label class="block font-semibold mb-2">
                        Kelas / Rombel
                    </label>

                    <select
                        name="rombel_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Kelas / Rombel --
                        </option>

                        <option value="1">
                            X RPL 1
                        </option>

                        <option value="2">
                            X RPL 2
                        </option>

                        <option value="3">
                            XI RPL 1
                        </option>

                        <option value="4">
                            XI RPL 2
                        </option>

                        <option value="5">
                            XII RPL 1
                        </option>

                        <option value="6">
                            XII RPL 2
                        </option>

                    </select>

                </div>


                <!-- MATA PELAJARAN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Mata Pelajaran
                    </label>

                    <select
                        name="mata_pelajaran_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Mata Pelajaran --
                        </option>

                        <option value="1">
                            Pemrograman Web
                        </option>

                        <option value="2">
                            Basis Data
                        </option>

                        <option value="3">
                            Pemrograman Berorientasi Objek
                        </option>

                        <option value="4">
                            Jaringan Komputer
                        </option>

                    </select>

                </div>


                <!-- NAMA SISWA -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nama Siswa
                    </label>

                    <select
                        name="siswa_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Nama Siswa --
                        </option>

                        <option value="1">
                            Budi Santoso
                        </option>

                        <option value="2">
                            Siti Aminah
                        </option>

                        <option value="3">
                            Andi Saputra
                        </option>

                        <option value="4">
                            Rina Anggraini
                        </option>

                    </select>

                </div>


                <!-- NILAI -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nilai
                    </label>

                    <input
                        type="number"
                        name="nilai"
                        min="0"
                        max="100"
                        placeholder="Masukkan nilai 0 - 100"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- KETERANGAN -->
                <div class="col-span-2">

                    <label class="block font-semibold mb-2">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        rows="3"
                        placeholder="Masukkan keterangan nilai"
                        class="w-full border rounded-lg px-4 py-2"
                    ></textarea>

                </div>

            </div>


            <!-- BUTTON -->

            <div class="flex gap-3 mt-6">

                <a
                    href="{{ url('/dashboard') }}"
                    class="px-5 py-2 rounded-lg bg-gray-500 text-white"
                >
                    <i class="ph ph-arrow-left mr-1"></i>
                    Kembali
                </a>


                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white"
                >

                    <i class="ph ph-floppy-disk mr-1"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>


    <!-- ============================= -->
    <!-- TABEL DATA PENILAIAN -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="ph ph-table"></i>

        Data Penilaian

    </div>


    <div class="bg-white rounded-xl shadow p-6">

        <div class="overflow-x-auto">

            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="border px-4 py-3 text-left">
                            No
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tahun Ajaran
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Semester
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Kelas
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Nama Siswa
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Mata Pelajaran
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Nilai
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Keterangan
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td class="border px-4 py-3">
                            1
                        </td>

                        <td class="border px-4 py-3">
                            2026/2027
                        </td>

                        <td class="border px-4 py-3">
                            Ganjil
                        </td>

                        <td class="border px-4 py-3">
                            XI RPL 1
                        </td>

                        <td class="border px-4 py-3">
                            Budi Santoso
                        </td>

                        <td class="border px-4 py-3">
                            Pemrograman Web
                        </td>

                        <td class="border px-4 py-3 text-center">
                            85
                        </td>

                        <td class="border px-4 py-3">
                            Baik
                        </td>

                        <td class="border px-4 py-3 text-center">

                            <button
                                type="button"
                                onclick="editData()"
                                class="px-3 py-2 rounded-lg bg-yellow-500 text-white"
                            >

                                <i class="ph ph-pencil-simple"></i>

                                Edit

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>


/* ============================= */
/* EDIT DATA PENILAIAN */
/* ============================= */

function editData() {

    document.querySelector(
        'select[name="tahun_ajaran"]'
    ).value = "2026/2027";


    document.querySelector(
        'select[name="semester"]'
    ).value = "Ganjil";


    document.querySelector(
        'select[name="rombel_id"]'
    ).value = "3";


    document.querySelector(
        'select[name="mata_pelajaran_id"]'
    ).value = "1";


    document.querySelector(
        'select[name="siswa_id"]'
    ).value = "1";


    document.querySelector(
        'input[name="nilai"]'
    ).value = "85";


    document.querySelector(
        'textarea[name="keterangan"]'
    ).value = "Baik";


    window.scrollTo({

        top: 0,

        behavior: 'smooth'

    });

}


/* ============================= */
/* SIMPAN DATA PENILAIAN */
/* ============================= */

function simpanData(event) {

    event.preventDefault();


    // Menampilkan pesan berhasil

    alert("Data Penilaian Berhasil Disimpan!");


    // Kembali ke Dashboard

    window.location.href = "{{ url('/dashboard') }}";

}

</script>


@endsection