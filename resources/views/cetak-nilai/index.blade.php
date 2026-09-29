@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Cetak Nilai
        </h2>

        <p>
            Pilih data siswa dan periode penilaian, lalu cetak dokumen nilai
            berukuran A4 pada sistem E-Rapor SMK.
        </p>

    </div>


    <!-- ============================= -->
    <!-- FORM PILIH DATA -->
    <!-- ============================= -->

    <form
        id="formCetak"
        class="bg-white rounded-xl shadow p-6 mb-6"
        onsubmit="return tampilkanPratinjau()"
    >

        <!-- DATA SISWA -->

        <h2 class="section-title" style="margin-top: 0">
            <i class="ph ph-student"></i>
            Data Siswa
        </h2>


        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <!-- NAMA SISWA -->

            <div>

                <label class="block font-semibold mb-2">
                    Nama Siswa
                </label>

                <select
                    name="siswa"
                    id="siswa"
                    onchange="isiNisn()"
                    class="w-full border rounded-lg px-4 py-2"
                >

                    <option value="">
                        -- Pilih Siswa --
                    </option>

                    <option value="Ahmad Fauzan">
                        Ahmad Fauzan
                    </option>

                    <option value="Budi Santoso">
                        Budi Santoso
                    </option>

                    <option value="Citra Lestari">
                        Citra Lestari
                    </option>

                    <option value="Dimas Pratama">
                        Dimas Pratama
                    </option>

                    <option value="Eka Putri">
                        Eka Putri
                    </option>

                </select>

            </div>


            <!-- NISN -->

            <div>

                <label class="block font-semibold mb-2">
                    NISN
                </label>

                <input
                    type="text"
                    name="nisn"
                    id="nisn"
                    readonly
                    placeholder="Otomatis terisi dari pilihan siswa"
                    class="w-full border rounded-lg px-4 py-2 bg-gray-50"
                >

            </div>


            <!-- KELAS -->

            <div>

                <label class="block font-semibold mb-2">
                    Kelas
                </label>

                <select
                    name="kelas"
                    id="kelas"
                    class="w-full border rounded-lg px-4 py-2"
                >

                    <option value="">
                        -- Pilih Kelas --
                    </option>

                    <option value="X RPL 1">
                        X RPL 1
                    </option>

                    <option value="X RPL 2">
                        X RPL 2
                    </option>

                    <option value="XI RPL 1">
                        XI RPL 1
                    </option>

                    <option value="XI RPL 2">
                        XI RPL 2
                    </option>

                    <option value="XII RPL 1">
                        XII RPL 1
                    </option>

                    <option value="XII RPL 2">
                        XII RPL 2
                    </option>

                </select>

            </div>


            <!-- TAHUN AJARAN -->

            <div>

                <label class="block font-semibold mb-2">
                    Tahun Ajaran
                </label>

                <select
                    name="tahun_ajaran"
                    id="tahun_ajaran"
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

                </select>

            </div>


            <!-- SEMESTER -->

            <div>

                <label class="block font-semibold mb-2">
                    Semester
                </label>

                <select
                    name="semester"
                    id="semester"
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


            <!-- JENIS CETAK -->

            <div>

                <label class="block font-semibold mb-2">
                    Dokumen
                </label>

                <select
                    name="jenis_cetak"
                    id="jenis_cetak"
                    onchange="tampilkanOtomatis()"
                    class="w-full border rounded-lg px-4 py-2"
                >

                    <option value="">
                        -- Pilih Dokumen --
                    </option>

                    <option value="Daftar Nilai">
                        Daftar Nilai
                    </option>

                    <option value="Rapor Siswa">
                        Rapor Siswa
                    </option>

                    <option value="Rekap Nilai">
                        Rekap Nilai
                    </option>

                </select>

            </div>


            <!-- MATA PELAJARAN -->

            <div>

                <label class="block font-semibold mb-2">
                    Mata Pelajaran
                </label>

                <select
                    name="mata_pelajaran"
                    id="mata_pelajaran"
                    onchange="tampilkanOtomatis()"
                    class="w-full border rounded-lg px-4 py-2"
                >

                    <option value="">
                        Semua Mata Pelajaran
                    </option>

                    <option value="Matematika">
                        Matematika
                    </option>

                    <option value="Bahasa Indonesia">
                        Bahasa Indonesia
                    </option>

                    <option value="Bahasa Inggris">
                        Bahasa Inggris
                    </option>

                    <option value="Pendidikan Agama">
                        Pendidikan Agama
                    </option>

                    <option value="PPKn">
                        PPKn
                    </option>

                    <option value="Informatika">
                        Informatika
                    </option>

                    <option value="Pemrograman Web">
                        Pemrograman Web
                    </option>

                    <option value="Pemrograman Berorientasi Objek">
                        Pemrograman Berorientasi Objek
                    </option>

                    <option value="Basis Data">
                        Basis Data
                    </option>

                    <option value="Produk Kreatif dan Kewirausahaan">
                        Produk Kreatif dan Kewirausahaan
                    </option>

                </select>

            </div>

        </div>


        <!-- BUTTON -->

        <div class="flex flex-wrap gap-3 mt-6 pt-6 border-t border-gray-200">

            <button
                type="submit"
                class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
            >

                <i class="ph ph-eye mr-1"></i>

                Tampilkan

            </button>


            <button
                type="button"
                id="tombolCetak"
                onclick="cetakNilai()"
                disabled
                class="px-5 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 disabled:opacity-40 disabled:cursor-not-allowed"
            >

                <i class="ph ph-printer mr-1"></i>

                Cetak

            </button>


            <button
                type="button"
                onclick="resetCetak()"
                class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300"
            >

                <i class="ph ph-arrow-counter-clockwise mr-1"></i>

                Reset

            </button>

        </div>

    </form>


    <!-- ============================= -->
    <!-- PRATINJAU DOKUMEN -->
    <!-- ============================= -->

    <div id="areaPratinjau" class="hidden">

        <h2 class="section-title">
            <i class="ph ph-file-text"></i>
            Pratinjau Dokumen
        </h2>


        <div class="bg-white rounded-xl shadow p-4">

            <div
                id="pratinjau"
                class="w-full border border-gray-200 rounded-lg bg-gray-50"
                style="height: 900px"
            >
            </div>

            <p class="text-xs text-gray-500 mt-3 text-center">
                Pratinjau menampilkan dokumen persis seperti hasil cetak (ukuran A4).
            </p>

        </div>

    </div>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>


