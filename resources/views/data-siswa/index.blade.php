@extends('layouts.app')
@section('content')
    <div class="content">
        <!-- HEADER -->
        <div class="welcome">
            <h2 class="italic font-bold">
                Data Siswa
            </h2>
            <p>
                Kelola data siswa yang terdaftar dalam sistem E-Rapor SMK.
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
                    <input type="text" id="searchSiswa"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        placeholder="Cari nama, NISN...">
                </div>
                <!-- JENIS KELAMIN -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Jenis Kelamin
                    </label>
                    <select id="jenisKelaminSiswa"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <!-- ROMBEL -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Rombel
                    </label>
                    <select id="rombelSiswa"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua Rombel</option>
                        @foreach ($rombelList ?? [] as $rombel)
                            <option value="{{ $rombel->id }}">{{ $rombel->nama_rombel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- TOMBOL -->
            <div class="mt-5 flex flex-wrap gap-3">
                <button type="button" onclick="filterSiswa()"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                    <i class="ph ph-magnifying-glass mr-1"></i>
                    Cari
                </button>
                <button type="button" onclick="resetFilterSiswa()"
                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                    <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                    Reset
                </button>
            </div>
        </div>

        <!-- Tabel Siswa -->
        <x-table-card title="Data Siswa" subtitle="Menampilkan daftar seluruh data siswa yang terdaftar dalam sistem."
            :createRoute="route('data-siswa.create')" :items="$siswa">
            <!-- Header Tabel -->
            <x-slot:thead>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">NISN</th>
                <th class="px-6 py-4">Nama Guru</th>
                <th class="px-6 py-4">Jenis Kelamin</th>
                <th class="px-6 py-4">Tempat Lahir</th>
                <th class="px-6 py-4">Tanggal Lahir</th>
                <th class="px-6 py-4">Rombel</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </x-slot:thead>

            <!-- Body / Isi Tabel -->
            @forelse ($siswa as $item)
                <tr class="status-row transition hover:bg-gray-50">
                    <td class="px-6 py-5">{{ $loop->iteration }}</td>
                    <td class="px-6 py-5 font-medium text-gray-700">{{ $item->nisn ?? '-' }}</td>
                    <td class="px-6 py-5">
                        <div class="font-semibold text-gray-800">{{ $item->nama_siswa }}</div>
                    </td>
                    <td class="px-6 py-5">
                        @if ($item->jenis_kelamin === 'L')
                            <span
                                class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Laki-laki</span>
                        @elseif ($item->jenis_kelamin === 'P')
                            <span
                                class="rounded-full bg-pink-100 px-3 py-1 text-xs font-semibold text-pink-700">Perempuan</span>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-gray-600">{{ $item->tempat_lahir ?? '-' }}</td>
                    <td class="px-6 py-5 text-gray-600">{{ $item->tanggal_lahir->format('d/m/Y') ?? '-' }}</td>
                    <td class="px-6 py-5 text-gray-600">{{ $item->nama_rombel ?? '-' }}</td>
                    <td class="px-6 py-5 text-center">
                        <a href="{{ route('data-siswa.edit', $item->id) }}"
                            class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                            <i class="ph ph-pencil-simple text-sm"></i>
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data siswa.
                    </td>
                </tr>
            @endforelse
        </x-table-card>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        function filterSiswa() {
            const search = document.getElementById('searchSiswa').value;
            const jenisKelamin = document.getElementById('jenisKelaminSiswa').value;
            const rombel = document.getElementById('rombelSiswa').value;
            alert("Filter diterapkan!\n\nPencarian: " + (search || "Semua") + "\nJenis Kelamin: " + (jenisKelamin || "Semua") + "\nRombel: " + (rombel || "Semua"));
            // TODO: Implement actual filtering (AJAX or form submit)
        }

        function resetFilterSiswa() {
            document.getElementById('searchSiswa').value = "";
            document.getElementById('jenisKelaminSiswa').value = "";
            document.getElementById('rombelSiswa').value = "";
            alert("Filter berhasil direset.");
        }
    </script>
@endsection
