```blade
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-6">

    <!-- HEADER -->
    <div class="mb-6">

        <div class="flex items-center gap-3">

            <!-- Tombol Kembali -->
            <a
                href="{{ url('/input-nilai') }}"
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-white text-gray-600 shadow-sm transition hover:bg-gray-100"
            >
                ←
            </a>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Tambah Nilai Siswa
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Silakan masukkan data siswa dan nilai.
                </p>
            </div>

        </div>

    </div>


    <!-- FORM DUMMY -->
    <form
        onsubmit="simpanNilaiDummy(event)"
    >

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
            <!-- NILAI -->
            <!-- ========================= -->

            <div class="mb-8">

                <h2 class="mb-5 border-b border-gray-200 pb-3 text-lg font-bold text-gray-800">
                    Nilai Mata Pelajaran
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


                    <!-- NILAI -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nilai
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
                    href="{{ url('/input-nilai') }}"
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

function simpanNilaiDummy(event) {

    event.preventDefault();

    // Ambil data dari form
    const siswa = document.getElementById('siswa').value;
    const kelas = document.getElementById('kelas').value;
    const tahunAjaran = document.getElementById('tahun_ajaran').value;
    const semester = document.getElementById('semester').value;
    const mataPelajaran = document.getElementById('mata_pelajaran').value;
    const nilai = document.getElementById('nilai').value;
    const catatan = document.getElementById('catatan').value;


    // Data dummy
    const dataNilai = {

        siswa: siswa,

        kelas: kelas,

        tahun_ajaran: tahunAjaran,

        semester: semester,

        mata_pelajaran: mataPelajaran,

        nilai: nilai,

        catatan: catatan

    };


    // Simpan sementara di browser
    localStorage.setItem(
        'nilaiBaru',
        JSON.stringify(dataNilai)
    );


    // Pesan berhasil
    alert(
        'Nilai ' + siswa + ' berhasil disimpan!'
    );


    // Kembali ke halaman Input Nilai
    window.location.href = "{{ url('/input-nilai') }}";

}

</script>

@endsection
```