/* ============================= */
/* DAFTAR NISN SISWA */
/* ============================= */

const dataSiswa = {

    "Ahmad Fauzan": "00654321",

    "Budi Santoso": "00765432",

    "Citra Lestari": "00876543",

    "Dimas Pratama": "00987654",

    "Eka Putri": "00123456"

};


/* ============================= */
/* ISI NISN OTOMATIS */
/* ============================= */

function isiNisn() {

    const siswa =
        document.getElementById('siswa').value;

    document.getElementById('nisn').value =
        dataSiswa[siswa] || '';

    tampilkanOtomatis();

}


/* ============================= */
/* KUMPULKAN PARAMETER */
/* ============================= */

function ambilParameter() {

    const form =
        document.getElementById('formCetak');

    const data =
        new FormData(form);

    return new URLSearchParams(data).toString();

}


/* ============================= */
/* TAMPILKAN PRATINJAU */
/* ============================= */

function tampilkanPratinjau() {

    const wajib = ['siswa', 'kelas', 'tahun_ajaran', 'semester', 'jenis_cetak'];

    const form =
        document.getElementById('formCetak');

    const data =
        new FormData(form);

    const kosong = wajib.filter(function (nama) {

        return (data.get(nama) || '').trim() === '';

    });

    if (kosong.length > 0) {

        alert('Silakan lengkapi pilihan terlebih dahulu.');

        return false;

    }


    // Muat dokumen ke iframe

    document.getElementById('pratinjau').src =
        '{{ route('cetak-nilai.create') }}?' + ambilParameter();

    document.getElementById('areaPratinjau')
        .classList
        .remove('hidden');

    document.getElementById('tombolCetak')
        .disabled = false;

    document.getElementById('areaPratinjau')
        .scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    return false;

}


/* ============================= */
/* TAMPILKAN OTOMATIS */
/* ============================= */

function tampilkanOtomatis() {

    const tombol =
        document.getElementById('tombolCetak');

    // Belum ada dokumen yang ditampilkan

    if (tombol.disabled) {

        return;

    }

    document.getElementById('pratinjau').src =
        '{{ route('cetak-nilai.create') }}?' + ambilParameter();

}


/* ============================= */
/* CETAK DOKUMEN */
/* ============================= */

function cetakNilai() {

    const pratinjau =
        document.getElementById('pratinjau');


    // Cetak dari dalam iframe agar hasil sama dengan pratinjau

    try {

        pratinjau.contentWindow.focus();

        pratinjau.contentWindow.print();

    } catch (error) {

        window.open(pratinjau.src, '_blank');

    }

}


/* ============================= */
/* RESET */
/* ============================= */

function resetCetak() {

    document.getElementById('formCetak').reset();

    document.getElementById('nisn').value = '';

    document.getElementById('areaPratinjau')
        .classList
        .add('hidden');

    document.getElementById('tombolCetak').disabled = true;

    document.getElementById('pratinjau').src = 'about:blank';

}

</script>


<style>

    @media print {

        .content > *:not(#areaPratinjau) {

            display: none !important;

        }

        #areaPratinjau {

            display: block !important;

        }

        #pratinjau {

            border: none !important;

            height: auto !important;

            background: white !important;

        }

    }

</style>


@endsection
