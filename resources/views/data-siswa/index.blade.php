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
                ['label' => 'Data Siswa'],
            ]" />

            <div class="mt-1 flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                        <i class="ph ph-student text-2xl text-white"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold leading-tight">
                            Data Siswa
                        </h1>

                        <p class="mt-1 text-xs text-[#c2c2dc]">
                            Kelola data siswa, rombel, dan akun login dalam sistem E-Rapor SMK.
                        </p>
                    </div>

                </div>

                <div class="hidden rounded-xl bg-white/10 px-5 py-3 ring-1 ring-white/10 sm:block">
                    <p class="text-[10px] uppercase tracking-wide text-[#c2c2dc]">
                        Total Siswa
                    </p>

                    <p class="mt-0.5 text-2xl font-bold">
                        {{ $siswa->count() }}
                    </p>
                </div>

            </div>
        </div>


        {{-- =====================================================
            ALERT SUCCESS
        ====================================================== --}}
        @if (session('status'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700 shadow-sm">
                <div class="flex items-start gap-3">

                    <div
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <i class="ph ph-check-circle text-lg"></i>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Berhasil
                        </p>

                        <p class="mt-1 text-xs">
                            {{ session('status') }}
                        </p>
                    </div>

                </div>
            </div>
        @endif


        {{-- =====================================================
            ALERT ERROR
        ====================================================== --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-sm">
                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <i class="ph ph-warning-circle text-lg"></i>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Terjadi kesalahan
                        </p>

                        <p class="mt-1 text-xs">
                            {{ $errors->first() }}
                        </p>
                    </div>

                </div>
            </div>
        @endif


        {{-- =====================================================
            FILTER
        ====================================================== --}}
        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

            <div class="mb-4 flex items-center justify-between">

                <div>
                    <div class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-funnel"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Filter Data Siswa
                            </h2>

                            <p class="text-[11px] text-slate-400">
                                Gunakan filter untuk menemukan siswa dengan cepat.
                            </p>
                        </div>
                    </div>
                </div>

                <span id="filterStatus"
                    class="hidden rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-semibold text-indigo-600">
                    Filter aktif
                </span>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                {{-- PENCARIAN --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Pencarian
                    </label>

                    <div class="relative">

                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                        </i>

                        <input type="text" id="searchSiswa"
                            class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="Cari nama atau NISN...">

                    </div>

                    <p class="mt-1.5 text-[10px] text-slate-400">
                        Pencarian berjalan otomatis saat mengetik.
                    </p>
                </div>


                {{-- JENIS KELAMIN --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Jenis Kelamin
                    </label>

                    <select id="jenisKelaminSiswa"
                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
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


                {{-- ROMBEL --}}
                <div>
                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Rombel
                    </label>

                    <select id="rombelSiswa"
                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Rombel
                        </option>

                        @foreach ($rombelList ?? [] as $rombel)
                            <option value="{{ $rombel->id }}">
                                {{ $rombel->nama_rombel }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- RESET --}}
                <div class="flex items-end">

                    <button type="button" onclick="resetFilterSiswa()"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-slate-100 px-5 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                        <i class="ph ph-arrow-counter-clockwise"></i>
                        Reset Filter
                    </button>

                </div>

            </div>


            {{-- HASIL FILTER --}}
            <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">

                <div class="flex items-center gap-2 text-xs text-slate-500">

                    <i class="ph ph-list-magnifying-glass text-indigo-500"></i>

                    <span>
                        Menampilkan
                        <strong id="jumlahHasil" class="font-semibold text-slate-700">
                            {{ $siswa->count() }}
                        </strong>
                        data siswa
                    </span>

                </div>

                <span class="text-[10px] text-slate-400">
                    Filter otomatis
                </span>

            </div>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}
        <div id="tableSiswa">

            <x-table-card title="Daftar Siswa" subtitle="Menampilkan seluruh siswa yang terdaftar dalam sistem E-Rapor SMK."
                :createRoute="route('data-siswa.create')" :items="$siswa">

                <x-slot:thead>

                    <th class="px-6 py-4">
                        No
                    </th>

                    <th class="px-6 py-4">
                        Siswa
                    </th>

                    <th class="px-6 py-4">
                        NISN
                    </th>

                    <th class="px-6 py-4">
                        Jenis Kelamin
                    </th>

                    <th class="px-6 py-4">
                        Tempat / Tanggal Lahir
                    </th>

                    <th class="px-6 py-4">
                        Rombel
                    </th>

                    <th class="px-6 py-4">
                        Akun
                    </th>

                    <th class="min-w-[220px] px-6 py-4 text-center">
                        Aksi
                    </th>

                </x-slot:thead>


                {{-- DATA SISWA --}}
                @forelse ($siswa as $item)
                    <tr class="status-row transition hover:bg-slate-50"
                        data-nama="{{ strtolower($item->nama_siswa ?? '') }}"
                        data-nisn="{{ strtolower($item->nisn ?? '') }}" data-jk="{{ $item->jenis_kelamin ?? '' }}"
                        data-rombel="{{ $item->rombel_id ?? '' }}">

                        {{-- NO --}}
                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $loop->iteration }}
                        </td>


                        {{-- SISWA --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                    <i class="ph ph-student"></i>
                                </div>

                                <div>

                                    <div class="font-semibold text-slate-800">
                                        {{ $item->nama_siswa }}
                                    </div>

                                    <div class="mt-0.5 text-[11px] text-slate-400">
                                        ID: {{ $item->id }}
                                    </div>

                                </div>

                            </div>

                        </td>


                        {{-- NISN --}}
                        <td class="px-6 py-5 text-sm font-medium text-slate-700">
                            {{ $item->nisn ?? '-' }}
                        </td>


                        {{-- JENIS KELAMIN --}}
                        <td class="px-6 py-5">

                            @if ($item->jenis_kelamin === 'L')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                    <i class="ph ph-gender-male"></i>
                                    Laki-laki
                                </span>
                            @elseif ($item->jenis_kelamin === 'P')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-700">
                                    <i class="ph ph-gender-female"></i>
                                    Perempuan
                                </span>
                            @else
                                <span class="text-sm text-slate-400">
                                    Belum diisi
                                </span>
                            @endif

                        </td>


                        {{-- TEMPAT / TANGGAL LAHIR --}}
                        <td class="px-6 py-5">

                            <div class="text-sm text-slate-700">
                                {{ $item->tempat_lahir ?? '-' }}
                            </div>

                            <div class="mt-1 flex items-center gap-1 text-[11px] text-slate-400">

                                <i class="ph ph-calendar"></i>

                                {{ $item->tanggal_lahir?->format('d/m/Y') ?? '-' }}

                            </div>

                        </td>


                        {{-- ROMBEL --}}
                        <td class="px-6 py-5">

                            @if ($item->rombel)
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700">
                                    <i class="ph ph-users-three"></i>
                                    {{ $item->rombel->nama_rombel }}
                                </span>
                            @else
                                <span class="text-sm text-slate-400">
                                    Belum ditentukan
                                </span>
                            @endif

                        </td>


                        {{-- AKUN --}}
                        <td class="px-6 py-5">

                            @if ($item->user)
                                <div>

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        <i class="ph ph-check-circle"></i>
                                        Terhubung
                                    </span>

                                    <div class="mt-1 text-[11px] text-slate-400">
                                        {{ $item->user->username }}
                                    </div>

                                </div>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                    <i class="ph ph-warning-circle"></i>
                                    Belum
                                </span>
                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-5 text-center">

                            <div class="flex flex-wrap items-center justify-center gap-1.5">

                                {{-- DETAIL --}}
                                <a href="{{ route('data-siswa.show', $item->id) }}"
                                    class="inline-flex items-center gap-1 rounded-lg bg-blue-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-600">
                                    <i class="ph ph-eye"></i>
                                    Detail
                                </a>


                                {{-- EDIT --}}
                                <a href="{{ route('data-siswa.edit', $item->id) }}"
                                    class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                                    <i class="ph ph-pencil-simple"></i>
                                    Edit
                                </a>


                                {{-- HAPUS --}}
                                <form action="{{ route('data-siswa.destroy', $item->id) }}" method="POST"
                                    class="inline-block" data-hapus-form>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" data-nama="{{ $item->nama_siswa }}"
                                        class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-600">
                                        <i class="ph ph-trash"></i>
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">

                            <div class="flex flex-col items-center">

                                <div
                                    class="mb-3 flex h-14 w-14 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                    <i class="ph ph-student text-2xl"></i>
                                </div>

                                <p class="font-semibold text-slate-700">
                                    Belum ada data siswa
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Tambahkan data siswa untuk mulai menggunakan fitur ini.
                                </p>

                            </div>

                        </td>
                    </tr>
                @endforelse

            </x-table-card>

        </div>

    </div>


    {{-- =====================================================
        JAVASCRIPT FILTER
    ====================================================== --}}
    <script>
        const searchSiswa = document.getElementById('searchSiswa');
        const jenisKelaminSiswa = document.getElementById('jenisKelaminSiswa');
        const rombelSiswa = document.getElementById('rombelSiswa');
        const jumlahHasil = document.getElementById('jumlahHasil');
        const filterStatus = document.getElementById('filterStatus');


        // ==========================================
        // FILTER DATA SISWA
        // ==========================================
        function filterSiswa() {

            const search = searchSiswa.value.toLowerCase().trim();
            const jenisKelamin = jenisKelaminSiswa.value;
            const rombel = rombelSiswa.value;

            const rows = document.querySelectorAll('.status-row');

            let jumlah = 0;

            rows.forEach(function(row) {

                const nama = row.dataset.nama || '';
                const nisn = row.dataset.nisn || '';
                const jk = row.dataset.jk || '';
                const rombelId = row.dataset.rombel || '';

                const cocokSearch =
                    search === '' ||
                    nama.includes(search) ||
                    nisn.includes(search);

                const cocokJk =
                    jenisKelamin === '' ||
                    jk === jenisKelamin;

                const cocokRombel =
                    rombel === '' ||
                    rombelId === rombel;

                const tampil =
                    cocokSearch &&
                    cocokJk &&
                    cocokRombel;

                row.style.display = tampil ? '' : 'none';

                if (tampil) {
                    jumlah++;
                }

            });


            // Update jumlah hasil
            if (jumlahHasil) {
                jumlahHasil.textContent = jumlah;
            }


            // Status filter
            const filterAktif =
                search !== '' ||
                jenisKelamin !== '' ||
                rombel !== '';

            if (filterStatus) {
                filterStatus.classList.toggle(
                    'hidden',
                    !filterAktif
                );
            }

        }


        // ==========================================
        // SEARCH REALTIME
        // ==========================================
        searchSiswa.addEventListener(
            'input',
            filterSiswa
        );


        // ==========================================
        // FILTER JENIS KELAMIN
        // ==========================================
        jenisKelaminSiswa.addEventListener(
            'change',
            filterSiswa
        );


        // ==========================================
        // FILTER ROMBEL
        // ==========================================
        rombelSiswa.addEventListener(
            'change',
            filterSiswa
        );


        // ==========================================
        // RESET FILTER
        // ==========================================
        function resetFilterSiswa() {

            searchSiswa.value = '';
            jenisKelaminSiswa.value = '';
            rombelSiswa.value = '';

            filterSiswa();

        }


        // ==========================================
        // KONFIRMASI HAPUS
        // ==========================================
        document
            .querySelectorAll('form[data-hapus-form]')
            .forEach(function(form) {

                form.addEventListener('submit', function(event) {

                    const button =
                        form.querySelector('button[data-nama]');

                    const nama =
                        button?.dataset.nama || 'siswa ini';

                    const yakin = confirm(
                        'Yakin ingin menghapus data siswa "' +
                        nama +
                        '"?\n\n' +
                        'Data yang sudah dihapus tidak dapat dikembalikan.'
                    );

                    if (!yakin) {
                        event.preventDefault();
                    }

                });

            });


        // ==========================================
        // JALANKAN FILTER SAAT HALAMAN DIBUKA
        // ==========================================
        filterSiswa();
    </script>
@endsection
