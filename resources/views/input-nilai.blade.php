@extends('layouts.app')

@section('content')

{{--
    Form simpan nilai berdiri sendiri di luar tabel. Input nilai pada tabel
    diikat lewat atribut form="formNilai" agar tidak ada <form> bersarang,
    sehingga form filter dan form hapus tetap bisa bekerja normal.
--}}

<form
    method="POST"
    action="{{ route('input-nilai.store') }}"
    id="formNilai"
>

    @csrf

    <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
    <input type="hidden" name="semester" value="{{ $semester }}">
    <input type="hidden" name="rombel_id" value="{{ $rombelId }}">

</form>

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
                                                        form="formNilai"
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

                                    <div class="flex flex-wrap items-center justify-center gap-1.5">

                                        <button
                                            type="button"
                                            onclick="lihatDetailNilai({{ $item->id }})"
                                            class="inline-flex items-center gap-1 rounded-lg bg-blue-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-600"
                                            title="Lihat rincian nilai">

                                            <i class="ph ph-eye text-sm"></i> Detail

                                        </button>

                                        <button
                                            type="button"
                                            onclick="editNilai(this)"
                                            class="edit-btn inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">

                                            <i class="ph ph-pencil-simple text-sm"></i> Edit

                                        </button>

                                        <button
                                            type="button"
                                            onclick="simpanNilai(this)"
                                            style="display:none"
                                            class="save-btn inline-flex items-center gap-1 rounded-lg bg-green-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-green-700">

                                            <i class="ph ph-floppy-disk text-sm"></i> Simpan

                                        </button>

                                        <button
                                            type="button"
                                            onclick="batalEdit(this)"
                                            style="display:none"
                                            class="cancel-btn inline-flex items-center gap-1 rounded-lg bg-gray-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-gray-600">

                                            <i class="ph ph-x text-sm"></i> Batal

                                        </button>

                                        <form
                                            action="{{ route('input-nilai.destroy', $item->id) }}"
                                            method="POST"
                                            class="inline-block"
                                            data-hapus-form>

                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
                                            <input type="hidden" name="semester" value="{{ $semester }}">
                                            <input type="hidden" name="rombel_id" value="{{ $rombelId }}">

                                            <button
                                                type="submit"
                                                data-nama="{{ $item->nama_siswa }}"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-600"
                                                title="Hapus semua nilai siswa ini pada periode ini">

                                                <i class="ph ph-trash text-sm"></i> Hapus

                                            </button>

                                        </form>

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
                form="formNilai"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                <i class="ph ph-floppy-disk mr-1"></i> Simpan Nilai

            </button>

        </div>

    </div>


<!-- ========================================================= -->

<!-- MODAL DETAIL NILAI -->

<!-- ========================================================= -->

<div id="modalDetail"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50 p-4"
    onclick="if (event.target === this) { tutupDetailNilai(); }">

    <div class="flex max-h-[85vh] w-full max-w-2xl flex-col overflow-hidden rounded-xl bg-white shadow-xl">

        <!-- Header modal -->
        <div class="flex items-start justify-between gap-4 border-b border-gray-200 px-6 py-4">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Rincian Nilai Siswa</h3>
                <p class="mt-1 text-sm text-gray-500">
                    <span id="detailNama" class="font-semibold text-gray-700"></span>
                    <span class="text-gray-400"> &bull; </span>
                    NISN <span id="detailNisn"></span>
                    <span class="text-gray-400"> &bull; </span>
                    <span id="detailKelas"></span>
                </p>
                <p class="mt-1 text-xs text-gray-500">
                    Periode <span id="detailPeriode" class="font-semibold"></span>
                </p>
            </div>

            <button type="button"
                onclick="tutupDetailNilai()"
                class="shrink-0 rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-700"
                title="Tutup">
                <i class="ph ph-x text-xl"></i>
            </button>
        </div>

        <!-- Isi modal -->
        <div class="overflow-y-auto px-6 py-4">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-gray-200 bg-gray-50 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-4 py-3">Mata Pelajaran</th>
                        <th class="px-4 py-3 text-center">Nilai</th>
                        <th class="px-4 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody id="detailIsi"></tbody>
            </table>
        </div>

        <!-- Footer modal -->
        <div class="border-t border-gray-200 px-6 py-4">
            <button type="button"
                onclick="tutupDetailNilai()"
                class="w-full rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-600 sm:w-auto">
                Tutup
            </button>
        </div>

    </div>

