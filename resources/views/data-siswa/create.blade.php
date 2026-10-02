@extends('layouts.app')
@section('content')
    <!-- ============================= -->
    <!-- FORM INPUT DATA SISWA -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-student"></i>
        Input Data Siswa
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form method="POST" action="{{ route('data-siswa.store') }}" id="formSiswa">

            @csrf

            @if ($errors->any())
                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                    <i class="ph ph-warning-circle mr-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                <!-- NISN -->
                <div>

                    <label class="block font-semibold mb-2">
                        NISN
                    </label>

                    <input type="text" name="nisn" placeholder="Masukkan NISN siswa"
                        class="w-full border rounded-lg px-4 py-2">

                    @if ($errors->has('nisn'))
                        <p class="mt-1 text-sm text-red-600">
                            {{ $errors->first('nisn') }}
                        </p>
                    @endif

                </div>


                <!-- NAMA SISWA -->
                <div>

                    <label class="block font-semibold mb-2">
                        Nama Siswa
                    </label>

                    <input type="text" name="nama_siswa" placeholder="Masukkan nama siswa"
                        class="w-full border rounded-lg px-4 py-2">

                </div>


                <!-- JENIS KELAMIN -->
                <div>

                    <label class="block font-semibold mb-2">
                        Jenis Kelamin
                    </label>

                    <select name="jenis_kelamin" class="w-full border rounded-lg px-4 py-2">

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option value="L">
                            Laki-laki
                        </option>

                        <option value="P">
                            Perempuan
                        </option>

                    </select>

                </div>


                <!-- TEMPAT LAHIR -->
                <div>

                    <label class="block font-semibold mb-2">
                        Tempat Lahir
                    </label>

                    <input type="text" name="tempat_lahir" placeholder="Masukkan tempat lahir"
                        class="w-full border rounded-lg px-4 py-2">

                </div>


                <!-- TANGGAL LAHIR -->
                <div>

                    <label class="block font-semibold mb-2">
                        Tanggal Lahir
                    </label>

                    <input type="date" name="tanggal_lahir" class="w-full border rounded-lg px-4 py-2">

                </div>


                <!-- ROMBEL -->
                <div>

                    <label class="block font-semibold mb-2">
                        Rombel / Kelas
                    </label>

                    <select name="rombel_id" class="w-full border rounded-lg px-4 py-2">

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


                <!-- ALAMAT -->
                <div class="col-span-2">

                    <label class="block font-semibold mb-2">
                        Alamat
                    </label>

                    <textarea name="alamat" rows="3" placeholder="Masukkan alamat siswa" class="w-full border rounded-lg px-4 py-2"></textarea>

                </div>

            </div>


            <!-- ===================================================== -->
            <!-- DATA AKUN LOGIN -->
            <!-- ===================================================== -->

            <div class="mt-6 border-t border-gray-200 pt-5">

                <div
                    class="mb-4 flex items-start gap-2 rounded-lg border border-blue-200 bg-blue-50 p-3 text-sm text-blue-800">
                    <i class="ph ph-info mt-0.5 shrink-0"></i>
                    <p>
                        Akun login siswa dibuat otomatis dari data di atas.
                        Username default memakai NISN. Kosongkan password bila
                        ingin sistem yang menetapkannya.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <!-- USERNAME -->
                    <div>

                        <label class="mb-2 block font-semibold">
                            Username Login
                        </label>

                        <input type="text" name="username" value="{{ old('username') }}"
                            placeholder="Kosongkan untuk memakai NISN" class="w-full rounded-lg border px-4 py-2">

                        @error('username')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- PASSWORD -->
                    <div>

                        <label class="mb-2 block font-semibold">
                            Password Awal
                        </label>

                        <input type="password" name="password" placeholder="Kosongkan untuk dibuatkan sistem"
                            class="w-full rounded-lg border px-4 py-2">

                        @error('password')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- BUTTON -->

            <div class="flex gap-3 mt-6">

                <a href="{{ route('data-siswa') }}" class="px-5 py-2 rounded-lg bg-gray-500 text-white">
                    <i class="ph ph-arrow-left mr-1"></i>
                    Kembali
                </a>


                <button type="submit" onclick="simpanData(event)" class="px-5 py-2 rounded-lg bg-blue-600 text-white">

                    <i class="ph ph-floppy-disk mr-1"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>



    </div>
@endsection

<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>
    /* ============================= */
    /* EDIT DATA SISWA */
    /* ============================= */

    function editData() {

        document.querySelector(
            'input[name="nisn"]'
        ).value = "1234567890";


        document.querySelector(
            'input[name="nama_siswa"]'
        ).value = "Budi Santoso";


        document.querySelector(
            'select[name="jenis_kelamin"]'
        ).value = "L";


        document.querySelector(
            'input[name="tempat_lahir"]'
        ).value = "Palembang";


        document.querySelector(
            'input[name="tanggal_lahir"]'
        ).value = "2009-05-12";


        document.querySelector(
            'select[name="rombel_id"]'
        ).value = "3";


        document.querySelector(
            'textarea[name="alamat"]'
        ).value = "Jl. Contoh No. 10 Palembang";


        window.scrollTo({

            top: 0,

            behavior: 'smooth'

        });

    }


    /* ============================= */
    /* SIMPAN DATA SISWA */
    /* ============================= */

    function simpanData(event) {

        // Kirim form ke server agar tersimpan di database

        document.getElementById('formSiswa').submit();

    }
</script>
