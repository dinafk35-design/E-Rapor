@extends('layouts.app')
@section('content')
    <div class="content">
        <div
            class="mb-6 overflow-hidden rounded-lg bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-5 py-4 text-white shadow-sm">
            <div class="flex items-center justify-between">
                <!-- Kiri -->
                <div>
                    <p class="mb-1 text-[9px] font-bold uppercase tracking-[1.5px] text-[#aaa9d5]">
                        Ringkasan Sistem
                    </p>
                    <h1 class="text-xl font-bold leading-tight">
                        Selamat datang kembali, Admin.
                    </h1>
                    <p class="mt-1 text-xs text-[#c2c2dc]">
                        Berikut ringkasan aktivitas penilaian dan sinkronisasi data Dapodik sekolah Anda hari ini.
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- TOTAL SISWA --}}
            <div class="flex h-full items-center gap-[15px] rounded-xl border border-red-200 bg-red-100 p-5">
                <div
                    class="flex h-[55px] w-[55px] shrink-0 items-center justify-center rounded-[10px] bg-red-200 text-[22px] text-red-700">
                    <i class="ph ph-student"></i>
                </div>
                <div>
                    <div class="text-[25px] font-bold text-red-700">
                        500
                    </div>
                    <div class="text-[13px] text-red-900">
                        Total Siswa
                    </div>
                </div>
            </div>
            {{-- TOTAL GURU --}}
            <div class="flex h-full items-center gap-[15px] rounded-xl border border-green-200 bg-green-100 p-5">
                <div
                    class="flex h-[55px] w-[55px] shrink-0 items-center justify-center rounded-[10px] bg-green-200 text-[22px] text-green-700">
                    <i class="ph ph-chalkboard-teacher"></i>
                </div>
                <div>
                    <div class="text-[25px] font-bold text-green-700">
                        70
                    </div>
                    <div class="text-[13px] text-green-900">
                        Total Guru
                    </div>
                </div>
            </div>
            {{-- MATA PELAJARAN --}}
            <div class="flex h-full items-center gap-[15px] rounded-xl border border-yellow-200 bg-yellow-100 p-5">
                <div
                    class="flex h-[55px] w-[55px] shrink-0 items-center justify-center rounded-[10px] bg-yellow-200 text-[22px] text-yellow-700">
                    <i class="ph ph-book"></i>
                </div>
                <div>
                    <div class="text-[25px] font-bold text-yellow-700">
                        10
                    </div>
                    <div class="text-[13px] text-yellow-900">
                        Mata Pelajaran
                    </div>
                </div>
            </div>
            {{-- TOTAL ROMBEL --}}
            <div class="flex h-full items-center gap-[15px] rounded-xl border border-blue-200 bg-blue-100 p-5">
                <div
                    class="flex h-[55px] w-[55px] shrink-0 items-center justify-center rounded-[10px] bg-blue-200 text-[22px] text-blue-700">
                    <i class="ph ph-users-three"></i>
                </div>
                <div>
                    <div class="text-[25px] font-bold text-blue-700">
                        100
                    </div>
                    <div class="text-[13px] text-blue-900">
                        Total Rombel
                    </div>
                </div>
            </div>
        </div>
        {{-- =====================================================
         TUGAS / MENU SISTEM
    ====================================================== --}}
        <div class="my-[30px] flex items-center gap-2.5 text-[19px] font-bold text-[#193b5d]">
            <i class="ph ph-list-checks"></i>
            Menu Sistem
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- DATA SEKOLAH --}}
            <div
                class="flex h-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div
                    class="mb-4 flex h-[50px] w-[50px] items-center justify-center rounded-xl bg-blue-100 text-xl text-blue-700">
                    <i class="ph ph-graduation-cap"></i>
                </div>
                <h5 class="mb-2 text-lg font-bold text-[#193b5d]">
                    Data Sekolah
                </h5>
                <p class="mb-5 text-sm leading-6 text-gray-600">
                    Mengelola identitas dan informasi sekolah
                    yang digunakan dalam sistem E-Rapor.
                </p>
                <a href="{{ url('/data-sekolah') }}"
                    class="mt-auto inline-flex w-fit items-center justify-center rounded-lg bg-[#193b5d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#142f4a]">
                    Kelola Data
                </a>
            </div>
            {{-- DATA GURU --}}
            <div>
                <div
                    class="flex h-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div
                        class="mb-4 flex h-[50px] w-[50px] items-center justify-center rounded-xl bg-green-100 text-xl text-green-700">
                        <i class="ph ph-chalkboard-teacher"></i>
                    </div>
                    <h5 class="mb-2 text-lg font-bold text-[#193b5d]">
                        Data Guru
                    </h5>
                    <p class="mb-5 text-sm leading-6 text-gray-600">
                        Menambah, mengubah, melihat dan mengelola
                        data guru.
                    </p>
                    <a href="{{ url('/data-guru') }}"
                        class="mt-auto inline-flex w-fit items-center justify-center rounded-lg bg-[#193b5d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#142f4a]">
                        Kelola Data
                    </a>
                </div>
            </div>
            {{-- DATA SISWA --}}
            <div
                class="flex h-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div
                    class="mb-4 flex h-[50px] w-[50px] items-center justify-center rounded-xl bg-red-100 text-xl text-red-700">
                    <i class="ph ph-student"></i>
                </div>
                <h5 class="mb-2 text-lg font-bold text-[#193b5d]">
                    Data Siswa
                </h5>
                <p class="mb-5 text-sm leading-6 text-gray-600">
                    Mengelola data siswa yang terdaftar
                    pada sistem E-Rapor.
                </p>
                <a href="{{ url('/data-siswa') }}"
                    class="mt-auto inline-flex w-fit items-center justify-center rounded-lg bg-[#193b5d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#142f4a]">
                    Kelola Data
                </a>
            </div>
            {{-- MATA PELAJARAN --}}
            <div
                class="flex h-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div
                    class="mb-4 flex h-[50px] w-[50px] items-center justify-center rounded-xl bg-yellow-100 text-xl text-yellow-700">
                    <i class="ph ph-book"></i>
                </div>
                <h5 class="mb-2 text-lg font-bold text-[#193b5d]">
                    Mata Pelajaran
                </h5>
                <p class="mb-5 text-sm leading-6 text-gray-600">
                    Mengatur daftar mata pelajaran
                    yang digunakan dalam penilaian.
                </p>
                <a href="{{ url('/mata-pelajaran') }}"
                    class="mt-auto inline-flex w-fit items-center justify-center rounded-lg bg-[#193b5d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#142f4a]">
                    Kelola Data
                </a>
            </div>
            {{-- ROMBEL --}}
            <div
                class="flex h-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div
                    class="mb-4 flex h-[50px] w-[50px] items-center justify-center rounded-xl bg-purple-100 text-xl text-purple-700">
                    <i class="ph ph-users-three"></i>
                </div>
                <h5 class="mb-2 text-lg font-bold text-[#193b5d]">
                    Rombel
                </h5>
                <p class="mb-5 text-sm leading-6 text-gray-600">
                    Mengatur rombongan belajar
                    dan pembagian siswa.
                </p>
                <a href="{{ url('/rombel') }}"
                    class="mt-auto inline-flex w-fit items-center justify-center rounded-lg bg-[#193b5d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#142f4a]">
                    Kelola Data
                </a>
            </div>
            {{-- PENILAIAN --}}
            <div
                class="flex h-full flex-col rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <div
                    class="mb-4 flex h-[50px] w-[50px] items-center justify-center rounded-xl bg-orange-100 text-xl text-orange-700">
                    <i class="ph ph-pencil-simple"></i>
                </div>
                <h5 class="mb-2 text-lg font-bold text-[#193b5d]">
                    Penilaian
                </h5>
                <p class="mb-5 text-sm leading-6 text-gray-600">
                    Memantau proses input dan
                    pengelolaan nilai siswa.
                </p>
                <a href="{{ url('/penilaian') }}"
                    class="mt-auto inline-flex w-fit items-center justify-center rounded-lg bg-[#193b5d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#142f4a]">
                    Kelola Nilai
                </a>
            </div>
        </div>
        {{-- =====================================================
         AKTIVITAS SISTEM
    ====================================================== --}}
        <div class="my-[30px] flex items-center gap-2.5 text-[19px] font-bold text-[#193b5d]">
            <i class="ph ph-clock-counter-clockwise"></i>
            Aktivitas Sistem
        </div>
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white">
            {{-- AKTIVITAS LOGIN --}}
            <div class="flex items-center gap-4 border-b border-gray-100 p-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                    <i class="ph ph-user"></i>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-800">
                        {{ auth()->user()?->name ?? (auth()->user()?->username ?? 'Pengguna') }}
                        membuka Dashboard
                    </div>
                    <div class="mt-1 text-xs text-gray-500">
                        Baru saja
                    </div>
                </div>
            </div>
            {{-- AKTIVITAS SISTEM --}}
            <div class="flex items-center gap-4 border-b border-gray-100 p-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-700">
                    <i class="ph ph-database"></i>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-800">
                        Sistem E-Rapor siap digunakan
                    </div>
                    <div class="mt-1 text-xs text-gray-500">
                        Hari ini
                    </div>
                </div>
            </div>
            {{-- AKTIVITAS USER --}}
            <div class="flex items-center gap-4 p-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-purple-100 text-purple-700">
                    <i class="ph ph-shield-check"></i>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-800">
                        Pengguna saat ini:
                        {{ auth()->user()?->role ?? 'pengguna' }}
                    </div>
                    <div class="mt-1 text-xs text-gray-500">
                        Aktif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
