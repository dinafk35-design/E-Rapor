```blade
@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div>

                    {{-- BREADCRUMB --}}
                    <x-breadcrumb :items="[
                        ['label' => 'Dashboard', 'url' => route('dashboard')],
                        ['label' => 'Data Master'],
                        ['label' => 'Data Guru'],
                        ['label' => 'Tambah Data Guru'],
                    ]" />

                    {{-- TITLE --}}
                    <div class="mt-1 flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                            <i class="ph ph-chalkboard-teacher text-2xl text-white"></i>
                        </div>

                        <div>
                            <h1 class="text-xl font-bold leading-tight">
                                Tambah Data Guru
                            </h1>

                            <p class="mt-1 text-xs text-[#c2c2dc]">
                                Tambahkan data guru dan akun login yang akan digunakan dalam sistem E-Rapor SMK.
                            </p>
                        </div>

                    </div>

                </div>

            </div>
        </div>


        {{-- =====================================================
            ERROR
        ====================================================== --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-sm">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <i class="ph ph-warning-circle text-lg"></i>
                    </div>

                    <div>
                        <p class="font-semibold">
                            Data belum dapat disimpan
                        </p>

                        <p class="mt-1 text-xs text-red-600">
                            Periksa kembali data yang diisi pada formulir.
                        </p>

                        <ul class="mt-2 list-inside list-disc text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        @endif


        {{-- =====================================================
            FORM
        ====================================================== --}}
        <form method="POST" action="{{ route('data-guru.store') }}" id="formGuru">

            @csrf


            {{-- =====================================================
                DATA IDENTITAS
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

                {{-- SECTION HEADER --}}
                <div class="border-b border-slate-100 px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <i class="ph ph-identification-card text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Identitas Guru
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Informasi identitas utama guru yang akan terdaftar dalam sistem.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- FORM CONTENT --}}
                <div class="p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- NIP --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                NIP
                            </label>

                            <div class="relative">

                                <i
                                    class="ph ph-identification-card absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" name="nip" value="{{ old('nip') }}"
                                    placeholder="Masukkan NIP guru"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Nomor Induk Pegawai guru.
                            </p>

                            @error('nip')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- NIK --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                NIK
                            </label>

                            <div class="relative">

                                <i class="ph ph-cardholder absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" name="nik" value="{{ old('nik') }}"
                                    placeholder="Masukkan NIK guru"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Nomor Induk Kependudukan guru.
                            </p>

                            @error('nik')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- NAMA --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Nama Lengkap Guru
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">

                                <i class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" name="nama_guru" value="{{ old('nama_guru') }}"
                                    placeholder="Contoh: Budi Santoso, S.Pd." required
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Masukkan nama lengkap beserta gelar jika ada.
                            </p>

                            @error('nama_guru')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- JENIS KELAMIN --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Jenis Kelamin
                            </label>

                            <div class="relative">

                                <i class="ph ph-gender-intersex absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <select name="jenis_kelamin"
                                    class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-9 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        Pilih jenis kelamin
                                    </option>

                                    <option value="L" @selected(old('jenis_kelamin') === 'L')>
                                        Laki-laki
                                    </option>

                                    <option value="P" @selected(old('jenis_kelamin') === 'P')>
                                        Perempuan
                                    </option>

                                </select>

                                <i
                                    class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                            </div>

                            @error('jenis_kelamin')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                DATA KONTAK & KELAHIRAN
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

                {{-- SECTION HEADER --}}
                <div class="border-b border-slate-100 px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <i class="ph ph-address-book text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Informasi Kontak & Kelahiran
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Lengkapi informasi kontak dan data kelahiran guru.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- EMAIL --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Email
                            </label>

                            <div class="relative">

                                <i class="ph ph-envelope absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="guru@sekolah.sch.id"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Email dapat digunakan untuk akun login guru.
                            </p>

                            @error('email')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- TELEPON --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                No. Telepon
                            </label>

                            <div class="relative">

                                <i class="ph ph-phone absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Nomor telepon atau WhatsApp guru.
                            </p>

                            @error('no_telepon')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- TEMPAT LAHIR --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Tempat Lahir
                            </label>

                            <div class="relative">

                                <i class="ph ph-map-pin absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                    placeholder="Contoh: Palembang"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            @error('tempat_lahir')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- TANGGAL LAHIR --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Tanggal Lahir
                            </label>

                            <div class="relative">

                                <i class="ph ph-calendar absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            @error('tanggal_lahir')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- ALAMAT --}}
                        <div class="md:col-span-2">

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Alamat
                            </label>

                            <div class="relative">

                                <i class="ph ph-map-pin absolute left-3 top-3 text-slate-400">
                                </i>

                                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap guru"
                                    class="w-full resize-none rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">{{ old('alamat') }}</textarea>

                            </div>

                            @error('alamat')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                AKUN LOGIN
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

                {{-- SECTION HEADER --}}
                <div class="border-b border-slate-100 px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                            <i class="ph ph-user-circle text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Akun Login Guru
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Tentukan kredensial yang digunakan guru untuk masuk ke sistem.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    {{-- INFO --}}
                    <div class="mb-5 flex items-start gap-3 rounded-xl border border-indigo-100 bg-indigo-50 p-4">

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-indigo-600 shadow-sm">
                            <i class="ph ph-info"></i>
                        </div>

                        <div>

                            <p class="text-xs font-semibold text-indigo-800">
                                Informasi akun
                            </p>

                            <p class="mt-1 text-xs leading-relaxed text-indigo-700">
                                Akun login dapat dibuat bersamaan dengan data guru.
                                Jika username dikosongkan, sistem akan menggunakan
                                <strong>NIP</strong> sebagai username.
                                Password juga dapat dikosongkan agar sistem menentukan
                                password awal sesuai aturan aplikasi.
                            </p>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- USERNAME --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Username Login
                            </label>

                            <div class="relative">

                                <i class="ph ph-user-circle absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="text" name="username" value="{{ old('username') }}"
                                    placeholder="Kosongkan untuk menggunakan NIP"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            @error('username')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- PASSWORD --}}
                        <div>

                            <label class="mb-2 block text-xs font-semibold text-slate-600">
                                Password Awal
                            </label>

                            <div class="relative">

                                <i class="ph ph-lock-key absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                </i>

                                <input type="password" name="password" placeholder="Kosongkan untuk dibuatkan sistem"
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                            </div>

                            @error('password')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                ACTION
            ====================================================== --}}
            <div
                class="flex flex-col-reverse gap-3 rounded-xl bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">

                <a href="{{ route('data-guru.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-800">

                    <i class="ph ph-arrow-left"></i>

                    Kembali

                </a>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-200">

                    <i class="ph ph-floppy-disk"></i>

                    Simpan Data Guru

                </button>

            </div>

        </form>

    </div>
@endsection
```
