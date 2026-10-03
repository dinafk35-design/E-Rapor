@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- HEADER --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-5 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Manajemen Sistem'],
                ['label' => 'Pengguna'],
            ]" />

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10">
                    <i class="ph ph-users-three text-2xl"></i>
                </div>

                <div>
                    <h1 class="text-lg font-bold">
                        Pengguna
                    </h1>

                    <p class="mt-1 max-w-2xl text-xs leading-relaxed text-indigo-100">
                        Kelola akun pengguna, role, dan akses yang digunakan
                        untuk menjalankan sistem E-Rapor SMK.
                    </p>
                </div>

            </div>

        </div>


        {{-- RINGKASAN --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- TOTAL --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Total Pengguna
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                            {{ $users->count() }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Seluruh akun terdaftar
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50">
                        <i class="ph ph-users-three text-xl text-indigo-600"></i>
                    </div>

                </div>

            </div>


            {{-- ADMIN --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Admin
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-violet-600">
                            {{ $users->where('role', 'admin')->count() }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Pengelola sistem
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50">
                        <i class="ph ph-shield-star text-xl text-violet-600"></i>
                    </div>

                </div>

            </div>


            {{-- GURU --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Guru
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-emerald-600">
                            {{ $users->where('role', 'guru')->count() }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Akun tenaga pendidik
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50">
                        <i class="ph ph-chalkboard-teacher text-xl text-emerald-600"></i>
                    </div>

                </div>

            </div>


            {{-- SISWA --}}
            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-medium text-slate-500">
                            Siswa
                        </p>

                        <h3 class="mt-1 text-2xl font-bold text-amber-600">
                            {{ $users->where('role', 'siswa')->count() }}
                        </h3>

                        <p class="mt-1 text-[11px] text-slate-400">
                            Akun peserta didik
                        </p>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50">
                        <i class="ph ph-student text-xl text-amber-600"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- FILTER --}}
        <div class="mb-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="mb-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-sm font-bold text-slate-800">
                        Filter Pengguna
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Cari pengguna berdasarkan nama, username, email, atau role.
                    </p>
                </div>

                <span id="filterStatusPengguna"
                    class="hidden inline-flex w-fit items-center gap-1 rounded-full bg-indigo-50 px-3 py-1 text-[11px] font-semibold text-indigo-600">

                    <i class="ph ph-funnel"></i>
                    Filter aktif

                </span>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                {{-- PENCARIAN --}}
                <div>

                    <label for="filterPengguna" class="mb-2 block text-xs font-semibold text-slate-700">

                        Cari Pengguna

                    </label>

                    <div class="relative">

                        <i
                            class="ph ph-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input id="filterPengguna" type="search" placeholder="Cari nama, username, atau email..."
                            class="w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    </div>

                </div>


                {{-- ROLE --}}
                <div>

                    <label for="filterRole" class="mb-2 block text-xs font-semibold text-slate-700">

                        Role

                    </label>

                    <div class="relative">

                        <i
                            class="ph ph-shield-check pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <select id="filterRole"
                            class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-10 pr-9 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                            <option value="">
                                Semua Role
                            </option>

                            <option value="admin">
                                Admin
                            </option>

                            <option value="guru">
                                Guru
                            </option>

                            <option value="siswa">
                                Siswa
                            </option>

                        </select>

                        <i
                            class="ph ph-caret-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                    </div>

                </div>

            </div>


            {{-- RESET --}}
            <div class="mt-4 flex justify-end">

                <button type="button" onclick="resetPenggunaFilter()"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50">

                    <i class="ph ph-arrow-counter-clockwise"></i>
                    Reset Filter

                </button>

            </div>

        </div>


        {{-- TABEL --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- TABLE HEADER --}}
            <div
                class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50">
                            <i class="ph ph-users-three text-indigo-600"></i>
                        </div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Daftar Pengguna
                        </h2>

                    </div>

                    <p class="mt-1 text-xs text-slate-500">
                        Daftar akun yang dapat mengakses sistem E-Rapor.
                    </p>

                </div>


                <span id="penggunaResultCount"
                    class="inline-flex w-fit items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold text-slate-600">

                    <i class="ph ph-list-dashes"></i>
                    {{ $users->count() }} data ditampilkan

                </span>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[950px] text-left text-sm">

                    <thead class="bg-slate-50 text-[10px] uppercase tracking-wide text-slate-500">

                        <tr>

                            <th class="px-5 py-3.5 font-semibold">
                                No
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Pengguna
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Username
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Email
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Role
                            </th>

                            <th class="px-5 py-3.5 text-center font-semibold">
                                Status
                            </th>

                            <th class="px-5 py-3.5 font-semibold">
                                Diperbarui
                            </th>

                        </tr>

                    </thead>


                    <tbody id="penggunaTableBody" class="divide-y divide-slate-100">

                        @forelse ($users as $index => $user)
                            @php

                                $roleLabel = match ($user->role) {
                                    'admin' => 'Admin',

                                    'guru' => 'Guru',

                                    'siswa' => 'Siswa',

                                    default => ucfirst($user->role ?? 'Pengguna'),
                                };

                                $roleClass = match ($user->role) {
                                    'admin' => 'bg-violet-50 text-violet-700',

                                    'guru' => 'bg-emerald-50 text-emerald-700',

                                    'siswa' => 'bg-amber-50 text-amber-700',

                                    default => 'bg-slate-100 text-slate-600',
                                };

                                $roleIcon = match ($user->role) {
                                    'admin' => 'ph-shield-star',

                                    'guru' => 'ph-chalkboard-teacher',

                                    'siswa' => 'ph-student',

                                    default => 'ph-user',
                                };

                                $displayName = $user->name ?: $user->username;

                                $initials = strtoupper(substr($displayName, 0, 1));

                            @endphp


                            <tr data-user-row data-role="{{ $user->role }}"
                                data-search="{{ strtolower($displayName . ' ' . $user->username . ' ' . ($user->email ?? '')) }}"
                                class="transition hover:bg-slate-50">

                                {{-- NO --}}
                                <td class="px-5 py-4 text-xs text-slate-500">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- PENGGUNA --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">

                                            {{ $initials }}

                                        </div>


                                        <div class="min-w-0">

                                            <div class="truncate text-xs font-semibold text-slate-800">

                                                {{ $displayName }}

                                            </div>

                                            <div class="mt-0.5 text-[10px] text-slate-400">

                                                Akun pengguna E-Rapor

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- USERNAME --}}
                                <td class="px-5 py-4">

                                    <span class="text-xs font-medium text-slate-700">
                                        {{ $user->username }}
                                    </span>

                                </td>


                                {{-- EMAIL --}}
                                <td class="px-5 py-4">

                                    <span class="text-xs text-slate-600">
                                        {{ $user->email ?? '-' }}
                                    </span>

                                </td>


                                {{-- ROLE --}}
                                <td class="px-5 py-4 text-center">

                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-[11px] font-semibold {{ $roleClass }}">

                                        <i class="ph {{ $roleIcon }}"></i>

                                        {{ $roleLabel }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4 text-center">

                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-semibold text-emerald-700">

                                        <i class="ph ph-check-circle"></i>
                                        Aktif

                                    </span>

                                </td>


                                {{-- UPDATED --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-1.5 text-xs text-slate-600">

                                        <i class="ph ph-clock text-slate-400"></i>

                                        {{ $user->updated_at?->format('d M Y H:i') ?? '-' }}

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-12 text-center">

                                    <div
                                        class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">

                                        <i class="ph ph-users text-xl text-slate-400"></i>

                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-600">
                                        Belum ada data pengguna
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Belum terdapat akun pengguna yang terdaftar.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- EMPTY FILTER STATE --}}
            <div id="penggunaEmptyState" class="hidden border-t border-slate-100 px-6 py-12 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100">

                    <i class="ph ph-magnifying-glass text-xl text-slate-400"></i>

                </div>

                <p class="mt-3 text-sm font-semibold text-slate-600">
                    Pengguna tidak ditemukan
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Coba ubah kata pencarian atau role yang dipilih.
                </p>

            </div>


            {{-- FOOTER --}}
            <div class="flex justify-start border-t border-slate-100 px-5 py-4">

                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">

                    <i class="ph ph-arrow-left"></i>
                    Kembali ke Dashboard

                </a>

            </div>

        </div>

    </div>


    <script>
        const filterPengguna =
            document.getElementById('filterPengguna');

        const filterRole =
            document.getElementById('filterRole');


        function applyPenggunaFilter() {

            const query =
                filterPengguna.value
                .trim()
                .toLowerCase();

            const role =
                filterRole.value;

            const rows =
                document.querySelectorAll('[data-user-row]');

            const emptyState =
                document.getElementById(
                    'penggunaEmptyState'
                );

            const resultCount =
                document.getElementById(
                    'penggunaResultCount'
                );

            const filterStatus =
                document.getElementById(
                    'filterStatusPengguna'
                );


            let visibleRows = 0;


            rows.forEach(function(row) {

                const matchesQuery = !query ||
                    row.dataset.search.includes(query);


                const matchesRole = !role ||
                    row.dataset.role === role;


                const isVisible =
                    matchesQuery &&
                    matchesRole;


                row.classList.toggle(
                    'hidden',
                    !isVisible
                );


                if (isVisible) {
                    visibleRows++;
                }

            });


            // JUMLAH HASIL
            resultCount.innerHTML = `
            <i class="ph ph-list-dashes"></i>
            ${visibleRows} data ditampilkan
        `;


            // EMPTY STATE
            emptyState.classList.toggle(
                'hidden',
                visibleRows !== 0
            );


            // FILTER STATUS
            const filterAktif =
                query !== '' ||
                role !== '';


            filterStatus.classList.toggle(
                'hidden',
                !filterAktif
            );

        }


        function resetPenggunaFilter() {

            filterPengguna.value = '';
            filterRole.value = '';

            applyPenggunaFilter();

        }


        // PENCARIAN REALTIME
        filterPengguna.addEventListener(
            'input',
            applyPenggunaFilter
        );


        // ROLE REALTIME
        filterRole.addEventListener(
            'change',
            applyPenggunaFilter
        );


        // LOAD AWAL
        applyPenggunaFilter();
    </script>
@endsection
