@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Sekolah
        </h2>

        <p>
            Kelola informasi dan identitas sekolah yang digunakan
            dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- FORM INPUT DATA SEKOLAH -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-graduation-cap"></i>
        Input Data Sekolah
    </div>

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form method="POST" action="{{ url('/data-sekolah') }}" onsubmit="simpanData(event)">

            @csrf

            <div class="grid grid-cols-2 gap-4">

                <!-- NAMA SEKOLAH -->
                <div>
                    <label class="block font-semibold mb-2">
                        Nama Sekolah
                    </label>

                    <input
                        type="text"
                        name="nama_sekolah"
                        placeholder="Masukkan nama sekolah"
                        class="w-full border rounded-lg px-4 py-2"
                    >
                </div>


                <!-- NPSN -->
                <div>
                    <label class="block font-semibold mb-2">
                        NPSN
                    </label>

                    <input
                        type="text"
                        name="npsn"
                        placeholder="Masukkan NPSN"
                        class="w-full border rounded-lg px-4 py-2"
                    >
                </div>


                <!-- NAMA KEPALA SEKOLAH -->
                <div>
                    <label class="block font-semibold mb-2">
                        Kepala Sekolah
                    </label>

                    <input
                        type="text"
                        name="kepala_sekolah"
                        placeholder="Masukkan nama kepala sekolah"
                        class="w-full border rounded-lg px-4 py-2"
                    >
                </div>


                <!-- NIP KEPALA SEKOLAH -->
                <div>
                    <label class="block font-semibold mb-2">
                        NIP Kepala Sekolah
                    </label>

                    <input
                        type="text"
                        name="nip_kepala_sekolah"
                        placeholder="Masukkan NIP"
                        class="w-full border rounded-lg px-4 py-2"
                    >
                </div>


                <!-- ALAMAT -->
                <div class="col-span-2">
                    <label class="block font-semibold mb-2">
                        Alamat Sekolah
                    </label>

                    <textarea
                        name="alamat"
                        rows="3"
                        placeholder="Masukkan alamat sekolah"
                        class="w-full border rounded-lg px-4 py-2"
                    ></textarea>
                </div>


                <!-- TELEPON -->
                <div>
                    <label class="block font-semibold mb-2">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="telepon"
                        placeholder="Masukkan nomor telepon"
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
                        placeholder="Masukkan email sekolah"
                        class="w-full border rounded-lg px-4 py-2"
                    >
                </div>


                <!-- WEBSITE -->
                <div>
                    <label class="block font-semibold mb-2">
                        Website
                    </label>

                    <input
                        type="text"
                        name="website"
                        placeholder="Masukkan website sekolah"
                        class="w-full border rounded-lg px-4 py-2"
                    >
                </div>


                <!-- KODE POS -->
                <div>
                    <label class="block font-semibold mb-2">
                        Kode Pos
                    </label>

                    <input
                        type="text"
                        name="kode_pos"
                        placeholder="Masukkan kode pos"
                        class="w-full border rounded-lg px-4 py-2"
                    >
                </div>

            </div>


            <!-- BUTTON -->

            <div class="flex gap-3 mt-6">

                <a
                    href="{{ url('/dashboard') }}"
                    class="px-5 py-2 rounded-lg bg-gray-500 text-white"
                >
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
    <!-- TABEL DATA SEKOLAH -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="ph ph-table"></i>

        Data Sekolah

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
                            Nama Sekolah
                        </th>

                        <th class="border px-4 py-3 text-left">
                            NPSN
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Kepala Sekolah
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Telepon
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
                            SMK Contoh
                        </td>

                        <td class="border px-4 py-3">
                            12345678
                        </td>

                        <td class="border px-4 py-3">
                            Nama Kepala Sekolah
                        </td>

                        <td class="border px-4 py-3">
                            0711-123456
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

function editData() {

    document.querySelector('input[name="nama_sekolah"]').value =
        "SMK Contoh";

    document.querySelector('input[name="npsn"]').value =
        "12345678";

    document.querySelector('input[name="kepala_sekolah"]').value =
        "Nama Kepala Sekolah";

    document.querySelector('input[name="nip_kepala_sekolah"]').value =
        "";

    document.querySelector('textarea[name="alamat"]').value =
        "Alamat sekolah";

    document.querySelector('input[name="telepon"]').value =
        "0711-123456";

    document.querySelector('input[name="email"]').value =
        "sekolah@email.com";

    document.querySelector('input[name="website"]').value =
        "https://sekolah.sch.id";

    document.querySelector('input[name="kode_pos"]').value =
        "30100";

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

}


/* ============================= */
/* SIMPAN DATA */
/* ============================= */

function simpanData(event) {

    event.preventDefault();

    // Menampilkan pesan berhasil
    alert("Data Sekolah Berhasil Disimpan!");

    // Setelah klik OK, kembali ke Dashboard
    window.location.href = "{{ url('/dashboard') }}";

}

</script>

@endsection