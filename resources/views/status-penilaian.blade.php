@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50">

        {{-- =====================================================
        HEADER
    ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Status Penilaian']]" />

            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

                <div>

                    <div class="mb-2 flex items-center gap-2">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-clipboard-text text-xl"></i>
                        </div>

                        <span class="text-xs font-medium uppercase tracking-wider text-indigo-200">
                            E-Rapor SMK
                        </span>

                    </div>

                    <h1 class="text-2xl font-bold tracking-tight">
                        Status Penilaian
                    </h1>

                    <p class="mt-1 max-w-2xl text-sm text-indigo-100">
                        Pantau status pengisian nilai siswa berdasarkan tahun ajaran,
                        semester, kelas, dan mata pelajaran.
                    </p>

                </div>


                {{-- Periode --}}
                <div class="rounded-xl border border-white/10 bg-white/10 px-5 py-3 backdrop-blur-sm">

                    <div class="text-[10px] font-medium uppercase tracking-wider text-indigo-200">
                        Monitoring Penilaian
                    </div>

                    <div class="mt-1 flex items-center gap-2 text-sm font-semibold">

                        <i class="ph ph-chart-bar"></i>

                        <span>
                            {{ $tahunAjaran }} • {{ $semester }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
        RINGKASAN STATUS
    ====================================================== --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Sudah Dinilai --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Sudah Dinilai
                        </p>

                        <p id="jumlahSudahDinilai" class="mt-1 text-2xl font-bold text-green-600">
                            {{ $sudahDinilai }}
                        </p>

                        <p class="mt-0.5 text-[11px] text-slate-400">
                            Data penilaian telah tersedia
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-600">

                        <i class="ph ph-check-circle text-xl"></i>

                    </div>

                </div>

            </div>


            {{-- Belum Dinilai --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Belum Dinilai
                        </p>

                        <p id="jumlahBelumDinilai" class="mt-1 text-2xl font-bold text-red-600">
                            {{ $belumDinilai }}
                        </p>

                        <p class="mt-0.5 text-[11px] text-slate-400">
                            Masih membutuhkan pengisian nilai
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-600">

                        <i class="ph ph-warning-circle text-xl"></i>

                    </div>

                </div>

            </div>


            {{-- Total --}}
            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Total Data
                        </p>

                        <p id="jumlahTotal" class="mt-1 text-2xl font-bold text-indigo-600">
                            {{ $totalPenilaian }}
                        </p>

                        <p class="mt-0.5 text-[11px] text-slate-400">
                            Siswa x mata pelajaran
                        </p>

                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">

                        <i class="ph ph-student text-xl"></i>

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

                    Filter Status Penilaian

                </h2>

                <p class="text-xs text-slate-500">
                    Gunakan filter untuk menampilkan status penilaian sesuai kebutuhan.
                </p>

            </div>


            <form method="GET" action="{{ route('status-penilaian') }}">

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

                            @foreach ($daftarTahun as $tahun)
                                <option value="{{ $tahun }}" @selected($tahunAjaran === $tahun)>
                                    {{ $tahun }}
                                </option>
                            @endforeach

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
                                <option value="{{ $item->id }}" @selected((string) $mapelId === (string) $item->id)>
                                    {{ $item->nama_mata_pelajaran }}
                                </option>
                            @endforeach

                        </select>

                        <i
                            class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                    </div>

                </div>

            </div>


            {{-- Search --}}
                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div class="relative max-w-md">

                        <i
                            class="ph ph-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="search" name="q" id="searchStatus" value="{{ request('q') }}"
                            placeholder="Cari nama siswa atau NISN..."
                            class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    </div>

                    <button type="submit"
                        class="inline-flex shrink-0 items-center justify-center gap-1.5 rounded-lg bg-indigo-600 px-3.5 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700">
                        <i class="ph ph-funnel"></i>
                        Terapkan
                    </button>

                </div>

            </form>


            {{-- Status filter --}}
            <div class="mt-3 text-[11px] text-slate-500">
                Menampilkan
                <span id="jumlahHasil" class="font-semibold text-slate-700">
                    {{ count($statusPenilaian) }}
                </span>
                data
            </div>

        </div>


        {{-- =====================================================
        TABEL
    ====================================================== --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">

                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                    <div>

                        <h2 class="flex items-center gap-2 text-base font-bold text-slate-800">

                            <i class="ph ph-list-checks text-indigo-600"></i>

                            Daftar Status Penilaian

                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Menampilkan status penilaian berdasarkan data siswa dan mata pelajaran.
                        </p>

                    </div>


                    <span id="badgeJumlahData"
                        class="inline-flex w-fit items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                        <i class="ph ph-database"></i>

                        <span id="jumlahData">
                            {{ $totalPenilaian }}
                        </span>

                        Data

                    </span>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1050px] text-left text-sm">

                    <thead
                        class="border-b border-slate-200 bg-slate-50 text-[10px] uppercase tracking-wider text-slate-500">

                        <tr>

                            <th class="px-5 py-3.5 font-semibold">
                                No
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Siswa
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Kelas
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Mata Pelajaran
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Tahun Ajaran
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Semester
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody id="statusTable" class="divide-y divide-slate-100">

                        @forelse ($statusPenilaian as $item)
                            <tr class="status-row transition hover:bg-slate-50"
                                data-nama="{{ strtolower($item->siswa->nama_siswa ?? '') }}"
                                data-nisn="{{ strtolower($item->siswa->nisn ?? '') }}"
                                data-rombel="{{ $item->siswa->rombel_id ?? '' }}"
                                data-mapel="{{ $item->mata_pelajaran_id ?? '' }}"
                                data-status="{{ $item->status ?? '' }}">

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
                                                {{ $item->siswa->nama_siswa ?? '-' }}
                                            </div>

                                            <div class="mt-0.5 text-[11px] text-slate-500">
                                                NISN:
                                                {{ $item->siswa->nisn ?? '-' }}
                                            </div>

                                            <div class="mt-0.5 text-[11px] text-slate-400">
                                                @if ($item->nilai === null)
                                                    <span>Nilai belum diisi</span>
                                                @else
                                                    Nilai:
                                                    {{ rtrim(rtrim(number_format((float) $item->nilai, 2, '.', ''), '0'), '.') }}
                                                @endif
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Kelas --}}
                                <td class="px-5 py-4 align-top">

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-semibold text-blue-700">

                                        <i class="ph ph-users-three"></i>

                                        {{ $item->siswa->rombel?->nama_rombel ?? '-' }}

                                    </span>

                                </td>


                                {{-- Mata Pelajaran --}}
                                <td class="px-5 py-4 align-top">

                                    <div class="font-medium text-slate-700">
                                        {{ $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                    </div>

                                    @if (!empty($item->mataPelajaran->kode_mata_pelajaran))
                                        <div class="mt-0.5 text-[10px] text-slate-400">
                                            {{ $item->mataPelajaran->kode_mata_pelajaran }}
                                        </div>
                                    @endif

                                </td>


                                {{-- Tahun --}}
                                <td class="px-5 py-4 text-center align-top">

                                    <span
                                        class="inline-flex rounded-full bg-indigo-50 px-2.5 py-1 text-[10px] font-semibold text-indigo-700">
                                        {{ $item->tahun_ajaran ?? '-' }}
                                    </span>

                                </td>


                                {{-- Semester --}}
                                <td class="px-5 py-4 text-center align-top">

                                    <span
                                        class="inline-flex rounded-full bg-purple-50 px-2.5 py-1 text-[10px] font-semibold text-purple-700">
                                        {{ $item->semester ?? '-' }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-4 text-center align-top">

                                    @if ($item->status === \App\Http\Controllers\StatusPenilaianController::SUDAH)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1.5 text-[11px] font-semibold text-green-700">

                                            <i class="ph ph-check-circle"></i>

                                            Sudah Dinilai

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1.5 text-[11px] font-semibold text-red-700">

                                            <i class="ph ph-warning-circle"></i>

                                            Belum Dinilai

                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

                                            <i class="ph ph-clipboard-text text-2xl"></i>

                                        </div>

                                        <div class="text-sm font-semibold text-slate-700">
                                            Belum ada data penilaian
                                        </div>

                                        <div class="mt-1 max-w-md text-xs text-slate-500">
                                            Tambahkan data siswa, rombel, dan mata pelajaran
                                            terlebih dahulu agar status penilaian dapat dihitung.
                                        </div>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Footer --}}
            <div
                class="flex flex-col gap-3 border-t border-slate-100 bg-slate-50/60 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <p class="text-xs text-slate-500">

                    Menampilkan

                    <span id="footerJumlah" class="font-semibold text-slate-700">
                        {{ count($statusPenilaian) }}
                    </span>

                    data penilaian

                </p>

                <div class="text-[11px] text-slate-400">
                    Status mengikuti data nilai yang tersimpan di
                    {{ $tahunAjaran }} semester {{ $semester }}.
                </div>

            </div>

        </div>

    </div>


    {{-- Filter sudah diproses di server oleh StatusPenilaianController,
    sehingga angka ringkasan selalu sama dengan tabel. --}}
@endsection