</div>


<!-- ========================================================= -->

<!-- DATA MATA PELAJARAN (untuk tombol tambah nilai) -->

<!-- ========================================================= -->

<script>

    /*
    |--------------------------------------------------------------------------
    | Pilihan mata pelajaran per siswa
    |--------------------------------------------------------------------------
    |
    | Mata pelajaran yang sudah dinilai tidak ikut ditawarkan, supaya tidak
    | ada input ganda untuk siswa yang sama pada periode yang sama.
    |
    */

    const pilihanMapel = @json($pilihanMapel);

    /*
    |--------------------------------------------------------------------------
    | Data rincian nilai untuk tombol Detail
    |--------------------------------------------------------------------------
    */

    const rincianNilai = @json($rincianNilai);

    const periode = @json([
        'tahun_ajaran' => $tahunAjaran,
        'semester' => $semester,
    ]);

    const modalDetail = document.getElementById('modalDetail');

</script>


<!-- ========================================================= -->

<!-- KONFIRMASI HAPUS -->

<!-- ========================================================= -->

<script>
    document.querySelectorAll('form[data-hapus-form]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const nama = form.querySelector('button[data-nama]').dataset.nama;

            const yakin = confirm(
                'Yakin ingin menghapus SEMUA nilai "' + nama + '" pada periode ini?\n' +
                'Data yang sudah dihapus tidak dapat dikembalikan.'
            );

            if (!yakin) {
                event.preventDefault();
            }
        });
    });
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

        button.style.display = 'none';

        row.querySelector('.save-btn').style.display = '';

        row.querySelector('.cancel-btn').style.display = '';

    }


    /*
    |--------------------------------------------------------------------------
    | Tombol SIMPAN (per baris)
    |--------------------------------------------------------------------------
    |
    | Hanya baris ini yang ikut terkirim. Input baris lain dinonaktifkan
    | lebih dulu supaya nilai yang belum disimpan di baris lain tidak ikut
    | terimpan tanpa sengaja.
    |
    */

    function simpanNilai(button) {

        const row = button.closest('.nilai-row');

        // Kunci tombol agar tidak terkirim dua kali
        button.disabled = true;

        document.querySelectorAll('.nilai-row').forEach(function (barisLain) {

            if (barisLain !== row) {

                barisLain.querySelectorAll('input, select').forEach(function (el) {

                    el.disabled = true;

                });

            }

        });

        // Input di luar tabel (tambahan) ikut dikunci agar tidak terkirim
        document.getElementById('formNilai').submit();

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

        button.style.display = 'none';

        row.querySelector('.edit-btn').style.display = '';

        row.querySelector('.save-btn').style.display = 'none';

    }


    /*
    |--------------------------------------------------------------------------
    | Tombol DETAIL
    |--------------------------------------------------------------------------
    |
    | Menampilkan rincian nilai siswa dalam modal. Kolom nilai ikut dibaca
    | langsung dari input, jadi nilai yang baru diketik ikut terlihat.
    |
    */

    function lihatDetailNilai(idSiswa) {

        const data = rincianNilai[idSiswa];

        if (!data) {
            return;
        }

        // Ambil input yang sedang diedit supaya tidak menampilkan data lama
        const row = document.querySelector('.nilai-row[data-row="' + idSiswa + '"]');

        const inputPerMapel = {};

        if (row) {

            row.querySelectorAll('input[name*="[' + idSiswa + ']"]').forEach(function (input) {

                const cocok = input.name.match(/\[(\d+)\]$/);

                if (cocok) {

                    inputPerMapel[cocok[1]] = input.value;

                }

            });

        }

        document.getElementById('detailNama').textContent = data.nama;
        document.getElementById('detailNisn').textContent = data.nisn;
        document.getElementById('detailKelas').textContent = data.kelas;
        document.getElementById('detailPeriode').textContent =
            periode.tahun_ajaran + ' / ' + periode.semester;

        const tbody = document.getElementById('detailIsi');

        tbody.innerHTML = '';

        const daftar = Object.entries(data.nilai);

        if (daftar.length === 0) {

            tbody.innerHTML =
                '<tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">' +
                'Belum ada mata pelajaran.</td></tr>';

        }

        daftar.forEach(function ([idMapel, baris]) {

            // Nilai yang sedang diketik (dan belum disimpan) diutamakan
            const adaInput = Object.prototype.hasOwnProperty.call(inputPerMapel, idMapel);
            const nilai = adaInput && inputPerMapel[idMapel] !== ''
                ? inputPerMapel[idMapel]
                : baris.nilai;

            const tr = document.createElement('tr');
            tr.className = 'border-b border-gray-200';

            const tdMapel = document.createElement('td');
            tdMapel.className = 'px-4 py-3 text-gray-700';
            tdMapel.textContent = baris.mapel;

            const tdNilai = document.createElement('td');
            tdNilai.className = 'px-4 py-3 text-center';

            if (nilai === null || nilai === '') {

                tdNilai.className += ' text-gray-400';
                tdNilai.textContent = '-';

            } else {

                tdNilai.className += ' font-bold text-green-600';
                tdNilai.textContent = nilai;

                if (adaInput) {
                    tdNilai.title = 'Belum disimpan';
                }

            }

            const tdStatus = document.createElement('td');
            tdStatus.className = 'px-4 py-3 text-center';

            if (adaInput) {

                tdStatus.innerHTML =
                    '<span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">Belum disimpan</span>';

            } else if (nilai !== null && nilai !== '') {

                tdStatus.innerHTML =
                    '<span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">Tersimpan</span>';

            } else {

                tdStatus.innerHTML =
                    '<span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-600">Kosong</span>';

            }

            tr.appendChild(tdMapel);
            tr.appendChild(tdNilai);
            tr.appendChild(tdStatus);
            tbody.appendChild(tr);

        });

        modalDetail.classList.remove('hidden');
        modalDetail.classList.add('flex');
        document.body.classList.add('overflow-hidden');

    }


    function tutupDetailNilai() {

        modalDetail.classList.add('hidden');
        modalDetail.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');

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

        // Mata pelajaran yang belum dinilai untuk siswa ini
        const mapel = pilihanMapel[idSiswa] || {};

        const daftar = Object.entries(mapel);

        // Tandai mapel yang sudah dipakai di baris tambahan
        const terpakai = Array.from(
            wrapper.querySelectorAll('[data-tambahan] select')
        ).map(function (select) {
            return select.value;
        }).filter(function (value) {
            return value !== '';
        });

        const belumDipakai = daftar.filter(function ([id]) {
            return !terpakai.includes(id);
        });

        if (belumDipakai.length === 0) {

            alert(
                daftar.length === 0
                    ? 'Semua mata pelajaran sudah dinilai untuk siswa ini.'
                    : 'Semua mata pelajaran yang tersedia sudah dipilih.'
            );

            return;

        }

        // Longitudinal id agar tidak bentrok dengan baris sebelumnya
        const baris = document.createElement('div');

        baris.className = 'flex flex-wrap items-center justify-between gap-3';
        baris.setAttribute('data-tambahan', '1');

        // Opsi mata pelajaran
        let opsi = '<option value="">-- Pilih Mata Pelajaran --</option>';

        belumDipakai.forEach(function ([id, nama]) {

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
                form="formNilai"
                disabled
                class="nilai-input w-20 rounded-lg border border-gray-300 px-3 py-1.5 text-center font-semibold outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

            <button
                type="button"
                onclick="hapusNilaiBaris(this)"
                class="rounded-lg bg-red-500 px-2 py-1.5 text-xs font-semibold text-white transition hover:bg-red-600"
                title="Hapus baris ini">

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
