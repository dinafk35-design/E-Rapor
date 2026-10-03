@extends('layouts.app')

@section('content')
    <div class="content">

        <!-- HEADER -->
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Wali Kelas', 'url' => route('wali-kelas')],
                ['label' => 'Edit Data'],
            ]" />

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15">
                    <i class="ph ph-user-circle-gear text-2xl"></i>
                </div>

                <div>
                    <h2 class="text-xl font-bold">
                        Edit Data Wali Kelas
                    </h2>

                    <p class="mt-1 text-xs text-indigo-100">
                        Perbarui penugasan guru sebagai wali kelas pada rombongan belajar.
                    </p>
                </div>

            </div>

        </div>


        <!-- ERROR -->
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


        <form method="POST" action="{{ route('wali-kelas.update', $waliKelas->id) }}" id="formWali">

            @csrf
            @method('PUT')


            <!-- RINGKASAN -->
            <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-user"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-[10px] uppercase tracking-wide text-slate-400">
                                Guru
                            </p>

                            <p class="truncate text-xs font-semibold text-slate-700">
                                {{ $waliKelas->guru?->nama_guru ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 text-violet-600">
                            <i class="ph ph-users-three"></i>
                        </div>

                        <div class="min-w-0">
                            <p class="text-[10px] uppercase tracking-wide text-slate-400">
                                Rombel
                            </p>

                            <p class="truncate text-xs font-semibold text-slate-700">
                                {{ $waliKelas->rombel?->nama_rombel ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                            <i class="ph ph-calendar-blank"></i>
                        </div>

                        <div>
                            <p class="text-[10px] uppercase tracking-wide text-slate-400">
                                Tahun Ajaran
                            </p>

                            <p class="text-xs font-semibold text-slate-700">
                                {{ $waliKelas->tahun_ajaran ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="rounded-xl border border-slate-100 bg-white p-4 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="ph ph-check-circle"></i>
                        </div>

                        <div>
                            <p class="text-[10px] uppercase tracking-wide text-slate-400">
                                Semester
                            </p>

                            <p class="text-xs font-semibold text-slate-700">
                                {{ $waliKelas->semester ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            <!-- FORM -->
            <div class="mb-6 overflow-hidden rounded-xl border border-slate-100 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="ph ph-pencil-simple text-lg"></i>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-800">
                                Informasi Penugasan
                            </h3>

                            <p class="text-xs text-slate-500">
                                Perbarui guru, rombel, tahun ajaran, atau semester.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    <!-- GURU -->
                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Nama Guru
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="guru_id"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-9 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Guru --
                                </option>

                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}" @selected(old('guru_id', $waliKelas->guru_id) == $item->id)>
                                        {{ $item->nama_guru }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Guru yang ditetapkan sebagai wali kelas.
                        </p>

                    </div>


                    <!-- ROMBEL -->
                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Rombel
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-users-three absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="rombel_id"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-9 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Rombel --
                                </option>

                                @foreach ($rombel as $item)
                                    <option value="{{ $item->id }}" @selected(old('rombel_id', $waliKelas->rombel_id) == $item->id)>
                                        {{ $item->nama_rombel }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Rombongan belajar tempat guru menjalankan tugas wali kelas.
                        </p>

                    </div>


                    <!-- TAHUN AJARAN -->
                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Tahun Ajaran
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-calendar-blank absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="tahun_ajaran"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-9 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Tahun Ajaran --
                                </option>

                                <option value="2025/2026" @selected(old('tahun_ajaran', $waliKelas->tahun_ajaran) === '2025/2026')>
                                    2025/2026
                                </option>

                                <option value="2026/2027" @selected(old('tahun_ajaran', $waliKelas->tahun_ajaran) === '2026/2027')>
                                    2026/2027
                                </option>

                            </select>

                        </div>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Periode akademik penugasan wali kelas.
                        </p>

                    </div>


                    <!-- SEMESTER -->
                    <div>

                        <label class="mb-1.5 block text-xs font-semibold text-slate-700">
                            Semester
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-calendar absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <select name="semester"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-slate-50 px-9 py-2.5 text-sm outline-none transition focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Semester --
                                </option>

                                <option value="Ganjil" @selected(old('semester', $waliKelas->semester) === 'Ganjil')>
                                    Ganjil
                                </option>

                                <option value="Genap" @selected(old('semester', $waliKelas->semester) === 'Genap')>
                                    Genap
                                </option>

                            </select>

                        </div>

                        <p class="mt-1.5 text-[11px] text-slate-400">
                            Semester saat penugasan wali kelas berlaku.
                        </p>

                    </div>

                </div>

            </div>


            <!-- INFO -->
            <div class="mb-6 rounded-xl border border-indigo-100 bg-indigo-50/60 p-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                        <i class="ph ph-info text-base"></i>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-indigo-800">
                            Periksa Kembali Data
                        </p>

                        <p class="mt-1 text-[11px] leading-relaxed text-indigo-700">
                            Pastikan kombinasi guru, rombel, tahun ajaran, dan semester
                            sudah sesuai sebelum menyimpan perubahan.
                        </p>
                    </div>

                </div>

            </div>


            <!-- ACTION -->
            <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">

                <a href="{{ route('wali-kelas') }}"
                    class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-slate-100 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-200">
                    <i class="ph ph-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-1.5 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i class="ph ph-floppy-disk"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>
@endsection
