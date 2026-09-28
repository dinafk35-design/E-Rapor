@extends('layouts.app')

@section('content')

<form
    method="POST"
    action="{{ route('input-nilai.store') }}"
    id="formNilai"
>

    @csrf

    <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
    <input type="hidden" name="semester" value="{{ $semester }}">
    <input type="hidden" name="rombel_id" value="{{ $rombelId }}">

    <div class="min-h-screen bg-gray-100 p-6">

        @if (session('status'))

            <div class="mb-4 rounded-lg border border-green-300 bg-green-50 p-4 text-sm text-green-800">
                <i class="ph ph-check-circle mr-1"></i>
                {{ session('status') }}
            </div>

        @endif

        @if ($errors->any())

            <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800">
                <i class="ph ph-warning-circle mr-1"></i>
                {{ $errors->first() }}
            </div>

        @endif

        <!-- Header -->
        <div class="mb-6">

            <h1 class="text-2xl font-bold text-gray-800">
                Input Nilai Siswa
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola nilai siswa berdasarkan tahun ajaran, kelas, dan mata pelajaran.
            </p>

        </div>


        <!-- Filter & Pencarian -->
        <form
            method="GET"
            action="{{ route('input-nilai') }}"
            class="mb-6 rounded-xl bg-white p-6 shadow-sm">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                <!-- Tahun Ajaran -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Tahun Ajaran
                    </label>

                    <select
                        name="tahun_ajaran"
                        onchange="this.form.submit()"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="2025/2026" @selected($tahunAjaran === '2025/2026')>
                            2025/2026
                        </option>

                        <option value="2026/2027" @selected($tahunAjaran === '2026/2027')>
                            2026/2027
                        </option>

                    </select>

                </div>


                <!-- Semester -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Semester
                    </label>

                    <select
                        name="semester"
                        onchange="this.form.submit()"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="Ganjil" @selected($semester === 'Ganjil')>
                            Ganjil
                        </option>

                        <option value="Genap" @selected($semester === 'Genap')>
                            Genap
                        </option>

                    </select>

                </div>


                <!-- Kelas -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Kelas
                    </label>

                    <select
                        name="rombel_id"
                        onchange="this.form.submit()"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="">Semua Kelas</option>

                        @foreach ($rombel as $item)
                            <option value="{{ $item->id }}" @selected((string) $rombelId === (string) $item->id)>
                                {{ $item->nama_rombel }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <!-- Mata Pelajaran -->
                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Mata Pelajaran
                    </label>

                    <select
                        name="filter_mata_pelajaran"
                        onchange="this.form.submit()"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="">Semua Mata Pelajaran</option>

                        @foreach ($mataPelajaran as $item)
                            <option value="{{ $item->id }}" @selected((string) request('filter_mata_pelajaran') === (string) $item->id)>
                                {{ $item->nama_mata_pelajaran }}
                            </option>
                        @endforeach

                    </select>

                </div>

            </div>

        </form>


        <!-- Tabel Nilai -->
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">

            <!-- Header tabel -->
            <div class="border-b border-gray-200 px-6 py-4">

                <h2 class="text-lg font-bold text-gray-800">
                    Daftar Nilai Siswa
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Setiap siswa dapat memiliki beberapa mata pelajaran dan nilai.
                </p>

            </div>


            <!-- Responsive Table -->
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1100px] text-left text-sm">

                    <thead class="bg-gray-50 text-xs uppercase text-gray-600">

                        <tr>

                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">NISN</th>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">Kelas</th>
                            <th class="px-6 py-4">Nilai</th>
                            <th class="px-6 py-4 text-center">Periode</th>
                            <th class="px-6 py-4 text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse ($siswa as $item)

                            <tr
                                class="nilai-row transition hover:bg-gray-50"
                                data-row="{{ $item->id }}">

                                <td class="px-6 py-5">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-5">
                                    {{ $item->nisn ?? '-' }}
                                </td>

                                <td class="px-6 py-5">

                                    <div class="font-semibold text-gray-800">
                                        {{ $item->nama_siswa }}
                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                        {{ $item->rombel?->nama_rombel ?? '-' }}
                                    </span>

                                </td>

                                <td class="px-6 py-5">

                                    <div class="space-y-2" id="daftar-nilai-{{ $item->id }}">

                                        @forelse ($mataPelajaran as $mapel)

                                            @php
                                                $kunci = $item->id . '-' . $mapel->id;
                                                $nilai = $nilaiTersimpan[$kunci] ?? null;
                                            @endphp

                                            <div class="flex items-center justify-between gap-6">

                                                <span>
                                                    {{ $mapel->nama_mata_pelajaran }}
                                                </span>

                                                <div class="nilai-container">

                                                    <span
                                                        class="nilai-text font-bold {{ $nilai !== null ? 'text-green-600' : 'text-gray-400' }}">
                                                        {{ $nilai !== null ? rtrim(rtrim(number_format((float) $nilai, 2, '.', ''), '0'), '.') : '-' }}
                                                    </span>

                                                    <input
                                                        type="number"
                                                        min="0"
                                                        max="100"
                                                        step="0.01"
                                                        name="nilai[{{ $item->id }}][{{ $mapel->id }}]"
                                                        value="{{ $nilai !== null ? rtrim(rtrim(number_format((float) $nilai, 2, '.', ''), '0'), '.') : '' }}"
                                                        class="nilai-input hidden w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                                </div>

                                            </div>

                                        @empty

                                            <span class="text-xs text-gray-400">
                                                Belum ada mata pelajaran.
                                            </span>

                                        @endforelse

                                    </div>


                                    <!-- TAMBAH NILAI BARU UNTUK SISWA INI -->

                                    <button
                                        type="button"
                                        data-siswa="{{ $item->id }}"
                                        onclick="tambahNilaiBaris(this)"
                                        class="mt-3 rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">

                                        <i class="ph ph-plus"></i> Tambah Nilai

                                    </button>

                                </td>

                                <td class="px-6 py-5 text-center">
                                    {{ $tahunAjaran }} / {{ $semester }}
                                </td>

                                <td class="px-6 py-5 text-center">

                                    <div class="flex items-center justify-center gap-2">

                                        <button
                                            type="button"
                                            onclick="editNilai(this)"
                                            class="edit-btn rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-yellow-600">

                                            <i class="ph ph-pencil-simple"></i> Edit

                                        </button>

                                        <button
                                            type="button"
                                            onclick="simpanNilai(this)"
                                            class="save-btn hidden rounded-lg bg-green-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-green-700">

                                            <i class="ph ph-floppy-disk"></i> Simpan

                                        </button>

                                        <button
                                            type="button"
                                            onclick="batalEdit(this)"
                                            class="cancel-btn hidden rounded-lg bg-gray-500 px-4 py-2 text-xs font-semibold text-white transition hover:bg-gray-600">

                                            <i class="ph ph-x"></i> Batal

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada data siswa. Tambahkan data siswa terlebih dahulu.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <!-- Tombol Simpan -->
        <div class="mt-6 flex justify-end gap-3">

            <a
                href="{{ route('input-nilai') }}"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                Refresh
            </a>

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                <i class="ph ph-floppy-disk mr-1"></i> Simpan Nilai

            </button>

        </div>

    </div>

