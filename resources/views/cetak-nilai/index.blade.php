@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- ========================================= --}}
        {{-- AREA KONTROL --}}
        {{-- ========================================= --}}

        <div id="halamanKontrol">

            {{-- HEADER --}}

            <div
                class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-5 py-5 text-white shadow-sm">

                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => route('dashboard')],
                    ['label' => 'Nilai'],
                    ['label' => 'Cetak Nilai'],
                ]" />

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10">
                        <i class="ph ph-printer text-2xl"></i>
                    </div>

                    <div>

                        <h1 class="text-lg font-bold">
                            Cetak Nilai
                        </h1>

                        <p class="mt-1 max-w-2xl text-xs leading-relaxed text-indigo-100">
                            Pilih siswa, periode penilaian, dan jenis dokumen untuk
                            menampilkan serta mencetak dokumen nilai dalam format A4.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ALERT --}}

            @if (session('status'))
                <div
                    class="mb-5 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-sm">
                    <i class="ph ph-check-circle mt-0.5 text-lg text-green-600"></i>

                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-sm">
                    <i class="ph ph-warning-circle mt-0.5 text-lg text-red-600"></i>

                    <div>{{ $errors->first() }}</div>
                </div>
            @endif


            {{-- FORM --}}

            <form id="formCetak" class="mb-6 rounded-xl border border-slate-200 bg-white shadow-sm"
                onsubmit="return tampilkanPratinjau()">

                {{-- HEADER FORM --}}

                <div class="border-b border-slate-200 px-5 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-faders-horizontal text-lg"></i>
                        </div>

                        <div>

                            <h2 class="text-sm font-bold text-slate-800">
                                Pilihan Data Cetak
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Tentukan data siswa dan periode yang akan ditampilkan.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="space-y-6 p-5">

                    {{-- DATA SISWA --}}

                    <div>

                        <div class="mb-4 flex items-center gap-2">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                <i class="ph ph-student"></i>
                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">
                                    Data Siswa
                                </h3>

                                <p class="text-[11px] text-slate-500">
                                    Pilih siswa yang akan dicetak.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            {{-- SISWA --}}

                            <div>

                                <label for="siswa" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    Nama Siswa
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <i class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                                    <select name="siswa_id" id="siswa" onchange="isiDetailSiswa()"
                                        class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-9 pr-9 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                        <option value="">
                                            -- Pilih Siswa --
                                        </option>

                                        @foreach ($siswa as $item)
                                            <option value="{{ $item->id }}"
                                                data-nisn="{{ $item->nisn ?? '' }}"
                                                data-rombel="{{ $item->rombel?->nama_rombel ?? '' }}"
                                                data-rombel-id="{{ $item->rombel_id ?? '' }}"
                                                @selected((string) request('siswa_id') === (string) $item->id)>
                                                {{ $item->nama_siswa }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                @if ($siswa->isEmpty())
                                    <p class="mt-1.5 text-[11px] text-amber-600">
                                        Belum ada data siswa. Tambahkan pada menu Data Siswa terlebih dahulu.
                                    </p>
                                @endif

                            </div>


                            {{-- NISN --}}

                            <div>

                                <label for="nisn" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    NISN
                                </label>

                                <div class="relative">

                                    <i
                                        class="ph ph-identification-card absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                                    <input type="text" id="nisn" name="nisn" readonly
                                        placeholder="Otomatis terisi"
                                        class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-9 text-sm text-slate-600">

                                </div>

                            </div>


                            {{-- KELAS --}}

                            <div>

                                <label for="kelas" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    Kelas
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <i
                                        class="ph ph-users-three absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                                    <select name="rombel_id" id="kelas"
                                        class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-9 pr-9 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                        <option value="">
                                            -- Pilih Kelas --
                                        </option>

                                        @foreach ($rombel as $item)
                                            <option value="{{ $item->id }}" @selected((string) $rombelId === (string) $item->id)>
                                                {{ $item->nama_rombel }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="border-t border-slate-100"></div>


                    {{-- PERIODE --}}

                    <div>

                        <div class="mb-4 flex items-center gap-2">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-violet-50 text-violet-600">
                                <i class="ph ph-calendar-blank"></i>
                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">
                                    Periode Penilaian
                                </h3>

                                <p class="text-[11px] text-slate-500">
                                    Tentukan tahun ajaran dan semester.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            <div>

                                <label for="tahun_ajaran" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    Tahun Ajaran
                                    <span class="text-red-500">*</span>
                                </label>

                                <select name="tahun_ajaran" id="tahun_ajaran"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        -- Pilih Tahun Ajaran --
                                    </option>

                                    @foreach ($daftarTahun as $tahun)
                                        <option value="{{ $tahun }}">
                                            {{ $tahun }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            <div>

                                <label for="semester" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    Semester
                                    <span class="text-red-500">*</span>
                                </label>

                                <select name="semester" id="semester"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        -- Pilih Semester --
                                    </option>

                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>

                                </select>

                            </div>

                        </div>

                    </div>


                    <div class="border-t border-slate-100"></div>


                    {{-- KETERANGAN KEHADIRAN --}}

                    <div>

                        <div class="mb-4 flex items-center gap-2">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600">
                                <i class="ph ph-calendar-x"></i>
                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">
                                    Keterangan Kehadiran
                                </h3>

                                <p class="text-[11px] text-slate-500">
                                    Jumlah izin, sakit, dan alpa pada periode yang dipilih.
                                    Data ini muncul di bagian Keterangan dokumen.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                            @foreach (['izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa'] as $kolom => $judul)
                                <div>

                                    <label for="{{ $kolom }}" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                        {{ $judul }}
                                    </label>

                                    <div class="relative">

                                        <i class="ph ph-hash absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                                        <input type="number" name="{{ $kolom }}" id="{{ $kolom }}" min="0" max="400" step="1"
                                            value="{{ request($kolom, 0) }}"
                                            placeholder="0"
                                            class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-9 pr-3 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>


                    <div class="border-t border-slate-100"></div>


                    {{-- DOKUMEN --}}

                    <div>

                        <div class="mb-4 flex items-center gap-2">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                <i class="ph ph-file-text"></i>
                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">
                                    Dokumen
                                </h3>

                                <p class="text-[11px] text-slate-500">
                                    Tentukan jenis dokumen dan mata pelajaran.
                                </p>

                            </div>

                        </div>


                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                            <div>

                                <label for="jenis_cetak" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    Jenis Dokumen
                                    <span class="text-red-500">*</span>
                                </label>

                                <select name="jenis_cetak" id="jenis_cetak"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

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


                            <div>

                                <label for="filter_mata_pelajaran" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    Mata Pelajaran
                                </label>

                                <select name="filter_mata_pelajaran" id="filter_mata_pelajaran"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        Semua Mata Pelajaran
                                    </option>

                                    @foreach ($mataPelajaran as $item)
                                        <option value="{{ $item->id }}" @selected((string) $mapelId === (string) $item->id)>
                                            {{ $item->nama_mata_pelajaran }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>


                    {{-- ACTION --}}

                    <div class="flex flex-wrap gap-2 border-t border-slate-100 pt-5">

                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white hover:bg-indigo-700">
                            <i class="ph ph-eye"></i>
                            Tampilkan Pratinjau
                        </button>

                        <button type="button" id="tombolCetak" onclick="cetakNilai()" disabled
                            class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-5 py-2.5 text-xs font-semibold text-white hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-40">
                            <i class="ph ph-printer"></i>
                            Cetak
                        </button>

                        <button type="button" onclick="resetCetak()"
                            class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                            <i class="ph ph-arrow-counter-clockwise"></i>
                            Reset
                        </button>

                    </div>

                </div>

            </form>


            {{-- ========================================= --}}
            {{-- SIMPAN KEHADIRAN --}}
            {{-- ========================================= --}}

            <form method="POST" action="{{ route('cetak-nilai.kehadiran.store') }}"
                class="rounded-xl border border-slate-200 bg-white shadow-sm">

                @csrf

                <input type="hidden" name="siswa_id" id="kehadiran_siswa_id">

                <div class="border-b border-slate-200 px-5 py-4">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                                <i class="ph ph-floppy-disk text-lg"></i>
                            </div>

                            <div>

                                <h2 class="text-sm font-bold text-slate-800">
                                    Simpan Keterangan Kehadiran
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-500">
                                    Angka izin, sakit, dan alpa di form atas disimpan ke
                                    database memakai siswa dan periode yang sama.
                                </p>

                            </div>

                        </div>

                        <button type="submit"
                            class="inline-flex items-center gap-2 self-start rounded-lg bg-slate-800 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-900 sm:self-auto">
                            <i class="ph ph-check"></i>
                            Simpan Kehadiran
                        </button>

                    </div>

                </div>

                <p class="px-5 py-4 text-xs text-slate-500">
                    Pilih Nama Siswa, Tahun Ajaran, dan Semester pada form di atas
                    terlebih dahulu, lalu tekan Simpan Kehadiran. Nilai disimpan per periode,
                    jadi mengisi Ganjil tidak mengubah rekap Genap.
                </p>

            </form>

        </div>


        {{-- ========================================= --}}
        {{-- AREA PRATINJAU --}}
        {{-- ========================================= --}}

        <div id="areaPratinjau" class="hidden">

            {{-- TOOLBAR PRATINJAU --}}

            <div id="toolbarPratinjau"
                class="mb-4 flex flex-wrap items-center justify-between gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-file-text text-lg"></i>
                    </div>

                    <div>

                        <p class="text-sm font-bold text-slate-800">
                            Pratinjau Dokumen
                        </p>

                        <p class="text-[10px] text-slate-500">
                            Periksa dokumen sebelum mencetak.
                        </p>

                    </div>

                </div>


                <div class="flex gap-2">

                    <button type="button" onclick="kembaliKeForm()"
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                        <i class="ph ph-arrow-left"></i>
                        Kembali
                    </button>

                    <button type="button" onclick="cetakNilai()"
                        class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-xs font-semibold text-white hover:bg-emerald-700">
                        <i class="ph ph-printer"></i>
                        Cetak
                    </button>

                </div>

            </div>


            {{-- DOKUMEN --}}

            <iframe id="pratinjau" title="Pratinjau Dokumen Nilai" src="about:blank"
                class="h-[1100px] w-full rounded-xl border border-slate-200 bg-slate-100 shadow-sm"></iframe>

        </div>

    </div>


    <script>
        /*
        |--------------------------------------------------------------------------
        | FORM CETAK
        |--------------------------------------------------------------------------
        */

        function ambilParameter() {

            const form =
                document.getElementById('formCetak');

            const data =
                new FormData(form);

            return new URLSearchParams(data).toString();

        }


        function tampilkanPratinjau() {

            const wajib = [
                ['siswa', 'Nama Siswa'],
                ['kelas', 'Kelas'],
                ['tahun_ajaran', 'Tahun Ajaran'],
                ['semester', 'Semester'],
                ['jenis_cetak', 'Jenis Dokumen']
            ];

            const form =
                document.getElementById('formCetak');

            const data =
                new FormData(form);

            const kosong =
                wajib.filter(function(item) {

                    return (data.get(item[0]) || '').trim() === '';

                });


            if (kosong.length > 0) {

                alert(
                    'Silakan lengkapi ' +
                    kosong.map(function(item) {
                        return item[1];
                    }).join(', ') +
                    ' terlebih dahulu.'
                );

                return false;

            }


            const url =
                '{{ route('cetak-nilai.create') }}?' +
                ambilParameter();


            document
                .getElementById('pratinjau')
                .src = url;


            document
                .getElementById('halamanKontrol')
                .classList
                .add('hidden');


            document
                .getElementById('areaPratinjau')
                .classList
                .remove('hidden');


            document
                .getElementById('tombolCetak')
                .disabled = false;


            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });


            return false;

        }


        function kembaliKeForm() {

            document
                .getElementById('areaPratinjau')
                .classList
                .add('hidden');


            document
                .getElementById('halamanKontrol')
                .classList
                .remove('hidden');


            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

        }


        function cetakNilai() {

            const iframe =
                document.getElementById('pratinjau');


            if (
                !iframe.src ||
                iframe.src.endsWith('about:blank')
            ) {

                alert('Tampilkan pratinjau terlebih dahulu.');

                return;

            }


            try {

                iframe.contentWindow.focus();

                iframe.contentWindow.print();

            } catch (error) {

                window.open(
                    iframe.src,
                    '_blank'
                );

            }

        }


        function resetCetak() {

            document
                .getElementById('formCetak')
                .reset();


            document
                .getElementById('nisn')
                .value = '';


            document
                .getElementById('kehadiran_siswa_id')
                .value = '';


            document
                .getElementById('areaPratinjau')
                .classList
                .add('hidden');


            document
                .getElementById('halamanKontrol')
                .classList
                .remove('hidden');


            document
                .getElementById('tombolCetak')
                .disabled = true;


            document
                .getElementById('pratinjau')
                .src = 'about:blank';

        }


        /*
        |--------------------------------------------------------------------------
        | SISWA YANG DIPILIH
        |--------------------------------------------------------------------------
        |
        | NISN, kelas, dan id siswa ikut tersalin supaya form "Simpan
        | Kehadiran" memakai siswa yang sama dengan dokumen.
        |
        */

        function isiDetailSiswa() {

            const select =
                document.getElementById('siswa');

            const opsi =
                select.options[select.selectedIndex];

            const terpilih =
                select.value !== '';

            document.getElementById('nisn').value =
                terpilih ? (opsi.dataset.nisn || '') : '';

            document.getElementById('kehadiran_siswa_id').value =
                terpilih ? select.value : '';


            const kelas =
                document.getElementById('kelas');

            const rombelId =
                terpilih ? opsi.dataset.rombelId : '';

            if (
                rombelId !== '' &&
                kelas.value !== rombelId
            ) {

                kelas.value = rombelId;

            }

        }


        document
            .addEventListener('DOMContentLoaded', isiDetailSiswa);
    </script>


    <style>
        /*
    |--------------------------------------------------------------------------
    | Saat print dari halaman index
    |--------------------------------------------------------------------------
    |
    | Hanya iframe tidak ikut tercetak karena dokumen sebenarnya
    | dicetak menggunakan window.print() dari halaman create.
    |
    */

        @media print {

            body>* {
                display: none !important;
            }

        }
    </style>
@endsection