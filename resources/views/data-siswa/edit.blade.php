@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <div>

                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => route('dashboard')],
                    ['label' => 'Data Master'],
                    ['label' => 'Data Siswa'],
                    ['label' => 'Edit Data Siswa'],
                ]" />

                <div class="mt-1 flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                        <i class="ph ph-student text-2xl"></i>
                    </div>

                    <div>
                        <h1 class="text-xl font-bold leading-tight">
                            Edit Data Siswa
                        </h1>

                        <p class="mt-1 text-xs text-[#c2c2dc]">
                            Perbarui data siswa, rombel, dan akun login dalam sistem E-Rapor SMK.
                        </p>
                    </div>

                </div>

            </div>
        </div>


        {{-- ERROR --}}
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


        <form method="POST" action="{{ route('data-siswa.update', $siswa->id) }}">

            @csrf
            @method('PUT')


            {{-- =====================================================
                IDENTITAS SISWA
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <i class="ph ph-identification-card text-xl"></i>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-slate-800">
                                Identitas Siswa
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Informasi identitas utama siswa yang terdaftar dalam sistem.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                        {{-- NISN --}}
                        <div>
                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-identification-card text-indigo-500"></i>
                                NISN
                            </label>

                            <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}"
                                placeholder="Masukkan NISN siswa"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        </div>


                        {{-- NAMA --}}
                        <div>
                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-user text-indigo-500"></i>
                                Nama Siswa
                                <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                                placeholder="Masukkan nama siswa"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        </div>


                        {{-- JENIS KELAMIN --}}
                        <div>
                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-gender-intersex text-indigo-500"></i>
                                Jenis Kelamin
                            </label>

                            <select name="jenis_kelamin"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                <option value="">-- Pilih Jenis Kelamin --</option>

                                <option value="L" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'L')>
                                    Laki-laki
                                </option>

                                <option value="P" @selected(old('jenis_kelamin', $siswa->jenis_kelamin) === 'P')>
                                    Perempuan
                                </option>

                            </select>
                        </div>


                        {{-- TEMPAT LAHIR --}}
                        <div>
                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-map-pin text-indigo-500"></i>
                                Tempat Lahir
                            </label>

                            <input type="text" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" placeholder="Masukkan tempat lahir"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        </div>


                        {{-- TANGGAL --}}
                        <div>
                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-calendar text-indigo-500"></i>
                                Tanggal Lahir
                            </label>

                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $siswa->tanggal_lahir?->format('Y-m-d')) }}"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">
                        </div>


                        {{-- ROMBEL --}}
                        <div>
                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-users-three text-indigo-500"></i>
                                Rombel / Kelas
                            </label>

                            <select name="rombel_id"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">

                                <option value="">-- Pilih Rombel --</option>

                                @foreach ($rombel as $item)
                                    <option value="{{ $item->id }}" @selected(old('rombel_id', $siswa->rombel_id) == $item->id)>
                                        {{ $item->nama_rombel }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        {{-- ALAMAT --}}
                        <div class="md:col-span-2">

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-map-pin text-indigo-500"></i>
                                Alamat
                            </label>

                            <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap siswa"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100">{{ old('alamat', $siswa->alamat) }}</textarea>

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
                                Akun Login Siswa
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Kelola akun yang digunakan siswa untuk masuk ke sistem.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6">

                    @if ($siswa->user)
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
                                    Siswa ini sudah memiliki akun login dengan username
                                    <strong>{{ $siswa->user->username }}</strong>.
                                </p>
                            </div>

                        </div>
                    @else
                        <div class="mb-5 flex items-start gap-3 rounded-xl border border-amber-100 bg-amber-50 p-4">

                            <div
                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-amber-600 shadow-sm">
                                <i class="ph ph-warning-circle text-lg"></i>
                            </div>

                            <div>
                                <p class="text-xs font-semibold text-amber-800">
                                    Siswa belum memiliki akun login
                                </p>

                                <p class="mt-1 text-xs leading-relaxed text-amber-700">
                                    Username dan password dapat digunakan untuk membuat atau
                                    menghubungkan akun login siswa.
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

                            <input type="text" name="username" value="{{ old('username', $siswa->user?->username) }}"
                                placeholder="Masukkan username"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-2 focus:ring-violet-100">

                        </div>


                        {{-- PASSWORD --}}
                        <div>

                            <label class="mb-2 flex items-center gap-1.5 text-sm font-semibold text-slate-700">
                                <i class="ph ph-lock-key text-violet-500"></i>
                                Password Baru
                            </label>

                            <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                                class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm outline-none transition placeholder:text-slate-400 focus:border-violet-400 focus:ring-2 focus:ring-violet-100">

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Kosongkan jika ingin mempertahankan password lama.
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

                <a href="{{ route('data-siswa.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">

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
