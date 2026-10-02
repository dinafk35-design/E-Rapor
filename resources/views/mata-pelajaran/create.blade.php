@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Tambah Data Mata Pelajaran
        </h2>

        <p>
            Kelola data mata pelajaran yang digunakan dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- PESAN ERROR -->
    <!-- ============================= -->

    @if ($errors->any())

        <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
            <i class="ph ph-warning-circle mr-1"></i>
            {{ $errors->first() }}
        </div>

    @endif


    <!-- ============================= -->
    <!-- FORM INPUT MATA PELAJARAN -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-book"></i>
        Input Data Mata Pelajaran
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ route('mata-pelajaran.store') }}"
            id="formMataPelajaran"
        >
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- KODE MATA PELAJARAN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Kode Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="kode_mata_pelajaran"
                        value="{{ old('kode_mata_pelajaran') }}"
                        placeholder="Contoh: RPL001"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                    >

                    @error('kode_mata_pelajaran')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- NAMA MATA PELAJARAN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mata_pelajaran"
                        value="{{ old('nama_mata_pelajaran') }}"
                        placeholder="Masukkan nama mata pelajaran"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                        required
                    >

                    @error('nama_mata_pelajaran')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- KELOMPOK -->
                <div>

                    <label class="block font-semibold mb-2">
                        Kelompok
                    </label>

                    <select
                        name="kelompok"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                    >

                        <option value="">
                            -- Pilih Kelompok --
                        </option>

                        <option value="A" {{ old('kelompok') === 'A' ? 'selected' : '' }}>
                            Kelompok A
                        </option>

                        <option value="B" {{ old('kelompok') === 'B' ? 'selected' : '' }}>
                            kelompok B
                        </option>

                        <option value="C" {{ old('kelompok') === 'C' ? 'selected' : '' }}>
                            Kelompok C
                        </option>

                        <option value="Muatan Lokal" {{ old('kelompok') === 'Muatan Lokal' ? 'selected' : '' }}>
                            Muatan Lokal
                        </option>

                    </select>

                </div>


                <!-- SEKOLAH -->
                <div>

                    <label class="block font-semibold mb-2">
                        Sekolah
                    </label>

                    <select
                        name="sekolah_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5"
                    >

                        <option value="">
                            -- Pilih Sekolah --
                        </option>

                        @foreach ($sekolah as $item)

                            <option
                                value="{{ $item->id }}"
                                {{ (string) old('sekolah_id') === (string) $item->id ? 'selected' : '' }}
                            >
                                {{ $item->nama_sekolah }}
                            </option>

                        @endforeach

                    </select>

                    @error('sekolah_id')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            <!-- ============================================ -->
            <!-- PILIH GURU YANG MENGAJAR                       -->
            <!-- ============================================ -->

            <div class="mt-8 border-t pt-6">

                <div class="flex flex-wrap items-center justify-between gap-3 mb-4">

                    <div>

                        <div class="flex items-center gap-2">

                            <i class="ph ph-chalkboard-teacher text-xl text-blue-600"></i>

                            <h3 class="text-lg font-bold text-slate-800">
                                Guru yang Mengajar
                            </h3>

                        </div>

                        <p class="text-sm text-slate-500 mt-1">
                            Pilih guru dari data guru yang tersedia. Boleh dikosongkan
                            dan bisa ditambah nanti dari halaman edit.
                        </p>

                    </div>


                    <button
                        type="button"
                        onclick="tambahBarisGuru()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition"
                    >

                        <i class="ph ph-plus"></i>

                        Tambah Guru

                    </button>

                </div>


                @if ($guru->isEmpty())

                    <div class="rounded-lg border border-amber-300 bg-amber-50 p-4 text-sm text-amber-800">

                        <i class="ph ph-warning-circle mr-1"></i>

                        Belum ada data guru. Silakan tambahkan data guru terlebih dahulu.

                    </div>

                @else

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="bg-slate-50 border-b">

                                <tr>

                                    <th class="px-4 py-3 font-semibold text-slate-700">
                                        No
                                    </th>

                                    <th class="px-4 py-3 font-semibold text-slate-700">
                                        Guru
                                    </th>

                                    <th class="px-4 py-3 font-semibold text-slate-700">
                                        Rombel
                                    </th>

                                    <th class="px-4 py-3 font-semibold text-slate-700">
                                        Tahun Ajaran
                                    </th>

                                    <th class="px-4 py-3 font-semibold text-slate-700">
                                        Semester
                                    </th>

                                    <th class="px-4 py-3 text-center font-semibold text-slate-700">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="wrapperGuruMengajar">

                                @php
                                    $barisGuruLama = (array) old('guru_id', []);
                                    $barisRombelLama = (array) old('rombel_id', []);
                                    $barisTahunLama = (array) old('tahun_ajaran', []);
                                    $barisSemesterLama = (array) old('semester', []);

                                    /*
                                    | Kalau ada input lama dari validasi gagal, tampilkan
                                    | sebanyak baris itu. Selain itu satu baris kosong.
                                    */
                                    $jumlahBaris = $barisGuruLama === [] ? 1 : count($barisGuruLama);
                                @endphp

                                @for ($i = 0; $i < $jumlahBaris; $i++)

                                    <tr class="border-b">

                                        <td class="px-4 py-3 text-slate-600 nomor-guru">
                                            {{ $i + 1 }}
                                        </td>


                                        <td class="px-4 py-3">

                                            <select
                                                name="guru_id[]"
                                                class="pilihan-guru w-full border border-gray-300 rounded-lg px-3 py-2"
                                            >

                                                <option value="">
                                                    -- Pilih Guru --
                                                </option>

                                                @foreach ($guru as $item)

                                                    <option
                                                        value="{{ $item->id }}"
                                                        {{ (string) ($barisGuruLama[$i] ?? '') === (string) $item->id ? 'selected' : '' }}
                                                    >
                                                        {{ $item->nama_guru }}
                                                        @if ($item->nip)
                                                            - {{ $item->nip }}
                                                        @endif
                                                    </option>

                                                @endforeach

                                            </select>

                                        </td>


                                        <td class="px-4 py-3">

                                            <select
                                                name="rombel_id[]"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                            >

                                                <option value="">
                                                    -- Pilih Rombel --
                                                </option>

                                                @foreach ($rombel as $item)

                                                    <option
                                                        value="{{ $item->id }}"
                                                        {{ (string) ($barisRombelLama[$i] ?? '') === (string) $item->id ? 'selected' : '' }}
                                                    >
                                                        {{ $item->nama_rombel }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            @error('rombel_id.' . $i)
                                                <p class="text-red-500 text-sm mt-1">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </td>


                                        <td class="px-4 py-3">

                                            <select
                                                name="tahun_ajaran[]"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                            >

                                                <option value="">
                                                    -- Tahun Ajaran --
                                                </option>

                                                @foreach (['2025/2026', '2026/2027', '2027/2028'] as $tahun)
                                                    <option
                                                        value="{{ $tahun }}"
                                                        {{ ($barisTahunLama[$i] ?? '') === $tahun ? 'selected' : '' }}
                                                    >
                                                        {{ $tahun }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </td>


                                        <td class="px-4 py-3">

                                            <select
                                                name="semester[]"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                            >

                                                <option value="">
                                                    -- Semester --
                                                </option>

                                                @foreach (['Ganjil', 'Genap'] as $pilihanSemester)
                                                    <option
                                                        value="{{ $pilihanSemester }}"
                                                        {{ ($barisSemesterLama[$i] ?? '') === $pilihanSemester ? 'selected' : '' }}
                                                    >
                                                        {{ $pilihanSemester }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </td>


                                        <td class="px-4 py-3 text-center">

                                            <button
                                                type="button"
                                                onclick="hapusBarisGuru(this)"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-700 transition"
                                            >

                                                <i class="ph ph-trash"></i>

                                                Hapus

                                            </button>

                                        </td>

                                    </tr>

                                @endfor

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>


            <!-- BUTTON -->

            <div class="flex gap-3 mt-6">

                <a
                    href="{{ route('mata-pelajaran.index') }}"
                    class="px-5 py-2 rounded-lg bg-gray-500 text-white"
                >
                    <i class="ph ph-arrow-left mr-1"></i>
                    Kembali
                </a>


                <button
                    type="submit"
                    class="px-5 py-2 rounded-lg bg-blue-600 text-white"
                >

                    <i class="ph ph-floppy-disk mr-1"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>


<!-- ============================================================ -->
<!-- TEMPLATE BARIS GURU (disalin oleh JavaScript)               -->
<!-- ============================================================ -->

<template id="templateBarisGuru">

    <tr class="border-b">

        <td class="px-4 py-3 text-slate-600 nomor-guru"></td>


        <td class="px-4 py-3">

            <select
                name="guru_id[]"
                class="pilihan-guru w-full border border-gray-300 rounded-lg px-3 py-2"
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

        </td>


        <td class="px-4 py-3">

            <select
                name="rombel_id[]"
                class="w-full border border-gray-300 rounded-lg px-3 py-2"
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

        </td>


        <td class="px-4 py-3">

            <select
                name="tahun_ajaran[]"
                class="w-full border border-gray-300 rounded-lg px-3 py-2"
            >

                <option value="">
                    -- Tahun Ajaran --
                </option>

                <option value="2025/2026">
                    2025/2026
                </option>

                <option value="2026/2027">
                    2026/2027
                </option>

                <option value="2027/2028">
                    2027/2028
                </option>

            </select>

        </td>


        <td class="px-4 py-3">

            <select
                name="semester[]"
                class="w-full border border-gray-300 rounded-lg px-3 py-2"
            >

                <option value="">
                    -- Semester --
                </option>

                <option value="Ganjil">
                    Ganjil
                </option>

                <option value="Genap">
                    Genap
                </option>

            </select>

        </td>


        <td class="px-4 py-3 text-center">

            <button
                type="button"
                onclick="hapusBarisGuru(this)"
                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-600 text-white text-xs font-semibold hover:bg-red-700 transition"
            >

                <i class="ph ph-trash"></i>

                Hapus

            </button>

        </td>

    </tr>

</template>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>

/* ============================================================== */
/* TAMBAH BARIS GURU                                               */
/* ============================================================== */

function tambahBarisGuru() {

    const wrapper = document.getElementById('wrapperGuruMengajar');

    const template = document.getElementById('templateBarisGuru');

    if (!wrapper || !template) {
        return;
    }

    wrapper.appendChild(template.content.cloneNode(true));

    perbaruiNomorGuru();

}


/* ============================================================== */
/* HAPUS BARIS GURU                                               */
/* ============================================================== */

function hapusBarisGuru(tombol) {

    const baris = tombol.closest('tr');

    baris.remove();

    perbaruiNomorGuru();

}


/* ============================================================== */
/* NOMOR URUT BARIS GURU                                          */
/* ============================================================== */

function perbaruiNomorGuru() {

    document
        .querySelectorAll('#wrapperGuruMengajar .nomor-guru')
        .forEach(function(kolom, index) {

            kolom.textContent = index + 1;

        });

}

</script>


@endsection
