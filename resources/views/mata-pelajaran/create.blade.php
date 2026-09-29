@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Tambah Data Mata Pelajaran
        </h2>

        <p>
            Input data mata pelajaran sekaligus guru yang mengajar mata pelajaran
            tersebut pada setiap rombongan belajar.
        </p>

    </div>


    <form
        method="POST"
        action="{{ route('mata-pelajaran.store') }}"
        id="formMapel"
    >

        @csrf

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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- KODE MATA PELAJARAN -->

                <div>

                    <label class="block font-semibold mb-2">
                        Kode Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="kode_mata_pelajaran"
                        placeholder="Masukkan kode mata pelajaran"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NAMA MATA PELAJARAN -->

                <div>

                    <label class="block font-semibold mb-2">
                        Nama Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="nama_mata_pelajaran"
                        placeholder="Masukkan nama mata pelajaran"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- KELOMPOK -->

                <div>

                    <label class="block font-semibold mb-2">
                        Kelompok
                    </label>

                    <select
                        name="kelompok"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Kelompok --
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


                <!-- SEKOLAH -->

                <div>

                    <label class="block font-semibold mb-2">
                        Sekolah
                    </label>

                    <select
                        name="sekolah_id"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Sekolah --
                        </option>

                        @foreach ($sekolah as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_sekolah }}
                            </option>
                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        <!-- ============================= -->
        <!-- FORM INPUT GURU MENGAJAR -->
        <!-- ============================= -->

        <div class="section-title flex justify-between">

            <div>

                <i class="ph ph-chalkboard-teacher"></i>

                Input Guru Mengajar

            </div>

            <button
                type="button"
                onclick="tambahGuru()"
                class="bg-green-300 p-2 border border-gray-200 rounded-lg"
            >

                + Tambah Guru

            </button>

        </div>


        <div class="bg-white rounded-xl shadow p-6 mb-6">

            <div id="wrapper-guru" class="space-y-4">

                <!-- BARIS GURU 1 -->

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 guru-row">

                    <!-- GURU -->

                    <div>

                        <label class="block font-semibold mb-2">
                            Nama Guru
                        </label>

                        <select
                            name="guru_id[]"
                            class="w-full border rounded-lg px-4 py-2"
                        >

                            <option value="">
                                -- Pilih Guru --
                            </option>

                            @foreach ($guru as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_guru }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <!-- ROMBEL -->

                    <div>

                        <label class="block font-semibold mb-2">
                            Rombel
                        </label>

                        <select
                            name="rombel_id[]"
                            class="w-full border rounded-lg px-4 py-2"
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


                    <!-- TAHUN AJARAN -->

                    <div>

                        <label class="block font-semibold mb-2">
                            Tahun Ajaran
                        </label>

                        <select
                            name="tahun_ajaran[]"
                            class="w-full border rounded-lg px-4 py-2"
                        >

                            <option value="">
                                -- Pilih Tahun Ajaran --
                            </option>

                            <option value="2025/2026">
                                2025/2026
                            </option>

                            <option value="2026/2027">
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

                                <option value="">
                                    -- Pilih Semester --
                                </option>

                                <option value="Ganjil">
                                    Ganjil
                                </option>

                                <option value="Genap">
                                    Genap
                                </option>

                            </select>

                        </div>

                        <button
                            type="button"
                            onclick="hapusGuru(this)"
                            class="px-3 py-2 rounded-lg bg-red-500 text-white"
                        >

                            <i class="ph ph-trash"></i>

                        </button>

                    </div>

                </div>

            </div>

        </div>


        <!-- BUTTON -->

        <div class="flex gap-3 mt-6">

            <a
                href="{{ route('mata-pelajaran') }}"
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
/* TEMPLATE BARIS GURU MENGAJAR */
/* ============================= */

const templateGuru = `

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 guru-row">

        <div>

            <label class="block font-semibold mb-2">
                Nama Guru
            </label>

            <select name="guru_id[]" class="w-full border rounded-lg px-4 py-2">

                <option value="">-- Pilih Guru --</option>

                @foreach ($guru as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_guru }}</option>
                @endforeach

            </select>

        </div>


        <div>

            <label class="block font-semibold mb-2">
                Rombel
            </label>

            <select name="rombel_id[]" class="w-full border rounded-lg px-4 py-2">

                <option value="">-- Pilih Rombel --</option>

                @foreach ($rombel as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_rombel }}</option>
                @endforeach

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
                onclick="hapusGuru(this)"
                class="px-3 py-2 rounded-lg bg-red-500 text-white"
            >
                <i class="ph ph-trash"></i>
            </button>

        </div>

    </div>

`;


/* ============================= */
/* TAMBAH BARIS GURU */
/* ============================= */

function tambahGuru() {

    document.getElementById('wrapper-guru')
        .insertAdjacentHTML('beforeend', templateGuru);

    window.scrollTo({

        top: document.body.scrollHeight,

        behavior: 'smooth'

    });

}


/* ============================= */
/* HAPUS BARIS GURU */
/* ============================= */

function hapusGuru(tombol) {

    const baris = tombol.closest('.guru-row');

    const jumlahBaris = document.querySelectorAll('.guru-row').length;


    // Sisakan minimal satu baris guru

    if (jumlahBaris <= 1) {

        baris.querySelectorAll('select').forEach(function (select) {

            select.value = "";

        });

        return;

    }


    baris.remove();

}


/* ============================= */
/* SIMPAN DATA MATA PELAJARAN */
/* ============================= */

function simpanData(event) {

    // Kirim form ke server agar tersimpan di database

    document.getElementById('formMapel').submit();

}

</script>


@endsection
