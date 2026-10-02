@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="welcome">
            <h2 class="italic font-bold">
                Ganti Guru Pengajar
            </h2>
            <p>
                Pilih guru pengganti untuk mata pelajaran
                <strong>{{ $pengajar->mataPelajaran->nama_mata_pelajaran ?? '-' }}</strong>
                pada rombongan belajar
                <strong>{{ $pengajar->rombel->nama_rombel ?? '-' }}</strong>.
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

        <!-- INFORMASI PERUBAHAN -->
        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
            <h3 class="text-base font-bold text-gray-800">Penugasan Saat Ini</h3>

            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-xs font-semibold uppercase text-gray-500">Guru Saat Ini</p>
                    <p class="mt-1 font-semibold text-gray-800">
                        {{ $pengajar->guru->nama_guru ?? '-' }}
                    </p>
                </div>

                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-xs font-semibold uppercase text-gray-500">Mata Pelajaran</p>
                    <p class="mt-1 font-semibold text-gray-800">
                        {{ $pengajar->mataPelajaran->nama_mata_pelajaran ?? '-' }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $pengajar->mataPelajaran->kode_mata_pelajaran ?? '' }}
                    </p>
                </div>

                <div class="rounded-lg bg-gray-50 p-4">
                    <p class="text-xs font-semibold uppercase text-gray-500">Rombel &amp; Periode</p>
                    <p class="mt-1 font-semibold text-gray-800">{{ $pengajar->rombel->nama_rombel ?? '-' }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $pengajar->tahun_ajaran ?? '-' }} / {{ $pengajar->semester ?? '-' }}
                    </p>
                </div>
            </div>

            <p class="mt-4 rounded-lg border border-blue-200 bg-blue-50 p-3 text-sm text-blue-800">
                <i class="ph ph-info mr-1"></i>
                Hanya guru pengajar yang akan diganti. Data Mata Pelajaran, Rombel, dan
                seluruh data nilai siswa tetap tersimpan tanpa perubahan.
            </p>
        </div>

        <!-- FORM PILIH GURU -->
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <form method="POST" action="{{ route('guru-mengajar.update', $pengajar->id) }}">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Guru Pengganti <span class="text-red-500">*</span>
                    </label>

                    @if ($pilihanGuru->isEmpty())
                        <div class="rounded-lg border border-amber-300 bg-amber-50 p-3 text-sm text-amber-800">
                            Tidak ada guru lain yang tersedia. Tambahkan data guru baru terlebih dahulu.
                        </div>
                    @else
                        <select name="guru_id" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            <option value="">-- Pilih Guru Pengganti --</option>
                            @foreach ($pilihanGuru as $guru)
                                <option value="{{ $guru->id }}" @selected((int) old('guru_id') === $guru->id)>
                                    {{ $guru->nama_guru }}{{ $guru->nip ? ' (' . $guru->nip . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('guru-mengajar') }}"
                        class="rounded-lg bg-gray-500 px-5 py-2 text-sm font-semibold text-white transition hover:bg-gray-600">
                        <i class="ph ph-arrow-left mr-1"></i>
                        Batal
                    </a>

                    <button type="submit" @disabled($pilihanGuru->isEmpty())
                        class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50">
                        <i class="ph ph-user-switch mr-1"></i>
                        Simpan Guru Pengganti
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection