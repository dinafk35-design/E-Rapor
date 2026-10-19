@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}
        <div
            class="overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Penilaian'],
                ['label' => 'Perkembangan Nilai'],
            ]" />

            <div class="flex items-start justify-between gap-4">

                <div>
                    <div class="mb-2 flex h-10 w-10 items-center justify-center rounded-lg bg-white/10">
                        <i class="ph ph-chart-line-up text-xl"></i>
                    </div>

                    <h1 class="text-xl font-bold sm:text-2xl">
                        Perkembangan Nilai
                    </h1>

                    <p class="mt-1 max-w-2xl text-sm text-[#d6d5ec]">
                        Bandingkan nilai siswa antar semester dari data yang sudah
                        tersimpan pada Input Nilai.
                    </p>
                </div>

                <div class="hidden rounded-lg bg-white/10 px-4 py-3 text-right sm:block">
                    <p class="text-[10px] uppercase tracking-wide text-[#c7c6e4]">
                        Data Perkembangan
                    </p>

                    <p id="headerJumlahData" class="mt-1 text-2xl font-bold">
                        {{ $perkembangan->count() }}
                    </p>

                    <p class="text-[11px] text-[#d6d5ec]">
                        data nilai
                    </p>
                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FILTER --}}
        {{-- ========================================================= --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex items-center justify-between gap-3">

                <div>
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-funnel"></i>
                        </div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Filter Data
                        </h2>
                    </div>

                    <p class="mt-1 text-xs text-slate-500">
                        Gunakan filter untuk melihat perkembangan nilai sesuai kebutuhan.
                    </p>
                </div>

                <a href="{{ route('perkembangan-nilai') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                    <i class="ph ph-arrow-counter-clockwise"></i>
                    Reset

                </a>

            </div>


            <form method="GET" action="{{ route('perkembangan-nilai') }}">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                    {{-- PENCARIAN --}}
                    <div>
                        <label for="q" class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Cari Siswa
                        </label>

                        <div class="relative">

                            <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input type="search" name="q" id="q" value="{{ request('q') }}"
                                placeholder="Nama siswa atau NISN..."
                                class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                        </div>
                    </div>


                    {{-- TAHUN AJARAN --}}
                    <div>
                        <label for="tahun_ajaran" class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Tahun Ajaran
                        </label>

                        <select name="tahun_ajaran" id="tahun_ajaran" onchange="this.form.submit()"
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                            @foreach ($daftarTahun as $tahun)
                                <option value="{{ $tahun }}" @selected($tahun === $tahunAjaran)>
                                    {{ $tahun }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    {{-- KELAS --}}
                    <div>
                        <label for="rombel_id" class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Kelas
                        </label>

                        <select name="rombel_id" id="rombel_id" onchange="this.form.submit()"
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                Semua Kelas
                            </option>

                            @foreach ($rombel as $item)
                                <option value="{{ $item->id }}" @selected((string) $rombelId === (string) $item->id)>
                                    {{ $item->nama_rombel }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    {{-- MATA PELAJARAN --}}
                    <div>
                        <label for="filter_mata_pelajaran" class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Mata Pelajaran
                        </label>

                        <select name="filter_mata_pelajaran" id="filter_mata_pelajaran" onchange="this.form.submit()"
                            class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

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

                <div class="mt-3 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700">

                        <i class="ph ph-funnel"></i>
                        Terapkan

                    </button>
                </div>

            </form>


            {{-- STATUS FILTER --}}
            <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">

                <p class="text-xs text-slate-500">
                    Menampilkan
                    <span id="jumlahData" class="font-bold text-slate-700">
                        {{ $perkembangan->count() }}
                    </span>
                    data perkembangan nilai
                </p>

                <span id="filterStatus"
                    class="hidden items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-600">

                    <i class="ph ph-funnel"></i>
                    Filter aktif

                </span>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- RINGKASAN --}}
        {{-- ========================================================= --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- RATA-RATA --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Rata-rata Nilai
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                            {{ $rataRata === null ? '-' : rtrim(rtrim(number_format($rataRata, 2, '.', ''), '0'), '.') }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Rata-rata dari data yang tersedia
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-chart-line-up text-xl"></i>
                    </div>

                </div>

            </div>


            {{-- TERTINGGI --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Nilai Tertinggi
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-emerald-600">
                            {{ $nilaiTertinggi === null ? '-' : rtrim(rtrim(number_format($nilaiTertinggi, 2, '.', ''), '0'), '.') }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Nilai tertinggi yang tercatat
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <i class="ph ph-trend-up text-xl"></i>
                    </div>

                </div>

            </div>


            {{-- TERENDAH --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Nilai Terendah
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-rose-600">
                            {{ $nilaiTerendah === null ? '-' : rtrim(rtrim(number_format($nilaiTerendah, 2, '.', ''), '0'), '.') }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Nilai terendah yang tercatat
                        </p>

                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-rose-50 text-rose-600">
                        <i class="ph ph-trend-down text-xl"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- TABEL --}}
        {{-- ========================================================= --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div
                class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-chart-line"></i>
                        </div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Data Perkembangan Nilai
                        </h2>

                    </div>

                    <p class="mt-1 text-xs text-slate-500">
                        Perbandingan nilai siswa antar semester pada setiap mata pelajaran.
                    </p>

                </div>

                <div class="flex items-center gap-2 text-xs text-slate-500">

                    <i class="ph ph-info text-indigo-500"></i>

                    <span>
                        Tahun ajaran {{ $tahunAjaran }}
                    </span>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1200px] text-left text-sm">

                    <thead class="bg-slate-50 text-[10px] uppercase tracking-wide text-slate-500">

                        <tr>

                            <th class="px-5 py-3.5">
                                No
                            </th>

                            <th class="px-5 py-3.5">
                                NISN
                            </th>

                            <th class="px-5 py-3.5">
                                Siswa
                            </th>

                            <th class="px-5 py-3.5">
                                Kelas
                            </th>

                            <th class="px-5 py-3.5">
                                Mata Pelajaran
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                {{ $daftarSemester[0] }}
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                {{ $daftarSemester[1] }}
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                Perubahan
                            </th>

                            <th class="px-5 py-3.5 text-center">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody id="nilaiTable" class="divide-y divide-slate-100">

                        @forelse ($perkembangan as $item)
                            @php
                                $format = fn ($nilai) => $nilai === null
                                    ? '-'
                                    : rtrim(rtrim(number_format((float) $nilai, 2, '.', ''), '0'), '.');
                            @endphp

                            <tr class="nilai-row transition hover:bg-slate-50"
                                data-nama="{{ strtolower($item->siswa->nama_siswa ?? '') }}"
                                data-nisn="{{ strtolower($item->siswa->nisn ?? '') }}">

                                <td class="px-5 py-4 text-xs text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-5 py-4 text-xs font-medium text-slate-600">
                                    {{ $item->siswa->nisn ?? '-' }}
                                </td>

                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-600">
                                            {{ strtoupper(substr(preg_replace('/\s+/', ' ', trim($item->siswa->nama_siswa ?? '?')), 0, 2)) }}
                                        </div>

                                        <div>
                                            <div class="font-semibold text-slate-800">
                                                {{ $item->siswa->nama_siswa ?? '-' }}
                                            </div>

                                            <div class="text-[11px] text-slate-400">
                                                Siswa
                                            </div>
                                        </div>

                                    </div>

                                </td>

                                <td class="px-5 py-4">

                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[11px] font-semibold text-indigo-600">
                                        <i class="ph ph-users-three"></i>
                                        {{ $item->siswa->rombel?->nama_rombel ?? '-' }}
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                    {{ $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="font-semibold text-slate-700">
                                        {{ $format($item->nilai_ganjil) }}
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span
                                        class="font-semibold {{ $item->selisih === null ? 'text-slate-400' : ($item->selisih >= 0 ? 'text-emerald-600' : 'text-rose-600') }}">
                                        {{ $format($item->nilai_genap) }}
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-center">

                                    @if ($item->selisih === null)
                                        <span class="inline-flex items-center gap-1 font-semibold text-slate-300">
                                            <i class="ph ph-minus"></i>
                                            -
                                        </span>
                                    @elseif ($item->selisih > 0)
                                        <span
                                            class="inline-flex items-center gap-1 font-semibold text-emerald-600">
                                            <i class="ph ph-arrow-up"></i>
                                            +{{ $format($item->selisih) }}
                                        </span>
                                    @elseif ($item->selisih < 0)
                                        <span
                                            class="inline-flex items-center gap-1 font-semibold text-rose-600">
                                            <i class="ph ph-arrow-down"></i>
                                            {{ $format($item->selisih) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 font-semibold text-slate-500">
                                            <i class="ph ph-minus"></i>
                                            0
                                        </span>
                                    @endif

                                </td>

                                <td class="px-5 py-4 text-center">

                                    @php
                                        $gayaStatus = [
                                            'Meningkat' => 'bg-emerald-50 text-emerald-600',
                                            'Menurun' => 'bg-rose-50 text-rose-600',
                                            'Tetap' => 'bg-slate-100 text-slate-600',
                                            'Belum Lengkap' => 'bg-amber-50 text-amber-700',
                                            'Baru Ada' => 'bg-blue-50 text-blue-700',
                                            'Belum Dinilai' => 'bg-slate-100 text-slate-500',
                                        ];

                                        $gayaIkon = [
                                            'Meningkat' => 'ph-trend-up',
                                            'Menurun' => 'ph-trend-down',
                                            'Tetap' => 'ph-minus',
                                            'Belum Lengkap' => 'ph-hourglass-medium',
                                            'Baru Ada' => 'ph-info',
                                            'Belum Dinilai' => 'ph-minus',
                                        ];
                                    @endphp

                                    <span
                                        class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $gayaStatus[$item->status] ?? 'bg-slate-100 text-slate-600' }}">
                                        <i class="ph {{ $gayaIkon[$item->status] ?? 'ph-minus' }}"></i>
                                        {{ $item->status }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                            <i class="ph ph-chart-line text-2xl"></i>
                                        </div>

                                        <div class="text-sm font-semibold text-slate-700">
                                            Belum ada data perkembangan nilai
                                        </div>

                                        <div class="mt-1 max-w-md text-xs text-slate-500">
                                            Data muncul setelah nilai siswa tersimpan pada Input Nilai
                                            untuk tahun ajaran {{ $tahunAjaran }}.
                                        </div>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- FOOTER --}}
            <div
                class="flex flex-col gap-3 border-t border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-xs text-slate-500">

                    Menampilkan
                    <span id="jumlahDataFooter" class="font-semibold text-slate-700">
                        {{ $perkembangan->count() }}
                    </span>
                    data perkembangan nilai

                </p>

                <div class="flex items-center gap-1.5">

                    <a href="{{ route('input-nilai', [
                        'tahun_ajaran' => $tahunAjaran,
                        'rombel_id' => $rombelId,
                        'filter_mata_pelajaran' => $mapelId,
                    ]) }}"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700">

                        <i class="ph ph-notebook"></i>
                        Kelola di Input Nilai

                    </a>

                </div>

            </div>

        </div>

    </div>
@endsection