@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- HEADER --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Rombel'],
            ]" />

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-users-three text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold">
                                Data Rombel
                            </h2>

                            <p class="text-xs text-indigo-100">
                                Kelola rombongan belajar dan anggota siswa dalam sistem E-Rapor SMK.
                            </p>
                        </div>
                    </div>

                    <p class="max-w-2xl text-xs leading-relaxed text-indigo-100">
                        Atur kelas, tingkat pendidikan, sekolah, wali kelas, serta daftar siswa
                        yang tergabung dalam setiap rombongan belajar.
                    </p>
                </div>

                <div class="rounded-xl border border-white/10 bg-white/10 px-5 py-4 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-users text-xl"></i>
                        </div>

                        <div>
                            <p class="text-[10px] font-medium uppercase tracking-wide text-indigo-200">
                                Total Rombel
                            </p>

                            <p class="text-2xl font-bold">
                                {{ $rombel->count() }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        {{-- ALERT STATUS --}}
        @if (session('status'))
            <div
                class="mb-5 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                <i class="ph ph-check-circle mt-0.5 text-lg"></i>

                <div>
                    <p class="font-semibold">Berhasil</p>
                    <p class="text-xs text-green-700">
                        {{ session('status') }}
                    </p>
                </div>
            </div>
        @endif


        @if ($errors->any())
            <div
                class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <i class="ph ph-warning-circle mt-0.5 text-lg"></i>

                <div>
                    <p class="font-semibold">Terjadi kesalahan</p>
                    <p class="text-xs text-red-700">
                        {{ $errors->first() }}
                    </p>
                </div>
            </div>
        @endif


        {{-- FILTER --}}
        <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="flex items-center gap-2">
                        <i class="ph ph-funnel text-lg text-indigo-600"></i>

                        <h3 class="text-sm font-bold text-slate-800">
                            Filter Data Rombel
                        </h3>
                    </div>

                    <p class="mt-1 text-xs text-slate-500">
                        Gunakan pencarian atau filter untuk menemukan rombel dengan cepat.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span id="filterStatus"
                        class="hidden rounded-full bg-indigo-50 px-2.5 py-1 text-[10px] font-semibold text-indigo-700">
                        Filter aktif
                    </span>

                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-semibold text-slate-600">
                        <span id="jumlahHasil">{{ $rombel->count() }}</span> data
                    </span>
                </div>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                {{-- PENCARIAN --}}
                <div>
                    <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                        <i class="ph ph-magnifying-glass text-indigo-500"></i>
                        Pencarian
                    </label>

                    <input type="text" id="searchRombel"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        placeholder="Nama rombel...">
                </div>


                {{-- TINGKAT --}}
                <div>
                    <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                        <i class="ph ph-stairs text-indigo-500"></i>
                        Tingkat
                    </label>

                    <select id="tingkatRombel"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="">Semua Tingkat</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>


                {{-- SEKOLAH --}}
                <div>
                    <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                        <i class="ph ph-buildings text-indigo-500"></i>
                        Sekolah
                    </label>

                    <select id="sekolahRombel"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="">Semua Sekolah</option>

                        @foreach ($sekolahList ?? [] as $sekolah)
                            <option value="{{ $sekolah->id }}">
                                {{ $sekolah->nama_sekolah }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- WALI KELAS --}}
                <div>
                    <label class="mb-2 flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                        <i class="ph ph-chalkboard-teacher text-indigo-500"></i>
                        Wali Kelas
                    </label>

                    <select id="waliRombel"
                        class="w-full rounded-lg border border-slate-300 px-3.5 py-2.5 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                        <option value="">Semua Wali Kelas</option>

                        @foreach ($guruList ?? [] as $guru)
                            <option value="{{ $guru->id }}">
                                {{ $guru->nama_guru }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>


            <div class="mt-4 flex justify-end">
                <button type="button" onclick="resetFilterRombel()"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-3.5 py-2 text-xs font-semibold text-slate-600 transition hover:border-slate-400 hover:bg-slate-50">
                    <i class="ph ph-arrow-counter-clockwise"></i>
                    Reset Filter
                </button>
            </div>

        </div>


        {{-- TABLE --}}
        <x-table-card title="Daftar Rombel" subtitle="Daftar rombongan belajar beserta wali kelas dan jumlah anggota siswa."
            createRoute="{{ route('rombel.create') }}" :items="$rombel">

            <x-slot name="thead">
                <th class="w-12 px-4 py-3">No</th>
                <th class="px-4 py-3">Rombel</th>
                <th class="px-4 py-3">Tingkat</th>
                <th class="px-4 py-3">Sekolah</th>
                <th class="px-4 py-3">Wali Kelas</th>
                <th class="px-4 py-3 text-center">Anggota</th>
                <th class="min-w-[220px] px-4 py-3 text-center">Aksi</th>
            </x-slot>


            @forelse ($rombel as $item)
                <tr class="rombel-row transition hover:bg-slate-50" data-nama="{{ strtolower($item->nama_rombel ?? '') }}"
                    data-tingkat="{{ $item->tingkat ?? '' }}" data-sekolah="{{ $item->sekolah_id ?? '' }}"
                    data-wali="{{ $item->wali_kelas_id ?? '' }}">

                    {{-- NO --}}
                    <td class="px-4 py-3 text-xs text-slate-500">
                        {{ $loop->iteration }}
                    </td>


                    {{-- ROMBEL --}}
                    <td class="px-4 py-3">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <i class="ph ph-users-three text-lg"></i>
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ $item->nama_rombel }}
                                </p>

                                <p class="text-[10px] text-slate-400">
                                    Rombongan belajar
                                </p>
                            </div>

                        </div>

                    </td>


                    {{-- TINGKAT --}}
                    <td class="px-4 py-3">

                        @if ($item->tingkat)
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[10px] font-bold text-indigo-700">
                                <i class="ph ph-stairs"></i>
                                Tingkat {{ $item->tingkat }}
                            </span>
                        @else
                            <span class="text-xs text-slate-400">-</span>
                        @endif

                    </td>


                    {{-- SEKOLAH --}}
                    <td class="px-4 py-3">

                        <div class="flex items-center gap-1.5 text-xs text-slate-600">
                            <i class="ph ph-buildings text-slate-400"></i>

                            {{ $item->sekolah?->nama_sekolah ?? '-' }}
                        </div>

                    </td>


                    {{-- WALI --}}
                    <td class="px-4 py-3">

                        @if ($item->wali)
                            <div class="flex items-center gap-2">

                                <div
                                    class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-100 text-slate-600">
                                    <i class="ph ph-user text-sm"></i>
                                </div>

                                <span class="text-xs font-medium text-slate-700">
                                    {{ $item->wali->nama_guru }}
                                </span>

                            </div>
                        @else
                            <span class="text-xs text-slate-400">
                                Belum ditentukan
                            </span>
                        @endif

                    </td>


                    {{-- ANGGOTA --}}
                    <td class="px-4 py-3 text-center">

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-[10px] font-bold text-emerald-700">
                            <i class="ph ph-student"></i>
                            {{ $item->anggota_count }} Siswa
                        </span>

                    </td>


                    {{-- AKSI --}}
                    <td class="px-4 py-3 text-center">

                        <div class="flex flex-wrap items-center justify-center gap-1.5">

                            <a href="{{ route('rombel.show', $item->id) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-indigo-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-indigo-600"
                                title="Lihat detail rombel">
                                <i class="ph ph-eye"></i>
                                Detail
                            </a>


                            <a href="{{ route('rombel.edit', $item->id) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-amber-600"
                                title="Ubah data rombel">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </a>


                            <form action="{{ route('rombel.destroy', $item->id) }}" method="POST" class="inline-block"
                                data-hapus-form>
                                @csrf
                                @method('DELETE')

                                <button type="submit" data-nama="{{ $item->nama_rombel }}"
                                    class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-red-600"
                                    title="Hapus data rombel">
                                    <i class="ph ph-trash"></i>
                                    Hapus
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="px-4 py-10 text-center">

                        <div class="flex flex-col items-center justify-center">

                            <div
                                class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="ph ph-users-three text-2xl"></i>
                            </div>

                            <p class="text-sm font-semibold text-slate-600">
                                Belum ada data rombel
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Tambahkan rombongan belajar untuk mulai mengelola anggota siswa.
                            </p>

                        </div>

                    </td>
                </tr>
            @endforelse

        </x-table-card>

    </div>


    <script>
        const searchRombel = document.getElementById('searchRombel');
        const tingkatRombel = document.getElementById('tingkatRombel');
        const sekolahRombel = document.getElementById('sekolahRombel');
        const waliRombel = document.getElementById('waliRombel');

        function filterRombel() {

            const search = searchRombel.value.toLowerCase().trim();
            const tingkat = tingkatRombel.value;
            const sekolah = sekolahRombel.value;
            const wali = waliRombel.value;

            const rows = document.querySelectorAll('.rombel-row');

            let jumlahHasil = 0;

            rows.forEach(function(row) {

                const nama = row.dataset.nama || '';
                const rowTingkat = row.dataset.tingkat || '';
                const rowSekolah = row.dataset.sekolah || '';
                const rowWali = row.dataset.wali || '';

                const cocokSearch =
                    search === '' ||
                    nama.includes(search);

                const cocokTingkat =
                    tingkat === '' ||
                    rowTingkat === tingkat;

                const cocokSekolah =
                    sekolah === '' ||
                    rowSekolah === sekolah;

                const cocokWali =
                    wali === '' ||
                    rowWali === wali;

                const tampil =
                    cocokSearch &&
                    cocokTingkat &&
                    cocokSekolah &&
                    cocokWali;

                row.style.display = tampil ? '' : 'none';

                if (tampil) {
                    jumlahHasil++;
                }

            });


            const jumlahHasilElement = document.getElementById('jumlahHasil');

            if (jumlahHasilElement) {
                jumlahHasilElement.textContent = jumlahHasil;
            }


            const filterStatus = document.getElementById('filterStatus');

            const filterAktif =
                search !== '' ||
                tingkat !== '' ||
                sekolah !== '' ||
                wali !== '';

            if (filterStatus) {
                filterStatus.classList.toggle('hidden', !filterAktif);
            }

        }


        searchRombel.addEventListener('input', filterRombel);
        tingkatRombel.addEventListener('change', filterRombel);
        sekolahRombel.addEventListener('change', filterRombel);
        waliRombel.addEventListener('change', filterRombel);


        function resetFilterRombel() {

            searchRombel.value = '';
            tingkatRombel.value = '';
            sekolahRombel.value = '';
            waliRombel.value = '';

            filterRombel();

        }


        document.querySelectorAll('form[data-hapus-form]').forEach(function(form) {

            form.addEventListener('submit', function(event) {

                const button = form.querySelector('button[data-nama]');
                const nama = button ? button.dataset.nama : 'rombel ini';

                const yakin = confirm(
                    'Yakin ingin menghapus rombel "' +
                    nama +
                    '"?\n\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }

            });

        });


        filterRombel();
    </script>
@endsection
