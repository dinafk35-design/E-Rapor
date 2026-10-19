@php

    $judulDokumen = match ($jenisCetak) {
        'Rapor Siswa' => 'RAPOR SISWA',
        'Rekap Nilai' => 'REKAPITULASI NILAI',
        default => 'DAFTAR NILAI',
    };

    $nilaiTersimpan = $daftarNilai
        ->map(fn ($n) => $n->nilai === null ? null : (float) $n->nilai)
        ->filter(fn ($n) => $n !== null)
        ->values();

    $jumlahMapel = $daftarNilai->count();

    $rataRata = $nilaiTersimpan->isEmpty()
        ? null
        : round($nilaiTersimpan->avg(), 1);

    $nilaiTertinggi = $nilaiTersimpan->isEmpty() ? null : $nilaiTersimpan->max();

    $nilaiTerendah = $nilaiTersimpan->isEmpty() ? null : $nilaiTersimpan->min();

    $predikatRataRata = $rataRata === null
        ? '-'
        : match (true) {
            $rataRata >= 90 => 'Sangat Baik',
            $rataRata >= 80 => 'Baik',
            $rataRata >= 70 => 'Cukup',
            default => 'Kurang',
        };

    $statusRataRata = $rataRata === null
        ? '-'
        : ($rataRata >= 80 ? 'Tuntas' : 'Belum Tuntas');

    $mapelNilaiTertinggi = '-';

    if (! $nilaiTersimpan->isEmpty()) {
        $tertinggi = $daftarNilai
            ->firstWhere(fn ($n) => $n->nilai !== null && (float) $n->nilai === $nilaiTertinggi);

        $mapelNilaiTertinggi = $tertinggi?->mataPelajaran?->nama_mata_pelajaran ?? '-';
    }

    // Keterangan izin, sakit, dan alpa untuk periode yang dicetak.
    $izin = (int) ($kehadiran->izin ?? 0);
    $sakit = (int) ($kehadiran->sakit ?? 0);
    $alpa = (int) ($kehadiran->alpa ?? 0);
    $totalKetidakhadiran = $izin + $sakit + $alpa;

    $format = fn ($angka) => $angka === null
        ? '-'
        : rtrim(rtrim(number_format((float) $angka, 2, '.', ''), '0'), '.');

