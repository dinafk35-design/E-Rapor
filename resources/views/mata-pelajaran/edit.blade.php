@extends('layouts.app')

@section('content')

    <div class="content">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Mata Pelajaran', 'url' => route('mata-pelajaran.index')],
                ['label' => 'Edit Mata Pelajaran'],
            ]" />

            <div class="mt-1 flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                        <i class="ph ph-pencil-simple text-2xl"></i>
                    </div>

                    <div>

                        <h1 class="text-xl font-bold">
                            Edit Mata Pelajaran
                        </h1>

                        <p class="mt-1 text-xs text-[#c2c2dc]">
                            Perbarui informasi mata pelajaran dan kelola guru yang mengajar.
                        </p>

                    </div>

                </div>

                <div class="hidden rounded-xl bg-white/10 px-5 py-3 ring-1 ring-white/10 sm:block">

                    <p class="text-[10px] uppercase tracking-wide text-[#c2c2dc]">
                        Guru Mengajar
                    </p>

                    <p class="mt-0.5 text-2xl font-bold">
                        {{ $mataPelajaran->guruMengajar->count() }}
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ALERT
        ====================================================== --}}
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <i class="ph ph-check-circle text-lg"></i>
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-emerald-800">
                            Berhasil
                        </p>

                        <p class="mt-1 text-xs text-emerald-700">
                            {{ session('status') }}
                        </p>

                    </div>

                </div>

            </div>
        @endif


        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 shadow-sm">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <i class="ph ph-warning-circle text-lg"></i>
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-red-800">
                            Periksa kembali data
                        </p>

                        <p class="mt-1 text-xs text-red-700">
                            {{ $errors->first() }}
                        </p>

                    </div>

                </div>

            </div>
        @endif


        {{-- =====================================================
            DATA UTAMA
        ====================================================== --}}
        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <i class="ph ph-book-open text-lg"></i>
                </div>

                <div>

                    <h2 class="text-base font-bold text-slate-800">
                        Informasi Mata Pelajaran
                    </h2>

                    <p class="text-[11px] text-slate-400">
                        Perbarui identitas dan pengelompokan mata pelajaran.
                    </p>

                </div>

            </div>


            <form action="{{ route('mata-pelajaran.update', $mataPelajaran->id) }}" method="POST">

                @csrf
                @method('PUT')


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- KODE --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Kode Mata Pelajaran
                        </label>

                        <div class="relative">

                            <i class="ph ph-hash absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <input type="text" name="kode_mata_pelajaran"
                                value="{{ old('kode_mata_pelajaran', $mataPelajaran->kode_mata_pelajaran) }}"
                                placeholder="Contoh: RPL001"
                                class="w-full rounded-lg border border-slate-200 py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        </div>

                        <p class="mt-1.5 text-[10px] text-slate-400">
                            Kode identitas mata pelajaran dalam sistem.
                        </p>

                        @error('kode_mata_pelajaran')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- NAMA --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Nama Mata Pelajaran
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-book-bookmark absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <input type="text" name="nama_mata_pelajaran"
                                value="{{ old('nama_mata_pelajaran', $mataPelajaran->nama_mata_pelajaran) }}"
                                placeholder="Masukkan nama mata pelajaran"
                                class="w-full rounded-lg border border-slate-200 py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                required>

                        </div>

                        @error('nama_mata_pelajaran')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- KELOMPOK --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Kelompok
                        </label>

                        <div class="relative">

                            <i class="ph ph-stack absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <select name="kelompok"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Kelompok --
                                </option>

                                <option value="A" @selected(old('kelompok', $mataPelajaran->kelompok) === 'A')>
                                    Kelompok A
                                </option>

                                <option value="B" @selected(old('kelompok', $mataPelajaran->kelompok) === 'B')>
                                    Kelompok B
                                </option>

                                <option value="C" @selected(old('kelompok', $mataPelajaran->kelompok) === 'C')>
                                    Kelompok C
                                </option>

                                <option value="Muatan Lokal" @selected(old('kelompok', $mataPelajaran->kelompok) === 'Muatan Lokal')>
                                    Muatan Lokal
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- SEKOLAH --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Sekolah
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-buildings absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <select name="sekolah_id"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Sekolah --
                                </option>

                                @foreach ($sekolah as $item)
                                    <option value="{{ $item->id }}" @selected((string) old('sekolah_id', $mataPelajaran->sekolah_id) === (string) $item->id)>
                                        {{ $item->nama_sekolah }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        @error('sekolah_id')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                <div
                    class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-between">

                    <a href="{{ route('mata-pelajaran.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-100 px-5 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                        <i class="ph ph-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        <i class="ph ph-floppy-disk"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>


        {{-- =====================================================
            GURU MENGAJAR
        ====================================================== --}}
        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

            <div class="mb-5 flex flex-wrap items-start justify-between gap-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="ph ph-chalkboard-teacher text-lg"></i>
                    </div>

                    <div>

                        <h2 class="text-base font-bold text-slate-800">
                            Guru yang Mengajar
                        </h2>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Guru yang terhubung dengan mata pelajaran
                            <span class="font-semibold text-indigo-600">
                                {{ $mataPelajaran->nama_mata_pelajaran }}
                            </span>.
                        </p>

                    </div>

                </div>


                <div class="flex items-center gap-2">

                    <span
                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700">
                        <i class="ph ph-users-three"></i>
                        <span id="jumlahGuru">
                            {{ $mataPelajaran->guruMengajar->count() }}
                        </span>
                        Guru
                    </span>

                    <button type="button" onclick="bukaModalTambah()"
                        class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                        <i class="ph ph-user-plus"></i>
                        Tambah Guru
                    </button>

                </div>

            </div>


            <div class="overflow-x-auto rounded-xl border border-slate-200">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-slate-200 bg-slate-50">

                        <tr>

                            <th class="px-4 py-3 text-xs font-semibold text-slate-600">
                                No
                            </th>

                            <th class="px-4 py-3 text-xs font-semibold text-slate-600">
                                Guru
                            </th>

                            <th class="px-4 py-3 text-xs font-semibold text-slate-600">
                                Kontak
                            </th>

                            <th class="px-4 py-3 text-xs font-semibold text-slate-600">
                                Rombel
                            </th>

                            <th class="px-4 py-3 text-xs font-semibold text-slate-600">
                                Periode
                            </th>

                            <th class="px-4 py-3 text-center text-xs font-semibold text-slate-600">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="tabelGuru">

                        @forelse ($mataPelajaran->guruMengajar as $index => $relasi)
                            <tr id="baris-guru-{{ $relasi->id }}"
                                class="border-b border-slate-100 transition hover:bg-slate-50">

                                <td class="px-4 py-4 text-sm text-slate-500">
                                    {{ $index + 1 }}
                                </td>


                                <td class="px-4 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                            <i class="ph ph-chalkboard-teacher"></i>
                                        </div>

                                        <div>

                                            <p class="font-semibold text-slate-800">
                                                {{ $relasi->guru->nama_guru ?? '-' }}
                                            </p>

                                            <p class="mt-0.5 text-[11px] text-slate-400">
                                                NIP:
                                                {{ $relasi->guru->nip ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                <td class="px-4 py-4">

                                    <p class="text-sm text-slate-700">
                                        {{ $relasi->guru->email ?? '-' }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        {{ $relasi->guru->no_telepon ?? '-' }}
                                    </p>

                                </td>


                                <td class="px-4 py-4">

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                        <i class="ph ph-users-three"></i>
                                        {{ $relasi->rombel->nama_rombel ?? '-' }}
                                    </span>

                                </td>


                                <td class="px-4 py-4">

                                    <p class="text-sm font-medium text-slate-700">
                                        {{ $relasi->tahun_ajaran ?? '-' }}
                                    </p>

                                    <p class="mt-1 text-[11px] text-slate-400">
                                        Semester {{ $relasi->semester ?? '-' }}
                                    </p>

                                </td>


                                <td class="px-4 py-4">

                                    <div class="flex items-center justify-center gap-1.5">

                                        <button type="button" onclick="bukaModalGanti({{ $relasi->id }})"
                                            class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-blue-700">
                                            <i class="ph ph-pencil-simple"></i>
                                            Ganti
                                        </button>


                                        <form
                                            action="{{ route('mata-pelajaran.guru.delete', [
                                                'mataPelajaran' => $mataPelajaran->id,
                                                'guruMengajar' => $relasi->id,
                                            ]) }}"
                                            method="POST" onsubmit="return konfirmasiHapus()">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                                <i class="ph ph-trash"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-4 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="mb-3 flex h-14 w-14 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                            <i class="ph ph-users-three text-2xl"></i>
                                        </div>

                                        <p class="font-semibold text-slate-700">
                                            Belum ada guru yang mengajar
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Tambahkan guru untuk menghubungkan mata pelajaran ini dengan rombel.
                                        </p>

                                        <button type="button" onclick="bukaModalTambah()"
                                            class="mt-4 inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-emerald-700">
                                            <i class="ph ph-user-plus"></i>
                                            Tambah Guru Sekarang
                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =====================================================
        MODAL TAMBAH GURU
    ====================================================== --}}
    <div id="modalTambahGuru" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">

        <div class="w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">

            <div class="border-b border-slate-100 px-6 py-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="ph ph-user-plus text-lg"></i>
                        </div>

                        <div>

                            <h3 class="text-base font-bold text-slate-800">
                                Tambah Guru Mengajar
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Hubungkan guru dengan mata pelajaran dan rombel.
                            </p>

                        </div>

                    </div>

                    <button type="button" onclick="tutupModalTambah()"
                        class="text-xl text-slate-400 transition hover:text-slate-700">
                        &times;
                    </button>

                </div>

            </div>


            <form action="{{ route('mata-pelajaran.guru.store', $mataPelajaran->id) }}" method="POST" class="p-6">

                @csrf

                @if ($guru->isEmpty())
                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-xs text-amber-800">

                        <i class="ph ph-warning-circle mr-1"></i>

                        Belum ada data guru. Tambahkan data guru terlebih dahulu.

                    </div>
                @else
                    <div class="mb-4">

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Guru
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="guru_id_tambah" name="guru_id" required
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                -- Pilih Guru --
                            </option>

                            @foreach ($guru as $item)
                                <option value="{{ $item->id }}" @selected((string) old('guru_id') === (string) $item->id)>
                                    {{ $item->nama_guru }}
                                    @if ($item->nip)
                                        - {{ $item->nip }}
                                    @endif
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="mb-4">

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Rombel
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="rombel_id_tambah" name="rombel_id" required
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                -- Pilih Rombel --
                            </option>

                            @foreach ($rombel as $item)
                                <option value="{{ $item->id }}" @selected((string) old('rombel_id') === (string) $item->id)>
                                    {{ $item->nama_rombel }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="mb-4">

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Tahun Ajaran
                        </label>

                        <select id="tahun_ajaran_tambah" name="tahun_ajaran"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                -- Pilih Tahun Ajaran --
                            </option>

                            @foreach (['2025/2026', '2026/2027', '2027/2028'] as $tahun)
                                <option value="{{ $tahun }}">
                                    {{ $tahun }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="mb-6">

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Semester
                        </label>

                        <select id="semester_tambah" name="semester"
                            class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

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


                    <div class="flex justify-end gap-3">

                        <button type="button" onclick="tutupModalTambah()"
                            class="rounded-lg bg-slate-100 px-5 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                            Batal
                        </button>

                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-emerald-700">
                            <i class="ph ph-user-plus"></i>
                            Tambah Guru
                        </button>

                    </div>
                @endif

            </form>

        </div>

    </div>


    {{-- =====================================================
        MODAL GANTI GURU
    ====================================================== --}}
    <div id="modalGantiGuru" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4">

        <div class="w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">

            <div class="border-b border-slate-100 px-6 py-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <i class="ph ph-pencil-simple text-lg"></i>
                        </div>

                        <div>

                            <h3 class="text-base font-bold text-slate-800">
                                Ganti Guru
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                Perbarui guru, rombel, dan periode mengajar.
                            </p>

                        </div>

                    </div>

                    <button type="button" onclick="tutupModalGanti()"
                        class="text-xl text-slate-400 transition hover:text-slate-700">
                        &times;
                    </button>

                </div>

            </div>


            <form id="formGantiGuru" method="POST" class="p-6">

                @csrf
                @method('PUT')


                <div class="mb-4">

                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Guru
                    </label>

                    <select id="guru_id_edit" name="guru_id" required
                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            -- Pilih Guru --
                        </option>

                        @foreach ($guru as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_guru }}
                                @if ($item->nip)
                                    - {{ $item->nip }}
                                @endif
                            </option>
                        @endforeach

                    </select>

                </div>


                <div class="mb-4">

                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Rombel
                    </label>

                    <select id="rombel_id_edit" name="rombel_id" required
                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            -- Pilih Rombel --
                        </option>

                        @foreach ($rombel as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_rombel }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div class="mb-4">

                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Tahun Ajaran
                    </label>

                    <select id="tahun_ajaran_edit" name="tahun_ajaran"
                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                        <option value="2027/2028">2027/2028</option>

                    </select>

                </div>


                <div class="mb-6">

                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Semester
                    </label>

                    <select id="semester_edit" name="semester"
                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>

                    </select>

                </div>


                <div class="flex justify-end gap-3">

                    <button type="button" onclick="tutupModalGanti()"
                        class="rounded-lg bg-slate-100 px-5 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                        Batal
                    </button>

                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-indigo-700">
                        <i class="ph ph-floppy-disk"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =====================================================
        JAVASCRIPT
    ====================================================== --}}
    <script>
        function bukaModalTambah() {

            const modal =
                document.getElementById('modalTambahGuru');

            if (!modal) {
                return;
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        }


        function tutupModalTambah() {

            const modal =
                document.getElementById('modalTambahGuru');

            if (!modal) {
                return;
            }

            modal.classList.add('hidden');
            modal.classList.remove('flex');

        }


        const dataGuruMengajar = {

            @foreach ($mataPelajaran->guruMengajar as $relasi)

                "{{ $relasi->id }}": {

                    guru_id: "{{ $relasi->guru_id }}",
                    rombel_id: "{{ $relasi->rombel_id }}",
                    tahun_ajaran: "{{ $relasi->tahun_ajaran ?? '' }}",
                    semester: "{{ $relasi->semester ?? '' }}"

                },
            @endforeach

        };


        function bukaModalGanti(id) {

            const data =
                dataGuruMengajar[id];

            if (!data) {

                alert('Data guru tidak ditemukan.');

                return;

            }


            const form =
                document.getElementById('formGantiGuru');

            form.action =
                "{{ url('/mata-pelajaran') }}/{{ $mataPelajaran->id }}/guru/" + id;


            document.getElementById('guru_id_edit').value =
                data.guru_id || '';

            document.getElementById('rombel_id_edit').value =
                data.rombel_id || '';

            document.getElementById('tahun_ajaran_edit').value =
                data.tahun_ajaran || '2026/2027';

            document.getElementById('semester_edit').value =
                data.semester || 'Ganjil';


            const modal =
                document.getElementById('modalGantiGuru');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

        }


        function tutupModalGanti() {

            const modal =
                document.getElementById('modalGantiGuru');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

        }


        function konfirmasiHapus() {

            return confirm(
                'Yakin ingin menghapus guru ini dari mata pelajaran?'
            );

        }


        document
            .getElementById('modalGantiGuru')
            .addEventListener('click', function(event) {

                if (event.target === this) {
                    tutupModalGanti();
                }

            });


        document
            .getElementById('modalTambahGuru')
            .addEventListener('click', function(event) {

                if (event.target === this) {
                    tutupModalTambah();
                }

            });


        document.addEventListener('keydown', function(event) {

            if (event.key !== 'Escape') {
                return;
            }

            tutupModalTambah();
            tutupModalGanti();

        });


        @if ($errors->any() || $mataPelajaran->guruMengajar->isEmpty())

            document.addEventListener('DOMContentLoaded', function() {

                bukaModalTambah();

            });
        @endif
    </script>

@endsection
