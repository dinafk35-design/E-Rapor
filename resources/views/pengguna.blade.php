@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Pengguna
        </h2>

        <p>
            Kelola akun pengguna dan hak akses dalam sistem E-Rapor SMK.
        </p>
    </div>


    <!-- RINGKASAN -->
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-4">

        <!-- TOTAL PENGGUNA -->
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Total Pengguna
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-blue-600">
                        {{ $users->count() }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100">
                    <i class="ph ph-users text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>


        <!-- ADMIN -->
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Admin
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-indigo-600">
                        {{ $users->where('role', 'admin')->count() }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100">
                    <i class="ph ph-shield-star text-2xl text-indigo-600"></i>
                </div>
            </div>
        </div>


        <!-- GURU -->
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Guru
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-green-600">
                        {{ $users->where('role', 'guru')->count() }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                    <i class="ph ph-chalkboard-teacher text-2xl text-green-600"></i>
                </div>
            </div>
        </div>


        <!-- SISWA -->
        <div class="rounded-xl bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">
                        Siswa
                    </p>

                    <h3 class="mt-1 text-2xl font-bold text-amber-600">
                        {{ $users->where('role', 'siswa')->count() }}
                    </h3>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-100">
                    <i class="ph ph-student text-2xl text-amber-600"></i>
                </div>
            </div>
        </div>

    </div>


    <!-- FILTER -->
    <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

            <!-- PENCARIAN -->
            <div>
                <label for="filterPengguna" class="mb-2 block text-sm font-semibold text-gray-700">
                    Cari Pengguna
                </label>

                <div class="relative">
                    <i class="ph ph-magnifying-glass pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input
                        id="filterPengguna"
                        type="search"
                        placeholder="Cari nama, username, atau email..."
                        class="w-full rounded-lg border border-gray-300 py-2.5 pl-10 pr-4 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        oninput="applyPenggunaFilter()">

                </div>
            </div>


            <!-- ROLE -->
            <div>
                <label for="filterRole" class="mb-2 block text-sm font-semibold text-gray-700">
                    Role
                </label>

                <select
                    id="filterRole"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    onchange="applyPenggunaFilter()">

                    <option value="">Semua Role</option>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>

                </select>
            </div>

        </div>


        <div class="mt-5 flex flex-wrap gap-3">

            <button
                type="button"
                onclick="applyPenggunaFilter()"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                <i class="ph ph-magnifying-glass mr-1"></i>
                Tampilkan

            </button>


            <button
                type="button"
                onclick="resetPenggunaFilter()"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                Reset

            </button>

        </div>

    </div>


    <!-- TABEL PENGGUNA -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">

        <div class="flex flex-col gap-2 border-b border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-800">
                    Daftar Pengguna
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Daftar akun yang dapat mengakses sistem E-Rapor.
                </p>
            </div>

            <span id="penggunaResultCount" class="text-sm text-gray-500">
                {{ $users->count() }} data ditampilkan
            </span>
        </div>


        <div class="overflow-x-auto">
            <table class="w-full min-w-[950px] text-left text-sm">

                <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4">Diperbarui</th>
                    </tr>
                </thead>


                <tbody id="penggunaTableBody" class="divide-y divide-gray-200">
                    @forelse ($users as $index => $user)
                        @php
                            $roleLabel = match ($user->role) {
                                'admin' => 'Admin',
                                'guru' => 'Guru',
                                'siswa' => 'Siswa',
                                default => ucfirst($user->role ?? 'Pengguna'),
                            };

                            $roleClass = match ($user->role) {
                                'admin' => 'bg-indigo-100 text-indigo-700',
                                'guru' => 'bg-green-100 text-green-700',
                                'siswa' => 'bg-amber-100 text-amber-700',
                                default => 'bg-gray-100 text-gray-700',
                            };

                            $displayName = $user->name ?: $user->username;
                            $initials = strtoupper(substr($displayName, 0, 1));
                        @endphp

                        <tr
                            data-user-row
                            data-role="{{ $user->role }}"
                            data-search="{{ strtolower($displayName.' '.$user->username.' '.($user->email ?? '')) }}"
                            class="transition hover:bg-gray-50">

                            <td class="px-6 py-5">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">
                                        {{ $initials }}
                                    </div>

                                    <div>
                                        <div class="font-semibold text-gray-800">
                                            {{ $displayName }}
                                        </div>

                                        <div class="text-xs text-gray-500">
                                            Terakhir login belum tersedia
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 font-medium text-gray-700">
                                {{ $user->username }}
                            </td>

                            <td class="px-6 py-5 text-gray-600">
                                {{ $user->email ?? '-' }}
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $roleClass }}">
                                    {{ $roleLabel }}
                                </span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    <i class="ph ph-check-circle"></i>
                                    Aktif
                                </span>
                            </td>

                            <td class="px-6 py-5 text-gray-600">
                                {{ $user->updated_at?->format('d M Y H:i') ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>


        <div id="penggunaEmptyState" class="hidden px-6 py-10 text-center">
            <i class="ph ph-magnifying-glass text-3xl text-gray-400"></i>
            <p class="mt-2 text-sm text-gray-500">Pengguna tidak ditemukan.</p>
        </div>


        <div class="border-t border-gray-200 px-6 py-4">
            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center rounded-lg bg-gray-500 px-5 py-2 text-sm font-semibold text-white transition hover:bg-gray-600">

                <i class="ph ph-arrow-left mr-1"></i>
                Kembali ke Dashboard

            </a>
        </div>

    </div>

</div>

<script>
    function applyPenggunaFilter() {
        const query = document.getElementById('filterPengguna').value.trim().toLowerCase();
        const role = document.getElementById('filterRole').value;
        const rows = document.querySelectorAll('[data-user-row]');
        const emptyState = document.getElementById('penggunaEmptyState');
        const resultCount = document.getElementById('penggunaResultCount');

        let visibleRows = 0;

        rows.forEach((row) => {
            const matchesQuery = !query || row.dataset.search.includes(query);
            const matchesRole = !role || row.dataset.role === role;
            const isVisible = matchesQuery && matchesRole;

            row.classList.toggle('hidden', !isVisible);

            if (isVisible) {
                visibleRows++;
            }
        });

        emptyState.classList.toggle('hidden', visibleRows !== 0);
        resultCount.textContent = `${visibleRows} data ditampilkan`;
    }

    function resetPenggunaFilter() {
        document.getElementById('filterPengguna').value = '';
        document.getElementById('filterRole').value = '';

        applyPenggunaFilter();
    }
</script>

@endsection
