@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <div>
                {{-- BREADCRUMB --}}
                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => route('dashboard')],
                    ['label' => 'Data Master'],
                    ['label' => 'Data Guru'],
                    ['label' => 'Edit Data Guru'],
                ]" />

                {{-- TITLE --}}
                <div class="mt-1 flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                        <i class="ph ph-chalkboard-teacher text-2xl text-white"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold leading-tight">
                            Edit Data Guru
                        </h1>

                        <p class="mt-1 text-xs text-[#c2c2dc]">
                            Perbarui informasi data guru dan akun login dalam sistem E-Rapor SMK.
                        </p>
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
                            Data belum dapat diperbarui
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


        <form method="POST" action="{{ route('data-guru.update', $guru->id) }}" id="formGuru">

            @csrf
            @method('PUT')


            {{-- =====================================================
                IDENTITAS GURU
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

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
                                Informasi identitas utama guru yang terdaftar dalam sistem.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- NIP --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-identification-card text-indigo-500"></i>
                                NIP
                            </label>

                            <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}"
                                placeholder="Masukkan NIP guru"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Nomor Induk Pegawai guru.
                            </p>

                        </div>


                        {{-- NIK --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-cardholder text-indigo-500"></i>
                                NIK
                            </label>

                            <input type="text" name="nik" value="{{ old('nik', $guru->nik) }}"
                                placeholder="Masukkan NIK guru"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Nomor Induk Kependudukan guru.
                            </p>

                        </div>


                        {{-- NAMA --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-user text-indigo-500"></i>
                                Nama Guru
                                <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="nama_guru" value="{{ old('nama_guru', $guru->nama_guru) }}"
                                placeholder="Contoh: Budi Santoso, S.Pd."
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Nama lengkap beserta gelar jika ada.
                            </p>

                        </div>


                        {{-- JENIS KELAMIN --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-gender-intersex text-indigo-500"></i>
                                Jenis Kelamin
                            </label>

                            <select name="jenis_kelamin"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Jenis Kelamin --
                                </option>

                                <option value="L" @selected(old('jenis_kelamin', $guru->jenis_kelamin) === 'L')>
                                    Laki-laki
                                </option>

                                <option value="P" @selected(old('jenis_kelamin', $guru->jenis_kelamin) === 'P')>
                                    Perempuan
                                </option>

                            </select>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Pilih jenis kelamin guru.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                INFORMASI KONTAK & KELAHIRAN
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

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
                                Perbarui informasi kontak dan data kelahiran guru.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- EMAIL --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-envelope text-emerald-500"></i>
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email', $guru->email) }}"
                                placeholder="guru@example.com"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Email yang dapat digunakan untuk komunikasi.
                            </p>

                        </div>


                        {{-- TELEPON --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-phone text-emerald-500"></i>
                                No. Telepon
                            </label>

                            <input type="text" name="no_telepon" value="{{ old('no_telepon', $guru->no_telepon) }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Nomor telepon atau WhatsApp guru.
                            </p>

                        </div>


                        {{-- TEMPAT LAHIR --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-map-pin text-emerald-500"></i>
                                Tempat Lahir
                            </label>

                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $guru->tempat_lahir) }}"
                                placeholder="Masukkan tempat lahir"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Kota atau kabupaten tempat guru lahir.
                            </p>

                        </div>


                        {{-- TANGGAL LAHIR --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-calendar text-emerald-500"></i>
                                Tanggal Lahir
                            </label>

                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $guru->tanggal_lahir ? $guru->tanggal_lahir->format('Y-m-d') : '') }}"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Tanggal lahir guru.
                            </p>

                        </div>


                        {{-- ALAMAT --}}
                        <div class="md:col-span-2">

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-map-pin text-emerald-500"></i>
                                Alamat
                            </label>

                            <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap guru"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">{{ old('alamat', $guru->alamat) }}</textarea>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Alamat tempat tinggal guru.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                AKUN LOGIN
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

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
                                Kelola akun yang digunakan guru untuk masuk ke sistem.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    @if ($guru->user)
                        {{-- AKUN TERHUBUNG --}}
                        <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-100 bg-emerald-50 p-4">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-emerald-600 shadow-sm">
                                <i class="ph ph-check-circle text-lg"></i>
                            </div>

                            <div>
                                <p class="text-xs font-semibold text-emerald-800">
                                    Akun login terhubung
                                </p>

                                <p class="mt-1 text-xs leading-relaxed text-emerald-700">
                                    Guru ini sudah memiliki akun login dengan username
                                    <strong>{{ $guru->user->username }}</strong>.
                                </p>
                            </div>

                        </div>
                    @else
                        {{-- BELUM ADA AKUN --}}
                        <div class="mb-5 flex items-start gap-3 rounded-xl border border-amber-100 bg-amber-50 p-4">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-amber-600 shadow-sm">
                                <i class="ph ph-warning-circle text-lg"></i>
                            </div>

                            <div>
                                <p class="text-xs font-semibold text-amber-800">
                                    Guru belum memiliki akun login
                                </p>

                                <p class="mt-1 text-xs leading-relaxed text-amber-700">
                                    Jika username dan password diisi, akun login dapat
                                    dibuat atau dihubungkan dengan data guru ini.
                                </p>
                            </div>

                        </div>
                    @endif


                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- USERNAME --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-user-circle text-violet-500"></i>
                                Username Login
                            </label>

                            <input type="text" name="username" value="{{ old('username', $guru->user?->username) }}"
                                placeholder="Masukkan username"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-2 focus:ring-violet-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Username yang digunakan untuk login ke sistem.
                            </p>

                        </div>


                        {{-- PASSWORD --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-lock-key text-violet-500"></i>
                                Password Baru
                            </label>

                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                                class="w-full rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-2 focus:ring-violet-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Kosongkan apabila password lama tetap digunakan.
                            </p>

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
                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>
@endsection