@endphp

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $judulDokumen }} - {{ $siswa->nama_siswa }}
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
                    {{ $sekolah?->nama_sekolah ?? 'SMK E-Rapor' }}
                </h1>

                <p class="mt-1 text-xs">
                    {{ $sekolah?->alamat ?? 'Jl. Contoh No. 10, Palembang, Sumatera Selatan 30123' }}
                </p>

                <p class="text-xs">
                    @if ($sekolah?->telepon)
                        Telp. {{ $sekolah->telepon }}
                        &nbsp;|&nbsp;
                    @endif
                    {{ $sekolah?->email ?? 'info@smkerapor.sch.id' }}
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
                        {{ $siswa->nama_siswa }}
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
                        {{ $siswa->nisn ?? '-' }}
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
                        {{ $rombel?->nama_rombel ?? '-' }}
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
                        {{ $filterMapel?->nama_mata_pelajaran ?? 'Semua Mata Pelajaran' }}
                    </td>
                </tr>

            </tbody>

        </table>


        {{-- ============================= --}}
        {{-- KETERANGAN KEHADIRAN --}}
        {{-- ============================= --}}

        <table class="mt-5 w-full border-collapse border border-gray-900 text-sm">

            <thead>

                <tr class="bg-gray-200">

                    <th colspan="3" class="border border-gray-900 px-3 py-2 text-left">
                        Keterangan Kehadiran
                    </th>

                </tr>

            </thead>


            <tbody>

                <tr>

                    <td class="w-1/3 border border-gray-900 px-3 py-2 text-center">
                        <span class="font-semibold">{{ $izin }}</span>
                        <span class="block text-[10px] uppercase text-gray-600">Izin</span>
                    </td>

                    <td class="w-1/3 border border-gray-900 px-3 py-2 text-center">
                        <span class="font-semibold">{{ $sakit }}</span>
                        <span class="block text-[10px] uppercase text-gray-600">Sakit</span>
                    </td>

                    <td class="w-1/3 border border-gray-900 px-3 py-2 text-center">
                        <span class="font-semibold">{{ $alpa }}</span>
                        <span class="block text-[10px] uppercase text-gray-600">Alpa</span>
                    </td>

                </tr>


                <tr class="bg-gray-100">

                    <td colspan="3" class="border border-gray-900 px-3 py-1.5 text-center text-xs">
                        Total tidak hadir:
                        <strong>{{ $totalKetidakhadiran }}</strong>
                        hari pada semester {{ $semester }}
                    </td>

                </tr>

                @if (! $kehadiran)
                    <tr>
                        <td colspan="3" class="border border-gray-900 px-3 py-2 text-center text-xs text-gray-600">
                            Keterangan kehadiran untuk periode ini belum diinput,
                            sehingga angka di atas tampil sebagai 0.
                        </td>
                    </tr>
                @endif

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

                @forelse ($daftarNilai as $index => $nilai)
                    @php

                        $angka = $nilai->nilai === null ? null : (float) $nilai->nilai;

                        $predikat = $angka === null
                            ? '-'
                            : match (true) {
                                $angka >= 90 => 'A',
                                $angka >= 80 => 'B',
                                $angka >= 70 => 'C',
                                $angka >= 60 => 'D',
                                default => 'E',
                            };

                        $keteranganNilai = $angka === null
                            ? 'Belum ada nilai'
                            : match (true) {
                                $angka >= 90 => 'Sangat Baik',
                                $angka >= 80 => 'Baik',
                                $angka >= 70 => 'Cukup',
                                $angka >= 60 => 'Perlu Bimbingan',
                                default => 'Belum Tuntas',
                            };

                    @endphp

                    <tr>

                        <td class="border border-gray-900 px-3 py-2 text-center">
                            {{ $index + 1 }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2">
                            {{ $nilai->mataPelajaran?->nama_mata_pelajaran ?? '-' }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center font-bold">
                            {{ $format($angka) }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center font-bold">
                            {{ $predikat }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2">
                            {{ $keteranganNilai }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="border border-gray-900 px-3 py-8 text-center text-gray-500">
                            Belum ada data nilai pada periode ini.
                        </td>

                    </tr>
                @endforelse

            </tbody>


            @if ($nilaiTersimpan->isNotEmpty())
                <tfoot>

                    <tr class="bg-gray-200 font-bold">

                        <td colspan="2" class="border border-gray-900 px-3 py-2 text-right">
                            Rata-rata
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center">
                            {{ $format($rataRata) }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2 text-center">
                            {{ $statusRataRata }}
                        </td>

                        <td class="border border-gray-900 px-3 py-2">
                            Tertinggi {{ $format($nilaiTertinggi) }}
                            &bull;
                            Terendah {{ $format($nilaiTerendah) }}
                        </td>

                    </tr>

                </tfoot>
            @endif

        </table>


        {{-- ============================= --}}
        {{-- CATATAN --}}
        {{-- ============================= --}}

        @if ($nilaiTersimpan->isNotEmpty())
            <div class="hindari-potong mt-5">

                <p class="text-sm font-bold">
                    Catatan:
                </p>

                <p class="mt-1 text-sm leading-relaxed">

                    Nilai tertinggi adalah
                    <strong>{{ $format($nilaiTertinggi) }}</strong>
                    pada mata pelajaran
                    <strong>{{ $mapelNilaiTertinggi }}</strong>.

                    Nilai terendah adalah
                    <strong>{{ $format($nilaiTerendah) }}</strong>.

                    Rata-rata nilai siswa adalah
                    <strong>{{ $format($rataRata) }}</strong>
                    dengan predikat
                    <strong>{{ $predikatRataRata }}</strong>.

                </p>

            </div>
        @endif

        <div class="hindari-potong mt-4">

            <p class="text-sm font-bold">
                Keterangan kehadiran:
            </p>

            <p class="mt-1 text-sm leading-relaxed">
                Selama semester {{ $semester }} tahun ajaran {{ $tahunAjaran }},
                siswa izin <strong>{{ $izin }}</strong> hari,
                sakit <strong>{{ $sakit }}</strong> hari,
                dan alpa <strong>{{ $alpa }}</strong> hari.
            </p>

        </div>


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
                    {{ $sekolah?->kepala_sekolah ?? '______________________' }}
                </p>

                <p class="text-xs text-gray-600">
                    NIP. {{ $sekolah?->nip_kepala_sekolah ?? '....................' }}
                </p>

            </div>


            <div>

                <p>
                    {{ $rombel?->nama_rombel ?? '-' }},
                    {{ now()->format('d F Y') }}
                </p>

                <p class="font-semibold">
                    Wali Kelas
                </p>

                <div class="h-20"></div>

                <p class="font-semibold">
                    {{ $rombel?->wali?->nama_guru ?? '______________________' }}
                </p>

                <p class="text-xs text-gray-600">
                    NIP. {{ $rombel?->wali?->nip ?? '....................' }}
                </p>

            </div>

        </div>

    </main>

</body>

</html>