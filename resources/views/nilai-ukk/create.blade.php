@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">

    <!-- HEADER -->
    <div class="mb-6">

        <div class="flex items-center gap-3">

            <!-- Tombol Kembali -->
            <a
                href="{{ url('/nilai-ukk') }}"
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-white text-gray-600 shadow-sm transition hover:bg-gray-100"
            >
                <i class="ph ph-arrow-left"></i>
            </a>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Tambah Nilai UKK
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Silakan masukkan data siswa dan nilai UKK.
                </p>
            </div>

        </div>

    </div>


    <!-- FORM DUMMY -->
    <form onsubmit="simpanNilaiUKK(event)">

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


                    <!-- NISN -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            NISN
                        </label>

                        <input
                            type="text"
                            id="nisn"
                            placeholder="Masukkan NISN"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

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
                            id="konsentrasi"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                            <option value="">
                                -- Pilih Konsentrasi --
                            </option>

                            <option value="RPL">
                                Rekayasa Perangkat Lunak (RPL)
                            </option>

                            <option value="TKJ">
                                Teknik Komputer dan Jaringan (TKJ)
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
            <!-- DATA UKK -->
            <!-- ========================= -->

            <div class="mb-8">

                <h2 class="mb-5 border-b border-gray-200 pb-3 text-lg font-bold text-gray-800">
                    Data UKK
                </h2>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                    <!-- KOMPETENSI UKK -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Kompetensi / Materi UKK
                        </label>

                        <select
                            id="kompetensi"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                            <option value="">
                                -- Pilih Kompetensi UKK --
                            </option>

                            <option value="Pembuatan Website">
                                Pembuatan Website
                            </option>

                            <option value="Aplikasi Web">
                                Aplikasi Web
                            </option>

                            <option value="Basis Data">
                                Basis Data
                            </option>

                            <option value="Pemrograman Mobile">
                                Pemrograman Mobile
                            </option>

                            <option value="Instalasi Jaringan">
                                Instalasi Jaringan
                            </option>

                        </select>

                    </div>


                    <!-- NILAI UKK -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nilai UKK
                        </label>

                        <input
                            type="number"
                            id="nilai"
                            min="0"
                            max="100"
                            placeholder="Masukkan nilai 0 - 100"
                            required
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                    </div>


                    <!-- PREDIKAT -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Predikat
                        </label>

                        <select
                            id="predikat"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                            <option value="">
                                -- Pilih Predikat --
                            </option>

                            <option value="Sangat Baik">
                                Sangat Baik
                            </option>

                            <option value="Baik">
                                Baik
                            </option>

                            <option value="Cukup">
                                Cukup
                            </option>

                            <option value="Kurang">
                                Kurang
                            </option>

                        </select>

                    </div>


                    <!-- STATUS -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Status
                        </label>

                        <select
                            id="status"
                            required
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        >

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option value="Lulus">
                                Lulus
                            </option>

                            <option value="Belum Lulus">
                                Belum Lulus
                            </option>

                        </select>

                    </div>

                </div>

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
                    placeholder="Masukkan catatan jika diperlukan..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                ></textarea>

            </div>


            <!-- ========================= -->
            <!-- BUTTON -->
            <!-- ========================= -->

            <div class="flex justify-end gap-3 border-t border-gray-200 pt-6">


                <!-- BATAL -->
                <a
                    href="{{ url('/nilai-ukk') }}"
                    class="rounded-lg bg-gray-200 px-6 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-300"
                >
                    Batal
                </a>


                <!-- SIMPAN -->
                <button
                    type="submit"
                    class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
                >
                    Simpan Nilai
                </button>

            </div>

        </div>

    </form>

</div>


<!-- ========================= -->
<!-- JAVASCRIPT DATA DUMMY -->
<!-- ========================= -->

<script>

function simpanNilaiUKK(event) {

    event.preventDefault();


    // Ambil data dari form
    const siswa = document.getElementById('siswa').value;
    const nisn = document.getElementById('nisn').value;
    const kelas = document.getElementById('kelas').value;
    const konsentrasi = document.getElementById('konsentrasi').value;
    const tahunAjaran = document.getElementById('tahun_ajaran').value;
    const semester = document.getElementById('semester').value;
    const kompetensi = document.getElementById('kompetensi').value;
    const nilai = document.getElementById('nilai').value;
    const predikat = document.getElementById('predikat').value;
    const status = document.getElementById('status').value;
    const catatan = document.getElementById('catatan').value;


    // Data UKK baru
    const dataUKK = {

        id: Date.now(),

        siswa: siswa,

        nisn: nisn,

        kelas: kelas,

        konsentrasi: konsentrasi,

        tahun_ajaran: tahunAjaran,

        semester: semester,

        kompetensi: kompetensi,

        nilai: nilai,

        predikat: predikat,

        status: status,

        catatan: catatan

    };


    // Ambil data UKK sebelumnya
    let dataNilaiUKK =
        JSON.parse(localStorage.getItem('nilaiUKK')) || [];


    // Tambahkan data baru
    dataNilaiUKK.push(dataUKK);


    // Simpan ke browser
    localStorage.setItem(
        'nilaiUKK',
        JSON.stringify(dataNilaiUKK)
    );


    // Pesan berhasil
    alert(
        'Nilai UKK ' + siswa + ' berhasil disimpan!'
    );


    // Kembali ke halaman Nilai UKK
    window.location.href = "{{ url('/nilai-ukk') }}";

}

</script>

@endsection