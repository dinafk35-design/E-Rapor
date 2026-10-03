@extends('layouts.app')

@section('content')
    <div class="content">

        <!-- Header -->
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <x-breadcrumb :items="[
                        ['label' => 'Data Master'],
                        ['label' => 'Data Sekolah'],
                        ['label' => 'Tambah Data Sekolah'],
                    ]" />

                    {{-- TITLE --}}
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                            <i class="ph ph-buildings text-2xl text-white"></i>
                        </div>

                        <div>
                            <h1 class="text-xl font-bold leading-tight">
                                Tambah Data Sekolah
                            </h1>

                            <p class="mt-1 text-xs text-[#c2c2dc]">
                                Tambahkan informasi sekolah yang akan digunakan dalam sistem E-Rapor SMK.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <!-- ============================= -->
        <!-- ERROR MESSAGE -->
        <!-- ============================= -->
        @if ($errors->any())
            <div class="mb-5 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">

                <i class="ph ph-warning-circle mt-0.5 text-xl"></i>

                <div>
                    <p class="font-semibold">
                        Data belum dapat disimpan
                    </p>

                    <p class="mt-1 text-sm text-red-600">
                        {{ $errors->first() }}
                    </p>
                </div>

            </div>
        @endif


        <!-- ============================= -->
        <!-- FORM -->
        <!-- ============================= -->
        <form method="POST" action="{{ route('data-sekolah.store') }}" id="formSekolah" class="space-y-5">

            @csrf


            <!-- ============================= -->
            <!-- IDENTITAS SEKOLAH -->
            <!-- ============================= -->
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <!-- Header -->
                <div class="border-b border-gray-100 px-6 py-5">
                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <i class="ph ph-buildings text-xl"></i>
                        </div>

                        <div>
                            <h2 class="font-semibold text-gray-800">
                                Identitas Sekolah
                            </h2>

                            <p class="mt-0.5 text-sm text-gray-500">
                                Informasi dasar mengenai sekolah.
                            </p>
                        </div>

                    </div>
                </div>


                <!-- Fields -->
                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <!-- NAMA SEKOLAH -->
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Sekolah
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah') }}"
                            placeholder="Contoh: SMK Negeri 1 Palembang" required
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                        <p class="mt-1.5 text-xs text-gray-400">
                            Gunakan nama resmi sekolah sesuai dokumen administrasi.
                        </p>

                    </div>


                    <!-- NPSN -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            NPSN
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="npsn" value="{{ old('npsn') }}" placeholder="Contoh: 1060XXXX"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                        <p class="mt-1.5 text-xs text-gray-400">
                            Nomor Pokok Sekolah Nasional.
                        </p>

                    </div>


                    <!-- KODE POS -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Kode Pos
                        </label>

                        <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" placeholder="Contoh: 301XX"
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                    </div>


                    <!-- ALAMAT -->
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Alamat Sekolah
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap sekolah" required
                            class="w-full resize-none rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm leading-relaxed text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('alamat') }}</textarea>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Sertakan jalan, kecamatan, kota/kabupaten, dan informasi alamat lainnya.
                        </p>

                    </div>

                </div>

            </div>


            <!-- ============================= -->
            <!-- KEPALA SEKOLAH -->
            <!-- ============================= -->
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <!-- Header -->
                <div class="border-b border-gray-100 px-6 py-5">
                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                            <i class="ph ph-user-circle text-xl"></i>
                        </div>

                        <div>
                            <h2 class="font-semibold text-gray-800">
                                Kepala Sekolah
                            </h2>

                            <p class="mt-0.5 text-sm text-gray-500">
                                Informasi kepala sekolah yang sedang menjabat.
                            </p>
                        </div>

                    </div>
                </div>


                <!-- Fields -->
                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <!-- NAMA -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Kepala Sekolah
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="kepala_sekolah" value="{{ old('kepala_sekolah') }}"
                            placeholder="Masukkan nama kepala sekolah" required
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                    </div>


                    <!-- NIP -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            NIP Kepala Sekolah
                        </label>

                        <input type="text" name="nip_kepala_sekolah" value="{{ old('nip_kepala_sekolah') }}"
                            placeholder="Masukkan NIP kepala sekolah"
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                        <p class="mt-1.5 text-xs text-gray-400">
                            Kosongkan jika kepala sekolah tidak memiliki NIP.
                        </p>

                    </div>

                </div>

            </div>


            <!-- ============================= -->
            <!-- KONTAK SEKOLAH -->
            <!-- ============================= -->
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                <!-- Header -->
                <div class="border-b border-gray-100 px-6 py-5">
                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="ph ph-address-book text-xl"></i>
                        </div>

                        <div>
                            <h2 class="font-semibold text-gray-800">
                                Kontak Sekolah
                            </h2>

                            <p class="mt-0.5 text-sm text-gray-500">
                                Informasi yang dapat digunakan untuk menghubungi sekolah.
                            </p>
                        </div>

                    </div>
                </div>


                <!-- Fields -->
                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <!-- TELEPON -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Nomor Telepon
                        </label>

                        <div class="relative">

                            <i class="ph ph-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="text" name="telepon" value="{{ old('telepon') }}"
                                placeholder="Contoh: 0711XXXXXX"
                                class="w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-11 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                        </div>

                    </div>


                    <!-- EMAIL -->
                    <div>

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Email Sekolah
                        </label>

                        <div class="relative">

                            <i class="ph ph-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="contoh@sekolah.sch.id"
                                class="w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-11 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                        </div>

                    </div>


                    <!-- WEBSITE -->
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Website Sekolah
                        </label>

                        <div class="relative">

                            <i class="ph ph-globe absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                            <input type="text" name="website" value="{{ old('website') }}"
                                placeholder="https://www.sekolah.sch.id"
                                class="w-full rounded-xl border border-gray-200 bg-white py-2.5 pl-11 pr-4 text-sm text-gray-800 outline-none transition placeholder:text-gray-400 hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                        </div>

                        <p class="mt-1.5 text-xs text-gray-400">
                            Contoh: https://www.sekolah.sch.id
                        </p>

                    </div>

                </div>

            </div>


            <!-- ============================= -->
            <!-- ACTION BUTTON -->
            <!-- ============================= -->
            <div class="flex flex-col-reverse gap-3 pt-1 sm:flex-row sm:justify-end">

                <a href="{{ route('data-sekolah.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-5 py-2.5 text-sm font-semibold text-gray-600 shadow-sm transition hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">
                    <i class="ph ph-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-500/20 active:scale-[0.98]">
                    <i class="ph ph-floppy-disk"></i>
                    Simpan Data
                </button>

            </div>

        </form>

    </div>
@endsection
