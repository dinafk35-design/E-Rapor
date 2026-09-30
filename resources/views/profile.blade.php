@extends('layouts.app')

@section('content')

@php
    // =====================================================
    // DATA PENGGUNA YANG SEDANG MASUK
    // =====================================================

    $user = auth()->user();

    $nama = $user->name ?: ($user->username ?? 'Pengguna');

    $inisial = strtoupper(
        collect(preg_split('/\s+/', trim($nama)))
            ->filter()
            ->take(2)
            ->map(fn ($kata) => mb_substr($kata, 0, 1))
            ->implode('')
    ) ?: 'P';

    $roleLabel = match ($user->role ?? null) {
        'admin' => 'Administrator',
        'guru' => 'Guru',
        'siswa' => 'Siswa',
        default => 'Pengguna',
    };

    $roleClass = match ($user->role ?? null) {
        'admin' => 'bg-indigo-100 text-indigo-700',
        'guru' => 'bg-green-100 text-green-700',
        'siswa' => 'bg-amber-100 text-amber-700',
        default => 'bg-gray-100 text-gray-700',
    };

    // Daftar informasi akun (label, nilai, ikon)
    $detail = [
        [
            'label' => 'Nama',
            'value' => $nama,
            'icon' => 'ph ph-user',
        ],
        [
            'label' => 'Username',
            'value' => $user->username ?? '-',
            'icon' => 'ph ph-at',
        ],
        [
            'label' => 'Level Akses',
            'value' => $roleLabel,
            'icon' => 'ph ph-shield-star',
        ],
        [
            'label' => 'E-mail',
            'value' => $user->email ?: 'Belum diisi',
            'icon' => 'ph ph-envelope-simple',
        ],
        [
            'label' => 'Bergabung',
            'value' => $user->created_at?->format('d M Y H:i') ?? '-',
            'icon' => 'ph ph-calendar-blank',
        ],
        [
            'label' => 'Diperbarui',
            'value' => $user->updated_at?->format('d M Y H:i') ?? '-',
            'icon' => 'ph ph-clock-countdown',
        ],
    ];

    // Form password terbuka otomatis bila validasi gagal
    $passwordTerbuka = $errors->has('current_password') || $errors->has('password');
@endphp


