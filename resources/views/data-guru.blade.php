@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Guru
        </h2>

        <p>
            Kelola data guru yang terdaftar dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- FORM INPUT DATA GURU -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-chalkboard-teacher"></i>
        Input Data Guru
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ url('/data-guru') }}"
            onsubmit="simpanData(event)"
        >

            @csrf

            <div class="grid grid-cols-2 gap-4">


                <!-- NIP -->
                <div>

                    <label class="block font-semibold mb-2">
                        NIP
                    </label>

                    <input
                        type="text"
                        name="nip"
                        placeholder="Masukkan NIP guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NIK -->
                <div>

                    <label class="block font-semibold mb-2">
                        NIK
                    </label>

                    <input
                        type="text"
                        name="nik"
                        placeholder="Masukkan NIK guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NAMA GURU -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        name="nama_guru"
                        placeholder="Masukkan nama guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- EMAIL -->
                <div>

                    <label class="block font-semibold mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NOMOR TELEPON -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="no_telepon"
                        placeholder="Masukkan nomor telepon"
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


                <!-- ALAMAT -->
                <div class="col-span-2">

                    <label class="block font-semibold mb-2">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        rows="3"
                        placeholder="Masukkan alamat guru"
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
    <!-- TABEL DATA GURU -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="ph ph-table"></i>

        Data Guru

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
                            NIP
                        </th>

                        <th class="border px-4 py-3 text-left">
                            NIK
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Nama Guru
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Jenis Kelamin
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Email
                        </th>

                        <th class="border px-4 py-3 text-left">
                            No. Telepon
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
                            198501012010011001
                        </td>

                        <td class="border px-4 py-3">
                            1671000000000001
                        </td>

                        <td class="border px-4 py-3">
                            Budi Santoso, S.Pd.
                        </td>

                        <td class="border px-4 py-3">
                            Laki-laki
                        </td>

                        <td class="border px-4 py-3">
                            budi@sekolah.sch.id
                        </td>

                        <td class="border px-4 py-3">
                            081234567890
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
/* EDIT DATA GURU */
/* ============================= */

function editData() {

    document.querySelector(
        'input[name="nip"]'
    ).value = "198501012010011001";


    document.querySelector(
        'input[name="nik"]'
    ).value = "1671000000000001";


    document.querySelector(
        'input[name="nama_guru"]'
    ).value = "Budi Santoso, S.Pd.";


    document.querySelector(
        'input[name="email"]'
    ).value = "budi@sekolah.sch.id";


    document.querySelector(
        'input[name="no_telepon"]'
    ).value = "081234567890";


    document.querySelector(
        'select[name="jenis_kelamin"]'
    ).value = "L";


    document.querySelector(
        'input[name="tempat_lahir"]'
    ).value = "Palembang";


    document.querySelector(
        'input[name="tanggal_lahir"]'
    ).value = "1985-01-01";


    document.querySelector(
        'textarea[name="alamat"]'
    ).value = "Jl. Contoh No. 10 Palembang";


    window.scrollTo({

        top: 0,

        behavior: 'smooth'

    });

}


/* ============================= */
/* SIMPAN DATA GURU */
/* ============================= */

function simpanData(event) {

    event.preventDefault();


    // Menampilkan pesan berhasil

    alert("Data Guru Berhasil Disimpan!");


    // Kembali ke Dashboard

    window.location.href = "{{ url('/dashboard') }}";

}

</script>

@endsection