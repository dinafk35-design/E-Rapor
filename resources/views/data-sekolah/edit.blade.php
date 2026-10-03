@extends('layouts.app')

@section('content')
    {{-- =====================================================
            HEADER
        ====================================================== --}}
    <div
        class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

        <div class="flex items-center justify-between gap-4">

            <div>
                <x-breadcrumb :items="[
                    ['label' => 'Data Master'],
                    ['label' => 'Data Sekolah'],
                    ['label' => 'Edit Data ' . $sekolah->nama_sekolah],
                ]" />

                {{-- TITLE --}}
                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                        <i class="ph ph-buildings text-2xl text-white"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold leading-tight">
                            Data Sekolah
                        </h1>

                        <p class="mt-1 text-xs text-[#c2c2dc]">
                            Kelola informasi sekolah yang digunakan dalam sistem E-Rapor SMK.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- FORM --}}
    <div class="mb-6 rounded-xl border border-gray-200 bg-white shadow-sm">

        {{-- FORM HEADER --}}
        <div class="border-b border-gray-100 px-5 py-5 sm:px-6">

            <div class="flex items-start gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#37367a]/10 text-[#37367a]">
                    <i class="ph ph-buildings text-xl"></i>
                </div>

                <div>
                    <h2 class="text-base font-bold text-gray-800">
                        Informasi Sekolah
                    </h2>

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Lengkapi informasi sekolah yang akan digunakan dalam
                        sistem E-Rapor dan dokumen laporan.
                    </p>
                </div>

            </div>

        </div>


        <form method="POST" action="{{ route('data-sekolah.update', $sekolah->id) }}" id="formSekolah" class="p-5 sm:p-6">

            @csrf
            @method('PUT')


            {{-- ERROR --}}
            @if ($errors->any())
                <div
                    class="mb-6 flex items-start gap-3 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">

                    <i class="ph ph-warning-circle mt-0.5 shrink-0 text-lg"></i>

                    <div>
                        <p class="font-semibold">
                            Data belum dapat disimpan
                        </p>

                        <p class="mt-1 text-xs">
                            {{ $errors->first() }}
                        </p>
                    </div>

                </div>
            @endif


            {{-- ===================================================== --}}
            {{-- IDENTITAS SEKOLAH --}}
            {{-- ===================================================== --}}

            <div class="mb-6">

                <div class="mb-4 flex items-center gap-3">

                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="ph ph-identification-card"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-gray-800">
                            Identitas Sekolah
                        </h3>

                        <p class="text-xs text-gray-500">
                            Informasi dasar dan identitas resmi sekolah.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- NAMA SEKOLAH --}}
                    <div>

                        <label for="nama_sekolah" class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Sekolah
                        </label>

                        <input type="text" id="nama_sekolah" name="nama_sekolah"
                            placeholder="Contoh: SMK Negeri 1 Palembang"
                            value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Nama resmi sekolah yang digunakan pada sistem dan dokumen E-Rapor.
                        </p>

                    </div>


                    {{-- NPSN --}}
                    <div>

                        <label for="npsn" class="mb-2 block text-sm font-semibold text-gray-700">
                            NPSN
                        </label>

                        <input type="text" id="npsn" name="npsn" placeholder="Contoh: 10604000"
                            value="{{ old('npsn', $sekolah->npsn) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Nomor Pokok Sekolah Nasional sebagai identitas unik satuan pendidikan.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- KEPALA SEKOLAH --}}
            {{-- ===================================================== --}}

            <div class="mb-6 border-t border-gray-100 pt-6">

                <div class="mb-4 flex items-center gap-3">

                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                        <i class="ph ph-user-circle"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-gray-800">
                            Pimpinan Sekolah
                        </h3>

                        <p class="text-xs text-gray-500">
                            Informasi kepala sekolah yang bertanggung jawab atas satuan pendidikan.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- KEPALA SEKOLAH --}}
                    <div>

                        <label for="kepala_sekolah" class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Kepala Sekolah
                        </label>

                        <input type="text" id="kepala_sekolah" name="kepala_sekolah"
                            placeholder="Masukkan nama kepala sekolah"
                            value="{{ old('kepala_sekolah', $sekolah->kepala_sekolah) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Masukkan nama lengkap kepala sekolah sesuai data resmi.
                        </p>

                    </div>


                    {{-- NIP --}}
                    <div>

                        <label for="nip_kepala_sekolah" class="mb-2 block text-sm font-semibold text-gray-700">
                            NIP Kepala Sekolah
                        </label>

                        <input type="text" id="nip_kepala_sekolah" name="nip_kepala_sekolah"
                            placeholder="Masukkan NIP kepala sekolah"
                            value="{{ old('nip_kepala_sekolah', $sekolah->nip_kepala_sekolah) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Nomor Induk Pegawai kepala sekolah.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- ALAMAT & KONTAK --}}
            {{-- ===================================================== --}}

            <div class="border-t border-gray-100 pt-6">

                <div class="mb-4 flex items-center gap-3">

                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-50 text-green-600">
                        <i class="ph ph-map-pin"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-gray-800">
                            Alamat & Kontak
                        </h3>

                        <p class="text-xs text-gray-500">
                            Informasi yang dapat digunakan untuk menghubungi dan menemukan sekolah.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- ALAMAT --}}
                    <div class="sm:col-span-2">

                        <label for="alamat" class="mb-2 block text-sm font-semibold text-gray-700">
                            Alamat Sekolah
                        </label>

                        <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap sekolah"
                            class="w-full resize-none rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">{{ old('alamat', $sekolah->alamat) }}</textarea>

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Masukkan alamat lengkap sekolah beserta nama jalan dan wilayah jika diperlukan.
                        </p>

                    </div>


                    {{-- TELEPON --}}
                    <div>

                        <label for="telepon" class="mb-2 block text-sm font-semibold text-gray-700">
                            Nomor Telepon
                        </label>

                        <div class="relative">

                            <i class="ph ph-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="text" id="telepon" name="telepon" placeholder="Contoh: 0711xxxxxx"
                                value="{{ old('telepon', $sekolah->telepon) }}"
                                class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        </div>

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Nomor telepon resmi sekolah.
                        </p>

                    </div>


                    {{-- EMAIL --}}
                    <div>

                        <label for="email" class="mb-2 block text-sm font-semibold text-gray-700">
                            Email Sekolah
                        </label>

                        <div class="relative">

                            <i class="ph ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="email" id="email" name="email" placeholder="contoh@sekolah.sch.id"
                                value="{{ old('email', $sekolah->email) }}"
                                class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        </div>

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Alamat email resmi sekolah.
                        </p>

                    </div>


                    {{-- WEBSITE --}}
                    <div>

                        <label for="website" class="mb-2 block text-sm font-semibold text-gray-700">
                            Website
                        </label>

                        <div class="relative">

                            <i class="ph ph-globe absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="text" id="website" name="website" placeholder="https://www.sekolah.sch.id"
                                value="{{ old('website', $sekolah->website) }}"
                                class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        </div>

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Alamat website resmi sekolah jika tersedia.
                        </p>

                    </div>


                    {{-- KODE POS --}}
                    <div>

                        <label for="kode_pos" class="mb-2 block text-sm font-semibold text-gray-700">
                            Kode Pos
                        </label>

                        <div class="relative">

                            <i class="ph ph-map-pin-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="text" id="kode_pos" name="kode_pos" placeholder="Contoh: 301xx"
                                value="{{ old('kode_pos', $sekolah->kode_pos) }}"
                                class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 focus:border-[#5148b8] focus:ring-2 focus:ring-[#5148b8]/20">

                        </div>

                        <p class="mt-1.5 text-[11px] text-gray-400">
                            Kode pos lokasi sekolah.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- ACTION --}}
            {{-- ===================================================== --}}

            <div class="mt-7 flex flex-wrap items-center justify-between gap-3 border-t border-gray-100 pt-5">

                <p class="text-xs text-gray-400">
                    <i class="ph ph-info mr-1"></i>
                    Pastikan informasi sekolah sudah benar sebelum menyimpan.
                </p>


                <div class="flex gap-3">

                    <a href="{{ route('data-sekolah.index') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-600">

                        <i class="ph ph-arrow-left"></i>

                        Kembali

                    </a>


                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-[#37367a] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#25284d]">

                        <i class="ph ph-floppy-disk"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </form>

    </div>
@endsection


<script>
    function simpanData(event) {

        document.getElementById('formSekolah').submit();

    }
</script>
