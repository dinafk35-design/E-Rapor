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
                ['label' => 'Mata Pelajaran'],
            ]" />

            <div class="mt-1 flex items-center justify-between gap-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                        <i class="ph ph-book-open text-2xl text-white"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold leading-tight">
                            Data Mata Pelajaran
                        </h1>

                        <p class="mt-1 text-xs text-[#c2c2dc]">
                            Kelola mata pelajaran, kelompok, sekolah, dan guru yang mengajar.
                        </p>
                    </div>

                </div>

                <div class="hidden rounded-xl bg-white/10 px-5 py-3 ring-1 ring-white/10 sm:block">
                    <p class="text-[10px] uppercase tracking-wide text-[#c2c2dc]">
                        Total Mata Pelajaran
                    </p>

                    <p class="mt-0.5 text-2xl font-bold">
                        {{ $mataPelajaran->count() }}
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
                            Terjadi kesalahan
                        </p>

                        <p class="mt-1 text-xs text-red-700">
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

                <div class="flex items-center gap-2">

                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-funnel"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Filter Mata Pelajaran
                        </h2>

                        <p class="text-[11px] text-slate-400">
                            Cari mata pelajaran berdasarkan kode, nama, atau kelompok.
                        </p>
                    </div>

                </div>

                <span id="filterStatus"
                    class="hidden rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-semibold text-indigo-600">
                    Filter aktif
                </span>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

                {{-- PENCARIAN --}}
                <div>

                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Pencarian
                    </label>

                    <div class="relative">

                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" id="searchMapel"
                            class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                            placeholder="Cari kode atau nama mata pelajaran...">

                    </div>

                    <p class="mt-1.5 text-[10px] text-slate-400">
                        Hasil pencarian diperbarui otomatis saat mengetik.
                    </p>

                </div>


                {{-- KELOMPOK --}}
                <div>

                    <label class="mb-2 block text-xs font-semibold text-slate-700">
                        Kelompok
                    </label>

                    <select id="kelompokMapel"
                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        <option value="">
                            Semua Kelompok
                        </option>

                        <option value="A">
                            Kelompok A
                        </option>

                        <option value="B">
                            Kelompok B
                        </option>

                        <option value="C">
                            Kelompok C
                        </option>

                        <option value="Muatan Lokal">
                            Muatan Lokal
                        </option>

                    </select>

                </div>


                {{-- RESET --}}
                <div class="flex items-end">

                    <button type="button" onclick="resetFilterMapel()"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-slate-100 px-5 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                        <i class="ph ph-arrow-counter-clockwise"></i>
                        Reset Filter
                    </button>

                </div>

            </div>


            {{-- HASIL --}}
            <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">

                <div class="flex items-center gap-2 text-xs text-slate-500">

                    <i class="ph ph-list-magnifying-glass text-indigo-500"></i>

                    <span>
                        Menampilkan
                        <strong id="jumlahHasil" class="font-semibold text-slate-700">
                            {{ $mataPelajaran->count() }}
                        </strong>
                        mata pelajaran
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
        <x-table-card title="Daftar Mata Pelajaran"
            subtitle="Menampilkan seluruh mata pelajaran yang terdaftar dalam sistem E-Rapor SMK." :createRoute="route('mata-pelajaran.create')"
            :items="$mataPelajaran">

            <x-slot:thead>

                <th class="px-6 py-4">
                    No
                </th>

                <th class="px-6 py-4">
                    Mata Pelajaran
                </th>

                <th class="px-6 py-4">
                    Kelompok
                </th>

                <th class="px-6 py-4">
                    Sekolah
                </th>

                <th class="px-6 py-4">
                    Guru Mengajar
                </th>

                <th class="min-w-[220px] px-6 py-4 text-center">
                    Aksi
                </th>

            </x-slot:thead>


            @forelse ($mataPelajaran as $item)
                <tr class="status-row transition hover:bg-slate-50"
                    data-kode="{{ strtolower($item->kode_mata_pelajaran ?? '') }}"
                    data-nama="{{ strtolower($item->nama_mata_pelajaran ?? '') }}"
                    data-kelompok="{{ strtolower($item->kelompok ?? '') }}">

                    {{-- NO --}}
                    <td class="px-6 py-5 text-sm text-slate-500">
                        {{ $loop->iteration }}
                    </td>


                    {{-- MATA PELAJARAN --}}
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <i class="ph ph-book-open"></i>
                            </div>

                            <div>

                                <div class="font-semibold text-slate-800">
                                    {{ $item->nama_mata_pelajaran ?? '-' }}
                                </div>

                                <div class="mt-0.5 text-[11px] text-slate-400">
                                    Kode:
                                    {{ $item->kode_mata_pelajaran ?? 'Belum diisi' }}
                                </div>

                            </div>

                        </div>

                    </td>


                    {{-- KELOMPOK --}}
                    <td class="px-6 py-5">

                        @if ($item->kelompok)
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                <i class="ph ph-stack"></i>
                                {{ $item->kelompok === 'Muatan Lokal' ? 'Muatan Lokal' : 'Kelompok ' . $item->kelompok }}
                            </span>
                        @else
                            <span class="text-sm text-slate-400">
                                Belum ditentukan
                            </span>
                        @endif

                    </td>


                    {{-- SEKOLAH --}}
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-2">

                            <i class="ph ph-buildings text-slate-400"></i>

                            <span class="text-sm text-slate-700">
                                {{ $item->sekolah->nama_sekolah ?? '-' }}
                            </span>

                        </div>

                    </td>


                    {{-- GURU --}}
                    <td class="px-6 py-5">

                        @if ($item->guruMengajar && $item->guruMengajar->count() > 0)
                            <div class="space-y-1">

                                @foreach ($item->guruMengajar as $relasi)
                                    <div>
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                            <i class="ph ph-chalkboard-teacher"></i>
                                            {{ $relasi->guru->nama_guru ?? '-' }}
                                        </span>
                                    </div>
                                @endforeach

                            </div>

                            <p class="mt-2 text-[10px] text-slate-400">
                                {{ $item->guruMengajar->count() }} guru terhubung
                            </p>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">
                                <i class="ph ph-warning-circle"></i>
                                Belum ada guru
                            </span>
                        @endif

                    </td>


                    {{-- AKSI --}}
                    <td class="px-6 py-5 text-center">

                        <div class="flex flex-wrap items-center justify-center gap-1.5">

                            {{-- EDIT --}}
                            <a href="{{ route('mata-pelajaran.edit', $item->id) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </a>


                            {{-- RELASI --}}
                            <button type="button"
                                onclick="lihatRelasi(
                                    @js($item->nama_mata_pelajaran),
                                    @js($item->kode_mata_pelajaran),
                                    @js($item->kelompok),
                                    @js($item->sekolah->nama_sekolah ?? '-'),
                                    @js($item->guruMengajar->map(fn($relasi) => $relasi->guru->nama_guru ?? '-')->values()->toArray())
                                )"
                                class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">

                                <i class="ph ph-link-simple"></i>
                                Relasi

                            </button>


                            {{-- HAPUS --}}
                            <form action="{{ route('mata-pelajaran.destroy', $item->id) }}" method="POST"
                                class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus mata pelajaran {{ $item->nama_mata_pelajaran }}?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="inline-flex items-center gap-1 rounded-lg bg-red-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-700">

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
                                class="mb-3 flex h-14 w-14 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                <i class="ph ph-book-open text-2xl"></i>
                            </div>

                            <p class="font-semibold text-slate-700">
                                Belum ada data mata pelajaran
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Tambahkan mata pelajaran untuk mulai mengelola data akademik.
                            </p>

                        </div>

                    </td>

                </tr>
            @endforelse

        </x-table-card>

    </div>


    {{-- =====================================================
        MODAL RELASI
    ====================================================== --}}
    <div id="modalRelasi"
        class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 px-4 backdrop-blur-sm">

        <div class="w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">

            {{-- HEADER --}}
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">

                <div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Relasi Mata Pelajaran
                    </h3>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Guru yang mengajar mata pelajaran ini
                    </p>

                </div>

                <button type="button" onclick="tutupRelasi()"
                    class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">

                    <i class="ph ph-x text-lg"></i>

                </button>

            </div>


            {{-- CONTENT --}}
            <div class="max-h-[70vh] overflow-y-auto p-6">

                {{-- INFORMASI MAPEL --}}
                <div class="mb-5 rounded-xl bg-slate-50 p-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">

                            <i class="ph ph-book-open text-xl"></i>

                        </div>


                        <div class="min-w-0">

                            <h4 id="relasiNama" class="font-bold text-slate-800">
                                -
                            </h4>


                            <div class="mt-1 flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-500">

                                <span>
                                    Kode:
                                    <strong id="relasiKode" class="text-slate-700">
                                        -
                                    </strong>
                                </span>

                                <span>
                                    Kelompok:
                                    <strong id="relasiKelompok" class="text-slate-700">
                                        -
                                    </strong>
                                </span>

                            </div>


                            <p id="relasiSekolah" class="mt-1 text-xs text-slate-500">
                                -
                            </p>

                        </div>

                    </div>

                </div>


                {{-- GURU --}}
                <div>

                    <div class="mb-3 flex items-center justify-between">

                        <h4 class="text-sm font-bold text-slate-700">
                            Guru Pengajar
                        </h4>

                        <span id="relasiJumlah"
                            class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-600">
                            0 Guru
                        </span>

                    </div>


                    <div id="relasiGuruList" class="space-y-2">
                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="flex justify-end border-t border-slate-100 px-6 py-4">

                <button type="button" onclick="tutupRelasi()"
                    class="rounded-lg bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-200">

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
                    | FILTER MATA PELAJARAN
                    |--------------------------------------------------------------------------
                    */

        const searchMapel = document.getElementById('searchMapel');
        const kelompokMapel = document.getElementById('kelompokMapel');
        const jumlahHasil = document.getElementById('jumlahHasil');
        const filterStatus = document.getElementById('filterStatus');


        function filterMapel() {

            if (!searchMapel || !kelompokMapel) {
                return;
            }

            const search = searchMapel.value.toLowerCase().trim();
            const kelompok = kelompokMapel.value.toLowerCase().trim();

            const rows = document.querySelectorAll('.status-row');

            let jumlah = 0;


            rows.forEach(function(row) {

                const kode = row.dataset.kode || '';
                const nama = row.dataset.nama || '';
                const kelompokData = row.dataset.kelompok || '';


                const cocokSearch =
                    search === '' ||
                    kode.includes(search) ||
                    nama.includes(search);


                const cocokKelompok =
                    kelompok === '' ||
                    kelompokData === kelompok;


                const tampil =
                    cocokSearch &&
                    cocokKelompok;


                row.style.display = tampil ? '' : 'none';


                if (tampil) {
                    jumlah++;
                }

            });


            if (jumlahHasil) {
                jumlahHasil.textContent = jumlah;
            }


            const filterAktif =
                search !== '' ||
                kelompok !== '';


            if (filterStatus) {

                filterStatus.classList.toggle(
                    'hidden',
                    !filterAktif
                );

            }

        }


        if (searchMapel) {

            searchMapel.addEventListener(
                'input',
                filterMapel
            );

        }


        if (kelompokMapel) {

            kelompokMapel.addEventListener(
                'change',
                filterMapel
            );

        }


        function resetFilterMapel() {

            if (searchMapel) {
                searchMapel.value = '';
            }

            if (kelompokMapel) {
                kelompokMapel.value = '';
            }

            filterMapel();

        }


        /*
        |--------------------------------------------------------------------------
        | MODAL RELASI
        |--------------------------------------------------------------------------
        */

        function lihatRelasi(nama, kode, kelompok, sekolah, guru) {

            const modal = document.getElementById('modalRelasi');
            const relasiNama = document.getElementById('relasiNama');
            const relasiKode = document.getElementById('relasiKode');
            const relasiKelompok = document.getElementById('relasiKelompok');
            const relasiSekolah = document.getElementById('relasiSekolah');
            const relasiJumlah = document.getElementById('relasiJumlah');
            const guruList = document.getElementById('relasiGuruList');


            if (!modal) {
                return;
            }


            relasiNama.textContent = nama || '-';
            relasiKode.textContent = kode || '-';
            relasiKelompok.textContent = kelompok || '-';
            relasiSekolah.textContent = sekolah || '-';


            guru = Array.isArray(guru) ? guru : [];


            relasiJumlah.textContent =
                `${guru.length} ${guru.length === 1 ? 'Guru' : 'Guru'}`;


            guruList.innerHTML = '';


            if (guru.length === 0) {

                guruList.innerHTML = `
                    <div class="rounded-xl border border-dashed border-slate-300 px-4 py-8 text-center">

                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            <i class="ph ph-users-three text-2xl"></i>
                        </div>

                        <p class="text-sm font-semibold text-slate-600">
                            Belum ada guru
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Belum ada guru yang terhubung dengan mata pelajaran ini.
                        </p>

                    </div>
                `;

            } else {

                guru.forEach(function(namaGuru, index) {

                    const item = document.createElement('div');

                    item.className =
                        'flex items-center gap-3 rounded-xl border border-slate-100 bg-white px-4 py-3 shadow-sm';


                    const nomor = document.createElement('div');

                    nomor.className =
                        'flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-600';

                    nomor.textContent = index + 1;


                    const wrapper = document.createElement('div');

                    wrapper.className = 'min-w-0';


                    const namaElement = document.createElement('p');

                    namaElement.className =
                        'truncate text-sm font-semibold text-slate-700';

                    namaElement.textContent = namaGuru || '-';


                    const jabatan = document.createElement('p');

                    jabatan.className =
                        'text-xs text-slate-400';

                    jabatan.textContent =
                        'Guru Pengajar';


                    wrapper.appendChild(namaElement);
                    wrapper.appendChild(jabatan);

                    item.appendChild(nomor);
                    item.appendChild(wrapper);

                    guruList.appendChild(item);

                });

            }


            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

        }


        function tutupRelasi() {

            const modal = document.getElementById('modalRelasi');


            if (!modal) {
                return;
            }


            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

        }


        /*
        |--------------------------------------------------------------------------
        | KLIK AREA LUAR MODAL
        |--------------------------------------------------------------------------
        */

        const modalRelasi = document.getElementById('modalRelasi');


        if (modalRelasi) {

            modalRelasi.addEventListener('click', function(event) {

                if (event.target === modalRelasi) {

                    tutupRelasi();

                }

            });

        }


        /*
        |--------------------------------------------------------------------------
        | TOMBOL ESC
        |--------------------------------------------------------------------------
        */

        document.addEventListener('keydown', function(event) {

            if (event.key === 'Escape') {

                tutupRelasi();

            }

        });


        /*
        |--------------------------------------------------------------------------
        | JALANKAN FILTER SAAT HALAMAN DIMUAT
        |--------------------------------------------------------------------------
        */

        filterMapel();
    </script>

@endsection
