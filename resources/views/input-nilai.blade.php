@extends('layouts.app')

@section('content')

    {{-- =========================================================
    FORM SIMPAN NILAI
========================================================= --}}
    <form method="POST" action="{{ route('input-nilai.store') }}" id="formNilai">
        @csrf

        <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
        <input type="hidden" name="semester" value="{{ $semester }}">
        <input type="hidden" name="rombel_id" value="{{ $rombelId }}">
    </form>


    <div class="min-h-screen bg-slate-50">

        {{-- =====================================================
        HEADER
    ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Input Nilai']]" />

            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-notebook text-xl"></i>
                        </div>

                        <span class="text-xs font-medium uppercase tracking-wider text-indigo-200">
                            E-Rapor SMK
                        </span>
                    </div>

                    <h1 class="text-2xl font-bold tracking-tight">
                        Input Nilai Siswa
                    </h1>

                    <p class="mt-1 max-w-2xl text-sm text-indigo-100">
                        Kelola dan simpan nilai siswa berdasarkan tahun ajaran,
                        semester, kelas, dan mata pelajaran.
                    </p>
                </div>

                <div class="rounded-xl border border-white/10 bg-white/10 px-5 py-3 backdrop-blur-sm">
                    <div class="text-[10px] font-medium uppercase tracking-wider text-indigo-200">
                        Periode Aktif
                    </div>

                    <div class="mt-1 flex items-center gap-2 text-sm font-semibold">
                        <i class="ph ph-calendar-blank"></i>
                        {{ $tahunAjaran }}
                        <span class="text-indigo-300">•</span>
                        {{ $semester }}
                    </div>
                </div>

            </div>
        </div>


        {{-- =====================================================
        ALERT
    ====================================================== --}}
        @if (session('status'))
            <div
                class="mb-5 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-sm">
                <i class="ph ph-check-circle mt-0.5 text-lg text-green-600"></i>

                <div>
                    <div class="font-semibold">Berhasil</div>
                    <div class="mt-0.5">{{ session('status') }}</div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div
                class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 shadow-sm">
                <i class="ph ph-warning-circle mt-0.5 text-lg text-red-600"></i>

                <div>
                    <div class="font-semibold">Terjadi kesalahan</div>
                    <div class="mt-0.5">{{ $errors->first() }}</div>
                </div>
            </div>
        @endif


        {{-- =====================================================
        RINGKASAN
    ====================================================== --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Total Siswa --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Siswa Ditampilkan
                        </p>

                        <p class="mt-1 text-2xl font-bold text-slate-800">
                            {{ $siswa->count() }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-student text-xl"></i>
                    </div>

                </div>
            </div>


            {{-- Tahun Ajaran --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Tahun Ajaran
                        </p>

                        <p class="mt-1 text-lg font-bold text-slate-800">
                            {{ $tahunAjaran }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="ph ph-calendar-blank text-xl"></i>
                    </div>

                </div>
            </div>


            {{-- Semester --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Semester
                        </p>

                        <p class="mt-1 text-lg font-bold text-slate-800">
                            {{ $semester }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                        <i class="ph ph-books text-xl"></i>
                    </div>

                </div>
            </div>


            {{-- Mata Pelajaran --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Mata Pelajaran
                        </p>

                        <p class="mt-1 text-2xl font-bold text-slate-800">
                            {{ $mataPelajaran->count() }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <i class="ph ph-book-open text-xl"></i>
                    </div>

                </div>
            </div>

        </div>


        {{-- =====================================================
        FILTER
    ====================================================== --}}
        <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex flex-col gap-1">
                <h2 class="flex items-center gap-2 text-sm font-bold text-slate-800">
                    <i class="ph ph-funnel text-indigo-600"></i>
                    Filter Input Nilai
                </h2>

                <p class="text-xs text-slate-500">
                    Pilih periode, kelas, dan mata pelajaran yang ingin ditampilkan.
                </p>
            </div>


            <form method="GET" action="{{ route('input-nilai') }}">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                    {{-- Tahun Ajaran --}}
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Tahun Ajaran
                        </label>

                        <div class="relative">
                            <i
                                class="ph ph-calendar-blank pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="tahun_ajaran" onchange="this.form.submit()"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-8 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                                <option value="2025/2026" @selected($tahunAjaran === '2025/2026')>
                                    2025/2026
                                </option>

                                <option value="2026/2027" @selected($tahunAjaran === '2026/2027')>
                                    2026/2027
                                </option>
                            </select>

                            <i
                                class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                        </div>
                    </div>


                    {{-- Semester --}}
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Semester
                        </label>

                        <div class="relative">
                            <i
                                class="ph ph-books pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="semester" onchange="this.form.submit()"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-8 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                                <option value="Ganjil" @selected($semester === 'Ganjil')>
                                    Ganjil
                                </option>

                                <option value="Genap" @selected($semester === 'Genap')>
                                    Genap
                                </option>
                            </select>

                            <i
                                class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                        </div>
                    </div>


                    {{-- Kelas --}}
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Kelas
                        </label>

                        <div class="relative">
                            <i
                                class="ph ph-users-three pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="rombel_id" onchange="this.form.submit()"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-8 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach ($rombel as $item)
                                    <option value="{{ $item->id }}" @selected((string) $rombelId === (string) $item->id)>
                                        {{ $item->nama_rombel }}
                                    </option>
                                @endforeach
                            </select>

                            <i
                                class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                        </div>
                    </div>


                    {{-- Mata Pelajaran --}}
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Mata Pelajaran
                        </label>

                        <div class="relative">
                            <i
                                class="ph ph-book-open pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="filter_mata_pelajaran" onchange="this.form.submit()"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-8 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                                <option value="">
                                    Semua Mata Pelajaran
                                </option>

                                @foreach ($mataPelajaran as $item)
                                    <option value="{{ $item->id }}" @selected((string) request('filter_mata_pelajaran') === (string) $item->id)>
                                        {{ $item->nama_mata_pelajaran }}
                                    </option>
                                @endforeach
                            </select>

                            <i
                                class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>
                        </div>
                    </div>

                </div>

            </form>
        </div>


        {{-- =====================================================
        DAFTAR NILAI
    ====================================================== --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">

                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                    <div>
                        <h2 class="flex items-center gap-2 text-base font-bold text-slate-800">
                            <i class="ph ph-list-numbers text-indigo-600"></i>
                            Daftar Nilai Siswa
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Masukkan, ubah, atau tambahkan nilai mata pelajaran untuk setiap siswa.
                        </p>
                    </div>

                    <div class="flex items-center gap-2">

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                            <i class="ph ph-calendar"></i>
                            {{ $tahunAjaran }}
                        </span>

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-purple-50 px-3 py-1.5 text-xs font-semibold text-purple-700">
                            <i class="ph ph-books"></i>
                            {{ $semester }}
                        </span>

                    </div>

                </div>
            </div>


            {{-- Search siswa --}}
            <div class="border-b border-slate-100 bg-slate-50/70 px-5 py-3 sm:px-6">

                <div class="relative max-w-md">

                    <i
                        class="ph ph-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input type="text" id="searchNilai" placeholder="Cari nama siswa atau NISN..."
                        class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                </div>

                <div class="mt-2 hidden text-[11px] text-slate-500" id="filterStatus">
                    Menampilkan <span id="jumlahHasil" class="font-semibold text-slate-700">0</span> siswa
                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1150px] text-left text-sm">

                    <thead
                        class="border-b border-slate-200 bg-slate-50 text-[10px] uppercase tracking-wider text-slate-500">

                        <tr>
                            <th class="px-5 py-3.5 font-semibold">No</th>
                            <th class="px-5 py-3.5 font-semibold">Siswa</th>
                            <th class="px-5 py-3.5 font-semibold">Kelas</th>
                            <th class="px-5 py-3.5 font-semibold">Nilai</th>
                            <th class="px-5 py-3.5 text-center font-semibold">Periode</th>
                            <th class="px-5 py-3.5 text-center font-semibold">Aksi</th>
                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($siswa as $item)
                            <tr class="nilai-row transition hover:bg-slate-50" data-row="{{ $item->id }}"
                                data-nama="{{ strtolower($item->nama_siswa ?? '') }}"
                                data-nisn="{{ strtolower($item->nisn ?? '') }}">

                                {{-- No --}}
                                <td class="px-5 py-4 align-top">
                                    <span class="text-xs font-semibold text-slate-400">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>


                                {{-- Siswa --}}
                                <td class="px-5 py-4 align-top">

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                            <i class="ph ph-student"></i>
                                        </div>

                                        <div>
                                            <div class="font-semibold text-slate-800">
                                                {{ $item->nama_siswa }}
                                            </div>

                                            <div class="mt-0.5 text-[11px] text-slate-500">
                                                NISN: {{ $item->nisn ?? '-' }}
                                            </div>
                                        </div>

                                    </div>

                                </td>


                                {{-- Kelas --}}
                                <td class="px-5 py-4 align-top">

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-semibold text-blue-700">
                                        <i class="ph ph-users-three"></i>
                                        {{ $item->rombel?->nama_rombel ?? '-' }}
                                    </span>

                                </td>


                                {{-- Nilai --}}
                                <td class="px-5 py-4 align-top">

                                    <div class="min-w-[360px] space-y-2" id="daftar-nilai-{{ $item->id }}">

                                        {{-- Nilai yang sudah ada --}}
                                        @forelse ($mapelTerisi[$item->id] ?? [] as $idMapel => $namaMapel)
                                            @php
                                                $nilai = $nilaiTersimpan[$item->id . '-' . $idMapel] ?? null;
                                                $nilaiAngka = $nilai !== null ? (float) $nilai : null;
                                            @endphp

                                            <div
                                                class="flex items-center justify-between gap-4 rounded-lg border border-slate-100 bg-slate-50/60 px-3 py-2">

                                                <div class="min-w-0">
                                                    <div class="truncate text-xs font-semibold text-slate-700">
                                                        {{ $namaMapel }}
                                                    </div>
                                                </div>

                                                <div class="nilai-container shrink-0">

                                                    <span
                                                        class="nilai-text inline-flex min-w-[48px] items-center justify-center rounded-md px-2 py-1 text-xs font-bold
                                                    {{ $nilaiAngka === null
                                                        ? 'bg-slate-100 text-slate-400'
                                                        : ($nilaiAngka >= 75
                                                            ? 'bg-green-100 text-green-700'
                                                            : ($nilaiAngka >= 60
                                                                ? 'bg-amber-100 text-amber-700'
                                                                : 'bg-red-100 text-red-700')) }}">
                                                        {{ $nilai !== null ? rtrim(rtrim(number_format((float) $nilai, 2, '.', ''), '0'), '.') : '-' }}
                                                    </span>

                                                    <input type="number" min="0" max="100" step="0.01"
                                                        form="formNilai"
                                                        name="nilai[{{ $item->id }}][{{ $idMapel }}]"
                                                        value="{{ $nilai !== null ? rtrim(rtrim(number_format((float) $nilai, 2, '.', ''), '0'), '.') : '' }}"
                                                        class="nilai-input hidden w-20 rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-center text-xs font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                                </div>

                                            </div>

                                        @empty

                                            <div
                                                class="rounded-lg border border-dashed border-slate-200 px-3 py-3 text-xs text-slate-400">
                                                <i class="ph ph-info mr-1"></i>
                                                Belum ada nilai untuk siswa ini.
                                            </div>
                                        @endforelse

                                    </div>


                                    {{-- Tambah nilai --}}
                                    <button type="button" data-siswa="{{ $item->id }}"
                                        onclick="tambahNilaiBaris(this)"
                                        class="mt-2 inline-flex items-center gap-1.5 rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition hover:bg-indigo-100">
                                        <i class="ph ph-plus"></i>
                                        Tambah Nilai
                                    </button>

                                </td>


                                {{-- Periode --}}
                                <td class="px-5 py-4 text-center align-top">

                                    <div class="text-xs font-semibold text-slate-700">
                                        {{ $tahunAjaran }}
                                    </div>

                                    <div class="mt-1">
                                        <span
                                            class="inline-flex rounded-full bg-purple-50 px-2.5 py-1 text-[10px] font-semibold text-purple-700">
                                            {{ $semester }}
                                        </span>
                                    </div>

                                </td>


                                {{-- Aksi --}}
                                <td class="px-5 py-4 align-top">

                                    <div class="flex min-w-[150px] flex-wrap items-center justify-center gap-1.5">

                                        <button type="button" onclick="lihatDetailNilai({{ $item->id }})"
                                            class="inline-flex items-center gap-1 rounded-lg bg-blue-500 px-2.5 py-1.5 text-[11px] font-semibold text-white shadow-sm transition hover:bg-blue-600"
                                            title="Lihat rincian nilai">
                                            <i class="ph ph-eye"></i>
                                            Detail
                                        </button>


                                        <button type="button" onclick="editNilai(this)"
                                            class="edit-btn inline-flex items-center gap-1 rounded-lg bg-amber-500 px-2.5 py-1.5 text-[11px] font-semibold text-white shadow-sm transition hover:bg-amber-600">
                                            <i class="ph ph-pencil-simple"></i>
                                            Edit
                                        </button>


                                        <button type="button" onclick="simpanNilai(this)" style="display:none"
                                            class="save-btn inline-flex items-center gap-1 rounded-lg bg-green-600 px-2.5 py-1.5 text-[11px] font-semibold text-white shadow-sm transition hover:bg-green-700">
                                            <i class="ph ph-floppy-disk"></i>
                                            Simpan
                                        </button>


                                        <button type="button" onclick="batalEdit(this)" style="display:none"
                                            class="cancel-btn inline-flex items-center gap-1 rounded-lg bg-slate-500 px-2.5 py-1.5 text-[11px] font-semibold text-white shadow-sm transition hover:bg-slate-600">
                                            <i class="ph ph-x"></i>
                                            Batal
                                        </button>


                                        <form action="{{ route('input-nilai.destroy', $item->id) }}" method="POST"
                                            class="inline-block" data-hapus-form>
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
                                            <input type="hidden" name="semester" value="{{ $semester }}">
                                            <input type="hidden" name="rombel_id" value="{{ $rombelId }}">

                                            <button type="submit" data-nama="{{ $item->nama_siswa }}"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-2.5 py-1.5 text-[11px] font-semibold text-white shadow-sm transition hover:bg-red-600"
                                                title="Hapus semua nilai siswa ini pada periode ini">
                                                <i class="ph ph-trash"></i>
                                                Hapus
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                            <i class="ph ph-student text-2xl"></i>
                                        </div>

                                        <div class="text-sm font-semibold text-slate-700">
                                            Belum ada data siswa
                                        </div>

                                        <div class="mt-1 text-xs text-slate-500">
                                            Tambahkan data siswa terlebih dahulu untuk mulai memasukkan nilai.
                                        </div>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Footer table --}}
            <div
                class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50/60 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <div class="text-xs text-slate-500">
                    <i class="ph ph-info mr-1"></i>
                    Nilai berada pada rentang <strong>0–100</strong>.
                </div>

                <div class="flex items-center gap-2">

                    <a href="{{ route('input-nilai') }}"
                        class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100">
                        <i class="ph ph-arrow-clockwise"></i>
                        Refresh
                    </a>

                    <button type="submit" form="formNilai"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        <i class="ph ph-floppy-disk"></i>
                        Simpan Nilai
                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
    MODAL DETAIL NILAI
========================================================= --}}
    <div id="modalDetail"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
        onclick="if (event.target === this) { tutupDetailNilai(); }">

        <div class="flex max-h-[85vh] w-full max-w-2xl flex-col overflow-hidden rounded-xl bg-white shadow-2xl">

            {{-- Header --}}
            <div class="flex items-start justify-between gap-4 border-b border-slate-200 px-6 py-4">

                <div class="flex items-start gap-3">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-notebook text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-slate-800">
                            Rincian Nilai Siswa
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            <span id="detailNama" class="font-semibold text-slate-700"></span>
                            <span class="mx-1 text-slate-300">•</span>
                            NISN <span id="detailNisn"></span>
                            <span class="mx-1 text-slate-300">•</span>
                            <span id="detailKelas"></span>
                        </p>

                        <p class="mt-1 text-[11px] text-slate-500">
                            Periode
                            <span id="detailPeriode" class="font-semibold text-indigo-600"></span>
                        </p>
                    </div>

                </div>

                <button type="button" onclick="tutupDetailNilai()"
                    class="rounded-lg p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
                    title="Tutup">
                    <i class="ph ph-x text-lg"></i>
                </button>

            </div>


            {{-- Isi --}}
            <div class="overflow-y-auto px-6 py-4">

                <table class="w-full text-left text-sm">

                    <thead
                        class="border-b border-slate-200 bg-slate-50 text-[10px] uppercase tracking-wider text-slate-500">

                        <tr>
                            <th class="px-4 py-3 font-semibold">Mata Pelajaran</th>
                            <th class="px-4 py-3 text-center font-semibold">Nilai</th>
                            <th class="px-4 py-3 text-center font-semibold">Status</th>
                        </tr>

                    </thead>

                    <tbody id="detailIsi"></tbody>

                </table>

            </div>


            {{-- Footer --}}
            <div class="border-t border-slate-200 px-6 py-4">

                <button type="button" onclick="tutupDetailNilai()"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-500 px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-slate-600">
                    <i class="ph ph-x"></i>
                    Tutup
                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
    DATA JAVASCRIPT
========================================================= --}}
    <script>
        const pilihanMapel = @json($pilihanMapel);

        const rincianNilai = @json($rincianNilai);

        const periode = @json([
            'tahun_ajaran' => $tahunAjaran,
            'semester' => $semester,
        ]);

        const modalDetail = document.getElementById('modalDetail');


        /*
        |--------------------------------------------------------------------------
        | SEARCH SISWA
        |--------------------------------------------------------------------------
        */

        const searchNilai = document.getElementById('searchNilai');

        function filterNilaiSiswa() {

            const search = searchNilai.value.toLowerCase().trim();

            const rows = document.querySelectorAll('.nilai-row');

            let jumlahHasil = 0;

            rows.forEach(function(row) {

                const nama = row.dataset.nama || '';
                const nisn = row.dataset.nisn || '';

                const cocok =
                    search === '' ||
                    nama.includes(search) ||
                    nisn.includes(search);

                row.style.display = cocok ? '' : 'none';

                if (cocok) {
                    jumlahHasil++;
                }

            });

            const jumlahHasilElement = document.getElementById('jumlahHasil');

            if (jumlahHasilElement) {
                jumlahHasilElement.textContent = jumlahHasil;
            }

            const filterStatus = document.getElementById('filterStatus');

            if (filterStatus) {
                filterStatus.classList.toggle('hidden', search === '');
            }
        }

        if (searchNilai) {
            searchNilai.addEventListener('input', filterNilaiSiswa);
        }


        /*
        |--------------------------------------------------------------------------
        | KONFIRMASI HAPUS
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('form[data-hapus-form]').forEach(function(form) {

            form.addEventListener('submit', function(event) {

                const button = form.querySelector('button[data-nama]');
                const nama = button ? button.dataset.nama : 'siswa ini';

                const yakin = confirm(
                    'Yakin ingin menghapus SEMUA nilai "' +
                    nama +
                    '" pada periode ini?\n\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }

            });

        });


        /*
        |--------------------------------------------------------------------------
        | EDIT NILAI
        |--------------------------------------------------------------------------
        */

        function editNilai(button) {

            const row = button.closest('.nilai-row');

            row.querySelectorAll('.nilai-input').forEach(function(input) {
                input.classList.remove('hidden');
            });

            row.querySelectorAll('.nilai-text').forEach(function(teks) {
                teks.classList.add('hidden');
            });

            button.style.display = 'none';

            row.querySelector('.save-btn').style.display = '';

            row.querySelector('.cancel-btn').style.display = '';

        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN NILAI PER BARIS
        |--------------------------------------------------------------------------
        */

        function simpanNilai(button) {

            const row = button.closest('.nilai-row');

            button.disabled = true;

            document.querySelectorAll('.nilai-row').forEach(function(barisLain) {

                if (barisLain !== row) {

                    barisLain.querySelectorAll('input, select').forEach(function(el) {
                        el.disabled = true;
                    });

                }

            });

            document.getElementById('formNilai').submit();

        }


        /*
        |--------------------------------------------------------------------------
        | BATAL EDIT
        |--------------------------------------------------------------------------
        */

        function batalEdit(button) {

            const row = button.closest('.nilai-row');

            row.querySelectorAll('.nilai-container').forEach(function(container) {

                const input = container.querySelector('.nilai-input');
                const teks = container.querySelector('.nilai-text');

                if (input) {
                    input.classList.add('hidden');
                }

                if (teks) {
                    teks.classList.remove('hidden');
                }

            });

            button.style.display = 'none';

            row.querySelector('.edit-btn').style.display = '';

            row.querySelector('.save-btn').style.display = 'none';

        }


        /*
        |--------------------------------------------------------------------------
        | DETAIL NILAI
        |--------------------------------------------------------------------------
        */

        function lihatDetailNilai(idSiswa) {

            const data = rincianNilai[idSiswa];

            if (!data) {
                return;
            }

            const row = document.querySelector(
                '.nilai-row[data-row="' + idSiswa + '"]'
            );

            const inputPerMapel = {};

            if (row) {

                row.querySelectorAll('input.nilai-input[name]').forEach(function(input) {

                    const cocok = input.name.match(
                        /^nilai\[[^\]]+\]\[(\d+)\]$/
                    );

                    if (cocok) {
                        inputPerMapel[cocok[1]] = input.value;
                    }

                });

            }


            const mapelBaru = [];

            if (row) {

                row.querySelectorAll('[data-tambahan] select').forEach(function(select) {

                    if (select.value === '') {
                        return;
                    }

                    mapelBaru.push({
                        idMapel: String(select.value),
                        mapel: select.options[select.selectedIndex].text,
                    });

                });

            }


            document.getElementById('detailNama').textContent = data.nama;
            document.getElementById('detailNisn').textContent = data.nisn;
            document.getElementById('detailKelas').textContent = data.kelas;

            document.getElementById('detailPeriode').textContent =
                periode.tahun_ajaran + ' / ' + periode.semester;


            const tbody = document.getElementById('detailIsi');

            tbody.innerHTML = '';


            const daftar = Object.entries(data.nilai).map(function([idMapel, baris]) {

                return {
                    idMapel: String(idMapel),
                    mapel: baris.mapel,
                    tersimpan: baris.nilai,
                    baru: false,
                };

            });


            mapelBaru.forEach(function(item) {

                const sudahAda = daftar.some(function(baris) {
                    return baris.idMapel === item.idMapel;
                });

                if (!sudahAda) {

                    daftar.push({
                        idMapel: item.idMapel,
                        mapel: item.mapel,
                        tersimpan: null,
                        baru: true,
                    });

                }

            });


            if (daftar.length === 0) {

                tbody.innerHTML =
                    '<tr>' +
                    '<td colspan="3" class="px-4 py-6 text-center text-slate-500">' +
                    'Belum ada nilai.' +
                    '</td>' +
                    '</tr>';

                modalDetail.classList.remove('hidden');
                modalDetail.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                return;
            }


            daftar.forEach(function(baris) {

                const adaInput =
                    Object.prototype.hasOwnProperty.call(
                        inputPerMapel,
                        baris.idMapel
                    );

                const nilai =
                    adaInput && inputPerMapel[baris.idMapel] !== '' ?
                    inputPerMapel[baris.idMapel] :
                    baris.tersimpan;


                const berubah =
                    baris.baru ||
                    (
                        adaInput &&
                        String(inputPerMapel[baris.idMapel]) !==
                        String(baris.tersimpan)
                    );


                const tr = document.createElement('tr');

                tr.className = 'border-b border-slate-100';


                const tdMapel = document.createElement('td');

                tdMapel.className = 'px-4 py-3 text-xs font-medium text-slate-700';

                tdMapel.textContent = baris.mapel;


                const tdNilai = document.createElement('td');

                tdNilai.className = 'px-4 py-3 text-center';


                if (nilai === null || nilai === '') {

                    tdNilai.className += ' text-slate-400';
                    tdNilai.textContent = '-';

                } else {

                    tdNilai.className += ' font-bold text-green-600';
                    tdNilai.textContent = nilai;

                }


                const tdStatus = document.createElement('td');

                tdStatus.className = 'px-4 py-3 text-center';


                if (berubah) {

                    tdStatus.innerHTML =
                        '<span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-[10px] font-semibold text-amber-700">' +
                        'Belum disimpan' +
                        '</span>';

                } else if (nilai !== null && nilai !== '') {

                    tdStatus.innerHTML =
                        '<span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-[10px] font-semibold text-green-700">' +
                        'Tersimpan' +
                        '</span>';

                } else {

                    tdStatus.innerHTML =
                        '<span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-semibold text-slate-600">' +
                        'Kosong' +
                        '</span>';

                }


                tr.appendChild(tdMapel);
                tr.appendChild(tdNilai);
                tr.appendChild(tdStatus);

                tbody.appendChild(tr);

            });


            modalDetail.classList.remove('hidden');
            modalDetail.classList.add('flex');

            document.body.classList.add('overflow-hidden');

        }


        function tutupDetailNilai() {

            modalDetail.classList.add('hidden');
            modalDetail.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | PILIHAN MATA PELAJARAN
        |--------------------------------------------------------------------------
        */

        function semuaMapelSiswa(idSiswa) {
            return pilihanMapel[idSiswa] || {};
        }


        function mapelTerpakai(idSiswa, kecualiSelect) {

            const wrapper =
                document.getElementById('daftar-nilai-' + idSiswa);

            const terpakai = [];

            if (!wrapper) {
                return terpakai;
            }

            wrapper.querySelectorAll('[data-tambahan] select').forEach(function(select) {

                if (
                    select !== kecualiSelect &&
                    select.value !== ''
                ) {
                    terpakai.push(String(select.value));
                }

            });

            return terpakai;

        }


        function opsiMapelSiswa(idSiswa, kecualiSelect) {

            const semua = semuaMapelSiswa(idSiswa);

            const terpilih =
                kecualiSelect && kecualiSelect.value !== '' ?
                String(kecualiSelect.value) :
                '';

            const terpakai =
                mapelTerpakai(idSiswa, kecualiSelect);

            let opsi =
                '<option value="">-- Pilih Mata Pelajaran --</option>';


            if (
                terpilih !== '' &&
                semua[terpilih] !== undefined
            ) {

                opsi +=
                    '<option value="' +
                    terpilih +
                    '" selected>' +
                    semua[terpilih] +
                    '</option>';

            }


            Object.keys(semua).forEach(function(id) {

                if (
                    id === terpilih ||
                    terpakai.indexOf(id) !== -1
                ) {
                    return;
                }

                opsi +=
                    '<option value="' +
                    id +
                    '">' +
                    semua[id] +
                    '</option>';

            });


            return opsi;

        }


        function segarkanPilihanMapel(idSiswa) {

            const wrapper =
                document.getElementById('daftar-nilai-' + idSiswa);

            if (!wrapper) {
                return;
            }

            wrapper
                .querySelectorAll('[data-tambahan] select')
                .forEach(function(select) {

                    select.innerHTML =
                        opsiMapelSiswa(idSiswa, select);

                });

        }


        function segarkanPilihanDariInput(input) {

            const row = input.closest('.nilai-row');

            if (row) {
                segarkanPilihanMapel(row.dataset.row);
            }

        }


        /*
        |--------------------------------------------------------------------------
        | TAMBAH NILAI
        |--------------------------------------------------------------------------
        */

        function tambahNilaiBaris(button) {

            const idSiswa = button.dataset.siswa;

            const wrapper =
                document.getElementById('daftar-nilai-' + idSiswa);

            if (!wrapper) {
                return;
            }


            const semua = semuaMapelSiswa(idSiswa);

            const adaPilihan =
                Object.keys(semua).length > 0;


            const terpakai =
                mapelTerpakai(idSiswa, null);


            const belumDipakai =
                Object.keys(semua).filter(function(id) {

                    return terpakai.indexOf(String(id)) === -1;

                });


            if (belumDipakai.length === 0) {

                alert(
                    adaPilihan ?
                    'Semua mata pelajaran yang tersedia sudah dipilih.' :
                    'Semua mata pelajaran sudah dinilai untuk siswa ini.'
                );

                return;

            }


            const baris =
                document.createElement('div');

            baris.className =
                'flex flex-wrap items-center justify-between gap-3 rounded-lg border border-indigo-100 bg-indigo-50/40 px-3 py-2';

            baris.setAttribute('data-tambahan', '1');


            let opsi =
                '<option value="">-- Pilih Mata Pelajaran --</option>';


            belumDipakai.forEach(function(id) {

                opsi +=
                    '<option value="' +
                    id +
                    '">' +
                    semua[id] +
                    '</option>';

            });


            baris.innerHTML = `

            <select
                onchange="gantiNamaInputNilai(this)"
                class="w-48 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
            >
                ${opsi}
            </select>

            <input
                type="number"
                min="0"
                max="100"
                step="0.01"
                form="formNilai"
                oninput="segarkanPilihanDariInput(this)"
                disabled
                class="nilai-input w-20 rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-center text-xs font-semibold outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
            >

            <button
                type="button"
                onclick="hapusNilaiBaris(this)"
                class="rounded-lg bg-red-500 px-2 py-1.5 text-xs font-semibold text-white transition hover:bg-red-600"
                title="Hapus baris ini"
            >
                <i class="ph ph-trash"></i>
            </button>
        `;


            wrapper.appendChild(baris);

        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS NILAI TAMBAHAN
        |--------------------------------------------------------------------------
        */

        function hapusNilaiBaris(button) {

            const row =
                button.closest('.nilai-row');

            button
                .closest('[data-tambahan]')
                .remove();


            if (row) {
                segarkanPilihanMapel(row.dataset.row);
            }

        }


        /*
        |--------------------------------------------------------------------------
        | NAME INPUT NILAI
        |--------------------------------------------------------------------------
        */

        function gantiNamaInputNilai(select) {

            const baris =
                select.closest('[data-tambahan]');

            const input =
                baris.querySelector('.nilai-input');

            const idSiswa =
                select.closest('.nilai-row').dataset.row;


            if (select.value === '') {

                input.removeAttribute('name');

                input.disabled = true;

                segarkanPilihanMapel(idSiswa);

                return;

            }


            input.name =
                'nilai[' +
                idSiswa +
                '][' +
                select.value +
                ']';

            input.disabled = false;


            segarkanPilihanMapel(idSiswa);

        }
    </script>

@endsection
