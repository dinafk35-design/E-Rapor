@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- HEADER -->
        <div class="welcome">
            <h2 class="italic font-bold">
                Data Guru
            </h2>
            <p>
                Kelola data guru yang terdaftar dalam sistem E-Rapor SMK.
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
                    <input type="text" id="searchGuru"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        placeholder="Cari nama, NIP, NIK...">
                </div>
                <!-- JENIS KELAMIN -->
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Jenis Kelamin
                    </label>
                    <select id="jenisKelaminGuru"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <!-- TOMBOL -->
            <div class="mt-5 flex flex-wrap gap-3">
                <button type="button" onclick="filterGuru()"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                    <i class="ph ph-magnifying-glass mr-1"></i>
                    Cari
                </button>
                <button type="button" onclick="resetFilterGuru()"
                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                    <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                    Reset
                </button>
            </div>
        </div>

        <!-- Table Guru -->
        <x-table-card title="Data Guru" subtitle="Menampilkan daftar seluruh data guru yang terdaftar dalam sistem."
            :createRoute="route('data-guru.create')" :items="$guru">
            <!-- Header Tabel -->
            <x-slot:thead>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">NIP</th>
                <th class="px-6 py-4">NIK</th>
                <th class="px-6 py-4">Nama Guru</th>
                <th class="px-6 py-4">Jenis Kelamin</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">No. Telepon</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </x-slot:thead>

            <!-- Body / Isi Tabel -->
            @forelse ($guru as $item)
                <tr class="status-row transition hover:bg-gray-50">
                    <td class="px-6 py-5">{{ $loop->iteration }}</td>
                    <td class="px-6 py-5 font-medium text-gray-700">{{ $item->nip ?? '-' }}</td>
                    <td class="px-6 py-5 font-medium text-gray-700">{{ $item->nik ?? '-' }}</td>
                    <td class="px-6 py-5">
                        <div class="font-semibold text-gray-800">{{ $item->nama_guru }}</div>
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
                    <td class="px-6 py-5 text-gray-600">{{ $item->email ?? '-' }}</td>
                    <td class="px-6 py-5 text-gray-600">{{ $item->no_telepon ?? '-' }}</td>
                    <td class="px-6 py-5 text-center whitespace-nowrap">
                        <a href="{{ route('data-guru.edit', $item->id) }}"
                            class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                            <i class="ph ph-pencil-simple text-sm"></i>
                            Edit
                        </a>

                        <form action="{{ route('data-guru.destroy', $item->id) }}"
                            method="POST"
                            class="inline-block ml-1"
                            data-hapus-form>
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                data-nama="{{ $item->nama_guru }}"
                                class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-600"
                                title="Hapus data guru">
                                <i class="ph ph-trash text-sm"></i>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data guru.
                    </td>
                </tr>
            @endforelse
        </x-table-card>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        function filterGuru() {
            const search = document.getElementById('searchGuru').value;
            const jenisKelamin = document.getElementById('jenisKelaminGuru').value;
            alert("Filter diterapkan!\n\nPencarian: " + (search || "Semua") + "\nJenis Kelamin: " + (jenisKelamin || "Semua"));
            // TODO: Implement actual filtering (AJAX or form submit)
        }

        function resetFilterGuru() {
            document.getElementById('searchGuru').value = "";
            document.getElementById('jenisKelaminGuru').value = "";
            alert("Filter berhasil direset.");
        }

        /* ============================= */
        /* KONFIRMASI HAPUS             */
        /* ============================= */

        document.querySelectorAll('form[data-hapus-form]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                const nama = form.querySelector('button[data-nama]').dataset.nama;

                const yakin = confirm(
                    'Yakin ingin menghapus data guru "' + nama + '"?\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
