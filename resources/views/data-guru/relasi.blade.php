@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- HEADER -->
        <div class="welcome">
            <h2 class="italic font-bold">
                Relasi Mata Pelajaran
            </h2>
            <p>
                Daftar mata pelajaran yang masih diajar oleh
                <strong>{{ $guru->nama_guru ?? 'guru ini' }}</strong>
                beserta rombongan belajar dan periodenya.
            </p>
        </div>

        <!-- PESAN -->
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

        <!-- KARTU GURU -->
        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">{{ $guru->nama_guru ?? '-' }}</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        NIP: {{ $guru->nip ?? '-' }} &middot; NIK: {{ $guru->nik ?? '-' }}
                    </p>

                    <div class="mt-3 flex flex-wrap gap-2 text-xs font-semibold">
                        <span class="rounded-full bg-indigo-100 px-3 py-1 text-indigo-700">
                            {{ $guru->guru_mengajar_count }} Mata Pelajaran diajar
                        </span>
                        <span class="rounded-full bg-purple-100 px-3 py-1 text-purple-700">
                            {{ $guru->wali_kelas_count }} Penugasan Wali Kelas
                        </span>
                        <span class="rounded-full bg-sky-100 px-3 py-1 text-sky-700">
                            {{ $guru->rombel_diampu_count }} Rombel diampu
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('guru-mengajar', ['guru_id' => $guru->id]) }}"
                        class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                        <i class="ph ph-chalkboard-teacher"></i>
                        Semua Guru Mengajar
                    </a>
                    <a href="{{ route('data-guru.edit', $guru->id) }}"
                        class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-amber-600">
                        <i class="ph ph-pencil-simple"></i>
                        Edit Data
                    </a>
                    <a href="{{ route('data-guru') }}"
                        class="inline-flex items-center gap-1 rounded-lg bg-gray-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-gray-600">
                        <i class="ph ph-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>

            @if ($penghalang !== [])
                <div class="mt-5 rounded-lg border border-amber-300 bg-amber-50 p-4">
                    <p class="text-sm font-semibold text-amber-900">
                        <i class="ph ph-lock-simple mr-1"></i>
                        Data ini belum bisa dihapus
                    </p>
                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-amber-800">
                        @foreach ($penghalang as $item)
                            <li>
                                {{ $item['pesan'] }}
                                ({{ $item['jumlah'] }} {{ Str::lower($item['label']) }})
                            </li>
                        @endforeach
                    </ul>
                    <p class="mt-3 text-sm text-amber-800">
                        Lepas atau ganti relasi di bawah ini. Setelah semuanya beres,
                        guru ini baru bisa dihapus.
                    </p>
                </div>
            @endif
        </div>

        <!-- TABEL MATA PELAJARAN -->
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-bold text-gray-800">Mata Pelajaran yang Diajar</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Pilih "Ganti Guru" untuk memindahkan pengajaran ke guru lain, atau
                    "Lepas Relasi" untuk membatalkan penugasan tanpa menghapus mata pelajaran.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm sm:min-w-[900px]">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Kode</th>
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
                                <td class="px-6 py-5">{{ $item->mataPelajaran->kode_mata_pelajaran ?? '-' }}</td>
                                <td class="px-6 py-5 font-semibold text-gray-800">
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
                                            title="Ganti guru pengajar mata pelajaran ini">
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
                                    Guru ini tidak sedang mengajar mata pelajaran apa pun.
                                    Data guru sudah bisa dihapus.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-gray-200 px-6 py-4 text-sm text-gray-500">
                Menampilkan <span class="font-semibold text-gray-700">{{ $pengajar->count() }}</span>
                mata pelajaran
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