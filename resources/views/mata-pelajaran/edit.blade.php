@extends('layouts.app')

@section('content')

<div class="content">

    {{-- =============================== --}}
    {{-- HEADER --}}
    {{-- =============================== --}}

    <div class="welcome mb-6">

        <h2 class="italic font-bold text-2xl">
            Edit Mata Pelajaran
        </h2>

        <p class="text-gray-500 mt-1">
            Ubah data mata pelajaran dan guru yang mengajar.
        </p>

    </div>


    {{-- =============================== --}}
    {{-- PESAN --}}
    {{-- =============================== --}}

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-green-300 bg-green-50 p-3 text-sm text-green-800">
            <i class="ph ph-check-circle mr-1"></i>
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
            <i class="ph ph-warning-circle mr-1"></i>
            {{ $errors->first() }}
        </div>
    @endif


    {{-- =============================== --}}
    {{-- CARD DATA MATA PELAJARAN --}}
    {{-- =============================== --}}

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <div class="flex items-center gap-2 mb-5">

            <i class="ph ph-pencil-simple text-xl text-blue-600"></i>

            <h3 class="text-lg font-bold text-slate-800">
                Edit Data Mata Pelajaran
            </h3>

        </div>


        <form
            action="{{ route('mata-pelajaran.update', $mataPelajaran->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- KODE --}}

                <div>

                    <label class="block font-semibold mb-2">
                        Kode Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="kode_mata_pelajaran"
                        value="{{ old('kode_mata_pelajaran', $mataPelajaran->kode_mata_pelajaran) }}"
                        placeholder="Contoh: RPL001"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    @error('kode_mata_pelajaran')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- NAMA --}}

                <div>

                    <label class="block font-semibold mb-2">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mata_pelajaran"
                        value="{{ old('nama_mata_pelajaran', $mataPelajaran->nama_mata_pelajaran) }}"
                        placeholder="Masukkan nama mata pelajaran"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    >

                    @error('nama_mata_pelajaran')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- KELOMPOK --}}

                <div>

                    <label class="block font-semibold mb-2">
                        Kelompok
                    </label>

                    <select
                        name="kelompok"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                        <option value="">
                            -- Pilih Kelompok --
                        </option>

                        <option
                            value="A"
                            {{ old('kelompok', $mataPelajaran->kelompok) == 'A' ? 'selected' : '' }}
                        >
                            Kelompok A
                        </option>

                        <option
                            value="B"
                            {{ old('kelompok', $mataPelajaran->kelompok) == 'B' ? 'selected' : '' }}
                        >
                            Kelompok B
                        </option>

                        <option
                            value="C"
                            {{ old('kelompok', $mataPelajaran->kelompok) == 'C' ? 'selected' : '' }}
                        >
                            Kelompok C
                        </option>

                        <option
                            value="Muatan Lokal"
                            {{ old('kelompok', $mataPelajaran->kelompok) == 'Muatan Lokal' ? 'selected' : '' }}
                        >
                            Muatan Lokal
                        </option>

                    </select>

                </div>


                {{-- SEKOLAH --}}

                <div>

                    <label class="block font-semibold mb-2">
                        Sekolah
                    </label>

                    <select
                        name="sekolah_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                        <option value="">
                            -- Pilih Sekolah --
                        </option>

                        @foreach ($sekolah as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ old('sekolah_id', $mataPelajaran->sekolah_id) == $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nama_sekolah }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- BUTTON --}}

            <div class="flex gap-3 mt-6">

                <a
                    href="{{ route('mata-pelajaran.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gray-500 text-white hover:bg-gray-600 transition"
                >

                    <i class="ph ph-arrow-left"></i>

                    Kembali

                </a>


                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition"
                >

                    <i class="ph ph-floppy-disk"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>



    {{-- ====================================================== --}}
    {{-- CARD GURU YANG MENGAJAR --}}
    {{-- ====================================================== --}}

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        {{-- HEADER CARD --}}

        <div class="flex items-start justify-between mb-5">

            <div>

                <div class="flex items-center gap-2">

                    <i class="ph ph-chalkboard-teacher text-2xl text-blue-600"></i>

                    <h3 class="text-lg font-bold text-slate-800">
                        Guru yang Mengajar
                    </h3>

                </div>

                <p class="text-sm text-slate-500 mt-1">

                    Daftar guru yang mengajar mata pelajaran:

                    <span class="font-semibold text-blue-600">
                        {{ $mataPelajaran->nama_mata_pelajaran }}
                    </span>

                </p>

            </div>


            {{-- JUMLAH GURU --}}

            <div class="flex items-center gap-3">

                <div class="bg-blue-50 text-blue-700 px-3 py-2 rounded-lg text-sm font-semibold">

                    <span id="jumlahGuru">
                        {{ $mataPelajaran->guruMengajar->count() }}
                    </span>

                    Guru

                </div>


                {{-- TAMBAH GURU --}}

                <button
                    type="button"
                    onclick="bukaModalTambah()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition"
                >

                    <i class="ph ph-user-plus"></i>

                    Tambah Guru

                </button>

            </div>

        </div>



        {{-- TABLE --}}

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-4 py-3 font-semibold text-slate-700">
                            No
                        </th>

                        <th class="px-4 py-3 font-semibold text-slate-700">
                            NIP
                        </th>

                        <th class="px-4 py-3 font-semibold text-slate-700">
                            Nama Guru
                        </th>

                        <th class="px-4 py-3 font-semibold text-slate-700">
                            Email
                        </th>

                        <th class="px-4 py-3 font-semibold text-slate-700">
                            No. Telepon
                        </th>

                        <th class="px-4 py-3 font-semibold text-slate-700">
                            Rombel
                        </th>

                        <th class="px-4 py-3 font-semibold text-slate-700 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="tabelGuru">

                    @forelse (
                        $mataPelajaran->guruMengajar
                        as $index => $relasi
                    )

                        <tr
                            id="baris-guru-{{ $relasi->id }}"
                            class="border-b hover:bg-slate-50"
                        >

                            {{-- NO --}}

                            <td class="px-4 py-3 nomor-guru">
                                {{ $index + 1 }}
                            </td>


                            {{-- NIP --}}

                            <td class="px-4 py-3 text-slate-600">

                                {{ $relasi->guru->nip ?? '-' }}

                            </td>


                            {{-- NAMA --}}

                            <td class="px-4 py-3">

                                <div class="font-semibold text-slate-800">

                                    {{ $relasi->guru->nama_guru ?? '-' }}

                                </div>

                            </td>


                            {{-- EMAIL --}}

                            <td class="px-4 py-3 text-slate-600">

                                {{ $relasi->guru->email ?? '-' }}

                            </td>


                            {{-- TELEPON --}}

                            <td class="px-4 py-3 text-slate-600">

                                {{ $relasi->guru->no_telepon ?? '-' }}

                            </td>


                            {{-- ROMBEL --}}

                            <td class="px-4 py-3">

                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">

                                    {{ $relasi->rombel->nama_rombel ?? '-' }}

                                </span>

                            </td>


                            {{-- AKSI --}}

                            <td class="px-4 py-3">

                                <div class="flex justify-center items-center gap-2">

                                    {{-- GANTI --}}

                                    <button
                                        type="button"
                                        onclick="bukaModalGanti({{ $relasi->id }})"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition"
                                    >

                                        <i class="ph ph-pencil-simple"></i>

                                        Ganti

                                    </button>


                                    {{-- HAPUS --}}

                                    <form
                                        action="{{ route(
                                            'mata-pelajaran.guru.delete',
                                            [
                                                'mataPelajaran' => $mataPelajaran->id,
                                                'guruMengajar' => $relasi->id
                                            ]
                                        ) }}"
                                        method="POST"
                                        onsubmit="return konfirmasiHapus()"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-700 transition"
                                        >

                                            <i class="ph ph-trash"></i>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-4 py-10 text-center"
                            >

                                <div class="flex flex-col items-center">

                                    <i class="ph ph-users-three text-5xl text-slate-300 mb-3"></i>

                                    <p class="font-semibold text-slate-600">
                                        Belum ada guru yang mengajar
                                    </p>

                                    <p class="text-sm text-slate-400 mt-1">
                                        Mata pelajaran ini belum memiliki relasi dengan guru.
                                    </p>

                                    <button
                                        type="button"
                                        onclick="bukaModalTambah()"
                                        class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition"
                                    >

                                        <i class="ph ph-user-plus"></i>

                                        Tambah Guru Sekarang

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- ====================================================== --}}
{{-- MODAL TAMBAH GURU --}}
{{-- ====================================================== --}}

