@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Rombel
        </h2>

        <p>
            Kelola data rombongan belajar yang digunakan dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- FORM INPUT DATA ROMBEL -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="fa-solid fa-people-group"></i>
        Input Data Rombel
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ url('/rombel') }}"
            onsubmit="simpanData(event)"
        >
            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- NAMA ROMBEL -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nama Rombel
                    </label>

                    <input
                        type="text"
                        name="nama_rombel"
                        placeholder="Masukkan nama rombel"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- TINGKAT -->
                <div>

                    <label class="block font-semibold mb-2">
                        Tingkat
                    </label>

                    <select
                        name="tingkat"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Tingkat --
                        </option>

                        <option value="X">
                            X
                        </option>

                        <option value="XI">
                            XI
                        </option>

                        <option value="XII">
                            XII
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


                <!-- WALI KELAS -->
                <div>

                    <label class="block font-semibold mb-2">
                        Wali Kelas
                    </label>

                    <select
                        name="wali_kelas_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Wali Kelas --
                        </option>

                        <option value="1">
                            Budi Santoso, S.Pd.
                        </option>

                        <option value="2">
                            Siti Aminah, S.Pd.
                        </option>

                        <option value="3">
                            Andi Saputra, S.Kom.
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
    <!-- TABEL DATA ROMBEL -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="fa-solid fa-table"></i>

        Data Rombel

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
                            Nama Rombel
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tingkat
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Sekolah
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Wali Kelas
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
                            XI RPL 1
                        </td>

                        <td class="border px-4 py-3">
                            XI
                        </td>

                        <td class="border px-4 py-3">
                            SMK Contoh
                        </td>

                        <td class="border px-4 py-3">
                            Budi Santoso, S.Pd.
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
/* EDIT DATA ROMBEL */
/* ============================= */

function editData() {

    document.querySelector(
        'input[name="nama_rombel"]'
    ).value = "XI RPL 1";


    document.querySelector(
        'select[name="tingkat"]'
    ).value = "XI";


    document.querySelector(
        'select[name="sekolah_id"]'
    ).value = "1";


    document.querySelector(
        'select[name="wali_kelas_id"]'
    ).value = "1";


    window.scrollTo({

        top: 0,

        behavior: 'smooth'

    });

}


/* ============================= */
/* SIMPAN DATA ROMBEL */
/* ============================= */

function simpanData(event) {

    event.preventDefault();


    // Menampilkan pesan berhasil

    alert("✅ Data Rombel Berhasil Disimpan!");


    // Kembali ke Dashboard

    window.location.href = "{{ url('/dashboard') }}";

}

</script>


@endsection