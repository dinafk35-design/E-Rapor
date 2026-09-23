@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Mata Pelajaran
        </h2>

        <p>
            Kelola data mata pelajaran yang digunakan dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- FORM INPUT MATA PELAJARAN -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="fa-solid fa-book"></i>
        Input Data Mata Pelajaran
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ url('/mata-pelajaran') }}"
            onsubmit="simpanData(event)"
        >
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- KODE MATA PELAJARAN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Kode Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="kode_mata_pelajaran"
                        placeholder="Masukkan kode mata pelajaran"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NAMA MATA PELAJARAN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mata_pelajaran"
                        placeholder="Masukkan nama mata pelajaran"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- KELOMPOK -->
                <div>

                    <label class="block font-semibold mb-2">
                        Kelompok
                    </label>

                    <select
                        name="kelompok"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Kelompok --
                        </option>

                        <option value="A">
                            Kelompok A
                        </option>

                        <option value="B">
                            Kelompok B
                        </option>

                        <option value="C">
                            Kelompok C
                        </option>

                        <option value="Muatan Lokal">
                            Muatan Lokal
                        </option>

                    </select>

                </div>


                <!-- SEKOLAH -->
                <div>

                    <label class="block font-semibold mb-2">
                        Sekolah
                    </label>

                    <select
                        name="sekolah_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Sekolah --
                        </option>

                        <option value="1">
                            SMK Contoh
                        </option>

                    </select>

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
    <!-- TABEL MATA PELAJARAN -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="fa-solid fa-table"></i>

        Data Mata Pelajaran

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
                            Kode Mata Pelajaran
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Nama Mata Pelajaran
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Kelompok
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Sekolah
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
                            RPL001
                        </td>

                        <td class="border px-4 py-3">
                            Pemrograman Web
                        </td>

                        <td class="border px-4 py-3">
                            Kelompok C
                        </td>

                        <td class="border px-4 py-3">
                            SMK Contoh
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
/* EDIT DATA MATA PELAJARAN */
/* ============================= */

function editData() {

    document.querySelector(
        'input[name="kode_mata_pelajaran"]'
    ).value = "RPL001";


    document.querySelector(
        'input[name="nama_mata_pelajaran"]'
    ).value = "Pemrograman Web";


    document.querySelector(
        'select[name="kelompok"]'
    ).value = "C";


    document.querySelector(
        'select[name="sekolah_id"]'
    ).value = "1";


    window.scrollTo({

        top: 0,

        behavior: 'smooth'

    });

}


/* ============================= */
/* SIMPAN DATA MATA PELAJARAN */
/* ============================= */

function simpanData(event) {

    event.preventDefault();


    // Menampilkan pesan berhasil

    alert("✅ Data Mata Pelajaran Berhasil Disimpan!");


    // Kembali ke Dashboard

    window.location.href = "{{ url('/dashboard') }}";

}

</script>


@endsection