@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Tambah Data Wali Kelas
        </h2>

        <p>
            Tetapkan guru sebagai wali kelas pada suatu rombongan belajar
            beserta tahun ajaran dan semesternya.
        </p>

    </div>


    <!-- ============================= -->
    <!-- FORM INPUT WALI KELAS -->
    <!-- ============================= -->

    <div class="section-title">

        <i class="ph ph-user-circle"></i>

        Input Wali Kelas

    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ route('wali-kelas.store') }}"
            id="formWali"
        >

            @csrf

            @if ($errors->any())

                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                    <i class="ph ph-warning-circle mr-1"></i>
                    {{ $errors->first() }}
                </div>

            @endif


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- GURU -->

                <div>

                    <label class="block font-semibold mb-2">
                        Nama Guru
                    </label>

                    <select
                        name="guru_id"
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
                        name="rombel_id"
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
                        name="tahun_ajaran"
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

                <div>

                    <label class="block font-semibold mb-2">
                        Semester
                    </label>

                    <select
                        name="semester"
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

            </div>


            <!-- BUTTON -->

            <div class="flex gap-3 mt-6">

                <a
                    href="{{ route('wali-kelas') }}"
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

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>


/* ============================= */
/* SIMPAN DATA WALI KELAS */
/* ============================= */

function simpanData(event) {

    // Kirim form ke server agar tersimpan di database

    document.getElementById('formWali').submit();

}

</script>


@endsection
