@extends('layouts.app')
@section('content')
    <div class="content">

        <!-- Header -->
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <x-breadcrumb :items="[['label' => 'Data Master'], ['label' => 'Data Guru']]" />

                    {{-- TITLE --}}
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                            <i class="ph ph-chalkboard-teacher text-2xl text-white"></i>
                        </div>

                        <div>
                            <h1 class="text-xl font-bold leading-tight">
                                Data Guru
                            </h1>

                            <p class="mt-1 text-xs text-[#c2c2dc]">
                                Kelola informasi guru yang digunakan dalam sistem E-Rapor SMK.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- =====================================================
            FILTER
        ====================================================== --}}
        <div class="mb-6 rounded-xl bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-funnel"></i>
                        </div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Filter Data Guru
                        </h2>
                    </div>
                    <p class="mt-1 ml-10 text-xs text-slate-500">
                        Gunakan filter untuk menemukan data guru dengan cepat.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                {{-- SEARCH --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold text-slate-600">
                        Cari Guru
                    </label>
                    <div class="relative">
                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" id="searchGuru" placeholder="Nama, NIP, atau NIK..."
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                            onkeyup="filterGuru()">
                    </div>
                </div>
                {{-- JENIS KELAMIN --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold text-slate-600">
                        Jenis Kelamin
                    </label>
                    <select id="filterJenisKelamin" onchange="filterGuru()"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">
                        <option value="">
                            Semua Jenis Kelamin
                        </option>
                        <option value="L">
                            Laki-laki
                        </option>
                        <option value="P">
                            Perempuan
                        </option>
                    </select>
                </div>
                {{-- RESET --}}
                <div class="flex items-end">
                    <button type="button" onclick="resetFilterGuru()"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-800">
                        <i class="ph ph-arrow-counter-clockwise"></i>
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
        {{-- =====================================================
            TABLE CARD
        ====================================================== --}}
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
            {{-- TABLE HEADER --}}
            <div
                class="flex flex-col gap-3 border-b border-slate-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-chalkboard-teacher"></i>
                        </div>

                        <h2 class="text-base font-bold text-slate-800">
                            Daftar Guru
                        </h2>

                    </div>

                    <p class="mt-1 ml-10 text-xs text-slate-500">
                        Data guru yang terdaftar dalam sistem E-Rapor SMK.
                    </p>

                </div>


                {{-- KANAN --}}
                <div class="flex flex-wrap items-center gap-2">

                    {{-- JUMLAH DATA --}}
                    <div
                        class="inline-flex w-fit items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-xs font-semibold text-slate-600">

                        <i class="ph ph-database text-indigo-500"></i>

                        <span id="jumlahGuru">
                            {{ $guru->count() }}
                        </span>

                        <span>
                            Data
                        </span>

                    </div>


                    {{-- TAMBAH DATA --}}
                    <a href="{{ route('data-guru.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">

                        <i class="ph ph-plus"></i>

                        Tambah Data

                    </a>

                </div>

            </div>
            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-100 bg-slate-50/80">
                        <tr>
                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                No
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                Guru
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                NIP
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                NIK
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                Jenis Kelamin
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                Kontak
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-center text-xs font-bold text-slate-600">
                                Akun
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-center text-xs font-bold text-slate-600">
                                Relasi
                            </th>
                            <th class="whitespace-nowrap px-5 py-3.5 text-center text-xs font-bold text-slate-600">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody id="guruTableBody" class="divide-y divide-slate-100">
                        @forelse ($guru as $item)
                            @php
                                $jumlahRelasi =
                                    ($item->guru_mengajar_count ?? 0) +
                                    ($item->wali_kelas_count ?? 0) +
                                    ($item->rombel_diampu_count ?? 0);
                                $jumlahMapel = $item->guruMengajar
                                    ->map(function ($relasi) {
                                        return $relasi->mataPelajaran->nama_mata_pelajaran ?? null;
                                    })
                                    ->filter()
                                    ->unique()
                                    ->count();
                            @endphp
                            <tr class="guru-row group transition hover:bg-slate-50/70"
                                data-nama="{{ strtolower($item->nama_guru ?? '') }}"
                                data-nip="{{ strtolower($item->nip ?? '') }}" data-nik="{{ strtolower($item->nik ?? '') }}"
                                data-jk="{{ $item->jenis_kelamin ?? '' }}">
                                {{-- NO --}}
                                <td class="whitespace-nowrap px-5 py-4 align-middle">
                                    <span class="text-xs font-semibold text-slate-400">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                {{-- GURU --}}
                                <td class="px-5 py-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-sm font-bold text-indigo-600">
                                            {{ strtoupper(substr($item->nama_guru ?? 'G', 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-slate-800">
                                                {{ $item->nama_guru ?? '-' }}
                                            </p>
                                            <p class="mt-0.5 truncate text-xs text-slate-400">
                                                {{ $item->email ?? 'Email belum tersedia' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                {{-- NIP --}}
                                <td class="whitespace-nowrap px-5 py-4 align-middle">
                                    <span class="text-xs font-medium text-slate-600">
                                        {{ $item->nip ?? '-' }}
                                    </span>
                                </td>
                                {{-- NIK --}}
                                <td class="whitespace-nowrap px-5 py-4 align-middle">
                                    <span class="text-xs text-slate-600">
                                        {{ $item->nik ?? '-' }}
                                    </span>
                                </td>
                                {{-- JENIS KELAMIN --}}
                                <td class="whitespace-nowrap px-5 py-4 align-middle">
                                    @if (($item->jenis_kelamin ?? '') === 'L')
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-semibold text-blue-700">
                                            <i class="ph ph-gender-male"></i>
                                            Laki-laki
                                        </span>
                                    @elseif (($item->jenis_kelamin ?? '') === 'P')
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-pink-50 px-2.5 py-1 text-[11px] font-semibold text-pink-700">
                                            <i class="ph ph-gender-female"></i>
                                            Perempuan
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">
                                            -
                                        </span>
                                    @endif
                                </td>
                                {{-- KONTAK --}}
                                <td class="px-5 py-4 align-middle">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-1.5 text-xs text-slate-600">
                                            <i class="ph ph-phone text-slate-400"></i>
                                            <span>
                                                {{ $item->no_telepon ?? '-' }}
                                            </span>
                                        </div>
                                        <div
                                            class="flex max-w-[220px] items-center gap-1.5 truncate text-xs text-slate-400">
                                            <i class="ph ph-envelope"></i>
                                            <span class="truncate">
                                                {{ $item->email ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                {{-- AKUN --}}
                                <td class="px-5 py-4 text-center align-middle">
                                    @if ($item->user)
                                        <div class="inline-flex flex-col items-center">
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-semibold text-emerald-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Terhubung
                                            </span>
                                            <span class="mt-1 text-[10px] text-slate-400">
                                                {{ $item->user->username }}
                                            </span>
                                        </div>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-500">
                                            <i class="ph ph-user-minus"></i>
                                            Belum
                                        </span>
                                    @endif
                                </td>
                                {{-- RELASI --}}
                                <td class="px-5 py-4 text-center align-middle">
                                    <button type="button" onclick="lihatRelasi({{ $item->id }})"
                                        class="inline-flex items-center gap-1.5 rounded-lg border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-600 transition hover:border-indigo-200 hover:bg-indigo-100">
                                        <i class="ph ph-link-simple"></i>
                                        Lihat
                                    </button>
                                </td>
                                {{-- AKSI --}}
                                <td class="px-5 py-4 align-middle">
                                    <div class="flex items-center justify-center gap-1.5">
                                        {{-- EDIT --}}
                                        <a href="{{ route('data-guru.edit', $item->id) }}" title="Edit Data Guru"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600 transition hover:bg-amber-100">
                                            <i class="ph ph-pencil-simple text-sm"></i>
                                        </a>
                                        {{-- DELETE --}}
                                        @if ($jumlahRelasi > 0)
                                            <button type="button" disabled title="Guru masih memiliki relasi"
                                                class="inline-flex h-8 w-8 cursor-not-allowed items-center justify-center rounded-lg bg-slate-50 text-slate-300">
                                                <i class="ph ph-trash text-sm"></i>
                                            </button>
                                        @else
                                            <form action="{{ route('data-guru.destroy', $item->id) }}" method="POST"
                                                class="delete-guru-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDeleteGuru(this)"
                                                    title="Hapus Data Guru"
                                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500 transition hover:bg-red-100">
                                                    <i class="ph ph-trash text-sm"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-5 py-14">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50">
                                            <i class="ph ph-chalkboard-teacher text-3xl text-slate-300"></i>
                                        </div>
                                        <p class="font-semibold text-slate-700">
                                            Belum ada data guru
                                        </p>
                                        <p class="mt-1 text-xs text-slate-400">
                                            Data guru yang ditambahkan akan muncul di sini.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        {{-- NO RESULT FILTER --}}
                        <tr id="noFilterResult" class="hidden">
                            <td colspan="9" class="px-5 py-14">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50">
                                        <i class="ph ph-magnifying-glass text-2xl text-slate-300"></i>
                                    </div>
                                    <p class="font-semibold text-slate-700">
                                        Data tidak ditemukan
                                    </p>
                                    <p class="mt-1 text-xs text-slate-400">
                                        Tidak ada guru yang sesuai dengan filter yang dipilih.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- =====================================================
        MODAL RELASI GURU
    ====================================================== --}}
    <div id="modalRelasiGuru"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm">

        <div class="w-full max-w-xl overflow-hidden rounded-2xl bg-white shadow-2xl">

            {{-- HEADER --}}
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <i class="ph ph-link-simple-horizontal text-xl"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">
                            Relasi Guru
                        </h3>

                        <p class="text-xs text-slate-400">
                            Informasi penugasan dan tanggung jawab guru
                        </p>
                    </div>

                </div>

                <button type="button" onclick="tutupRelasi()"
                    class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                    <i class="ph ph-x text-lg"></i>

                </button>

            </div>


            {{-- CONTENT --}}
            <div class="max-h-[70vh] overflow-y-auto px-5 py-5">

                {{-- IDENTITAS GURU --}}
                <div class="mb-5 flex items-center gap-3 rounded-xl bg-slate-50 p-4">

                    <div id="relasiAvatar"
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-sm font-bold text-indigo-600">
                        G
                    </div>

                    <div class="min-w-0">

                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Guru
                        </p>

                        <p id="relasiNamaGuru" class="mt-0.5 truncate text-base font-bold text-slate-800">
                            -
                        </p>

                        <p id="relasiTotal" class="mt-0.5 text-xs text-slate-400">
                            0 relasi
                        </p>

                    </div>

                </div>


                {{-- =====================================================
                MATA PELAJARAN
            ====================================================== --}}
                <div class="mb-4 rounded-xl border border-slate-100 bg-white">

                    <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">

                        <div class="flex items-center gap-2">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <i class="ph ph-book-open"></i>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-slate-700">
                                    Guru Mengajar
                                </h4>

                                <p class="text-[10px] text-slate-400">
                                    Mata pelajaran yang diampu
                                </p>
                            </div>

                        </div>

                        <span id="jumlahMapelRelasi"
                            class="rounded-full bg-indigo-50 px-2.5 py-1 text-[10px] font-bold text-indigo-600">
                            0
                        </span>

                    </div>

                    <div id="relasiMapelContainer" class="space-y-2 p-3">
                    </div>

                </div>


                {{-- =====================================================
                WALI KELAS
            ====================================================== --}}
                <div class="mb-4 rounded-xl border border-slate-100 bg-white">

                    <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">

                        <div class="flex items-center gap-2">

                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                                <i class="ph ph-identification-card"></i>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-slate-700">
                                    Wali Kelas
                                </h4>

                                <p class="text-[10px] text-slate-400">
                                    Kelas yang menjadi tanggung jawab
                                </p>
                            </div>

                        </div>

                        <span id="jumlahWaliKelas"
                            class="rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-600">
                            0
                        </span>

                    </div>

                    <div id="relasiWaliKelasContainer" class="space-y-2 p-3">
                    </div>

                </div>


                {{-- =====================================================
                ROMBEL DIAMPU
            ====================================================== --}}
                <div class="mb-5 rounded-xl border border-slate-100 bg-white">

                    <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">

                        <div class="flex items-center gap-2">

                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                <i class="ph ph-users-three"></i>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-slate-700">
                                    Rombel Diampu
                                </h4>

                                <p class="text-[10px] text-slate-400">
                                    Rombongan belajar yang diampu
                                </p>
                            </div>

                        </div>

                        <span id="jumlahRombelDiampu"
                            class="rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-600">
                            0
                        </span>

                    </div>

                    <div id="relasiRombelContainer" class="space-y-2 p-3">
                    </div>

                </div>


                {{-- INFO --}}
                <div class="rounded-xl border border-blue-100 bg-blue-50 p-3">

                    <div class="flex gap-2">

                        <i class="ph ph-info mt-0.5 text-blue-500"></i>

                        <p class="text-xs leading-relaxed text-blue-700">
                            Relasi guru digunakan untuk menentukan mata pelajaran yang
                            diampu, wali kelas, serta rombongan belajar yang menjadi
                            tanggung jawab guru pada sistem E-Rapor.
                        </p>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="flex justify-end border-t border-slate-100 px-5 py-4">

                <button type="button" onclick="tutupRelasi()"
                    class="rounded-lg bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-200">

                    Tutup

                </button>

            </div>

        </div>
    </div>
    {{-- =====================================================
        JAVASCRIPT
    ====================================================== --}}
    <script>
        /*
        |--------------------------------------------------------------------------
        | DATA RELASI GURU
        |--------------------------------------------------------------------------
        */

        const dataGuruRelasi = @js(
    $guru
        ->mapWithKeys(function ($item) {
            return [
                $item->id => [
                    'nama' => $item->nama_guru,

                    // Guru Mengajar / Mata Pelajaran
                    'mata_pelajaran' => $item->guruMengajar
                        ->map(function ($relasi) {
                            return $relasi->mataPelajaran->nama_mata_pelajaran ?? null;
                        })
                        ->filter()
                        ->unique()
                        ->values()
                        ->toArray(),

                    // Wali Kelas
                    'wali_kelas' => $item->waliKelas
                        ->map(function ($wali) {
                            return $wali->rombel->nama_rombel ?? ($wali->nama_rombel ?? null);
                        })
                        ->filter()
                        ->unique()
                        ->values()
                        ->toArray(),

                    // Rombel yang Diampu
                    'rombel_diampu' => $item->rombelDiampu
                        ->map(function ($rombel) {
                            return $rombel->nama_rombel ?? null;
                        })
                        ->filter()
                        ->unique()
                        ->values()
                        ->toArray(),
                ],
            ];
        })
        ->toArray(),
);


        /*
        |--------------------------------------------------------------------------
        | LIHAT RELASI
        |--------------------------------------------------------------------------
        */

        function lihatRelasi(id) {

            const data = dataGuruRelasi[id];

            if (!data) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | DATA
            |--------------------------------------------------------------------------
            */

            const mapel = data.mata_pelajaran || [];
            const waliKelas = data.wali_kelas || [];
            const rombelDiampu = data.rombel_diampu || [];

            const totalRelasi =
                mapel.length +
                waliKelas.length +
                rombelDiampu.length;


            /*
            |--------------------------------------------------------------------------
            | IDENTITAS GURU
            |--------------------------------------------------------------------------
            */

            document.getElementById('relasiNamaGuru').textContent =
                data.nama || '-';

            document.getElementById('relasiAvatar').textContent =
                (data.nama || 'G').charAt(0).toUpperCase();

            document.getElementById('relasiTotal').textContent =
                `${totalRelasi} relasi`;


            /*
            |--------------------------------------------------------------------------
            | GURU MENGAJAR
            |--------------------------------------------------------------------------
            */

            const mapelContainer =
                document.getElementById('relasiMapelContainer');

            const jumlahMapel =
                document.getElementById('jumlahMapelRelasi');

            mapelContainer.innerHTML = '';

            jumlahMapel.textContent = mapel.length;


            if (mapel.length === 0) {

                mapelContainer.innerHTML = `
                <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 px-4 py-5 text-center">

                    <div class="mx-auto mb-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white text-slate-300">
                        <i class="ph ph-book-open text-lg"></i>
                    </div>

                    <p class="text-[11px] font-semibold text-slate-500">
                        Belum ada mata pelajaran
                    </p>

                    <p class="mt-1 text-[10px] text-slate-400">
                        Guru ini belum memiliki mata pelajaran yang diampu.
                    </p>

                </div>
            `;

            } else {

                mapel.forEach(function(namaMapel, index) {

                    mapelContainer.innerHTML += `
                    <div class="flex items-center gap-3 rounded-lg border border-slate-100 bg-slate-50/70 px-3 py-2.5">

                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-[10px] font-bold text-indigo-600">
                            ${index + 1}
                        </div>

                        <p class="min-w-0 truncate text-xs font-semibold text-slate-700">
                            ${escapeHtml(namaMapel)}
                        </p>

                    </div>
                `;

                });

            }


            /*
            |--------------------------------------------------------------------------
            | WALI KELAS
            |--------------------------------------------------------------------------
            */

            const waliContainer =
                document.getElementById('relasiWaliKelasContainer');

            const jumlahWaliKelas =
                document.getElementById('jumlahWaliKelas');

            waliContainer.innerHTML = '';

            jumlahWaliKelas.textContent =
                waliKelas.length;


            if (waliKelas.length === 0) {

                waliContainer.innerHTML = `
                <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 px-4 py-5 text-center">

                    <div class="mx-auto mb-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white text-slate-300">
                        <i class="ph ph-identification-card text-lg"></i>
                    </div>

                    <p class="text-[11px] font-semibold text-slate-500">
                        Bukan wali kelas
                    </p>

                    <p class="mt-1 text-[10px] text-slate-400">
                        Guru ini belum ditugaskan sebagai wali kelas.
                    </p>

                </div>
            `;

            } else {

                waliKelas.forEach(function(namaRombel, index) {

                    waliContainer.innerHTML += `
                    <div class="flex items-center gap-3 rounded-lg border border-amber-100 bg-amber-50/50 px-3 py-2.5">

                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-[10px] font-bold text-amber-600">
                            ${index + 1}
                        </div>

                        <div class="min-w-0">

                            <p class="text-[10px] font-medium uppercase tracking-wide text-amber-500">
                                Wali Kelas
                            </p>

                            <p class="truncate text-xs font-semibold text-slate-700">
                                ${escapeHtml(namaRombel)}
                            </p>

                        </div>

                    </div>
                `;

                });

            }


            /*
            |--------------------------------------------------------------------------
            | ROMBEL DIAMPU
            |--------------------------------------------------------------------------
            */

            const rombelContainer =
                document.getElementById('relasiRombelContainer');

            const jumlahRombel =
                document.getElementById('jumlahRombelDiampu');

            rombelContainer.innerHTML = '';

            jumlahRombel.textContent =
                rombelDiampu.length;


            if (rombelDiampu.length === 0) {

                rombelContainer.innerHTML = `
                <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 px-4 py-5 text-center">

                    <div class="mx-auto mb-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white text-slate-300">
                        <i class="ph ph-users-three text-lg"></i>
                    </div>

                    <p class="text-[11px] font-semibold text-slate-500">
                        Belum ada rombel
                    </p>

                    <p class="mt-1 text-[10px] text-slate-400">
                        Guru ini belum memiliki rombel yang diampu.
                    </p>

                </div>
            `;

            } else {

                rombelDiampu.forEach(function(namaRombel, index) {

                    rombelContainer.innerHTML += `
                    <div class="flex items-center gap-3 rounded-lg border border-emerald-100 bg-emerald-50/50 px-3 py-2.5">

                        <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-[10px] font-bold text-emerald-600">
                            ${index + 1}
                        </div>

                        <p class="min-w-0 truncate text-xs font-semibold text-slate-700">
                            ${escapeHtml(namaRombel)}
                        </p>

                    </div>
                `;

                });

            }


            /*
            |--------------------------------------------------------------------------
            | BUKA MODAL
            |--------------------------------------------------------------------------
            */

            const modal =
                document.getElementById('modalRelasiGuru');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');
        }


        /*
        |--------------------------------------------------------------------------
        | TUTUP MODAL
        |--------------------------------------------------------------------------
        */

        function tutupRelasi() {

            const modal =
                document.getElementById('modalRelasiGuru');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
        }


        /*
        |--------------------------------------------------------------------------
        | ESC TUTUP MODAL
        |--------------------------------------------------------------------------
        */

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {
                tutupRelasi();
            }

        });


        /*
        |--------------------------------------------------------------------------
        | KLIK BACKDROP
        |--------------------------------------------------------------------------
        */

        document
            .getElementById('modalRelasiGuru')
            .addEventListener('click', function(event) {

                if (event.target === this) {
                    tutupRelasi();
                }

            });


        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(text) {

            const div =
                document.createElement('div');

            div.textContent = text;

            return div.innerHTML;
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER GURU
        |--------------------------------------------------------------------------
        */

        function filterGuru() {

            const search =
                document
                .getElementById('searchGuru')
                .value
                .toLowerCase()
                .trim();

            const jenisKelamin =
                document
                .getElementById('filterJenisKelamin')
                .value;

            const rows =
                document.querySelectorAll('.guru-row');

            let jumlahTampil = 0;


            rows.forEach(function(row) {

                const nama =
                    row.dataset.nama || '';

                const nip =
                    row.dataset.nip || '';

                const nik =
                    row.dataset.nik || '';

                const jk =
                    row.dataset.jk || '';


                const cocokSearch =
                    nama.includes(search) ||
                    nip.includes(search) ||
                    nik.includes(search);


                const cocokJenisKelamin =
                    jenisKelamin === '' ||
                    jk === jenisKelamin;


                if (
                    cocokSearch &&
                    cocokJenisKelamin
                ) {

                    row.style.display = '';

                    jumlahTampil++;

                } else {

                    row.style.display = 'none';

                }

            });


            document
                .getElementById('jumlahGuru')
                .textContent = jumlahTampil;


            const noResult =
                document.getElementById('noFilterResult');


            if (
                jumlahTampil === 0 &&
                rows.length > 0
            ) {

                noResult.classList.remove('hidden');

            } else {

                noResult.classList.add('hidden');

            }

        }


        /*
        |--------------------------------------------------------------------------
        | RESET FILTER
        |--------------------------------------------------------------------------
        */

        function resetFilterGuru() {

            document
                .getElementById('searchGuru')
                .value = '';

            document
                .getElementById('filterJenisKelamin')
                .value = '';

            filterGuru();

        }


        /*
        |--------------------------------------------------------------------------
        | KONFIRMASI HAPUS
        |--------------------------------------------------------------------------
        */

        function confirmDeleteGuru(button) {

            const form =
                button.closest('.delete-guru-form');

            const yakin =
                confirm(
                    'Apakah Anda yakin ingin menghapus data guru ini?'
                );

            if (yakin) {
                form.submit();
            }

        }
    </script>
@endsection
