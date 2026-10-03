@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <x-breadcrumb :items="[['label' => 'Data Master'], ['label' => 'Data Sekolah']]" />

                    {{-- TITLE --}}
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                            <i class="ph ph-buildings text-2xl text-white"></i>
                        </div>

                        <div>
                            <h1 class="text-xl font-bold leading-tight">
                                Data Sekolah
                            </h1>

                            <p class="mt-1 text-xs text-[#c2c2dc]">
                                Kelola informasi sekolah yang digunakan dalam sistem E-Rapor SMK.
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
                            Filter Data Sekolah
                        </h2>

                    </div>

                    <p class="mt-1 ml-10 text-xs text-slate-500">
                        Gunakan pencarian untuk menemukan data sekolah dengan cepat.
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                {{-- SEARCH --}}
                <div>

                    <label class="mb-2 block text-xs font-semibold text-slate-600">
                        Cari Sekolah
                    </label>

                    <div class="relative">

                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                        </i>

                        <input type="text" id="searchSekolah" placeholder="Nama sekolah atau NPSN..."
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                            onkeyup="filterSekolah()">

                    </div>

                </div>


                {{-- RESET --}}
                <div class="flex items-end">

                    <button type="button" onclick="resetFilterSekolah()"
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
                            <i class="ph ph-buildings"></i>
                        </div>

                        <h2 class="text-base font-bold text-slate-800">
                            Daftar Sekolah
                        </h2>

                    </div>

                    <p class="mt-1 ml-10 text-xs text-slate-500">
                        Data sekolah yang terdaftar dalam sistem E-Rapor SMK.
                    </p>

                </div>


                {{-- KANAN --}}
                <div class="flex flex-wrap items-center gap-2">

                    {{-- JUMLAH DATA --}}
                    <div
                        class="inline-flex w-fit items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-xs font-semibold text-slate-600">

                        <i class="ph ph-database text-indigo-500"></i>

                        <span id="jumlahSekolah">
                            {{ $sekolah->count() }}
                        </span>

                        <span>
                            Data
                        </span>

                    </div>


                    {{-- TAMBAH DATA --}}
                    <a href="{{ route('data-sekolah.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">

                        <i class="ph ph-plus"></i>

                        Tambah Data

                    </a>

                </div>

            </div>


            {{-- =====================================================
                TABLE
            ====================================================== --}}
            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="border-b border-slate-100 bg-slate-50/80">

                        <tr>

                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                No
                            </th>

                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                Sekolah
                            </th>

                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                NPSN
                            </th>

                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                Kepala Sekolah
                            </th>

                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                Kontak
                            </th>

                            <th class="whitespace-nowrap px-5 py-3.5 text-xs font-bold text-slate-600">
                                Alamat
                            </th>

                            <th class="whitespace-nowrap px-5 py-3.5 text-center text-xs font-bold text-slate-600">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="sekolahTableBody" class="divide-y divide-slate-100">

                        @forelse ($sekolah as $item)
                            <tr class="sekolah-row group transition hover:bg-slate-50/70"
                                data-nama="{{ strtolower($item->nama_sekolah ?? '') }}"
                                data-npsn="{{ strtolower($item->npsn ?? '') }}">

                                {{-- NO --}}
                                <td class="whitespace-nowrap px-5 py-4 align-middle">

                                    <span class="text-xs font-semibold text-slate-400">
                                        {{ $loop->iteration }}
                                    </span>

                                </td>


                                {{-- SEKOLAH --}}
                                <td class="px-5 py-4 align-middle">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                            <i class="ph ph-buildings text-lg"></i>

                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate text-sm font-semibold text-slate-800">
                                                {{ $item->nama_sekolah ?? '-' }}
                                            </p>

                                            <p class="mt-0.5 truncate text-xs text-slate-400">
                                                {{ $item->email ?? 'Email belum tersedia' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- NPSN --}}
                                <td class="whitespace-nowrap px-5 py-4 align-middle">

                                    <span class="text-xs font-medium text-slate-600">
                                        {{ $item->npsn ?? '-' }}
                                    </span>

                                </td>


                                {{-- KEPALA SEKOLAH --}}
                                <td class="px-5 py-4 align-middle">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-50 text-slate-400">

                                            <i class="ph ph-user"></i>

                                        </div>

                                        <span class="text-xs font-medium text-slate-600">
                                            {{ $item->kepala_sekolah ?? '-' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- KONTAK --}}
                                <td class="px-5 py-4 align-middle">

                                    <div class="space-y-1">

                                        <div class="flex items-center gap-1.5 text-xs text-slate-600">

                                            <i class="ph ph-phone text-slate-400"></i>

                                            <span>
                                                {{ $item->telepon ?? '-' }}
                                            </span>

                                        </div>

                                        <div
                                            class="flex max-w-[220px] items-center gap-1.5 truncate text-xs text-slate-400">

                                            <i class="ph ph-globe"></i>

                                            <span class="truncate">
                                                {{ $item->website ?? '-' }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- ALAMAT --}}
                                <td class="px-5 py-4 align-middle">

                                    <div class="flex max-w-[280px] items-start gap-1.5">

                                        <i class="ph ph-map-pin mt-0.5 shrink-0 text-slate-400"></i>

                                        <span class="line-clamp-2 text-xs leading-relaxed text-slate-600">
                                            {{ $item->alamat ?? '-' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- AKSI --}}
                                <td class="px-5 py-4 align-middle">

                                    <div class="flex items-center justify-center gap-1.5">

                                        {{-- EDIT --}}
                                        <a href="{{ route('data-sekolah.edit', $item->id) }}" title="Edit Data Sekolah"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600 transition hover:bg-amber-100">

                                            <i class="ph ph-pencil-simple text-sm"></i>

                                        </a>


                                        {{-- DELETE --}}
                                        <form action="{{ route('data-sekolah.destroy', $item->id) }}" method="POST"
                                            class="delete-sekolah-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="button" onclick="confirmDeleteSekolah(this)"
                                                title="Hapus Data Sekolah"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-500 transition hover:bg-red-100">

                                                <i class="ph ph-trash text-sm"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-5 py-14">

                                    <div class="flex flex-col items-center justify-center">

                                        <div
                                            class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50">

                                            <i class="ph ph-buildings text-3xl text-slate-300">
                                            </i>

                                        </div>

                                        <p class="font-semibold text-slate-700">
                                            Belum ada data sekolah
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            Data sekolah yang ditambahkan akan muncul di sini.
                                        </p>

                                        <a href="{{ route('data-sekolah.create') }}"
                                            class="mt-4 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700">

                                            <i class="ph ph-plus"></i>

                                            Tambah Data Sekolah

                                        </a>

                                    </div>

                                </td>

                            </tr>
                        @endforelse


                        {{-- NO RESULT FILTER --}}
                        <tr id="noFilterResult" class="hidden">

                            <td colspan="7" class="px-5 py-14">

                                <div class="flex flex-col items-center justify-center">

                                    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50">

                                        <i class="ph ph-magnifying-glass text-2xl text-slate-300">
                                        </i>

                                    </div>

                                    <p class="font-semibold text-slate-700">
                                        Data tidak ditemukan
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Tidak ada sekolah yang sesuai dengan pencarian.
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
        JAVASCRIPT
    ====================================================== --}}
    <script>
        /*
                                |--------------------------------------------------------------------------
                                | FILTER SEKOLAH
                                |--------------------------------------------------------------------------
                                */

        function filterSekolah() {

            const search =
                document
                .getElementById('searchSekolah')
                .value
                .toLowerCase()
                .trim();

            const rows =
                document.querySelectorAll('.sekolah-row');

            let jumlahTampil = 0;

            rows.forEach(function(row) {

                const nama =
                    row.dataset.nama || '';

                const npsn =
                    row.dataset.npsn || '';

                const cocokSearch =
                    nama.includes(search) ||
                    npsn.includes(search);

                if (cocokSearch) {

                    row.style.display = '';

                    jumlahTampil++;

                } else {

                    row.style.display = 'none';

                }

            });


            document
                .getElementById('jumlahSekolah')
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

        function resetFilterSekolah() {

            document
                .getElementById('searchSekolah')
                .value = '';

            filterSekolah();

        }


        /*
        |--------------------------------------------------------------------------
        | KONFIRMASI HAPUS
        |--------------------------------------------------------------------------
        */

        function confirmDeleteSekolah(button) {

            const form =
                button.closest('.delete-sekolah-form');

            const nama =
                button
                .closest('.sekolah-row')
                ?.dataset.nama || 'sekolah ini';

            const yakin =
                confirm(
                    'Apakah Anda yakin ingin menghapus data sekolah "' +
                    nama +
                    '"?\n\nData yang sudah dihapus tidak dapat dikembalikan.'
                );

            if (yakin) {

                form.submit();

            }

        }
    </script>
@endsection
