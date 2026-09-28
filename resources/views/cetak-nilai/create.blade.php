@php
    // =============================
    // DATA DOKUMEN CETAK
    // =============================

    $siswa = request('siswa', 'Ahmad Fauzan');
    $nisn = request('nisn', '00654321');
    $kelas = request('kelas', 'XI RPL 1');
    $tahunAjaran = request('tahun_ajaran', '2026/2027');
    $semester = request('semester', 'Ganjil');
    $jenisCetak = request('jenis_cetak', 'Daftar Nilai');
    $filterMapel = request('mata_pelajaran', '');

    $judulDokumen = match ($jenisCetak) {
        'Rapor Siswa' => 'RAPOR SISWA',
        'Rekap Nilai' => 'REKAPITULASI NILAI',
        default => 'DAFTAR NILAI',
    };

    $daftarNilai = [
        ['Matematika', 85],
        ['Bahasa Indonesia', 87],
        ['Bahasa Inggris', 91],
        ['Pendidikan Agama', 84],
        ['PPKn', 86],
        ['Informatika', 89],
        ['Pemrograman Web', 88],
        ['Pemrograman Berorientasi Objek', 90],
        ['Basis Data', 92],
        ['Produk Kreatif dan Kewirausahaan', 85],
    ];

    // Filter per mata pelajaran bila dipilih

    if ($filterMapel !== '') {

        $daftarNilai = array_values(array_filter(
            $daftarNilai,
            fn ($item) => $item[0] === $filterMapel
        ));

    }

    $totalNilai = array_sum(array_column($daftarNilai, 1));
    $jumlahMapel = count($daftarNilai);
    $rataRata = $jumlahMapel > 0 ? round($totalNilai / $jumlahMapel, 1) : 0;

    $nilaiTertinggi = $jumlahMapel > 0 ? max(array_column($daftarNilai, 1)) : 0;
    $nilaiTerendah = $jumlahMapel > 0 ? min(array_column($daftarNilai, 1)) : 0;
@endphp


@extends('layouts.app')

@section('content')