</form>


<!-- ========================================================= -->

<!-- DATA MATA PELAJARAN (untuk tombol tambah nilai) -->

<!-- ========================================================= -->

<script>

    const daftarMataPelajaran = @json(
        $mataPelajaran->pluck('nama_mata_pelajaran', 'id')
    );

</script>


<!-- ========================================================= -->

<!-- JAVASCRIPT EDIT NILAI -->

<!-- ========================================================= -->

<script>

    /*
    |--------------------------------------------------------------------------
    | Tombol EDIT
    |--------------------------------------------------------------------------
    */

    function editNilai(button) {

        const row = button.closest('.nilai-row');

        row.querySelectorAll('.nilai-input').forEach(function (input) {

            input.classList.remove('hidden');

        });

        row.querySelectorAll('.nilai-text').forEach(function (teks) {

            teks.classList.add('hidden');

        });

        button.classList.add('hidden');

        row.querySelector('.save-btn').classList.remove('hidden');

        row.querySelector('.cancel-btn').classList.remove('hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | Tombol SIMPAN (per baris)
    |--------------------------------------------------------------------------
    */

    function simpanNilai(button) {

        // Perbarui tampilan teks di baris tersebut

        const row = button.closest('.nilai-row');

        row.querySelectorAll('.nilai-container').forEach(function (container) {

            const input = container.querySelector('.nilai-input');

            const teks = container.querySelector('.nilai-text');

            teks.textContent = input.value === '' ? '-' : input.value;

            teks.classList.remove('hidden');

            teks.classList.add('text-green-600');

            input.classList.add('hidden');

        });

        button.classList.add('hidden');

        row.querySelector('.edit-btn').classList.remove('hidden');

        row.querySelector('.cancel-btn').classList.add('hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | Tombol BATAL
    |--------------------------------------------------------------------------
    */

    function batalEdit(button) {

        const row = button.closest('.nilai-row');

        row.querySelectorAll('.nilai-container').forEach(function (container) {

            container.querySelector('.nilai-input').classList.add('hidden');

            container.querySelector('.nilai-text').classList.remove('hidden');

        });

        button.classList.add('hidden');

        row.querySelector('.edit-btn').classList.remove('hidden');

        row.querySelector('.save-btn').classList.add('hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH NILAI UNTUK SATU SISWA
    |--------------------------------------------------------------------------
    |
    | Menambah satu baris nilai baru pada siswa yang dipilih, lengkap dengan
    | pilihan mata pelajaran. Baris ini ikut tersimpan seperti nilai lainnya.
    |
    */

    function tambahNilaiBaris(button) {

        const idSiswa = button.dataset.siswa;

        const wrapper = document.getElementById('daftar-nilai-' + idSiswa);

        if (!wrapper) {
            return;
        }


        // Longitudinal id agar tidak bentrok dengan baris sebelumnya

        const baris = document.createElement('div');

        baris.className = 'flex items-center justify-between gap-6';
        baris.setAttribute('data-tambahan', '1');


        // Opsi mata pelajaran

        let opsi = '<option value="">-- Pilih Mata Pelajaran --</option>';

        Object.entries(daftarMataPelajaran).forEach(function ([id, nama]) {

            opsi += '<option value="' + id + '">' + nama + '</option>';

        });

        baris.innerHTML = `

            <select
                onchange="gantiNamaInputNilai(this)"
                class="w-48 rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                ${opsi}
            </select>

            <input
                type="number"
                min="0"
                max="100"
                step="0.01"
                disabled
                class="nilai-input w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

            <button
                type="button"
                onclick="hapusNilaiBaris(this)"
                class="rounded-lg bg-red-500 px-2 py-1.5 text-xs font-semibold text-white transition hover:bg-red-600">

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

        button.closest('[data-tambahan]').remove();

    }


    /*
    |--------------------------------------------------------------------------
    | SESUAIKAN NAME INPUT DENGAN MATA PELAJARAN DIPILIH
    |--------------------------------------------------------------------------
    |
    | Input baru disimpan sebagai nilai[<id siswa>][<id mata pelajaran>],
    | sama dengan format nilai bawaan agar langsung diproses server.
    |
    */

    function gantiNamaInputNilai(select) {

        const baris = select.closest('[data-tambahan]');

        const input = baris.querySelector('.nilai-input');

        const idSiswa = select.closest('.nilai-row').dataset.row;

        if (select.value === '') {

            input.removeAttribute('name');

            input.disabled = true;

            return;
        }

        input.name = 'nilai[' + idSiswa + '][' + select.value + ']';

        input.disabled = false;

    }

</script>


@endsection
