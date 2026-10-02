@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- HEADER -->
        <div class="welcome">
            <h2 class="italic font-bold">
                Guru Mengajar
            </h2>
            <p>
                Kelola penugasan guru mengajar mata pelajaran pada setiap rombongan
                belajar dalam sistem E-Rapor SMK.
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
        <form method="GET" action="{{ route('guru-mengajar.index')}}"
            class="mb-6 rounded-xl bg-white p-6 shadow-sm">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Guru</label>
                    <select name="guru_id"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua Guru</option>
                        @foreach ($guruList as $guru)
                            <option value="{{ $guru->id }}" @selected($guruDipilih === $guru->id)>
                                {{ $guru->nama_guru }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        <option value="">Semua Mata Pelajaran</option>
                        @foreach ($mapelList as $mapel)
                            <option value="{{ $mapel->id }}" @selected($mapelDipilih === $mapel->id)>
                                {{ $mapel->nama_mata_pelajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">
                        <i class="ph ph-magnifying-glass"></i>
                        Tampilkan
                    </button>
                    <a href="{{ route('guru-mengajar.index') }}"
                        class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">
                        Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- TABEL -->
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-bold text-gray-800">Daftar Guru Mengajar</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Menampilkan {{ $pengajar->count() }} penugasan guru mengajar.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm sm:min-w-[1000px]">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Guru Pengajar</th>
                            <th class="px-6 py-4">Mata Pelajaran</th>
                            <th class="px-6 py-4">Rombel</th>
                            <th class="px-6 py-4">Periode</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($pengajar as $item)
                            <tr class="transition hover:bg-gray-50">
                                <td class="px-6 py-5">{{ $loop->iteration }}</td>
                                <td class="px-6 py-5 font-semibold text-gray-800">
                                    {{ $item->guru->nama_guru ?? '-' }}
                                </td>
                                <td class="px-6 py-5 text-gray-600">
                                    {{ $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                                </td>
                                <td class="px-6 py-5 text-gray-600">{{ $item->rombel->nama_rombel ?? '-' }}</td>
                                <td class="px-6 py-5 text-gray-600">
                                    {{ $item->tahun_ajaran ?? '-' }} / {{ $item->semester ?? '-' }}
                                </td>
                                <td class="px-6 py-5 text-center whitespace-nowrap">
                                    <div class="inline-flex flex-wrap justify-center gap-1.5">
                                        <a href="{{ route('guru-mengajar.edit', $item->id) }}"
                                            class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700"
                                            title="Ganti guru pengajar">
                                            <i class="ph ph-user-switch"></i>
                                            Ganti Guru
                                        </a>

                                        <form action="{{ route('guru-mengajar.destroy', $item->id) }}"
                                            method="POST" class="inline-block" data-hapus-relasi-form>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                data-nama="{{ $item->mataPelajaran->nama_mata_pelajaran ?? '-' }}"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-600"
                                                title="Lepas relasi guru mengajar">
                                                <i class="ph ph-link-break"></i>
                                                Lepas Relasi
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada penugasan guru mengajar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('form[data-hapus-relasi-form]').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                const nama = form.querySelector('button[data-nama]').dataset.nama;

                const yakin = confirm(
                    'Lepas relasi guru mengajar untuk "' + nama + '"?\n\n' +
                    'Mata Pelajaran tidak akan dihapus, hanya penugasan gurunya yang dibatalkan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection