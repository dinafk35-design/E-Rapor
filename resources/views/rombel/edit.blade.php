@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Edit Data Rombel
        </h2>

        <p>
            Ubah data rombongan belajar beserta anggota siswa yang tergabung
            dalam rombel tersebut.
        </p>

    </div>


    <form
        method="POST"
        action="{{ route('rombel.update', $rombel->id) }}"
        id="formRombel"
    >

        @csrf

        @method('PUT')

        @if ($errors->any())

            <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                <i class="ph ph-warning-circle mr-1"></i>
                {{ $errors->first() }}
            </div>

        @endif


        <!-- ============================= -->
        <!-- FORM INPUT DATA ROMBEL -->
        <!-- ============================= -->

        <div class="section-title">

            <i class="ph ph-users-three"></i>

            Edit Data Rombel

        </div>


        <div class="bg-white rounded-xl shadow p-6 mb-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- NAMA ROMBEL -->

                <div>

                    <label class="block font-semibold mb-2">
                        Nama Rombel
                    </label>

                    <input
                        type="text"
                        name="nama_rombel"
                        value="{{ old('nama_rombel', $rombel->nama_rombel) }}"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- TINGKAT -->

                <div>

                    <label class="block font-semibold mb-2">
                        Tingkat
                    </label>

                    <select
                        name="tingkat"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="X" @selected(old('tingkat', $rombel->tingkat) === 'X')>
                            X
                        </option>

                        <option value="XI" @selected(old('tingkat', $rombel->tingkat) === 'XI')>
                            XI
                        </option>

                        <option value="XII" @selected(old('tingkat', $rombel->tingkat) === 'XII')>
                            XII
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
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">-- Pilih Sekolah --</option>

                        @foreach ($sekolah as $item)
                            <option
                                value="{{ $item->id }}"
                                @selected(old('sekolah_id', $rombel->sekolah_id) == $item->id)
                            >
                                {{ $item->nama_sekolah }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <!-- WALI KELAS -->

                <div>

                    <label class="block font-semibold mb-2">
                        Wali Kelas
                    </label>

                    <select
                        name="wali_kelas_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">-- Pilih Wali Kelas --</option>

                        @foreach ($guru as $item)
                            <option
                                value="{{ $item->id }}"
                                @selected(old('wali_kelas_id', $rombel->wali_kelas_id) == $item->id)
                            >
                                {{ $item->nama_guru }}
                            </option>
                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        <!-- ============================= -->
        <!-- FORM INPUT ANGGOTA ROMBEL -->
        <!-- ============================= -->

        <div class="section-title flex justify-between">

            <div>

                <i class="ph ph-users"></i>

                Edit Anggota Rombel

            </div>

            <button
                type="button"
                onclick="tambahAnggota()"
                class="bg-green-300 p-2 border border-gray-200 rounded-lg"
            >

                + Tambah Anggota

            </button>

        </div>


        <div class="bg-white rounded-xl shadow p-6 mb-6">

            <div id="wrapper-anggota" class="space-y-4">

                @php
                    $anggotaTerisi = $rombel->anggota;
                @endphp

                @forelse ($anggotaTerisi as $anggota)

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 anggota-row">

                        <!-- SISWA -->

                        <div>

                            <label class="block font-semibold mb-2">
                                Nama Siswa
                            </label>

                            <select
                                name="siswa_id[]"
                                class="w-full border rounded-lg px-4 py-2"
                            >

                                <option value="">-- Pilih Siswa --</option>

                                @foreach ($siswa as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected($anggota->siswa_id == $item->id)
                                    >
                                        {{ $item->nama_siswa }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <!-- TAHUN AJARAN -->

                        <div>

                            <label class="block font-semibold mb-2">
                                Tahun Ajaran
                            </label>

                            <select
                                name="tahun_ajaran[]"
                                class="w-full border rounded-lg px-4 py-2"
                            >

                                <option value="">-- Pilih Tahun Ajaran --</option>

                                <option
                                    value="2025/2026"
                                    @selected($anggota->tahun_ajaran === '2025/2026')
                                >
                                    2025/2026
                                </option>

                                <option
                                    value="2026/2027"
                                    @selected($anggota->tahun_ajaran === '2026/2027')
                                >
                                    2026/2027
                                </option>

                            </select>

                        </div>


                        <!-- SEMESTER -->

                        <div class="flex items-end gap-2">

                            <div class="flex-1">

                                <label class="block font-semibold mb-2">
                                    Semester
                                </label>

                                <select
                                    name="semester[]"
                                    class="w-full border rounded-lg px-4 py-2"
                                >

                                    <option value="">-- Pilih Semester --</option>

                                    <option
                                        value="Ganjil"
                                        @selected($anggota->semester === 'Ganjil')
                                    >
                                        Ganjil
                                    </option>

                                    <option
                                        value="Genap"
                                        @selected($anggota->semester === 'Genap')
                                    >
                                        Genap
                                    </option>

                                </select>

                            </div>

                            <button
                                type="button"
                                onclick="hapusAnggota(this)"
                                class="px-3 py-2 rounded-lg bg-red-500 text-white"
                            >

                                <i class="ph ph-trash"></i>

                            </button>

                        </div>

                    </div>

                @empty

                    <!-- Belum ada anggota: sisakan satu baris kosong -->

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 anggota-row">

                        <div>

                            <label class="block font-semibold mb-2">
                                Nama Siswa
                            </label>

                            <select
                                name="siswa_id[]"
                                class="w-full border rounded-lg px-4 py-2"
                            >

                                <option value="">-- Pilih Siswa --</option>

                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_siswa }}</option>
                                @endforeach

                            </select>

                        </div>


                        <div>

                            <label class="block font-semibold mb-2">
                                Tahun Ajaran
                            </label>

                            <select
                                name="tahun_ajaran[]"
                                class="w-full border rounded-lg px-4 py-2"
                            >

                                <option value="">-- Pilih Tahun Ajaran --</option>
                                <option value="2025/2026">2025/2026</option>
                                <option value="2026/2027">2026/2027</option>

                            </select>

                        </div>


                        <div class="flex items-end gap-2">

                            <div class="flex-1">

                                <label class="block font-semibold mb-2">
                                    Semester
                                </label>

                                <select
                                    name="semester[]"
                                    class="w-full border rounded-lg px-4 py-2"
                                >

                                    <option value="">-- Pilih Semester --</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>

                                </select>

                            </div>

                            <button
                                type="button"
                                onclick="hapusAnggota(this)"
                                class="px-3 py-2 rounded-lg bg-red-500 text-white"
                            >

                                <i class="ph ph-trash"></i>

                            </button>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>


        <!-- BUTTON -->

        <div class="flex gap-3 mt-6">

            <a
                href="{{ route('rombel.index') }}"
                class="px-5 py-2 rounded-lg bg-gray-500 text-white"
            >
                <i class="ph ph-arrow-left mr-1"></i>
                Kembali
            </a>


            <button
                type="submit"
                onclick="simpanData(event)"
                class="px-5 py-2 rounded-lg bg-blue-600 text-white"
            >

                <i class="ph ph-floppy-disk mr-1"></i>

                Simpan

            </button>

        </div>

    </form>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>


/* ============================= */
/* TEMPLATE BARIS ANGGOTA ROMBEL */
/* ============================= */

const templateAnggota = `

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 anggota-row">

        <div>

            <label class="block font-semibold mb-2">
                Nama Siswa
            </label>

            <select name="siswa_id[]" class="w-full border rounded-lg px-4 py-2">

                <option value="">-- Pilih Siswa --</option>

                <option value="1">Ahmad Fauzan</option>

                <option value="2">Budi Santoso</option>

                <option value="3">Citra Lestari</option>

                <option value="4">Dimas Pratama</option>

                <option value="5">Eka Putri</option>

            </select>

        </div>


        <div>

            <label class="block font-semibold mb-2">
                Tahun Ajaran
            </label>

            <select name="tahun_ajaran[]" class="w-full border rounded-lg px-4 py-2">

                <option value="">-- Pilih Tahun Ajaran --</option>

                <option value="2025/2026">2025/2026</option>

                <option value="2026/2027">2026/2027</option>

            </select>

        </div>


        <div class="flex items-end gap-2">

            <div class="flex-1">

                <label class="block font-semibold mb-2">
                    Semester
                </label>

                <select name="semester[]" class="w-full border rounded-lg px-4 py-2">

                    <option value="">-- Pilih Semester --</option>

                    <option value="Ganjil">Ganjil</option>

                    <option value="Genap">Genap</option>

                </select>

            </div>

            <button
                type="button"
                onclick="hapusAnggota(this)"
                class="px-3 py-2 rounded-lg bg-red-500 text-white"
            >
                <i class="ph ph-trash"></i>
            </button>

        </div>

    </div>

`;


/* ============================= */
/* TAMBAH BARIS ANGGOTA */
/* ============================= */

function tambahAnggota() {

    document.getElementById('wrapper-anggota')
        .insertAdjacentHTML('beforeend', templateAnggota);

    window.scrollTo({

        top: document.body.scrollHeight,

        behavior: 'smooth'

    });

}


/* ============================= */
/* HAPUS BARIS ANGGOTA */
/* ============================= */

function hapusAnggota(tombol) {

    const baris = tombol.closest('.anggota-row');

    const jumlahBaris = document.querySelectorAll('.anggota-row').length;


    // Sisakan minimal satu baris anggota

    if (jumlahBaris <= 1) {

        baris.querySelectorAll('select').forEach(function (select) {

            select.value = "";

        });

        return;

    }


    baris.remove();

}


/* ============================= */
/* SIMPAN DATA ROMBEL */
/* ============================= */

function simpanData(event) {

    // Kirim form ke server agar tersimpan di database

    document.getElementById('formRombel').submit();

}

</script>


@endsection