<div class="content">

    <!-- ============================= -->
    <!-- KENDALI (TIDAK IKUT DICETAK) -->
    <!-- ============================= -->

    <div class="cetak-sembunyi">

        <!-- HEADER -->

        <div class="welcome">

            <h2 class="italic font-bold">
                Cetak Nilai
            </h2>

            <p>
                Dokumen berikut akan dicetak pada kertas A4. Pastikan pengaturan
                cetak browser memilih ukuran A4 dan margin bawaan.
            </p>

        </div>


        <!-- RINGKASAN DATA -->

        <div class="bg-white rounded-xl shadow p-6 mb-4">

            <h2 class="section-title" style="margin-top: 0">
                <i class="ph ph-file-text"></i>
                Data yang Dicetak
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">

                <div>
                    <p class="text-xs uppercase text-gray-400 font-semibold">
                        Nama Siswa
                    </p>
                    <p class="font-semibold text-gray-800">
                        {{ $siswa }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-400 font-semibold">
                        NISN
                    </p>
                    <p class="font-semibold text-gray-800">
                        {{ $nisn }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-400 font-semibold">
                        Kelas
                    </p>
                    <p class="font-semibold text-gray-800">
                        {{ $kelas }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-400 font-semibold">
                        Tahun Ajaran
                    </p>
                    <p class="font-semibold text-gray-800">
                        {{ $tahunAjaran }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-400 font-semibold">
                        Semester
                    </p>
                    <p class="font-semibold text-gray-800">
                        {{ $semester }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase text-gray-400 font-semibold">
                        Dokumen
                    </p>
                    <p class="font-semibold text-gray-800">
                        {{ $jenisCetak }}
                    </p>
                </div>

            </div>

        </div>


        <!-- TOMBOL -->

        <div class="flex flex-wrap gap-3 mb-6">

            <a
                href="{{ route('cetak-nilai') }}"
                class="px-5 py-2 rounded-lg bg-gray-500 text-white"
            >
                <i class="ph ph-arrow-left mr-1"></i>
                Ganti Data
            </a>


            <button
                type="button"
                onclick="cetakNilai()"
                class="px-5 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700"
            >

                <i class="ph ph-printer mr-1"></i>

                Cetak

            </button>

        </div>

    </div>


    <!-- ============================= -->
    <!-- DOKUMEN CETAK -->
    <!-- ============================= -->

    <div class="cetak-dokumen bg-white rounded-xl shadow p-8">

        <!-- KOP SURAT -->

        <div class="cetak-avoid flex items-center gap-5 pb-4 border-b-2 border-gray-800">

            <div
                class="flex items-center justify-center w-20 h-20 shrink-0 border-2 border-gray-800 rounded-lg text-3xl"
            >
                <i class="ph ph-graduation-cap"></i>
            </div>

            <div class="text-center flex-1">

                <h1 class="text-xl font-bold uppercase tracking-wide text-gray-900">
                    SMK E-Rapor
                </h1>

                <p class="text-xs text-gray-700 mt-1">
                    Jl. Contoh No. 10, Palembang, Sumatera Selatan 30123
                </p>

                <p class="text-xs text-gray-700">
                    Telp. (071) 1234567 &nbsp;|&nbsp; Email: info@smkerapor.sch.id
                </p>

            </div>

        </div>


        <!-- JUDUL DOKUMEN -->

        <div class="mt-6 text-center">

            <h2 class="text-lg font-bold uppercase tracking-widest text-gray-900">
                {{ $judulDokumen }}
            </h2>

            <p class="text-sm text-gray-700 mt-1">
                Tahun Ajaran {{ $tahunAjaran }} &nbsp;&bull;&nbsp; Semester {{ $semester }}
            </p>

        </div>


        <!-- IDENTITAS SISWA -->

        <table class="w-full mt-6 text-sm border-none">

            <tbody>

                <tr>
                    <td class="w-32 py-1 align-top">
                        Nama Siswa
                    </td>
                    <td class="w-4 py-1 align-top">
                        :
                    </td>
                    <td class="py-1 align-top font-semibold">
                        {{ $siswa }}
                    </td>
                </tr>

                <tr>
                    <td class="py-1 align-top">
                        NISN
                    </td>
                    <td class="py-1 align-top">
                        :
                    </td>
                    <td class="py-1 align-top font-semibold">
                        {{ $nisn }}
                    </td>
                </tr>

                <tr>
                    <td class="py-1 align-top">
                        Kelas
                    </td>
                    <td class="py-1 align-top">
                        :
                    </td>
                    <td class="py-1 align-top font-semibold">
                        {{ $kelas }}
                    </td>
                </tr>

                <tr>
                    <td class="py-1 align-top">
                        Mata Pelajaran
                    </td>
                    <td class="py-1 align-top">
                        :
                    </td>
                    <td class="py-1 align-top font-semibold">
                        {{ $filterMapel === '' ? 'Semua Mata Pelajaran' : $filterMapel }}
                    </td>
                </tr>

            </tbody>

        </table>


        <!-- TABEL NILAI -->

        <table class="w-full mt-5 text-sm border-collapse border border-gray-800">

            <thead>

                <tr class="bg-gray-200">

                    <th class="cetak-avoid border border-gray-800 px-3 py-2 w-12 text-center">
                        No
                    </th>

                    <th class="cetak-avoid border border-gray-800 px-3 py-2 text-left">
                        Mata Pelajaran
                    </th>

                    <th class="cetak-avoid border border-gray-800 px-3 py-2 w-20 text-center">
                        Nilai
                    </th>

                    <th class="cetak-avoid border border-gray-800 px-3 py-2 w-20 text-center">
                        Predikat
                    </th>

                    <th class="cetak-avoid border border-gray-800 px-3 py-2 text-left">
                        Keterangan
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($daftarNilai as $index => $item)

                    @php
                        [$mapel, $nilai] = $item;

                        $predikat = match (true) {
                            $nilai >= 90 => 'A',
                            $nilai >= 80 => 'B',
                            $nilai >= 70 => 'C',
                            $nilai >= 60 => 'D',
                            default => 'E',
                        };

                        $keterangan = match (true) {
                            $nilai >= 90 => 'Sangat Baik',
                            $nilai >= 80 => 'Baik',
                            $nilai >= 70 => 'Cukup',
                            $nilai >= 60 => 'Perlu Bimbingan',
                            default => 'Belum Tuntas',
                        };
                    @endphp

                    <tr>

                        <td class="cetak-avoid border border-gray-800 px-3 py-2 text-center">
                            {{ $index + 1 }}
                        </td>

                        <td class="cetak-avoid border border-gray-800 px-3 py-2">
                            {{ $mapel }}
                        </td>

                        <td class="cetak-avoid border border-gray-800 px-3 py-2 text-center font-bold">
                            {{ $nilai }}
                        </td>

                        <td class="cetak-avoid border border-gray-800 px-3 py-2 text-center font-bold">
                            {{ $predikat }}
                        </td>

                        <td class="cetak-avoid border border-gray-800 px-3 py-2">
                            {{ $keterangan }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td
                            colspan="5"
                            class="cetak-avoid border border-gray-800 px-3 py-6 text-center text-gray-500"
                        >
                            Belum ada data nilai untuk mata pelajaran ini.
                        </td>
                    </tr>

                @endforelse

            </tbody>


            <tfoot>

                <tr class="bg-gray-200 font-bold">

                    <td
                        colspan="2"
                        class="cetak-avoid border border-gray-800 px-3 py-2 text-right"
                    >
                        Rata-rata
                    </td>

                    <td class="cetak-avoid border border-gray-800 px-3 py-2 text-center">
                        {{ $rataRata }}
                    </td>

                    <td class="cetak-avoid border border-gray-800 px-3 py-2 text-center">
                        {{ $jumlahMapel > 0 && $rataRata >= 80 ? 'Tuntas' : 'Belum Tuntas' }}
                    </td>

                    <td class="cetak-avoid border border-gray-800 px-3 py-2">
                        @if ($jumlahMapel > 0)
                            Tertinggi {{ $nilaiTertinggi }} &bull; Terendah {{ $nilaiTerendah }}
                        @endif
                    </td>

                </tr>

            </tfoot>

        </table>


        <!-- CATATAN -->

        <div class="cetak-avoid mt-5">

            <p class="text-sm font-bold">
                Catatan :
            </p>

            <p class="text-sm text-gray-800 mt-1">
                Nilai Tertinggi {{ $nilaiTertinggi }} pada
                {{ $daftarNilai[array_search($nilaiTertinggi, array_column($daftarNilai, 1))][0] ?? '-' }}
                dan Nilai Terendah {{ $nilaiTerendah }}. Siswa memperoleh nilai
                rata-rata {{ $rataRata }} dengan predikat
                {{ $jumlahMapel > 0 && $rataRata >= 80 ? ' Baik' : ' Cukup' }}.
            </p>

        </div>


        <!-- TANDA TANGAN -->

        <div class="cetak-avoid mt-10 grid grid-cols-2 gap-10 text-center text-sm">

            <div>

                <p class="text-gray-700">
                    Mengetahui,
                </p>

                <p class="font-semibold">
                    Kepala Sekolah
                </p>

                <div class="h-20"></div>

                <p class="font-semibold">
                    ______________________
                </p>

                <p class="text-xs text-gray-600">
                    NIP. 198501012010011001
                </p>

            </div>


            <div>

                <p class="text-gray-700">
                    {{ $kelas }}, {{ now()->format('d F Y') }}
                </p>

                <p class="font-semibold">
                    Wali Kelas
                </p>

                <div class="h-20"></div>

                <p class="font-semibold">
                    ______________________
                </p>

                <p class="text-xs text-gray-600">
                    NIP. 198502022010011002
                </p>

            </div>

        </div>

    </div>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>


/* ============================= */
/* CETAK DOKUMEN */
/* ============================= */

function cetakNilai() {

    window.print();

}

</script>


<!-- ============================= -->
<!-- STYLE KHUSUS CETAK */
/* ============================= -->

<style>

    @media print {

        /* Sembunyikan seluruh elemen kecuali dokumen */

        .cetak-dokumen ~ *,
        .cetak-sembunyi {

            display: none !important;
        }

        /* Dokumen Cetak */

        .cetak-dokumen {

            box-shadow: none !important;

            border: none !important;

            border-radius: 0 !important;

            padding: 0 !important;

            margin: 0 !important;

            width: 100% !important;

        }

        /* Pastikan tabel tidak terpotong */

        .cetak-dokumen table {

            page-break-inside: auto;

        }

        .cetak-dokumen tr {

            page-break-inside: avoid;

            break-inside: avoid;

        }

        /* Warna latar tetap tercetak */

        .cetak-dokumen * {

            -webkit-print-color-adjust: exact !important;

            print-color-adjust: exact !important;

        }

    }

</style>


@endsection