<div class="content">

    <!-- ============================= -->
    <!-- HEADER -->
    <!-- ============================= -->

    <div class="welcome">
        <h2 class="italic font-bold">
            Profil Pengguna
        </h2>

        <p>
            Informasi akun pengguna yang sedang masuk ke sistem E-Rapor SMK.
        </p>
    </div>


    <!-- ============================= -->
    <!-- PEMBERITAHUAN -->
    <!-- ============================= -->

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


    <!-- ============================= -->
    <!-- KARTU PROFIL + DETAIL AKUN -->
    <!-- ============================= -->

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">

        <!-- ---------- KARTU PROFIL (KIRI) ---------- -->

        <div class="lg:col-span-1">

            <div class="flex h-full flex-col items-center gap-4 rounded-xl bg-white p-6 text-center shadow-sm">

                <!-- Avatar -->
                <div class="flex h-24 w-24 items-center justify-center rounded-full border-4 border-blue-600 bg-blue-600 text-white shadow">
                    <span class="text-3xl font-bold tracking-wide">
                        {{ $inisial }}
                    </span>
                </div>


                <!-- Nama & Level -->
                <div class="min-w-0">
                    <h3 class="truncate text-lg font-bold text-gray-800">
                        {{ $nama }}
                    </h3>

                    <p class="mt-0.5 truncate text-sm text-gray-500">
                        {{ $user->username ?? '-' }}
                    </p>

                    <span class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $roleClass }}">
                        {{ $roleLabel }}
                    </span>
                </div>


                <!-- Pemisah -->
                <hr class="w-full border-gray-200">


                <!-- Tombol -->
                <div class="mt-auto flex w-full flex-col gap-2">

                    <button
                        type="button"
                        id="tombolUbahPassword"
                        onclick="toggleFormPassword()"
                        aria-expanded="{{ $passwordTerbuka ? 'true' : 'false' }}"
                        aria-controls="passwordBox"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">

                        <i class="ph ph-lock-key"></i>
                        Ubah Password

                    </button>


                    <a
                        href="{{ route('dashboard') }}"
                        class="flex w-full items-center justify-center gap-2 rounded-lg bg-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                        <i class="ph ph-arrow-left"></i>
                        Kembali ke Dashboard

                    </a>

                </div>

            </div>

        </div>


        <!-- ---------- DETAIL AKUN (KANAN) ---------- -->

        <div class="lg:col-span-2">

            <div class="h-full overflow-hidden rounded-xl bg-white shadow-sm">

                <!-- Judul -->
                <div class="flex items-center gap-2 border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <i class="ph ph-id-card text-gray-500"></i>

                    <h2 class="text-base font-bold text-gray-800">
                        Detail Akun
                    </h2>
                </div>


                <!-- Baris informasi -->
                <ul class="divide-y divide-gray-100">

                    @foreach ($detail as $baris)
                        <li class="flex flex-col gap-1 px-6 py-4 sm:flex-row sm:items-center sm:gap-4">

                            <!-- Label -->
                            <div class="flex shrink-0 items-center gap-2 text-sm font-semibold text-gray-600 sm:w-44">
                                <i class="{{ $baris['icon'] }} text-gray-400"></i>
                                {{ $baris['label'] }}
                            </div>


                            <!-- Nilai -->
                            <div class="min-w-0 break-words pl-6 text-sm text-gray-800 sm:pl-0">
                                {{ $baris['value'] }}
                            </div>

                        </li>
                    @endforeach

                </ul>

            </div>

        </div>

    </div>


    <!-- ============================= -->
    <!-- FORM UBAH PASSWORD -->
    <!-- ============================= -->

    <div
        id="passwordBox"
        @if (! $passwordTerbuka) style="display:none;" @endif
        class="mt-5 rounded-xl bg-white shadow-sm">

        <div class="flex items-center gap-2 border-b border-gray-200 bg-gray-50 px-6 py-4">
            <i class="ph ph-lock-key text-gray-500"></i>

            <h2 class="text-base font-bold text-gray-800">
                Ubah Password
            </h2>
        </div>


        <form
            method="POST"
            action="{{ route('profile.password.update') }}"
            id="formPassword"
            class="p-6"
            novalidate>

            @csrf
            @method('PUT')


            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                <!-- PASSWORD LAMA -->

                <div>
                    <label for="current_password" class="mb-2 block text-sm font-semibold text-gray-700">
                        Password Lama
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            autocomplete="current-password"
                            placeholder="Masukkan password lama"
                            class="w-full rounded-lg border px-4 py-2.5 pr-11 text-sm outline-none transition focus:ring-2
                                {{ $errors->has('current_password')
                                    ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-red-200'
                                    : 'border-gray-300 focus:border-blue-500 focus:ring-blue-200' }}">

                        <button
                            type="button"
                            onclick="toggleLihatPassword(this, 'current_password')"
                            aria-label="Lihat password lama"
                            class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-gray-400 transition hover:text-gray-600">

                            <i class="ph ph-eye"></i>

                        </button>
                    </div>

                    @error('current_password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- PASSWORD BARU -->

                <div>
                    <label for="password" class="mb-2 block text-sm font-semibold text-gray-700">
                        Password Baru
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            autocomplete="new-password"
                            oninput="cekKekuatanPassword(this.value)"
                            placeholder="Minimal 8 karakter"
                            class="w-full rounded-lg border px-4 py-2.5 pr-11 text-sm outline-none transition focus:ring-2
                                {{ $errors->has('password')
                                    ? 'border-red-400 bg-red-50 focus:border-red-500 focus:ring-red-200'
                                    : 'border-gray-300 focus:border-blue-500 focus:ring-blue-200' }}">

                        <button
                            type="button"
                            onclick="toggleLihatPassword(this, 'password')"
                            aria-label="Lihat password baru"
                            class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-gray-400 transition hover:text-gray-600">

                            <i class="ph ph-eye"></i>

                        </button>
                    </div>

                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Indikator kekuatan -->
                    <div class="mt-2 hidden" id="passwordStrength">
                        <div class="h-1.5 w-full overflow-hidden rounded-full bg-gray-200">
                            <div id="passwordStrengthBar" class="h-full w-0 rounded-full transition-all duration-300"></div>
                        </div>

                        <p id="passwordStrengthText" class="mt-1 text-xs text-gray-500"></p>
                    </div>
                </div>


                <!-- KONFIRMASI PASSWORD -->

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-gray-700">
                        Konfirmasi Password
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            autocomplete="new-password"
                            placeholder="Ulangi password baru"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 pr-11 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <button
                            type="button"
                            onclick="toggleLihatPassword(this, 'password_confirmation')"
                            aria-label="Lihat konfirmasi password"
                            class="absolute right-2 top-1/2 -translate-y-1/2 rounded p-1 text-gray-400 transition hover:text-gray-600">

                            <i class="ph ph-eye"></i>

                        </button>
                    </div>

                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>


            <!-- TOMBOL -->

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">

                <button
                    type="submit"
                    class="flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">

                    <i class="ph ph-floppy-disk"></i>
                    Simpan Password

                </button>


                <button
                    type="button"
                    onclick="tutupFormPassword()"
                    class="flex items-center justify-center gap-2 rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                    <i class="ph ph-x"></i>
                    Batal

                </button>

            </div>

        </form>

    </div>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>

    /**
     * Buka / tutup panel ubah password.
     */
    function toggleFormPassword() {
        const box = document.getElementById('passwordBox');
        const tombol = document.getElementById('tombolUbahPassword');

        const akanBuka = box.style.display === 'none' || box.style.display === '';

        if (akanBuka) {
            bukaFormPassword();
        } else {
            tutupFormPassword();
        }

        tombol.setAttribute('aria-expanded', akanBuka ? 'true' : 'false');
    }


    /**
     * Tampilkan panel ubah password lalu fokuskan kolom pertama.
     */
    function bukaFormPassword() {
        const box = document.getElementById('passwordBox');

        box.style.display = 'block';
        box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        document.getElementById('current_password')?.focus();
    }


    /**
     * Sembunyikan panel ubah password dan kosongkan isiannya.
     */
    function tutupFormPassword() {
        const box = document.getElementById('passwordBox');

        box.style.display = 'none';
        box.querySelectorAll('input[type="password"]').forEach((input) => {
            input.value = '';
        });

        resetKekuatanPassword();

        document.getElementById('tombolUbahPassword')?.setAttribute('aria-expanded', 'false');
    }


    /**
     * Tampilkan / sembunyikan isi kolom password.
     */
    function toggleLihatPassword(tombol, idInput) {
        const input = document.getElementById(idInput);
        const ikon = tombol.querySelector('i');

        const tampilkan = input.type === 'password';

        input.type = tampilkan ? 'text' : 'password';
        ikon.classList.toggle('ph-eye', !tampilkan);
        ikon.classList.toggle('ph-eye-slash', tampilkan);

        input.focus();
    }


    /**
     * Indikator sederhana kekuatan password baru.
     */
    function cekKekuatanPassword(nilai) {
        if (!nilai) {
            resetKekuatanPassword();
            return;
        }

        let skor = 0;

        if (nilai.length >= 8) skor++;
        if (nilai.length >= 12) skor++;
        if (/[A-Z]/.test(nilai) && /[a-z]/.test(nilai)) skor++;
        if (/\d/.test(nilai)) skor++;
        if (/[^A-Za-z0-9]/.test(nilai)) skor++;

        const level = [
            { lebar: '20%', warna: 'bg-red-500', teks: 'Lemah' },
            { lebar: '40%', warna: 'bg-orange-500', teks: 'Cukup' },
            { lebar: '60%', warna: 'bg-yellow-500', teks: 'Sedang' },
            { lebar: '80%', warna: 'bg-blue-500', teks: 'Kuat' },
            { lebar: '100%', warna: 'bg-green-500', teks: 'Sangat Kuat' },
        ][Math.min(skor, 4)];

        const wrapper = document.getElementById('passwordStrength');
        const bar = document.getElementById('passwordStrengthBar');
        const teks = document.getElementById('passwordStrengthText');

        wrapper.classList.remove('hidden');
        bar.className = 'h-full rounded-full transition-all duration-300 ' + level.warna;
        bar.style.width = level.lebar;
        teks.textContent = 'Kekuatan password: ' + level.teks;
    }


    /**
     * Kembalikan indikator kekuatan ke kondisi awal.
     */
    function resetKekuatanPassword() {
        document.getElementById('passwordStrength')?.classList.add('hidden');

        const bar = document.getElementById('passwordStrengthBar');

        if (bar) {
            bar.style.width = '0%';
        }

        const teks = document.getElementById('passwordStrengthText');

        if (teks) {
            teks.textContent = '';
        }
    }

</script>

@endsection
