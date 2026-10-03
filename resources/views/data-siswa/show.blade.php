@extends('layouts.app')

@section('content')
    <div class="content">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <div>

                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => route('dashboard')],
                    ['label' => 'Data Master'],
                    ['label' => 'Data Siswa'],
                    ['label' => 'Detail Siswa'],
                ]" />

                <div class="mt-1 flex items-center justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                            <i class="ph ph-student text-2xl"></i>
                        </div>

                        <div>

                            <h1 class="text-xl font-bold leading-tight">
                                Detail Siswa
                            </h1>

                            <p class="mt-1 text-xs text-[#c2c2dc]">
                                Informasi lengkap {{ $siswa->nama_siswa }} dalam sistem E-Rapor SMK.
                            </p>

                        </div>

                    </div>


                    {{-- STATUS AKUN --}}
                    @if ($siswa->user)
                        <div
                            class="hidden items-center gap-2 rounded-xl bg-emerald-500/15 px-4 py-2 ring-1 ring-emerald-300/20 sm:flex">

                            <i class="ph ph-check-circle text-emerald-300"></i>

                            <div>
                                <p class="text-[10px] text-emerald-200">
                                    Status Akun
                                </p>

                                <p class="text-xs font-semibold text-white">
                                    Terhubung
                                </p>
                            </div>

                        </div>
                    @else
                        <div
                            class="hidden items-center gap-2 rounded-xl bg-amber-500/15 px-4 py-2 ring-1 ring-amber-300/20 sm:flex">

                            <i class="ph ph-warning-circle text-amber-300"></i>

                            <div>
                                <p class="text-[10px] text-amber-200">
                                    Status Akun
                                </p>

                                <p class="text-xs font-semibold text-white">
                                    Belum Ada
                                </p>
                            </div>

                        </div>
                    @endif

                </div>

            </div>
        </div>


        {{-- =====================================================
            ACTION
        ====================================================== --}}
        <div class="mb-6 flex flex-wrap gap-3">

            <a href="{{ route('data-siswa.index') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">

                <i class="ph ph-arrow-left"></i>
                Kembali

            </a>

            <a href="{{ route('data-siswa.edit', $siswa->id) }}"
                class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600">

                <i class="ph ph-pencil-simple"></i>
                Edit Data

            </a>

            <form action="{{ route('data-siswa.destroy', $siswa->id) }}" method="POST" data-hapus-form>

                @csrf
                @method('DELETE')

                <button type="submit" data-nama="{{ $siswa->nama_siswa }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600">

                    <i class="ph ph-trash"></i>
                    Hapus Data

                </button>

            </form>

        </div>


        {{-- =====================================================
            PROFIL SINGKAT
        ====================================================== --}}
        <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

            <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center">

                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">

                    <i class="ph ph-student text-3xl"></i>

                </div>

                <div class="flex-1">

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Siswa
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-slate-800">
                        {{ $siswa->nama_siswa }}
                    </h2>

                    <div class="mt-2 flex flex-wrap gap-2">

                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">

                            <i class="ph ph-identification-card"></i>

                            NISN:
                            {{ $siswa->nisn ?? '-' }}

                        </span>


                        @if ($siswa->rombel)
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">

                                <i class="ph ph-users-three"></i>

                                {{ $siswa->rombel->nama_rombel }}

                            </span>
                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            IDENTITAS
        ====================================================== --}}
        <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <i class="ph ph-identification-card text-xl"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Identitas Siswa
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-400">
                            Informasi identitas dan data pribadi siswa.
                        </p>
                    </div>

                </div>

            </div>


            <div class="p-6">

                <dl class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>
                        <dt class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                            <i class="ph ph-user"></i>
                            Nama Lengkap
                        </dt>

                        <dd class="mt-1.5 text-sm font-semibold text-slate-800">
                            {{ $siswa->nama_siswa }}
                        </dd>
                    </div>


                    <div>
                        <dt class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                            <i class="ph ph-identification-card"></i>
                            NISN
                        </dt>

                        <dd class="mt-1.5 text-sm font-medium text-slate-700">
                            {{ $siswa->nisn ?? '-' }}
                        </dd>
                    </div>


                    <div>
                        <dt class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                            <i class="ph ph-gender-intersex"></i>
                            Jenis Kelamin
                        </dt>

                        <dd class="mt-2">

                            @if ($siswa->jenis_kelamin === 'L')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                    <i class="ph ph-gender-male"></i>
                                    Laki-laki
                                </span>
                            @elseif ($siswa->jenis_kelamin === 'P')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-pink-50 px-3 py-1 text-xs font-semibold text-pink-700">
                                    <i class="ph ph-gender-female"></i>
                                    Perempuan
                                </span>
                            @else
                                <span class="text-sm text-slate-400">
                                    Belum diisi
                                </span>
                            @endif

                        </dd>
                    </div>


                    <div>
                        <dt class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                            <i class="ph ph-map-pin"></i>
                            Tempat Lahir
                        </dt>

                        <dd class="mt-1.5 text-sm text-slate-700">
                            {{ $siswa->tempat_lahir ?? '-' }}
                        </dd>
                    </div>


                    <div>
                        <dt class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                            <i class="ph ph-calendar"></i>
                            Tanggal Lahir
                        </dt>

                        <dd class="mt-1.5 text-sm text-slate-700">
                            {{ $siswa->tanggal_lahir?->format('d F Y') ?? '-' }}
                        </dd>
                    </div>


                    <div class="md:col-span-2">

                        <dt class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                            <i class="ph ph-map-pin"></i>
                            Alamat
                        </dt>

                        <dd class="mt-1.5 rounded-lg bg-slate-50 p-3 text-sm leading-relaxed text-slate-700">
                            {{ $siswa->alamat ?? 'Alamat belum diisi.' }}
                        </dd>

                    </div>

                </dl>

            </div>

        </div>


        {{-- =====================================================
            ROMBEL
        ====================================================== --}}
        <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <i class="ph ph-users-three text-xl"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Rombongan Belajar
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-400">
                            Informasi kelas dan wali kelas siswa.
                        </p>
                    </div>

                </div>

            </div>


            <div class="p-6">

                @if ($siswa->rombel)
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                        <div>
                            <p class="text-xs font-semibold text-slate-400">
                                Nama Rombel
                            </p>

                            <p class="mt-1.5 text-sm font-semibold text-slate-800">
                                {{ $siswa->rombel->nama_rombel }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold text-slate-400">
                                Tingkat
                            </p>

                            <p class="mt-1.5 text-sm text-slate-700">
                                {{ $siswa->rombel->tingkat ?? '-' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold text-slate-400">
                                Wali Kelas
                            </p>

                            <p class="mt-1.5 text-sm text-slate-700">
                                {{ $siswa->rombel->wali?->nama_guru ?? '-' }}
                            </p>
                        </div>

                    </div>
                @else
                    <div class="flex items-center gap-3 rounded-xl border border-amber-100 bg-amber-50 p-4">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-amber-600">
                            <i class="ph ph-warning-circle"></i>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-amber-800">
                                Belum terdaftar pada rombel
                            </p>

                            <p class="mt-1 text-xs text-amber-700">
                                Siswa ini belum memiliki rombongan belajar.
                            </p>
                        </div>

                    </div>
                @endif

            </div>

        </div>


        {{-- =====================================================
            AKUN LOGIN
        ====================================================== --}}
        <div class="mb-6 overflow-hidden rounded-xl bg-white shadow-sm">

            <div class="border-b border-slate-100 px-6 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                        <i class="ph ph-key text-xl"></i>
                    </div>

                    <div>
                        <h2 class="text-sm font-bold text-slate-800">
                            Akun Login
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-400">
                            Informasi akun yang digunakan siswa untuk masuk ke sistem.
                        </p>
                    </div>

                </div>

            </div>


            <div class="p-6">

                @if ($siswa->user)
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                        <div>
                            <p class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                                <i class="ph ph-user-circle"></i>
                                Username
                            </p>

                            <p class="mt-1.5 text-sm font-semibold text-slate-800">
                                {{ $siswa->user->username }}
                            </p>
                        </div>


                        <div>
                            <p class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                                <i class="ph ph-shield-check"></i>
                                Peran
                            </p>

                            <div class="mt-2">

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-700">
                                    <i class="ph ph-student"></i>
                                    Siswa
                                </span>

                            </div>
                        </div>


                        <div>
                            <p class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                                <i class="ph ph-calendar"></i>
                                Akun Dibuat
                            </p>

                            <p class="mt-1.5 text-sm text-slate-700">
                                {{ $siswa->user->created_at?->format('d/m/Y') ?? '-' }}
                            </p>
                        </div>

                    </div>


                    <div class="mt-5 flex items-start gap-3 rounded-xl border border-indigo-100 bg-indigo-50 p-4">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-indigo-600 shadow-sm">
                            <i class="ph ph-info"></i>
                        </div>

                        <p class="text-xs leading-relaxed text-indigo-700">
                            Password tidak ditampilkan demi keamanan akun.
                            Siswa dapat mengubah password melalui halaman Profil.
                        </p>

                    </div>
                @else
                    <div class="flex items-start gap-3 rounded-xl border border-amber-100 bg-amber-50 p-4">

                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-amber-600 shadow-sm">
                            <i class="ph ph-warning-circle"></i>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-amber-800">
                                Belum memiliki akun login
                            </p>

                            <p class="mt-1 text-xs leading-relaxed text-amber-700">
                                Siswa ini belum terhubung dengan akun pengguna.
                                Akun dapat dibuat melalui halaman edit data siswa.
                            </p>
                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>


    <script>
        document.querySelectorAll('form[data-hapus-form]').forEach(function(form) {

            form.addEventListener('submit', function(event) {

                const nama = form.querySelector('button[data-nama]').dataset.nama;

                const yakin = confirm(
                    'Yakin ingin menghapus data siswa "' + nama + '"?\n\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }

            });

        });
    </script>
@endsection
