@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Siswa
        </h2>

        <p>
            Kelola data siswa yang terdaftar dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- FORM INPUT DATA SISWA -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="fa-solid fa-user-graduate"></i>
        Input Data Siswa
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ url('/data-siswa') }}"
            onsubmit="simpanData(event)"
        >

            @csrf

            <div class="grid grid-cols-2 gap-4">


                <!-- NISN -->
                <div>

                    <label class="block font-semibold mb-2">
                        NISN
                    </label>

                    <input
                        type="text"
                        name="nisn"
                        placeholder="Masukkan NISN siswa"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NAMA SISWA -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nama Siswa
                    </label>

                    <input
                        type="text"
                        name="nama_siswa"
                        placeholder="Masukkan nama siswa"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- JENIS KELAMIN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option value="L">
                            Laki-laki
                        </option>

                        <option value="P">
                            Perempuan
                        </option>

                    </select>

                </div>


                <!-- TEMPAT LAHIR -->
                <div>

                    <label class="block font-semibold mb-2">
                        Tempat Lahir
                    </label>

                    <input
                        type="text"
                        name="tempat_lahir"
                        placeholder="Masukkan tempat lahir"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- TANGGAL LAHIR -->
                <div>

                    <label class="block font-semibold mb-2">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tanggal_lahir"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- ROMBEL -->
                <div>

                    <label class="block font-semibold mb-2">
                        Rombel / Kelas
                    </label>

                    <select
                        name="rombel_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Rombel --
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


                <!-- ALAMAT -->
                <div class="col-span-2">

                    <label class="block font-semibold mb-2">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        rows="3"
                        placeholder="Masukkan alamat siswa"
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
                    <i class="fa-solid fa-arrow-left mr-1"></i>
                    Kembali
                </a>


                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white"
                >

                    <i class="fa-solid fa-save mr-1"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>


    <!-- ============================= -->
    <!-- TABEL DATA SISWA -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="fa-solid fa-table"></i>

        Data Siswa

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
                            NISN
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Nama Siswa
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Jenis Kelamin
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tempat Lahir
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tanggal Lahir
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Rombel
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
                            1234567890
                        </td>

                        <td class="border px-4 py-3">
                            Budi Santoso
                        </td>

                        <td class="border px-4 py-3">
                            Laki-laki
                        </td>

                        <td class="border px-4 py-3">
                            Palembang
                        </td>

                        <td class="border px-4 py-3">
                            12-05-2009
                        </td>

                        <td class="border px-4 py-3">
                            XI RPL 1
                        </td>

                        <td class="border px-4 py-3 text-center">

                            <button
                                type="button"
                                onclick="editData()"
                                class="px-3 py-2 rounded-lg bg-yellow-500 text-white"
                            >

                                <i class="fa-solid fa-pen-to-square"></i>

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
/* EDIT DATA SISWA */
/* ============================= */

function editData() {

    document.querySelector(
        'input[name="nisn"]'
    ).value = "1234567890";


    document.querySelector(
        'input[name="nama_siswa"]'
    ).value = "Budi Santoso";


    document.querySelector(
        'select[name="jenis_kelamin"]'
    ).value = "L";


    document.querySelector(
        'input[name="tempat_lahir"]'
    ).value = "Palembang";


    document.querySelector(
        'input[name="tanggal_lahir"]'
    ).value = "2009-05-12";


    document.querySelector(
        'select[name="rombel_id"]'
    ).value = "3";


    document.querySelector(
        'textarea[name="alamat"]'
    ).value = "Jl. Contoh No. 10 Palembang";


    window.scrollTo({

        top: 0,

        behavior: 'smooth'

    });

}


/* ============================= */
/* SIMPAN DATA SISWA */
/* ============================= */

function simpanData(event) {

    event.preventDefault();


    // Menampilkan pesan berhasil

    alert("✅ Data Siswa Berhasil Disimpan!");


    // Kembali ke Dashboard

    window.location.href = "{{ url('/dashboard') }}";

}

</script>

@endsection