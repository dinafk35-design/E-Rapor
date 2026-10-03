@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- HEADER --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Rombel', 'url' => route('rombel.index')],
                ['label' => 'Tambah Data'],
            ]" />

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15">
                    <i class="ph ph-users-three text-2xl"></i>
                </div>

                <div>
                    <h2 class="text-xl font-bold">
                        Tambah Data Rombel
                    </h2>

                    <p class="mt-1 text-xs text-indigo-100">
                        Tambahkan rombongan belajar, wali kelas, dan anggota siswa.
                    </p>
                </div>

            </div>

        </div>


        <form method="POST" action="{{ route('rombel.store') }}" id="formRombel">

            @csrf


            {{-- VALIDATION ERROR --}}
            @if ($errors->any())
                <div
                    class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">

                    <i class="ph ph-warning-circle mt-0.5 text-lg"></i>

                    <div>
                        <p class="font-semibold">
                            Data belum dapat disimpan
                        </p>

                        <p class="mt-1 text-xs text-red-700">
                            {{ $errors->first() }}
                        </p>
                    </div>

                </div>
            @endif


            {{-- INFORMASI ROMBEL --}}
            <div class="mb-3 flex items-center justify-between">

                <div>
                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-users-three"></i>
                        </div>

                        <h3 class="text-sm font-bold text-slate-800">
                            Informasi Rombel
                        </h3>

                    </div>

                    <p class="mt-1 ml-10 text-xs text-slate-500">
                        Tentukan identitas dasar rombongan belajar dan wali kelas.
                    </p>
                </div>

            </div>


            <div class="mb-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                    {{-- NAMA ROMBEL --}}
                    <div>

                        <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">

                            <i class="ph ph-users-three text-indigo-500"></i>

                            Nama Rombel

                        </label>

                        <input type="text" name="nama_rombel" value="{{ old('nama_rombel') }}"
                            placeholder="Contoh: X RPL 1"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Nama yang digunakan untuk mengidentifikasi rombongan belajar.
                        </p>

                    </div>


                    {{-- TINGKAT --}}
                    <div>

                        <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">

                            <i class="ph ph-stairs text-indigo-500"></i>

                            Tingkat

                        </label>

                        <select name="tingkat"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                -- Pilih Tingkat --
                            </option>

                            <option value="X" @selected(old('tingkat') === 'X')>
                                X
                            </option>

                            <option value="XI" @selected(old('tingkat') === 'XI')>
                                XI
                            </option>

                            <option value="XII" @selected(old('tingkat') === 'XII')>
                                XII
                            </option>

                        </select>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Pilih tingkat kelas sesuai jenjang siswa.
                        </p>

                    </div>


                    {{-- SEKOLAH --}}
                    <div>

                        <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">

                            <i class="ph ph-buildings text-indigo-500"></i>

                            Sekolah

                        </label>

                        <select name="sekolah_id"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                -- Pilih Sekolah --
                            </option>

                            @foreach ($sekolah as $item)
                                <option value="{{ $item->id }}" @selected(old('sekolah_id') == $item->id)>
                                    {{ $item->nama_sekolah }}
                                </option>
                            @endforeach

                        </select>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Sekolah tempat rombongan belajar terdaftar.
                        </p>

                    </div>


                    {{-- WALI KELAS --}}
                    <div>

                        <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">

                            <i class="ph ph-chalkboard-teacher text-indigo-500"></i>

                            Wali Kelas

                        </label>

                        <select name="wali_kelas_id"
                            class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                -- Pilih Wali Kelas --
                            </option>

                            @foreach ($guru as $item)
                                <option value="{{ $item->id }}" @selected(old('wali_kelas_id') == $item->id)>
                                    {{ $item->nama_guru }}
                                </option>
                            @endforeach

                        </select>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Guru yang bertanggung jawab sebagai wali kelas.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ANGGOTA --}}
            <div class="mb-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="ph ph-student"></i>
                        </div>

                        <h3 class="text-sm font-bold text-slate-800">
                            Anggota Rombel
                        </h3>

                        <span id="jumlahAnggota"
                            class="rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold text-emerald-700">
                            1 Anggota
                        </span>

                    </div>

                    <p class="mt-1 ml-10 text-xs text-slate-500">
                        Masukkan siswa yang tergabung dalam rombongan belajar ini.
                    </p>

                </div>


                <button type="button" onclick="tambahAnggota()"
                    class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                    <i class="ph ph-plus"></i>
                    Tambah Anggota
                </button>

            </div>


            <div class="mb-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-5 rounded-lg border border-indigo-100 bg-indigo-50 px-4 py-3">

                    <div class="flex items-start gap-2.5">

                        <i class="ph ph-info mt-0.5 text-lg text-indigo-600"></i>

                        <div>

                            <p class="text-xs font-semibold text-indigo-800">
                                Informasi anggota
                            </p>

                            <p class="mt-1 text-[11px] leading-relaxed text-indigo-700">
                                Setiap anggota perlu memiliki data siswa, tahun ajaran,
                                dan semester agar keanggotaan rombel dapat digunakan
                                dalam proses E-Rapor.
                            </p>

                        </div>

                    </div>

                </div>


                <div id="wrapper-anggota" class="space-y-4">

                    {{-- BARIS ANGGOTA AWAL --}}
                    <div class="anggota-row rounded-xl border border-slate-200 bg-slate-50/50 p-4">

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

                            {{-- SISWA --}}
                            <div>

                                <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                                    <i class="ph ph-student text-emerald-500"></i>
                                    Nama Siswa
                                </label>

                                <select name="siswa_id[]"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        -- Pilih Siswa --
                                    </option>

                                    @foreach ($siswa as $item)
                                        <option value="{{ $item->id }}" @selected(old('siswa_id.0') == $item->id)>
                                            {{ $item->nama_siswa }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>


                            {{-- TAHUN AJARAN --}}
                            <div>

                                <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                                    <i class="ph ph-calendar text-indigo-500"></i>
                                    Tahun Ajaran
                                </label>

                                <select name="tahun_ajaran[]"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        -- Pilih Tahun Ajaran --
                                    </option>

                                    <option value="2025/2026" @selected(old('tahun_ajaran.0') === '2025/2026')>
                                        2025/2026
                                    </option>

                                    <option value="2026/2027" @selected(old('tahun_ajaran.0') === '2026/2027')>
                                        2026/2027
                                    </option>

                                </select>

                            </div>


                            {{-- SEMESTER --}}
                            <div class="flex items-end gap-2">

                                <div class="flex-1">

                                    <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                                        <i class="ph ph-calendar-check text-indigo-500"></i>
                                        Semester
                                    </label>

                                    <select name="semester[]"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                        <option value="">
                                            -- Pilih Semester --
                                        </option>

                                        <option value="Ganjil" @selected(old('semester.0') === 'Ganjil')>
                                            Ganjil
                                        </option>

                                        <option value="Genap" @selected(old('semester.0') === 'Genap')>
                                            Genap
                                        </option>

                                    </select>

                                </div>

                                <button type="button" onclick="hapusAnggota(this)"
                                    class="flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100"
                                    title="Hapus anggota">
                                    <i class="ph ph-trash text-lg"></i>
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ACTION --}}
            <div
                class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center gap-2 text-xs text-slate-500">
                    <i class="ph ph-info text-indigo-500"></i>
                    Pastikan data rombel dan anggota sudah benar sebelum disimpan.
                </div>

                <div class="flex gap-2">

                    <a href="{{ route('rombel.index') }}"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">
                        <i class="ph ph-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        <i class="ph ph-floppy-disk"></i>
                        Simpan Data
                    </button>

                </div>

            </div>

        </form>

    </div>


    <script>
        const templateAnggota = `

    <div class="anggota-row rounded-xl border border-slate-200 bg-slate-50/50 p-4">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">

            <div>

                <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                    <i class="ph ph-student text-emerald-500"></i>
                    Nama Siswa
                </label>

                <select
                    name="siswa_id[]"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                >

                    <option value="">
                        -- Pilih Siswa --
                    </option>

                    @foreach ($siswa as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_siswa }}
                        </option>
                    @endforeach

                </select>

            </div>


            <div>

                <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                    <i class="ph ph-calendar text-indigo-500"></i>
                    Tahun Ajaran
                </label>

                <select
                    name="tahun_ajaran[]"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                >

                    <option value="">
                        -- Pilih Tahun Ajaran --
                    </option>

                    <option value="2025/2026">2025/2026</option>
                    <option value="2026/2027">2026/2027</option>

                </select>

            </div>


            <div class="flex items-end gap-2">

                <div class="flex-1">

                    <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                        <i class="ph ph-calendar-check text-indigo-500"></i>
                        Semester
                    </label>

                    <select
                        name="semester[]"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                    >

                        <option value="">
                            -- Pilih Semester --
                        </option>

                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>

                    </select>

                </div>

                <button
                    type="button"
                    onclick="hapusAnggota(this)"
                    class="flex h-[42px] w-[42px] shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100"
                    title="Hapus anggota"
                >
                    <i class="ph ph-trash text-lg"></i>
                </button>

            </div>

        </div>

    </div>

`;


        function updateJumlahAnggota() {

            const jumlah = document.querySelectorAll('.anggota-row').length;

            const element = document.getElementById('jumlahAnggota');

            if (element) {
                element.textContent =
                    jumlah + (jumlah === 1 ? ' Anggota' : ' Anggota');
            }

        }


        function tambahAnggota() {

            document
                .getElementById('wrapper-anggota')
                .insertAdjacentHTML('beforeend', templateAnggota);

            updateJumlahAnggota();

            const rows = document.querySelectorAll('.anggota-row');

            if (rows.length) {
                rows[rows.length - 1].scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

        }


        function hapusAnggota(tombol) {

            const baris = tombol.closest('.anggota-row');

            const jumlahBaris =
                document.querySelectorAll('.anggota-row').length;


            if (jumlahBaris <= 1) {

                baris.querySelectorAll('select').forEach(function(select) {
                    select.value = '';
                });

                return;

            }


            baris.remove();

            updateJumlahAnggota();

        }

        updateJumlahAnggota();
    </script>
@endsection
