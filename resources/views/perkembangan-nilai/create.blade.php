@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">

    <!-- HEADER -->
    <div class="mb-6">

        <div class="flex items-center gap-3">

            <!-- Tombol Kembali -->
            <a
                href="{{ url('/perkembangan-nilai') }}"
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-white text-gray-600 shadow-sm transition hover:bg-gray-100"
            >
                <i class="ph ph-arrow-left text-lg"></i>
            </a>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Tambah Perkembangan Nilai
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Silakan masukkan data perkembangan nilai siswa.
                </p>
            </div>

        </div>

    </div>


    <!-- FORM DUMMY -->
    <form onsubmit="simpanPerkembanganDummy(event)">

        <div class="rounded-xl bg-white p-6 shadow-sm">


            <!-- ========================= -->
            <!-- DATA SISWA -->
            <!-- ========================= -->

            <div class="mb-8">

                <h2 class="mb-5 border-b border-gray-200 pb-3 text-lg font-bold text-gray-800">
                    Data Siswa
                </h2>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <!-- NAMA SISWA -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Siswa
                        </label>

                        <select
                            id="siswa"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
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


                    <!-- KELAS -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Kelas
                        </label>

                        <select
                            id="kelas"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
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

                        </select>

                    </div>

                </div>

            </div>


            <!-- ========================= -->
            <!-- PERIODE PENILAIAN -->
            <!-- ========================= -->

            <div class="mb-8">

                <h2 class="mb-5 border-b border-gray-200 pb-3 text-lg font-bold text-gray-800">
                    Periode Penilaian
                </h2>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <!-- TAHUN AJARAN -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Tahun Ajaran
                        </label>

                        <select
                            id="tahun_ajaran"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
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

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Semester
                        </label>

                        <select
                            id="semester"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
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

                </div>

            </div>


            <!-- ========================= -->
            <!-- NILAI PERKEMBANGAN -->
            <!-- ========================= -->

            <div class="mb-8">

                <h2 class="mb-5 border-b border-gray-200 pb-3 text-lg font-bold text-gray-800">
                    Nilai Perkembangan
                </h2>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <!-- MATA PELAJARAN -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Mata Pelajaran
                        </label>

                        <select
                            id="mata_pelajaran"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                            <option value="">
                                -- Pilih Mata Pelajaran --
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

                            <option value="Pemrograman Web">
                                Pemrograman Web
                            </option>

                            <option value="Basis Data">
                                Basis Data
                            </option>

                            <option value="Pemrograman Berorientasi Objek">
                                Pemrograman Berorientasi Objek
                            </option>

                        </select>

                    </div>


                    <!-- NILAI SEMESTER GANJIL -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nilai Semester Ganjil
                        </label>

                        <input
                            type="number"
                            id="nilai_ganjil"
                            min="0"
                            max="100"
                            placeholder="Masukkan nilai 0 - 100"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                    </div>


                    <!-- NILAI SEMESTER GENAP -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nilai Semester Genap
                        </label>

                        <input
                            type="number"
                            id="nilai_genap"
                            min="0"
                            max="100"
                            placeholder="Masukkan nilai 0 - 100"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                    </div>


                    <!-- PERUBAHAN NILAI -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Perubahan Nilai
                        </label>

                        <input
                            type="text"
                            id="perubahan"
                            readonly
                            placeholder="Akan dihitung otomatis"
                            class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none"
                        >

                    </div>

                </div>

            </div>


            <!-- ========================= -->
            <!-- STATUS -->
            <!-- ========================= -->

            <div class="mb-8">

                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Status Perkembangan
                </label>

                <select
                    id="status"
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                >

                    <option value="">
                        -- Pilih Status --
                    </option>

                    <option value="Meningkat">
                        Meningkat
                    </option>

                    <option value="Tetap">
                        Tetap
                    </option>

                    <option value="Menurun">
                        Menurun
                    </option>

                </select>

            </div>


            <!-- ========================= -->
            <!-- CATATAN -->
            <!-- ========================= -->

            <div class="mb-8">

                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Catatan
                </label>

                <textarea
                    id="catatan"
                    rows="4"
                    placeholder="Masukkan catatan perkembangan siswa jika diperlukan..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                ></textarea>

            </div>


            <!-- ========================= -->
            <!-- BUTTON -->
            <!-- ========================= -->

            <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">

                <!-- BATAL -->
                <a
                    href="{{ url('/perkembangan-nilai') }}"
                    class="rounded-lg bg-gray-200 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-300"
                >
                    Batal
                </a>


                <!-- SIMPAN -->
                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
                >
                    Simpan Perkembangan
                </button>

            </div>

        </div>

    </form>

</div>


<!-- ========================= -->
<!-- JAVASCRIPT -->
<!-- ========================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const nilaiGanjil = document.getElementById('nilai_ganjil');
    const nilaiGenap = document.getElementById('nilai_genap');
    const perubahan = document.getElementById('perubahan');

    function hitungPerubahan() {

        const ganjil = parseFloat(nilaiGanjil.value);
        const genap = parseFloat(nilaiGenap.value);

        if (!isNaN(ganjil) && !isNaN(genap)) {

            const hasil = genap - ganjil;

            if (hasil > 0) {
                perubahan.value = '+' + hasil;
            } else {
                perubahan.value = hasil;
            }

        } else {

            perubahan.value = '';

        }

    }

    nilaiGanjil.addEventListener('input', hitungPerubahan);
    nilaiGenap.addEventListener('input', hitungPerubahan);

});


function simpanPerkembanganDummy(event) {

    event.preventDefault();


    // Ambil data dari form

    const siswa =
        document.getElementById('siswa').value;

    const kelas =
        document.getElementById('kelas').value;

    const tahunAjaran =
        document.getElementById('tahun_ajaran').value;

    const semester =
        document.getElementById('semester').value;

    const mataPelajaran =
        document.getElementById('mata_pelajaran').value;

    const nilaiGanjil =
        document.getElementById('nilai_ganjil').value;

    const nilaiGenap =
        document.getElementById('nilai_genap').value;

    const perubahan =
        document.getElementById('perubahan').value;

    const status =
        document.getElementById('status').value;

    const catatan =
        document.getElementById('catatan').value;


    // Data dummy

    const dataPerkembangan = {

        siswa: siswa,

        kelas: kelas,

        tahun_ajaran: tahunAjaran,

        semester: semester,

        mata_pelajaran: mataPelajaran,

        nilai_ganjil: nilaiGanjil,

        nilai_genap: nilaiGenap,

        perubahan: perubahan,

        status: status,

        catatan: catatan

    };


    // Simpan sementara di browser

    localStorage.setItem(
        'perkembanganNilaiBaru',
        JSON.stringify(dataPerkembangan)
    );


    // Pesan berhasil

    alert(
        'Data perkembangan nilai ' +
        siswa +
        ' berhasil disimpan!'
    );


    // Kembali ke halaman perkembangan nilai

    window.location.href =
        "{{ url('/perkembangan-nilai') }}";

}

</script>

@endsection