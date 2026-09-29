@extends('layouts.app')

@section('content')

    <!-- ============================= -->
    <!-- FORM INPUT DATA SEKOLAH -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-graduation-cap"></i>
        Input Data Sekolah
    </div>

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ route('data-sekolah.store') }}"
            id="formSekolah"
        >

            @csrf

            @if ($errors->any())

                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                    <i class="ph ph-warning-circle mr-1"></i>
                    {{ $errors->first() }}
                </div>

            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

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
                    href="{{ route('data-sekolah') }}"
                    class="px-5 py-2 rounded-lg bg-gray-500 text-white"
                >
                    Kembali
                </a>

                <button
                    type="submit"
                    onclick="simpanData(event)"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white"
                >
                    <i class="ph ph-floppy-disk mr-1"></i>
                    Simpan
                </button>

            </div>

        </form>

    </div>

@endsection
<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>

function editData() {

    // DiISI otomatis dari database saat halaman edit dibuka

}


/* ============================= */
/* SIMPAN DATA */
/* ============================= */

function simpanData(event) {

    // Kirim form ke server agar tersimpan di database

    document.getElementById('formSekolah').submit();

}

</script>