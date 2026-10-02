@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- HEADER -->
        <div class="welcome">
            <h2 class="italic font-bold">
                Detail Siswa
            </h2>
            <p>
                Rincian data siswa {{ $siswa->nama_siswa }} yang terdaftar dalam sistem E-Rapor SMK.
            </p>
        </div>

        <!-- TOMBOL AKSI -->
        <div class="mb-6 flex flex-wrap gap-3">
            <a href="{{ route('data-siswa.index') }}"
                class="inline-flex items-center gap-1 rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-600">
                <i class="ph ph-arrow-left"></i>
                Kembali
            </a>

            <a href="{{ route('data-siswa.edit', $siswa->id) }}"
                class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600">
                <i class="ph ph-pencil-simple"></i>
                Edit
            </a>

            <form action="{{ route('data-siswa.destroy', $siswa->id) }}"
                method="POST"
                data-hapus-form>
                @csrf
                @method('DELETE')

                <button type="submit"
                    data-nama="{{ $siswa->nama_siswa }}"
                    class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-600">
                    <i class="ph ph-trash"></i>
                    Hapus
                </button>
            </form>
        </div>

        <!-- IDENTITAS -->
        <div class="section-title">
            <i class="ph ph-identification-card"></i>
            Identitas Siswa
        </div>

        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
            <!-- grid 1 kolom di HP, 2 kolom di layar besar -->
            <dl class="grid grid-cols-1 gap-x-8 gap-y-5 md:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Nama Lengkap
                    </dt>
                    <dd class="mt-1 text-base font-semibold text-gray-800">
                        {{ $siswa->nama_siswa }}
                    </dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        NISN
                    </dt>
                    <dd class="mt-1 text-base text-gray-700">
                        {{ $siswa->nisn ?? '-' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Jenis Kelamin
                    </dt>
                    <dd class="mt-1 text-base text-gray-700">
                        @if ($siswa->jenis_kelamin === 'L')
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Laki-laki</span>
                        @elseif ($siswa->jenis_kelamin === 'P')
                            <span class="rounded-full bg-pink-100 px-3 py-1 text-xs font-semibold text-pink-700">Perempuan</span>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Tempat Lahir
                    </dt>
                    <dd class="mt-1 text-base text-gray-700">
                        {{ $siswa->tempat_lahir ?? '-' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Tanggal Lahir
                    </dt>
                    <dd class="mt-1 text-base text-gray-700">
                        {{ $siswa->tanggal_lahir?->format('d/m/Y') ?? '-' }}
                    </dd>
                </div>

                <div class="md:col-span-2">
                    <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                        Alamat
                    </dt>
                    <dd class="mt-1 text-base text-gray-700">
                        {{ $siswa->alamat ?? '-' }}
                    </dd>
                </div>
            </dl>
        </div>

        <!-- ROMBEL -->
        <div class="section-title">
            <i class="ph ph-users-three"></i>
            Rombel
        </div>

        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
            @if ($siswa->rombel)
                <dl class="grid grid-cols-1 gap-x-8 gap-y-5 md:grid-cols-3">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Nama Rombel
                        </dt>
                        <dd class="mt-1 text-base text-gray-700">
                            {{ $siswa->rombel->nama_rombel }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Tingkat
                        </dt>
                        <dd class="mt-1 text-base text-gray-700">
                            {{ $siswa->rombel->tingkat ?? '-' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Wali Kelas
                        </dt>
                        <dd class="mt-1 text-base text-gray-700">
                            {{ $siswa->rombel->wali?->nama_guru ?? '-' }}
                        </dd>
                    </div>
                </dl>
            @else
                <p class="text-sm text-gray-500">
                    Siswa ini belum terdaftar pada rombongan belajar mana pun.
                </p>
            @endif
        </div>

        <!-- AKUN LOGIN -->
        <div class="section-title">
            <i class="ph ph-key"></i>
            Akun Login
        </div>

        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
            @if ($siswa->user)
                <dl class="grid grid-cols-1 gap-x-8 gap-y-5 md:grid-cols-3">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Username
                        </dt>
                        <dd class="mt-1 text-base font-semibold text-gray-800">
                            {{ $siswa->user->username }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Peran
                        </dt>
                        <dd class="mt-1">
                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                Siswa
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            dibuat
                        </dt>
                        <dd class="mt-1 text-base text-gray-700">
                            {{ $siswa->user->created_at?->format('d/m/Y') ?? '-' }}
                        </dd>
                    </div>
                </dl>

                <p class="mt-4 text-sm text-gray-500">
                    Password dapat diubah siswa sendiri lewat halaman Profil.
                </p>
            @else
                <p class="text-sm text-gray-500">
                    Siswa ini belum memiliki akun login.
                </p>
            @endif
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        document.querySelectorAll('form[data-hapus-form]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                const nama = form.querySelector('button[data-nama]').dataset.nama;

                const yakin = confirm(
                    'Yakin ingin menghapus data siswa "' + nama + '"?\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