<div
    id="modalTambahGuru"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
>

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl">

        {{-- HEADER MODAL --}}

        <div class="flex items-center justify-between border-b px-6 py-4">

            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Tambah Guru Mengajar
                </h3>

                <p class="text-sm text-slate-500">
                    Tambahkan guru dari data guru untuk mata pelajaran ini.
                </p>

            </div>

            <button
                type="button"
                onclick="tutupModalTambah()"
                class="text-2xl text-slate-400 hover:text-slate-700"
            >
                &times;
            </button>

        </div>


        {{-- FORM MODAL --}}

        <form
            action="{{ route('mata-pelajaran.guru.store', $mataPelajaran->id) }}"
            method="POST"
            class="p-6"
        >

            @csrf

            @if ($guru->isEmpty())

                <div class="rounded-lg border border-amber-300 bg-amber-50 p-4 text-sm text-amber-800">

                    <i class="ph ph-warning-circle mr-1"></i>

                    Belum ada data guru. Silakan tambahkan data guru terlebih dahulu.

                </div>

            @else

                {{-- GURU --}}

                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Guru
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="guru_id_tambah"
                        name="guru_id"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                        <option value="">
                            -- Pilih Guru --
                        </option>

                        @foreach ($guru as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ (string) old('guru_id') === (string) $item->id ? 'selected' : '' }}
                            >

                                {{ $item->nama_guru }}

                                @if ($item->nip)
                                    - {{ $item->nip }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('guru_id')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- ROMBEL --}}

                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Rombel
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="rombel_id_tambah"
                        name="rombel_id"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                        <option value="">
                            -- Pilih Rombel --
                        </option>

                        @foreach ($rombel as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ (string) old('rombel_id') === (string) $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nama_rombel }}
                            </option>

                        @endforeach

                    </select>

                    @error('rombel_id')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- TAHUN AJARAN --}}

                <div class="mb-4">

                    <label class="block font-semibold mb-2">
                        Tahun Ajaran
                    </label>

                    <select
                        id="tahun_ajaran_tambah"
                        name="tahun_ajaran"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                    >

                        <option value="">-- Pilih Tahun Ajaran --</option>

                        @foreach (['2025/2026', '2026/2027', '2027/2028'] as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach

                    </select>

                </div>


                {{-- SEMESTER --}}

                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Semester
                    </label>

                    <select
                        id="semester_tambah"
                        name="semester"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                    >

                        <option value="">-- Pilih Semester --</option>

                        <option value="Ganjil">Ganjil</option>

                        <option value="Genap">Genap</option>

                    </select>

                </div>


                {{-- BUTTON MODAL --}}

                <div class="flex justify-end gap-3">

                    <button
                        type="button"
                        onclick="tutupModalTambah()"
                        class="px-5 py-2.5 rounded-lg bg-gray-500 text-white hover:bg-gray-600"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700"
                    >

                        <i class="ph ph-user-plus mr-1"></i>

                        Tambah Guru

                    </button>

                </div>

            @endif

        </form>

    </div>

</div>



{{-- ====================================================== --}}
{{-- MODAL GANTI GURU --}}
{{-- ====================================================== --}}

<div
    id="modalGantiGuru"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 px-4"
>

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-2xl">

        {{-- HEADER MODAL --}}

        <div class="flex items-center justify-between border-b px-6 py-4">

            <div>

                <h3 class="text-lg font-bold text-slate-800">
                    Ganti Guru
                </h3>

                <p class="text-sm text-slate-500">
                    Ubah guru yang mengajar mata pelajaran ini.
                </p>

            </div>

            <button
                type="button"
                onclick="tutupModalGanti()"
                class="text-2xl text-slate-400 hover:text-slate-700"
            >
                &times;
            </button>

        </div>


        {{-- FORM MODAL --}}

        <form
            id="formGantiGuru"
            method="POST"
            class="p-6"
        >

            @csrf

            @method('PUT')


            {{-- GURU --}}

            <div class="mb-4">

                <label class="block font-semibold mb-2">
                    Guru
                </label>

                <select
                    id="guru_id_edit"
                    name="guru_id"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                    <option value="">
                        -- Pilih Guru --
                    </option>

                    @foreach ($guru as $item)

                        <option value="{{ $item->id }}">

                            {{ $item->nama_guru }}

                            @if ($item->nip)
                                - {{ $item->nip }}
                            @endif

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ROMBEL --}}

            <div class="mb-4">

                <label class="block font-semibold mb-2">
                    Rombel
                </label>

                <select
                    id="rombel_id_edit"
                    name="rombel_id"
                    required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                    <option value="">
                        -- Pilih Rombel --
                    </option>

                    @foreach ($rombel as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_rombel }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- TAHUN AJARAN --}}

            <div class="mb-4">

                <label class="block font-semibold mb-2">
                    Tahun Ajaran
                </label>

                <select
                    id="tahun_ajaran_edit"
                    name="tahun_ajaran"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                >

                    <option value="2025/2026">
                        2025/2026
                    </option>

                    <option value="2026/2027">
                        2026/2027
                    </option>

                </select>

            </div>


            {{-- SEMESTER --}}

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Semester
                </label>

                <select
                    id="semester_edit"
                    name="semester"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                >

                    <option value="Ganjil">
                        Ganjil
                    </option>

                    <option value="Genap">
                        Genap
                    </option>

                </select>

            </div>


            {{-- BUTTON MODAL --}}

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    onclick="tutupModalGanti()"
                    class="px-5 py-2.5 rounded-lg bg-gray-500 text-white hover:bg-gray-600"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
                >

                    <i class="ph ph-floppy-disk mr-1"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>



