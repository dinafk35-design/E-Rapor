@extends('layouts.app')

@section('content')

    <div class="content">

        <!-- HEADER -->
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Guru Mengajar', 'url' => route('guru-mengajar.index')],
                ['label' => 'Ganti Guru'],
            ]" />

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15">
                    <i class="ph ph-user-switch text-2xl"></i>
                </div>

                <div>

                    <h2 class="text-xl font-bold">
                        Ganti Guru Pengajar
                    </h2>

                    <p class="mt-1 text-xs text-indigo-100">
                        Ganti guru yang bertanggung jawab mengajar pada penugasan ini.
                    </p>

                </div>

            </div>

        </div>


        <!-- ALERT -->
        @if (session('status'))
            <div
                class="mb-4 flex items-start gap-2 rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-800">

                <i class="ph ph-check-circle mt-0.5 text-base"></i>

                <span>
                    {{ session('status') }}
                </span>

            </div>
        @endif


        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">

                <div class="flex items-start gap-3">

                    <i class="ph ph-warning-circle mt-0.5 text-lg"></i>

                    <div>

                        <p class="font-semibold">
                            Data belum dapat diperbarui
                        </p>

                        <p class="mt-1 text-xs">
                            {{ $errors->first() }}
                        </p>

                    </div>

                </div>

            </div>
        @endif


        <!-- INFORMASI PENUGASAN -->
        <div class="mb-6 overflow-hidden rounded-xl border border-slate-100 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-identification-card text-lg"></i>
                    </div>

                    <div>

                        <h3 class="text-sm font-bold text-slate-800">
                            Penugasan Saat Ini
                        </h3>

                        <p class="text-xs text-slate-500">
                            Informasi penugasan yang akan dipertahankan setelah pergantian guru.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2 lg:grid-cols-4">

                <!-- GURU -->
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="ph ph-user"></i>
                    </div>

                    <p class="text-[10px] uppercase tracking-wide text-slate-400">
                        Guru Saat Ini
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">
                        {{ $pengajar->guru?->nama_guru ?? '-' }}
                    </p>

                    @if ($pengajar->guru?->nip)
                        <p class="mt-1 text-[10px] text-slate-400">
                            NIP: {{ $pengajar->guru->nip }}
                        </p>
                    @endif

                </div>


                <!-- MAPEL -->
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-violet-100 text-violet-600">
                        <i class="ph ph-book-open"></i>
                    </div>

                    <p class="text-[10px] uppercase tracking-wide text-slate-400">
                        Mata Pelajaran
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">
                        {{ $pengajar->mataPelajaran?->nama_mata_pelajaran ?? '-' }}
                    </p>

                    @if ($pengajar->mataPelajaran?->kode_mata_pelajaran)
                        <span
                            class="mt-1 inline-flex rounded-md bg-white px-2 py-0.5 text-[9px] font-medium text-slate-500">
                            {{ $pengajar->mataPelajaran->kode_mata_pelajaran }}
                        </span>
                    @endif

                </div>


                <!-- ROMBEL -->
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                        <i class="ph ph-users-three"></i>
                    </div>

                    <p class="text-[10px] uppercase tracking-wide text-slate-400">
                        Rombel
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">
                        {{ $pengajar->rombel?->nama_rombel ?? '-' }}
                    </p>

                </div>


                <!-- PERIODE -->
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                        <i class="ph ph-calendar-blank"></i>
                    </div>

                    <p class="text-[10px] uppercase tracking-wide text-slate-400">
                        Periode
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-700">
                        {{ $pengajar->tahun_ajaran ?? '-' }}
                    </p>

                    <p class="mt-1 text-[10px] text-slate-400">
                        Semester {{ $pengajar->semester ?? '-' }}
                    </p>

                </div>

            </div>

        </div>


        <!-- FORM -->
        <div class="mb-6 overflow-hidden rounded-xl border border-slate-100 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-user-switch text-lg"></i>
                    </div>

                    <div>

                        <h3 class="text-sm font-bold text-slate-800">
                            Pilih Guru Pengganti
                        </h3>

                        <p class="text-xs text-slate-500">
                            Hanya guru pengajar yang akan berubah.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                @if ($pilihanGuru->isEmpty())
                    <div class="flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 p-4">

                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-amber-100 text-amber-700">
                            <i class="ph ph-warning text-base"></i>
                        </div>

                        <div>

                            <p class="text-xs font-semibold text-amber-800">
                                Tidak ada guru pengganti
                            </p>

                            <p class="mt-1 text-[11px] leading-relaxed text-amber-700">
                                Tidak ada guru lain yang tersedia untuk menggantikan guru saat ini.
                                Tambahkan data guru baru terlebih dahulu.
                            </p>

                        </div>

                    </div>
                @endif


                <form method="POST" action="{{ route('guru-mengajar.update', $pengajar->id) }}">

                    @csrf
                    @method('PUT')


                    @if ($pilihanGuru->isNotEmpty())
                        <div>

                            <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                                Guru Pengganti
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">

                                <i class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                                <select name="guru_id" required
                                    class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-9 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                                    <option value="">
                                        -- Pilih Guru Pengganti --
                                    </option>

                                    @foreach ($pilihanGuru as $guru)
                                        <option value="{{ $guru->id }}" @selected((int) old('guru_id') === $guru->id)>
                                            {{ $guru->nama_guru }}{{ $guru->nip ? ' (' . $guru->nip . ')' : '' }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <p class="mt-1.5 text-[11px] text-slate-400">
                                Guru yang dipilih akan menggantikan guru saat ini tanpa mengubah
                                mata pelajaran, rombel, tahun ajaran, atau semester.
                            </p>

                        </div>
                    @endif


                    <!-- INFO -->
                    <div class="mt-5 rounded-xl border border-indigo-100 bg-indigo-50/60 p-4">

                        <div class="flex items-start gap-3">

                            <div
                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                                <i class="ph ph-info text-base"></i>
                            </div>

                            <div>

                                <p class="text-xs font-semibold text-indigo-800">
                                    Data lainnya tetap dipertahankan
                                </p>

                                <p class="mt-1 text-[11px] leading-relaxed text-indigo-700">
                                    Pergantian hanya mengubah guru pengajar pada relasi ini.
                                    Mata Pelajaran, Rombel, Tahun Ajaran, Semester, dan data
                                    nilai siswa tidak ikut diubah.
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- ACTION -->
                    <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">

                        <a href="{{ route('guru-mengajar.index') }}"
                            class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-200">
                            <i class="ph ph-arrow-left"></i>
                            Batal
                        </a>

                        <button type="submit" @disabled($pilihanGuru->isEmpty())
                            class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-50">
                            <i class="ph ph-user-switch"></i>
                            Simpan Guru Pengganti
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
