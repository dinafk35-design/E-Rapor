@php

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

    if ($filterMapel !== '') {
        $daftarNilai = array_values(array_filter($daftarNilai, fn($item) => $item[0] === $filterMapel));
    }

    $nilaiArray = array_column($daftarNilai, 1);

    $jumlahMapel = count($daftarNilai);

    $totalNilai = array_sum($nilaiArray);

    $rataRata = $jumlahMapel > 0 ? round($totalNilai / $jumlahMapel, 1) : 0;

    $nilaiTertinggi = $jumlahMapel > 0 ? max($nilaiArray) : 0;

    $nilaiTerendah = $jumlahMapel > 0 ? min($nilaiArray) : 0;

    $predikatRataRata = match (true) {
        $rataRata >= 90 => 'Sangat Baik',
        $rataRata >= 80 => 'Baik',
        $rataRata >= 70 => 'Cukup',
        default => 'Kurang',
    };

    $statusRataRata = $rataRata >= 80 ? 'Tuntas' : 'Belum Tuntas';

    $mapelNilaiTertinggi = '-';

    if ($jumlahMapel > 0) {
        $indexTertinggi = array_search($nilaiTertinggi, $nilaiArray);

        $mapelNilaiTertinggi = $daftarNilai[$indexTertinggi][0] ?? '-';
    }

@endphp

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $judulDokumen }} - {{ $siswa }}
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/regular/style.css">

    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: #e5e7eb;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
        }

        .dokumen {

            width: 210mm;
            min-height: 297mm;

            margin: 20px auto;

            padding: 16mm;

            background: white;

            box-sizing: border-box;

        }

        table {
            border-collapse: collapse;
        }

        tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .hindari-potong {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        @media print {

            html,
            body {
                background: white !important;
            }

            .dokumen {

                width: 100%;

                min-height: auto;

                margin: 0;

                padding: 0;

            }

        }
    </style>

</head>


<body>

    <main class="dokumen">

        {{-- ============================= --}}
        {{-- KOP SEKOLAH --}}
        {{-- ============================= --}}

        <div class="hindari-potong flex items-center gap-5 border-b-2 border-gray-900 pb-4">

            <div class="flex h-20 w-20 shrink-0 items-center justify-center border-2 border-gray-900 text-3xl">

                <i class="ph ph-graduation-cap"></i>

            </div>


            <div class="flex-1 text-center">

                <h1 class="text-xl font-bold uppercase tracking-wide">
                    SMK E-Rapor
                </h1>

                <p class="mt-1 text-xs">
                    Jl. Contoh No. 10, Palembang, Sumatera Selatan 30123
                </p>

                <p class="text-xs">
                    Telp. (071) 1234567
                    &nbsp;|&nbsp;
                    Email: info@smkerapor.sch.id
                </p>

            </div>

        </div>


        {{-- ============================= --}}
        {{-- JUDUL --}}
        {{-- ============================= --}}

        <div class="hindari-potong mt-6 text-center">

            <h2 class="text-lg font-bold uppercase tracking-widest">
                {{ $judulDokumen }}
            </h2>

            <p class="mt-1 text-sm">
                Tahun Ajaran {{ $tahunAjaran }}
                &nbsp;&bull;&nbsp;
                Semester {{ $semester }}
            </p>

        </div>


        {{-- ============================= --}}
        {{-- IDENTITAS --}}
        {{-- ============================= --}}

        <table class="mt-6 w-full text-sm">

            <tbody>

                <tr>
                    <td class="w-36 py-1">
                        Nama Siswa
                    </td>

                    <td class="w-5 py-1">
                        :
                    </td>

                    <td class="py-1 font-semibold">
                        {{ $siswa }}
                    </td>
                </tr>


                <tr>
                    <td class="py-1">
                        NISN
                    </td>

                    <td class="py-1">
                        :
                    </td>

                    <td class="py-1 font-semibold">
                        {{ $nisn }}
                    </td>
                </tr>


                <tr>
                    <td class="py-1">
                        Kelas
                    </td>

                    <td class="py-1">
                        :
                    </td>

                    <td class="py-1 font-semibold">
                        {{ $kelas }}
                    </td>
                </tr>


                <tr>
                    <td class="py-1">
                        Mata Pelajaran
                    </td>

                    <td class="py-1">
                        :
                    </td>

                    <td class="py-1 font-semibold">
                        {{ $filterMapel ?: 'Semua Mata Pelajaran' }}
                    </td>
                </tr>

            </tbody>

        </table>


        {{-- ============================= --}}
        {{-- TABEL NILAI --}}
        {{-- ============================= --}}

        <table class="mt-5 w-full border-collapse border border-gray-900 text-sm">

            <thead>

                <tr class="bg-gray-200">

                    <th class="w-12 border border-gray-900 px-3 py-2 text-center">
                        No
                    </th>

                    <th class="border border-gray-900 px-3 py-2 text-left">
                        Mata Pelajaran
                    </th>

                    <th class="w-20 border border-gray-900 px-3 py-2 text-center">
                        Nilai
                    </th>

                    <th class="w-24 border border-gray-900 px-3 py-2 text-center">
                        Predikat
                    </th>

                    <th class="border border-gray-900 px-3 py-2 text-left">
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

                        <td class="border border-gray-900 px-3 py-2 text-center">
                            {{ $index + 1 }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2">
                            {{ $mapel }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center font-bold">
                            {{ $nilai }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center font-bold">
                            {{ $predikat }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2">
                            {{ $keterangan }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="border border-gray-900 px-3 py-8 text-center text-gray-500">
                            Belum ada data nilai.
                        </td>

                    </tr>
                @endforelse

            </tbody>


            @if ($jumlahMapel > 0)
                <tfoot>

                    <tr class="bg-gray-200 font-bold">

                        <td colspan="2" class="border border-gray-900 px-3 py-2 text-right">
                            Rata-rata
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center">
                            {{ $rataRata }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center">
                            {{ $statusRataRata }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2">
                            Tertinggi {{ $nilaiTertinggi }}
                            &bull;
                            Terendah {{ $nilaiTerendah }}
                        </td>

                    </tr>

                </tfoot>
            @endif

        </table>


        {{-- ============================= --}}
        {{-- CATATAN --}}
        {{-- ============================= --}}

        @if ($jumlahMapel > 0)
            <div class="hindari-potong mt-5">

                <p class="text-sm font-bold">
                    Catatan:
                </p>

                <p class="mt-1 text-sm leading-relaxed">

                    Nilai tertinggi adalah
                    <strong>{{ $nilaiTertinggi }}</strong>
                    pada mata pelajaran
                    <strong>{{ $mapelNilaiTertinggi }}</strong>.

                    Nilai terendah adalah
                    <strong>{{ $nilaiTerendah }}</strong>.

                    Rata-rata nilai siswa adalah
                    <strong>{{ $rataRata }}</strong>
                    dengan predikat
                    <strong>{{ $predikatRataRata }}</strong>.

                </p>

            </div>
        @endif


        {{-- ============================= --}}
        {{-- TANDA TANGAN --}}
        {{-- ============================= --}}

        <div class="hindari-potong mt-12 grid grid-cols-2 gap-10 text-center text-sm">

            <div>

                <p>
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

                <p>
                    {{ $kelas }},
                    {{ now()->format('d F Y') }}
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

    </main>

</body>

</html>