{{-- ====================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ====================================================== --}}

<script>

/* ============================================================== */
/* BUKA MODAL TAMBAH GURU                                          */
/* ============================================================== */

function bukaModalTambah()
{
    const modal = document.getElementById('modalTambahGuru');

    if (!modal) {
        return;
    }

    modal.classList.remove('hidden');

    modal.classList.add('flex');

}


/* ============================================================== */
/* TUTUP MODAL TAMBAH GURU                                         */
/* ============================================================== */

function tutupModalTambah()
{
    const modal = document.getElementById('modalTambahGuru');

    if (!modal) {
        return;
    }

    modal.classList.add('hidden');

    modal.classList.remove('flex');

}


const dataGuruMengajar = {
    @foreach ($mataPelajaran->guruMengajar as $relasi)
        "{{ $relasi->id }}": {
            guru_id: "{{ $relasi->guru_id }}",
            rombel_id: "{{ $relasi->rombel_id }}",
            tahun_ajaran: "{{ $relasi->tahun_ajaran ?? '' }}",
            semester: "{{ $relasi->semester ?? '' }}"
        },
    @endforeach
};


function bukaModalGanti(id)
{
    const data = dataGuruMengajar[id];

    if (!data) {
        alert('Data guru tidak ditemukan.');
        return;
    }

    const form = document.getElementById('formGantiGuru');

    form.action =
        "{{ url('/mata-pelajaran') }}/{{ $mataPelajaran->id }}/guru/" + id;

    document.getElementById('guru_id_edit').value =
        data.guru_id || '';

    document.getElementById('rombel_id_edit').value =
        data.rombel_id || '';

    document.getElementById('tahun_ajaran_edit').value =
        data.tahun_ajaran || '2026/2027';

    document.getElementById('semester_edit').value =
        data.semester || 'Ganjil';

    const modal =
        document.getElementById('modalGantiGuru');

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


function tutupModalGanti()
{
    const modal =
        document.getElementById('modalGantiGuru');

    modal.classList.add('hidden');

    modal.classList.remove('flex');
}


function konfirmasiHapus()
{
    return confirm(
        'Yakin ingin menghapus guru ini dari mata pelajaran?'
    );
}


document
    .getElementById('modalGantiGuru')
    .addEventListener('click', function(event) {

        if (event.target === this) {
            tutupModalGanti();
        }

    });


document
    .getElementById('modalTambahGuru')
    .addEventListener('click', function(event) {

        if (event.target === this) {
            tutupModalTambah();
        }

    });


/* ============================================================== */
/* KETIK ESC UNTUK MENUTUP MODAL                                   */
/* ============================================================== */

document.addEventListener('keydown', function(event) {

    if (event.key !== 'Escape') {
        return;
    }

    tutupModalTambah();

    tutupModalGanti();

});


/* ============================================================== */
/* BUKA MODAL TAMBAH OTOMATIS                                      */
/* ============================================================== */

/*
| Jika validasi gagal, atau mata pelajaran ini memang belum punya
| guru, modal tambah guru langsung dibuka supaya admin tidak perlu
| mencari tombolnya lagi.
*/

@if (
    $errors->any()
    || $mataPelajaran->guruMengajar->isEmpty()
)

    document.addEventListener('DOMContentLoaded', function() {

        bukaModalTambah();

    });

@endif

</script>



@endsection