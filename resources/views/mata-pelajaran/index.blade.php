@extends('layouts.app')
@section('content')
    <div class="content">
        <!-- HEADER -->
        <div class="welcome">
            <h2 class="italic font-bold">
                Data Mata Pelajaran
            </h2>
            <p>
                Kelola data mata pelajaran beserta guru yang mengajar mata pelajaran
                tersebut pada setiap rombongan belajar dalam sistem E-Rapor SMK.
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
                    <input type="text" id="searchMapel"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        placeholder="Cari nama, kode mapel...">
                </div>
                <!-- KELOMPOK -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Kelompok
                    </label>
                    <select id="kelompokMapel"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua Kelompok</option>
                        <option value="A">Kelompok A (Normatif)</option>
                        <option value="B">Kelompok B (Adaptif)</option>
                        <option value="C">Kelompok C (Produktif)</option>
                    </select>
                </div>
                <!-- SEKOLAH -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Sekolah
                    </label>
                    <select id="sekolahMapel"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua Sekolah</option>
                        @foreach ($sekolahList ?? [] as $sekolah)
                            <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- GURU -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Guru Mengajar
                    </label>
                    <select id="guruMapel"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua Guru</option>
                        @foreach ($guruList ?? [] as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama_guru }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- TOMBOL -->
            <div class="mt-5 flex flex-wrap gap-3">
                <button type="button" onclick="filterMapel()"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                    <i class="ph ph-magnifying-glass mr-1"></i>
                    Cari
                </button>
                <button type="button" onclick="resetFilterMapel()"
                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                    <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                    Reset
                </button>
            </div>
        </div>

        <!-- Tabel Mata Pelajaran -->

        <x-table-card title="Data Mata Pelajaran"
            subtitle="Menampilkan daftar seluruh data mata pelajaran yang terdaftar dalam sistem." :createRoute="route('mata-pelajaran.create')"
            :items="$mataPelajaran">
            <!-- Header Tabel -->
            <x-slot:thead>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Kode Mata Pelajaran</th>
                <th class="px-6 py-4">Nama Mata Pelajaran</th>
                <th class="px-6 py-4">Kelompok</th>
                <th class="px-6 py-4">Sekolah</th>
                <th class="px-6 py-4">Guru Mengajar</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </x-slot:thead>

            <!-- Body / Isi Tabel -->
            @forelse ($mataPelajaran as $item)
                <tr class="status-row transition hover:bg-gray-50">
                    <td class="px-6 py-5">{{ $loop->iteration }}</td>
                    <td class="px-6 py-5">{{ $item->kode_mata_pelajaran ?? '-' }}</td>
                    <td class="px-6 py-5">{{ $item->nama_mata_pelajaran ?? '-' }}</td>
                    <td class="px-6 py-5">{{ $item->kelompok ?? '-' }}</td>
                    <td class="px-6 py-5">{{ $item->sekolah->nama_sekolah ?? '-' }}</td>
                    <td class="px-6 py-5">{{ $item->guru_mengajar ?? '-' }}</td>
                    <td class="px-6 py-5 text-center">
                        <a href="{{ route('mata-pelajaran.edit', $item->id) }}"
                            class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                            <i class="ph ph-pencil-simple text-sm"></i>
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data mata pelajaran.
                    </td>
                </tr>
            @endforelse
        </x-table-card>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        function filterMapel() {
            const search = document.getElementById('searchMapel').value;
            const kelompok = document.getElementById('kelompokMapel').value;
            const sekolah = document.getElementById('sekolahMapel').value;
            const guru = document.getElementById('guruMapel').value;
            alert("Filter diterapkan!\n\nPencarian: " + (search || "Semua") + "\nKelompok: " + (kelompok || "Semua") + "\nSekolah: " + (sekolah || "Semua") + "\nGuru: " + (guru || "Semua"));
            // TODO: Implement actual filtering (AJAX or form submit)
        }

        function resetFilterMapel() {
            document.getElementById('searchMapel').value = "";
            document.getElementById('kelompokMapel').value = "";
            document.getElementById('sekolahMapel').value = "";
            document.getElementById('guruMapel').value = "";
            alert("Filter berhasil direset.");
        }
    </script>
@endsection
