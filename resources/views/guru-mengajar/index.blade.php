@extends('layouts.app')

@section('content')
    <div class="content">

        <!-- HEADER -->
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Guru Mengajar'],
            ]" />

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2">

                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-chalkboard-teacher text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold">
                                Guru Mengajar
                            </h2>

                            <p class="text-xs text-indigo-100">
                                Kelola penugasan guru pada mata pelajaran dan rombongan belajar.
                            </p>
                        </div>

                    </div>

                    <p class="max-w-2xl text-xs leading-relaxed text-indigo-100">
                        Atur guru pengajar berdasarkan mata pelajaran, rombel,
                        tahun ajaran, dan semester dalam sistem E-Rapor SMK.
                    </p>
                </div>


                <!-- STAT -->
                <div class="rounded-xl border border-white/15 bg-white/10 px-5 py-4 backdrop-blur-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-chalkboard text-lg"></i>
                        </div>

                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-indigo-200">
                                Total Penugasan
                            </p>

                            <p class="text-xl font-bold">
                                {{ $pengajar->count() }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ALERT -->
        @if (session('status'))
            <div
                class="mb-4 flex items-start gap-2 rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-800">
                <i class="ph ph-check-circle mt-0.5 text-base"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif


        @if ($errors->any())
            <div class="mb-4 flex items-start gap-2 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-800">
                <i class="ph ph-warning-circle mt-0.5 text-base"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif


        <!-- FILTER -->
        <div class="mb-6 rounded-xl border border-slate-100 bg-white p-5 shadow-sm">

            <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                        <i class="ph ph-funnel text-indigo-600"></i>
                        Filter Penugasan
                    </div>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Filter berdasarkan guru atau mata pelajaran.
                    </p>
                </div>

                <div id="filterStatus"
                    class="hidden w-fit rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-semibold text-indigo-700">
                    Filter aktif
                </div>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                <!-- GURU -->
                <div>

                    <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Guru Pengajar
                    </label>

                    <div class="relative">

                        <i class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <select id="guruMengajar"
                            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-9 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
                            <option value="">Semua Guru</option>

                            @foreach ($guruList as $guru)
                                <option value="{{ $guru->id }}">
                                    {{ $guru->nama_guru }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>


                <!-- MAPEL -->
                <div>

                    <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Mata Pelajaran
                    </label>

                    <div class="relative">

                        <i class="ph ph-book-open absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <select id="mataPelajaranMengajar"
                            class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-9 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
                            <option value="">Semua Mata Pelajaran</option>

                            @foreach ($mapelList as $mapel)
                                <option value="{{ $mapel->id }}">
                                    {{ $mapel->nama_mata_pelajaran }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>

            </div>


            <div class="mt-4 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">

                <div class="text-xs text-slate-500">
                    Menampilkan
                    <span id="jumlahHasil" class="font-semibold text-slate-700">
                        {{ $pengajar->count() }}
                    </span>
                    penugasan
                </div>


                <button type="button" onclick="resetFilterGuruMengajar()"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-200">
                    <i class="ph ph-arrow-counter-clockwise"></i>
                    Reset Filter
                </button>

            </div>

        </div>


        <!-- TABLE -->
        <x-table-card title="Daftar Guru Mengajar"
            subtitle="Daftar penugasan guru pada mata pelajaran dan rombongan belajar" :items="$pengajar">

            <x-slot name="thead">

                <th class="w-12 px-4 py-3">
                    No
                </th>

                <th class="px-4 py-3">
                    Guru Pengajar
                </th>

                <th class="px-4 py-3">
                    Mata Pelajaran
                </th>

                <th class="px-4 py-3">
                    Rombel
                </th>

                <th class="px-4 py-3">
                    Periode
                </th>

                <th class="min-w-[190px] px-4 py-3 text-center">
                    Aksi
                </th>

            </x-slot>


            @forelse ($pengajar as $item)
                <tr class="guru-mengajar-row transition hover:bg-slate-50" data-guru-id="{{ $item->guru_id ?? '' }}"
                    data-mapel-id="{{ $item->mata_pelajaran_id ?? '' }}"
                    data-guru="{{ strtolower($item->guru?->nama_guru ?? '') }}"
                    data-mapel="{{ strtolower($item->mataPelajaran?->nama_mata_pelajaran ?? '') }}">

                    <!-- NO -->
                    <td class="px-4 py-3 text-xs text-slate-500">
                        {{ $loop->iteration }}
                    </td>


                    <!-- GURU -->
                    <td class="px-4 py-3">

                        <div class="flex items-center gap-2.5">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <i class="ph ph-chalkboard-teacher text-base"></i>
                            </div>

                            <div class="min-w-0">

                                <p class="truncate text-xs font-semibold text-slate-800">
                                    {{ $item->guru?->nama_guru ?? '-' }}
                                </p>

                                @if ($item->guru?->nip)
                                    <p class="text-[10px] text-slate-400">
                                        NIP: {{ $item->guru->nip }}
                                    </p>
                                @else
                                    <p class="text-[10px] text-slate-400">
                                        Guru Pengajar
                                    </p>
                                @endif

                            </div>

                        </div>

                    </td>


                    <!-- MAPEL -->
                    <td class="px-4 py-3">

                        <div>

                            <p class="text-xs font-semibold text-slate-700">
                                {{ $item->mataPelajaran?->nama_mata_pelajaran ?? '-' }}
                            </p>

                            @if ($item->mataPelajaran?->kode_mata_pelajaran)
                                <span
                                    class="mt-1 inline-flex rounded-md bg-slate-100 px-2 py-0.5 text-[9px] font-medium text-slate-500">
                                    {{ $item->mataPelajaran->kode_mata_pelajaran }}
                                </span>
                            @endif

                        </div>

                    </td>


                    <!-- ROMBEL -->
                    <td class="px-4 py-3">

                        <span
                            class="inline-flex items-center gap-1.5 rounded-lg bg-violet-50 px-2.5 py-1.5 text-xs font-semibold text-violet-700">

                            <i class="ph ph-users-three"></i>

                            {{ $item->rombel?->nama_rombel ?? '-' }}

                        </span>

                    </td>


                    <!-- PERIODE -->
                    <td class="px-4 py-3">

                        <div class="space-y-1">

                            <div class="flex items-center gap-1.5 text-xs text-slate-600">

                                <i class="ph ph-calendar-blank text-slate-400"></i>

                                {{ $item->tahun_ajaran ?? '-' }}

                            </div>


                            @if (($item->semester ?? '') === 'Ganjil')
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-0.5 text-[9px] font-semibold text-amber-700">
                                    <i class="ph ph-sun"></i>
                                    Ganjil
                                </span>
                            @elseif (($item->semester ?? '') === 'Genap')
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-sky-50 px-2 py-0.5 text-[9px] font-semibold text-sky-700">
                                    <i class="ph ph-cloud-sun"></i>
                                    Genap
                                </span>
                            @else
                                <span class="text-xs text-slate-400">
                                    -
                                </span>
                            @endif

                        </div>

                    </td>


                    <!-- AKSI -->
                    <td class="px-4 py-3 text-center">

                        <div class="flex flex-wrap items-center justify-center gap-1.5">

                            <a href="{{ route('guru-mengajar.edit', $item->id) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-indigo-700"
                                title="Ganti guru pengajar">
                                <i class="ph ph-user-switch text-base"></i>
                                Ganti Guru
                            </a>


                            <form action="{{ route('guru-mengajar.destroy', $item->id) }}" method="POST"
                                class="inline-block" data-hapus-relasi-form>

                                @csrf
                                @method('DELETE')

                                <button type="submit" data-nama="{{ $item->mataPelajaran?->nama_mata_pelajaran ?? '-' }}"
                                    class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-red-600"
                                    title="Lepas relasi guru mengajar">
                                    <i class="ph ph-link-break text-base"></i>
                                    Lepas
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>


            @empty

                <tr>

                    <td colspan="6" class="px-4 py-8 text-center">

                        <div class="flex flex-col items-center justify-center">

                            <div
                                class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="ph ph-chalkboard-teacher text-2xl"></i>
                            </div>

                            <p class="text-sm font-semibold text-slate-600">
                                Belum ada penugasan guru mengajar
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Penugasan guru mengajar dapat dibuat melalui data Mata Pelajaran.
                            </p>

                        </div>

                    </td>

                </tr>
            @endforelse

        </x-table-card>

    </div>


    <script>
        const guruMengajar = document.getElementById('guruMengajar');
        const mataPelajaranMengajar = document.getElementById('mataPelajaranMengajar');

        function filterGuruMengajar() {

            const guruId = guruMengajar.value;
            const mapelId = mataPelajaranMengajar.value;

            const rows = document.querySelectorAll('.guru-mengajar-row');

            let jumlahHasil = 0;

            rows.forEach(function(row) {

                const rowGuruId = row.dataset.guruId || '';
                const rowMapelId = row.dataset.mapelId || '';

                const cocokGuru =
                    guruId === '' ||
                    rowGuruId === guruId;

                const cocokMapel =
                    mapelId === '' ||
                    rowMapelId === mapelId;

                const tampil =
                    cocokGuru &&
                    cocokMapel;

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
                guruId !== '' ||
                mapelId !== '';

            if (filterStatus) {
                filterStatus.classList.toggle('hidden', !filterAktif);
            }

        }


        guruMengajar.addEventListener('change', filterGuruMengajar);
        mataPelajaranMengajar.addEventListener('change', filterGuruMengajar);


        function resetFilterGuruMengajar() {

            guruMengajar.value = '';
            mataPelajaranMengajar.value = '';

            filterGuruMengajar();

        }


        document.querySelectorAll('form[data-hapus-relasi-form]').forEach(function(form) {

            form.addEventListener('submit', function(event) {

                const button = form.querySelector('button[data-nama]');
                const nama = button ? button.dataset.nama : 'mata pelajaran ini';

                const yakin = confirm(
                    'Lepas relasi guru mengajar untuk "' +
                    nama +
                    '"?\n\n' +
                    'Mata Pelajaran tidak akan dihapus, hanya penugasan gurunya yang dibatalkan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }

            });

        });


        filterGuruMengajar();
    </script>
@endsection
