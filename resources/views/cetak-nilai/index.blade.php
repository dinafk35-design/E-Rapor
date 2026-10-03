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

                                    <select name="siswa" id="siswa" onchange="isiNisn()"
                                        class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-9 pr-9 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

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

                                    <select name="kelas" id="kelas"
                                        class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-9 pr-9 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                        <option value="">
                                            -- Pilih Kelas --
                                        </option>

                                        <option value="X RPL 1">X RPL 1</option>
                                        <option value="X RPL 2">X RPL 2</option>
                                        <option value="XI RPL 1">XI RPL 1</option>
                                        <option value="XI RPL 2">XI RPL 2</option>
                                        <option value="XII RPL 1">XII RPL 1</option>
                                        <option value="XII RPL 2">XII RPL 2</option>

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

                                    <option value="2025/2026">2025/2026</option>
                                    <option value="2026/2027">2026/2027</option>

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

                                <label for="mata_pelajaran" class="mb-1.5 block text-xs font-semibold text-slate-700">
                                    Mata Pelajaran
                                </label>

                                <select name="mata_pelajaran" id="mata_pelajaran"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        Semua Mata Pelajaran
                                    </option>

                                    <option value="Matematika">Matematika</option>
                                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="Pendidikan Agama">Pendidikan Agama</option>
                                    <option value="PPKn">PPKn</option>
                                    <option value="Informatika">Informatika</option>
                                    <option value="Pemrograman Web">Pemrograman Web</option>
                                    <option value="Pemrograman Berorientasi Objek">Pemrograman Berorientasi Objek</option>
                                    <option value="Basis Data">Basis Data</option>
                                    <option value="Produk Kreatif dan Kewirausahaan">
                                        Produk Kreatif dan Kewirausahaan
                                    </option>

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
        const dataSiswa = {
            "Ahmad Fauzan": "00654321",
            "Budi Santoso": "00765432",
            "Citra Lestari": "00876543",
            "Dimas Pratama": "00987654",
            "Eka Putri": "00123456"
        };


        function isiNisn() {

            const siswa =
                document.getElementById('siswa').value;

            document.getElementById('nisn').value =
                dataSiswa[siswa] || '';

        }


        function ambilParameter() {

            const form =
                document.getElementById('formCetak');

            const data =
                new FormData(form);

            return new URLSearchParams(data).toString();

        }


        function tampilkanPratinjau() {

            const wajib = [
                'siswa',
                'kelas',
                'tahun_ajaran',
                'semester',
                'jenis_cetak'
            ];

            const form =
                document.getElementById('formCetak');

            const data =
                new FormData(form);

            const kosong =
                wajib.filter(function(nama) {

                    return (data.get(nama) || '').trim() === '';

                });


            if (kosong.length > 0) {

                alert(
                    'Silakan lengkapi Nama Siswa, Kelas, Tahun Ajaran, Semester, dan Jenis Dokumen terlebih dahulu.'
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
