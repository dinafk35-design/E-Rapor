@extends('layouts.app')

@section('content')
    <div class="content">

        <!-- HEADER -->
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Wali Kelas'],
            ]" />

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <div class="mb-2 flex items-center gap-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-user-circle-gear text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-xl font-bold">
                                Data Wali Kelas
                            </h2>

                            <p class="text-xs text-indigo-100">
                                Kelola penugasan guru sebagai wali kelas pada setiap rombongan belajar.
                            </p>
                        </div>
                    </div>

                    <p class="max-w-2xl text-xs leading-relaxed text-indigo-100">
                        Atur guru yang bertanggung jawab terhadap masing-masing rombel,
                        lengkap dengan tahun ajaran dan semester penugasannya.
                    </p>
                </div>

                <div class="rounded-xl border border-white/15 bg-white/10 px-5 py-4 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/15">
                            <i class="ph ph-users-three text-lg"></i>
                        </div>

                        <div>
                            <p class="text-[10px] uppercase tracking-wider text-indigo-200">
                                Total Penugasan
                            </p>

                            <p class="text-xl font-bold">
                                {{ $waliKelas->count() }}
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
                        Filter Data Wali Kelas
                    </div>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Gunakan filter untuk menemukan penugasan wali kelas dengan cepat.
                    </p>
                </div>

                <div id="filterStatus"
                    class="hidden w-fit rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-semibold text-indigo-700">
                    Filter aktif
                </div>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                <!-- PENCARIAN -->
                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Pencarian
                    </label>

                    <div class="relative">
                        <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" id="searchWaliKelas"
                            class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-9 pr-3 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                            placeholder="Cari nama guru atau rombel...">
                    </div>
                </div>


                <!-- ROMBEL -->
                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Rombel
                    </label>

                    <select id="rombelWaliKelas"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
                        <option value="">Semua Rombel</option>

                        @foreach ($rombelList ?? [] as $rombel)
                            <option value="{{ $rombel->id }}">
                                {{ $rombel->nama_rombel }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- TAHUN AJARAN -->
                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Tahun Ajaran
                    </label>

                    <select id="tahunAjaranWaliKelas"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
                        <option value="">Semua Tahun Ajaran</option>
                        <option value="2025/2026">2025/2026</option>
                        <option value="2026/2027">2026/2027</option>
                        <option value="2027/2028">2027/2028</option>
                    </select>
                </div>


                <!-- SEMESTER -->
                <div>
                    <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                        Semester
                    </label>

                    <select id="semesterWaliKelas"
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">
                        <option value="">Semua Semester</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>

            </div>


            <div class="mt-4 flex items-center justify-between gap-3 border-t border-slate-100 pt-4">

                <div class="text-xs text-slate-500">
                    Menampilkan
                    <span id="jumlahHasil" class="font-semibold text-slate-700">
                        {{ $waliKelas->count() }}
                    </span>
                    penugasan
                </div>

                <button type="button" onclick="resetFilterWaliKelas()"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-200">
                    <i class="ph ph-arrow-counter-clockwise"></i>
                    Reset Filter
                </button>

            </div>

        </div>


        <!-- TABLE -->
        <x-table-card title="Data Wali Kelas"
            subtitle="Daftar guru yang ditugaskan sebagai wali kelas pada rombongan belajar"
            createRoute="{{ route('wali-kelas.create') }}" :items="$waliKelas">

            <x-slot name="thead">
                <th class="w-12 px-4 py-3">No</th>
                <th class="px-4 py-3">Guru</th>
                <th class="px-4 py-3">Rombel</th>
                <th class="px-4 py-3">Tahun Ajaran</th>
                <th class="px-4 py-3">Semester</th>
                <th class="px-4 py-3 text-center">Status</th>
                <th class="min-w-[160px] px-4 py-3 text-center">Aksi</th>
            </x-slot>


            @forelse ($waliKelas as $item)
                <tr class="wali-kelas-row transition hover:bg-slate-50"
                    data-guru="{{ strtolower($item->guru?->nama_guru ?? '') }}"
                    data-rombel="{{ strtolower($item->rombel?->nama_rombel ?? '') }}"
                    data-rombel-id="{{ $item->rombel_id ?? '' }}" data-tahun="{{ $item->tahun_ajaran ?? '' }}"
                    data-semester="{{ $item->semester ?? '' }}">

                    <td class="px-4 py-3 text-xs text-slate-500">
                        {{ $loop->iteration }}
                    </td>


                    <!-- GURU -->
                    <td class="px-4 py-3">

                        <div class="flex items-center gap-2.5">

                            <div
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                <i class="ph ph-user text-base"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-xs font-semibold text-slate-800">
                                    {{ $item->guru?->nama_guru ?? '-' }}
                                </p>

                                <p class="text-[10px] text-slate-400">
                                    Guru / Wali Kelas
                                </p>
                            </div>

                        </div>

                    </td>


                    <!-- ROMBEL -->
                    <td class="px-4 py-3">

                        <span
                            class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-semibold text-slate-700">
                            <i class="ph ph-users-three text-indigo-500"></i>
                            {{ $item->rombel?->nama_rombel ?? '-' }}
                        </span>

                    </td>


                    <!-- TAHUN -->
                    <td class="px-4 py-3">

                        <div class="flex items-center gap-1.5 text-xs text-slate-600">
                            <i class="ph ph-calendar-blank text-slate-400"></i>
                            {{ $item->tahun_ajaran ?? '-' }}
                        </div>

                    </td>


                    <!-- SEMESTER -->
                    <td class="px-4 py-3">

                        @if (($item->semester ?? '') === 'Ganjil')
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-semibold text-amber-700">
                                <i class="ph ph-sun"></i>
                                Ganjil
                            </span>
                        @elseif (($item->semester ?? '') === 'Genap')
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-sky-50 px-2.5 py-1 text-[10px] font-semibold text-sky-700">
                                <i class="ph ph-cloud-sun"></i>
                                Genap
                            </span>
                        @else
                            <span class="text-xs text-slate-400">-</span>
                        @endif

                    </td>


                    <!-- STATUS -->
                    <td class="px-4 py-3 text-center">

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-semibold text-emerald-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Aktif
                        </span>

                    </td>


                    <!-- AKSI -->
                    <td class="px-4 py-3 text-center">

                        <div class="flex flex-wrap items-center justify-center gap-1.5">

                            <a href="{{ route('wali-kelas.edit', $item->id) }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-amber-600"
                                title="Ubah data wali kelas">
                                <i class="ph ph-pencil-simple text-base"></i>
                                Edit
                            </a>


                            <form action="{{ route('wali-kelas.destroy', $item->id) }}" method="POST"
                                class="inline-block" data-hapus-form>
                                @csrf
                                @method('DELETE')

                                <button type="submit" data-nama="{{ $item->guru?->nama_guru ?? 'Wali Kelas' }}"
                                    class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-red-600"
                                    title="Hapus data wali kelas">
                                    <i class="ph ph-trash text-base"></i>
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="px-4 py-8 text-center">

                        <div class="flex flex-col items-center justify-center">

                            <div
                                class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="ph ph-user-circle-gear text-2xl"></i>
                            </div>

                            <p class="text-sm font-semibold text-slate-600">
                                Belum ada data wali kelas
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Tambahkan penugasan guru sebagai wali kelas untuk mulai mengelola data.
                            </p>

                        </div>

                    </td>
                </tr>
            @endforelse

        </x-table-card>

    </div>


    <script>
        const searchWaliKelas = document.getElementById('searchWaliKelas');
        const rombelWaliKelas = document.getElementById('rombelWaliKelas');
        const tahunAjaranWaliKelas = document.getElementById('tahunAjaranWaliKelas');
        const semesterWaliKelas = document.getElementById('semesterWaliKelas');

        function filterWaliKelas() {

            const search = searchWaliKelas.value.toLowerCase().trim();
            const rombel = rombelWaliKelas.value;
            const tahunAjaran = tahunAjaranWaliKelas.value;
            const semester = semesterWaliKelas.value;

            const rows = document.querySelectorAll('.wali-kelas-row');

            let jumlahHasil = 0;

            rows.forEach(function(row) {

                const guru = row.dataset.guru || '';
                const namaRombel = row.dataset.rombel || '';
                const rombelId = row.dataset.rombelId || '';
                const tahun = row.dataset.tahun || '';
                const semesterData = row.dataset.semester || '';

                const cocokSearch =
                    search === '' ||
                    guru.includes(search) ||
                    namaRombel.includes(search);

                const cocokRombel =
                    rombel === '' ||
                    rombelId === rombel;

                const cocokTahun =
                    tahunAjaran === '' ||
                    tahun === tahunAjaran;

                const cocokSemester =
                    semester === '' ||
                    semesterData === semester;

                const tampil =
                    cocokSearch &&
                    cocokRombel &&
                    cocokTahun &&
                    cocokSemester;

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
                rombel !== '' ||
                tahunAjaran !== '' ||
                semester !== '';

            if (filterStatus) {
                filterStatus.classList.toggle('hidden', !filterAktif);
            }

        }


        searchWaliKelas.addEventListener('input', filterWaliKelas);
        rombelWaliKelas.addEventListener('change', filterWaliKelas);
        tahunAjaranWaliKelas.addEventListener('change', filterWaliKelas);
        semesterWaliKelas.addEventListener('change', filterWaliKelas);


        function resetFilterWaliKelas() {

            searchWaliKelas.value = '';
            rombelWaliKelas.value = '';
            tahunAjaranWaliKelas.value = '';
            semesterWaliKelas.value = '';

            filterWaliKelas();

        }


        document.querySelectorAll('form[data-hapus-form]').forEach(function(form) {

            form.addEventListener('submit', function(event) {

                const button = form.querySelector('button[data-nama]');
                const nama = button ? button.dataset.nama : 'wali kelas ini';

                const yakin = confirm(
                    'Yakin ingin menghapus penugasan wali kelas untuk "' +
                    nama +
                    '"?\n\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }

            });

        });


        filterWaliKelas();
    </script>
@endsection
