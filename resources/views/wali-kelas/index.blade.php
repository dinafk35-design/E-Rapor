@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Wali Kelas
        </h2>

        <p>
            Kelola data guru yang ditugaskan sebagai wali kelas pada setiap
            rombongan belajar dalam sistem E-Rapor SMK.
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
                <input type="text" id="searchWaliKelas"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    placeholder="Cari nama guru...">
            </div>
            <!-- ROMBEL -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Rombel
                </label>
                <select id="rombelWaliKelas"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="">Semua Rombel</option>
                    @foreach ($rombelList ?? [] as $rombel)
                        <option value="{{ $rombel->id }}">{{ $rombel->nama_rombel }}</option>
                    @endforeach
                </select>
            </div>
            <!-- TAHUN AJARAN -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Tahun Ajaran
                </label>
                <select id="tahunAjaranWaliKelas"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="">Semua Tahun Ajaran</option>
                    <option value="2025/2026">2025/2026</option>
                    <option value="2026/2027">2026/2027</option>
                    <option value="2027/2028">2027/2028</option>
                </select>
            </div>
            <!-- SEMESTER -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Semester
                </label>
                <select id="semesterWaliKelas"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <option value="">Semua Semester</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>
        </div>
        <!-- TOMBOL -->
        <div class="mt-5 flex flex-wrap gap-3">
            <button type="button" onclick="filterWaliKelas()"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                <i class="ph ph-magnifying-glass mr-1"></i>
                Cari
            </button>
            <button type="button" onclick="resetFilterWaliKelas()"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                Reset
            </button>
        </div>
    </div>

    <!-- ============================= -->
    <!-- TABEL DATA WALI KELAS -->
    <!-- ============================= -->

    <x-table-card title="Data Wali Kelas" subtitle="Daftar guru yang ditugaskan sebagai wali kelas pada rombongan belajar" createRoute="{{ route('wali-kelas.create') }}" :items="$waliKelas">
        
        <x-slot name="thead">
            <th class="px-4 py-3 w-12">No</th>
            <th class="px-4 py-3">Nama Guru</th>
            <th class="px-4 py-3">Rombel</th>
            <th class="px-4 py-3">Tahun Ajaran</th>
            <th class="px-4 py-3">Semester</th>
            <th class="px-4 py-3 text-center w-32">Aksi</th>
        </x-slot>

        @forelse ($waliKelas as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-4 py-3 font-medium">{{ $item->guru?->nama_guru ?? '-' }}</td>
                <td class="px-4 py-3">{{ $item->rombel?->nama_rombel ?? '-' }}</td>
                <td class="px-4 py-3">{{ $item->tahun_ajaran ?? '-' }}</td>
                <td class="px-4 py-3">{{ $item->semester ?? '-' }}</td>
                <td class="px-4 py-3 text-center">
                    <a href="{{ route('wali-kelas.edit', $item->id) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-yellow-500 text-white text-xs font-medium hover:bg-yellow-600 transition">
                        <i class="ph ph-pencil-simple text-base"></i>
                        Edit
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                    Belum ada data wali kelas.
                </td>
            </tr>
        @endforelse

    </x-table-card>

</div>

<!-- JAVASCRIPT -->
<script>
    function filterWaliKelas() {
        const search = document.getElementById('searchWaliKelas').value;
        const rombel = document.getElementById('rombelWaliKelas').value;
        const tahunAjaran = document.getElementById('tahunAjaranWaliKelas').value;
        const semester = document.getElementById('semesterWaliKelas').value;
        alert("Filter diterapkan!\n\nPencarian: " + (search || "Semua") + "\nRombel: " + (rombel || "Semua") + "\nTahun Ajaran: " + (tahunAjaran || "Semua") + "\nSemester: " + (semester || "Semua"));
        // TODO: Implement actual filtering (AJAX or form submit)
    }

    function resetFilterWaliKelas() {
        document.getElementById('searchWaliKelas').value = "";
        document.getElementById('rombelWaliKelas').value = "";
        document.getElementById('tahunAjaranWaliKelas').value = "";
        document.getElementById('semesterWaliKelas').value = "";
        alert("Filter berhasil direset.");
    }
</script>

@endsection
