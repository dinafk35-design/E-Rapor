@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Data Rombel
        </h2>

        <p>
            Kelola data rombongan belajar beserta anggota siswa yang tergabung
            di dalamnya dalam satu halaman pada sistem E-Rapor SMK.
        </p>

    </div>


    @if (session('status'))

        <div class="mb-4 rounded-lg border border-green-300 bg-green-50 p-3 text-sm text-green-800">
            <i class="ph ph-check-circle mr-1"></i>
            {{ session('status') }}
        </div>

    @endif

    @if ($errors->any())

        <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
            <i class="ph ph-warning-circle mr-1"></i>
            {{ $errors->first() }}
        </div>

    @endif

    <!-- FILTER -->
    <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            <!-- PENCARIAN -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Pencarian
                </label>
                <input type="text" id="searchRombel"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    placeholder="Cari nama rombel...">
            </div>
            <!-- TINGKAT -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Tingkat
                </label>
                <select id="tingkatRombel"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="">Semua Tingkat</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>
            <!-- SEKOLAH -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Sekolah
                </label>
                <select id="sekolahRombel"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="">Semua Sekolah</option>
                    @foreach ($sekolahList ?? [] as $sekolah)
                        <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
                    @endforeach
                </select>
            </div>
            <!-- WALI KELAS -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Wali Kelas
                </label>
                <select id="waliRombel"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="">Semua Wali Kelas</option>
                    @foreach ($guruList ?? [] as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- TOMBOL -->
        <div class="mt-5 flex flex-wrap gap-3">
            <button type="button" onclick="filterRombel()"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                <i class="ph ph-magnifying-glass mr-1"></i>
                Cari
            </button>
            <button type="button" onclick="resetFilterRombel()"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                Reset
            </button>
        </div>
    </div>

    <!-- ============================= -->
    <!-- TABEL DATA ROMBEL -->
    <!-- ============================= -->

    <x-table-card title="Data Rombel" subtitle="Daftar rombongan belajar beserta informasi wali kelas dan jumlah siswa" createRoute="{{ route('rombel.create') }}" :items="$rombel">
        
        <x-slot name="thead">
            <th class="px-4 py-3 w-12">No</th>
            <th class="px-4 py-3">Nama Rombel</th>
            <th class="px-4 py-3">Tingkat</th>
            <th class="px-4 py-3">Sekolah</th>
            <th class="px-4 py-3">Wali Kelas</th>
            <th class="px-4 py-3 text-center">Anggota</th>
            <th class="px-4 py-3 text-center w-32">Aksi</th>
        </x-slot>

        @forelse ($rombel as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-medium">{{ $item->nama_rombel }}</td>
                <td class="px-4 py-3">{{ $item->tingkat ?? '-' }}</td>
                <td class="px-4 py-3">{{ $item->sekolah?->nama_sekolah ?? '-' }}</td>
                <td class="px-4 py-3">{{ $item->wali?->nama_guru ?? '-' }}</td>
                <td class="px-4 py-3 text-center text-gray-600">{{ $item->anggota_count }} Siswa</td>
                <td class="px-4 py-3 text-center">
                    <a href="{{ route('rombel.edit', $item->id) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-yellow-500 text-white text-xs font-medium hover:bg-yellow-600 transition">
                        <i class="ph ph-pencil-simple text-base"></i>
                        Edit
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                    Belum ada data rombel.
                </td>
            </tr>
        @endforelse

    </x-table-card>

</div>

<!-- JAVASCRIPT -->
<script>
    function filterRombel() {
        const search = document.getElementById('searchRombel').value;
        const tingkat = document.getElementById('tingkatRombel').value;
        const sekolah = document.getElementById('sekolahRombel').value;
        const wali = document.getElementById('waliRombel').value;
        alert("Filter diterapkan!\n\nPencarian: " + (search || "Semua") + "\nTingkat: " + (tingkat || "Semua") + "\nSekolah: " + (sekolah || "Semua") + "\nWali Kelas: " + (wali || "Semua"));
        // TODO: Implement actual filtering (AJAX or form submit)
    }

    function resetFilterRombel() {
        document.getElementById('searchRombel').value = "";
        document.getElementById('tingkatRombel').value = "";
        document.getElementById('sekolahRombel').value = "";
        document.getElementById('waliRombel').value = "";
        alert("Filter berhasil direset.");
    }
</script>

@endsection
