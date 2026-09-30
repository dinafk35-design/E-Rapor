@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Sekolah
        </h2>

        <p>
            Kelola informasi dan identitas sekolah yang digunakan
            dalam sistem E-Rapor SMK.
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
                <input type="text" id="searchSekolah"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    placeholder="Cari nama sekolah, NPSN...">
            </div>
        </div>
        <!-- TOMBOL -->
        <div class="mt-5 flex flex-wrap gap-3">
            <button type="button" onclick="filterSekolah()"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                <i class="ph ph-magnifying-glass mr-1"></i>
                Cari
            </button>
            <button type="button" onclick="resetFilterSekolah()"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                <i class="ph ph-arrow-counter-clockwise mr-1"></i>
                Reset
            </button>
        </div>
    </div>

    <!-- TABEL DATA SEKOLAH -->
    <x-table-card title="Data Sekolah" subtitle="Menampilkan daftar seluruh data sekolah yang terdaftar dalam sistem."
        :createRoute="route('data-sekolah.create')" :items="$sekolah">
        
        <x-slot name="thead">
            <th class="px-6 py-4 w-12">No</th>
            <th class="px-6 py-4">Nama Sekolah</th>
            <th class="px-6 py-4">NPSN</th>
            <th class="px-6 py-4">Kepala Sekolah</th>
            <th class="px-6 py-4">Telepon</th>
            <th class="px-6 py-4 text-center w-44">Aksi</th>
        </x-slot>

        @forelse ($sekolah as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-5 text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-5 font-medium">{{ $item->nama_sekolah }}</td>
                <td class="px-6 py-5">{{ $item->npsn ?? '-' }}</td>
                <td class="px-6 py-5">{{ $item->kepala_sekolah ?? '-' }}</td>
                <td class="px-6 py-5">{{ $item->telepon ?? '-' }}</td>
                <td class="px-6 py-5 text-center whitespace-nowrap">
                    <a href="{{ route('data-sekolah.edit', $item->id) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-yellow-500 text-white text-xs font-medium hover:bg-yellow-600 transition">
                        <i class="ph ph-pencil-simple text-base"></i>
                        Edit
                    </a>

                    <form action="{{ route('data-sekolah.destroy', $item->id) }}"
                          method="POST"
                          class="inline-block ml-1"
                          data-hapus-form>
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                data-nama="{{ $item->nama_sekolah }}"
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-red-500 text-white text-xs font-medium hover:bg-red-600 transition"
                                title="Hapus data sekolah">
                            <i class="ph ph-trash text-base"></i>
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    Belum ada data sekolah.
                </td>
            </tr>
        @endforelse

    </x-table-card>

</div>

<!-- JAVASCRIPT -->
<script>
    function filterSekolah() {
        const search = document.getElementById('searchSekolah').value;
        alert("Filter diterapkan!\n\nPencarian: " + (search || "Semua"));
        // TODO: Implement actual filtering (AJAX or form submit)
    }

    function resetFilterSekolah() {
        document.getElementById('searchSekolah').value = "";
        alert("Filter berhasil direset.");
    }

    /* ============================= */
    /* KONFIRMASI HAPUS             */
    /* ============================= */

    document.querySelectorAll('form[data-hapus-form]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const nama = form.querySelector('button[data-nama]').dataset.nama;

            const yakin = confirm(
                'Yakin ingin menghapus data sekolah "' + nama + '"?\n' +
                'Data yang sudah dihapus tidak dapat dikembalikan.'
            );

            if (!yakin) {
                event.preventDefault();
            }
        });
    });
</script>

@endsection