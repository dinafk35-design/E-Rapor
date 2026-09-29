@extends("layouts.app")
@section("content")

<div class="content">

    <!-- ============================= -->
    <!-- FORM INPUT DATA GURU -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-chalkboard-teacher"></i>
        Edit Data Guru
    </div>


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form
            method="POST"
            action="{{ route('data-guru.update', $guru->id) }}"
            id="formGuru"
        >

            @csrf

            @method('PUT')

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
                        value="{{ old('nip', $guru->nip) }}"
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
                        value="{{ old('nik', $guru->nik) }}"
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
                        value="{{ old('nama_guru', $guru->nama_guru) }}"
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

                        <option value="">-- Pilih Jenis Kelamin --</option>

                        <option value="L" @selected(old('jenis_kelamin', $guru->jenis_kelamin) === 'L')>
                            Laki-laki
                        </option>

                        <option value="P" @selected(old('jenis_kelamin', $guru->jenis_kelamin) === 'P')>
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
                        value="{{ old('email', $guru->email) }}"
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
                        value="{{ old('no_telepon', $guru->no_telepon) }}"
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
                        value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
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
                        value="{{ old('tanggal_lahir', $guru->tanggal_lahir ? $guru->tanggal_lahir->format('Y-m-d') : '') }}"
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
                        class="w-full border rounded-lg px-4 py-2"
                    >{{ old('alamat', $guru->alamat) }}</textarea>

                </div>

            </div>


            <!-- BUTTON -->

            <div class="flex gap-3 mt-6">

                <a
                    href="{{ route('data-guru') }}"
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
