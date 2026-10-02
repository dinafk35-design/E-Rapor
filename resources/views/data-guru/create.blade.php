@extends("layouts.app")
@section("content")

<div class="content">

    <!-- ============================= -->
    <!-- FORM INPUT DATA GURU -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-chalkboard-teacher"></i>
        Input Data Guru
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ route('data-guru.store') }}"
            id="formGuru"
        >

            @csrf

            @if ($errors->any())

                <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                    <i class="ph ph-warning-circle mr-1"></i>
                    {{ $errors->first() }}
                </div>

            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- NIP -->

                <div>

                    <label class="block font-semibold mb-2">
                        NIP
                    </label>

                    <input
                        type="text"
                        name="nip"
                        value="{{ old('nip') }}"
                        placeholder="Masukkan NIP guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NIK -->

                <div>

                    <label class="block font-semibold mb-2">
                        NIK
                    </label>

                    <input
                        type="text"
                        name="nik"
                        value="{{ old('nik') }}"
                        placeholder="Masukkan NIK guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NAMA GURU -->

                <div>

                    <label class="block font-semibold mb-2">
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        name="nama_guru"
                        value="{{ old('nama_guru') }}"
                        placeholder="Masukkan nama guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- JENIS KELAMIN -->

                <div>

                    <label class="block font-semibold mb-2">
                        Jenis Kelamin
                    </label>

                    <select
                        name="jenis_kelamin"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option value="L" @selected(old('jenis_kelamin') === 'L')>
                            Laki-laki
                        </option>

                        <option value="P" @selected(old('jenis_kelamin') === 'P')>
                            Perempuan
                        </option>

                    </select>

                </div>


                <!-- EMAIL -->

                <div>

                    <label class="block font-semibold mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- NO TELEPON -->

                <div>

                    <label class="block font-semibold mb-2">
                        No. Telepon
                    </label>

                    <input
                        type="text"
                        name="no_telepon"
                        value="{{ old('no_telepon') }}"
                        placeholder="Masukkan nomor telepon"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- TEMPAT LAHIR -->

                <div>

                    <label class="block font-semibold mb-2">
                        Tempat Lahir
                    </label>

                    <input
                        type="text"
                        name="tempat_lahir"
                        value="{{ old('tempat_lahir') }}"
                        placeholder="Masukkan tempat lahir"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- TANGGAL LAHIR -->

                <div>

                    <label class="block font-semibold mb-2">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tanggal_lahir"
                        value="{{ old('tanggal_lahir') }}"
                        class="w-full border rounded-lg px-4 py-2"
                    >

                </div>


                <!-- ALAMAT -->

                <div class="col-span-2">

                    <label class="block font-semibold mb-2">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        rows="3"
                        placeholder="Masukkan alamat guru"
                        class="w-full border rounded-lg px-4 py-2"
                    >{{ old('alamat') }}</textarea>

                </div>

            </div>


            <!-- ===================================================== -->
            <!-- DATA AKUN LOGIN -->
            <!-- ===================================================== -->

            <div class="mt-6 border-t border-gray-200 pt-5">

                <div class="mb-4 flex items-start gap-2 rounded-lg border border-blue-200 bg-blue-50 p-3 text-sm text-blue-800">
                    <i class="ph ph-info mt-0.5 shrink-0"></i>
                    <p>
                        Akun login guru dibuat otomatis dari data di atas.
                        Username default memakai NIP, dan email guru ikut
                        dipakai sebagai email akun. Kosongkan password bila
                        ingin sistem yang menetapkannya.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                    <!-- USERNAME -->
                    <div>

                        <label class="mb-2 block font-semibold">
                            Username Login
                        </label>

                        <input
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="Kosongkan untuk memakai NIP"
                            class="w-full rounded-lg border px-4 py-2"
                        >

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

                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan untuk dibuatkan sistem"
                            class="w-full rounded-lg border px-4 py-2"
                        >

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

                <a
                    href="{{ route('data-guru.index') }}"
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


function simpanData(event) {

    // Kirim form ke server agar tersimpan di database

    document.getElementById('formGuru').submit();

}

</script>


@endsection
