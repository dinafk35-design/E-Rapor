@extends('layouts.app')

@section('content')

<div class="content">

    <!-- JUDUL -->
    <div class="welcome">
        <h2 class="italic font-bold">
            PROFIL PENGGUNA
        </h2>

        <p>
            Informasi akun pengguna yang sedang masuk ke sistem E-Rapor SMK.
        </p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- PROFIL PENGGUNA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


        <!-- ============================= -->
        <!-- BAGIAN KIRI - PROFIL -->
        <!-- ============================= -->

        <div
            class="rounded-3xl p-8 text-center"
            style="
                background:#704747;
                min-height:250px;
            "
        >

            <!-- ICON USER -->
            <div class="flex justify-center mb-3">

                <div
                    class="flex items-center justify-center rounded-full"
                    style="
                        width:95px;
                        height:95px;
                        border:9px solid white;
                    "
                >
                    <i
                        class="ph ph-user"
                        style="
                            color:white;
                            font-size:42px;
                        "
                    ></i>
                </div>

            </div>


            <!-- NAMA -->
            <h3
                class="font-bold"
                style="color:white;"
            >
                {{ auth()->user()->name ?? auth()->user()->username }}
            </h3>


            <!-- USERNAME -->
            <p
                class="text-sm"
                style="color:white;"
            >
                Username : {{ auth()->user()->username }}
            </p>


            <!-- LEVEL -->
            <p
                class="text-sm"
                style="color:white;"
            >
                Level : {{ ucfirst(auth()->user()->role ?? 'Pengguna') }}
            </p>


            <!-- TOMBOL PASSWORD -->
            <div class="mt-6">

                <button
                    type="button"
                    onclick="ubahPassword()"
                    class="px-6 py-2 rounded-full font-semibold"
                    style="
                        background:#39308f;
                        color:white;
                    "
                >
                    <i class="ph ph-lock"></i> Ubah Password
                </button>

            </div>

        </div>



        <!-- ============================= -->
        <!-- BAGIAN KANAN - DETAIL -->
        <!-- ============================= -->

        <div>

            <!-- HEADER DETAIL -->

            <div
                class="px-4 py-2"
                style="
                    background:#4770a5;
                    color:white;
                    font-weight:500;
                "
            >
                DETAIL
            </div>


            <!-- NAMA -->

            <div
                class="px-3 py-3 mt-1 rounded-full"
                style="
                    background:#69aeb2;
                    color:#000;
                "
            >
                Nama :
                <span class="ml-1">
                    {{ auth()->user()->name ?? auth()->user()->username }}
                </span>
            </div>


            <!-- USERNAME -->

            <div
                class="px-3 py-3 mt-2 rounded-full"
                style="
                    background:#69aeb2;
                    color:#000;
                "
            >
                Username :
                <span class="ml-1">
                    {{ auth()->user()->username }}
                </span>
            </div>


            <!-- LEVEL -->

            <div
                class="px-3 py-3 mt-2 rounded-full"
                style="
                    background:#69aeb2;
                    color:#000;
                "
            >
                Level :
                <span class="ml-1">
                    {{ ucfirst(auth()->user()->role ?? 'Pengguna') }}
                </span>
            </div>


            <!-- EMAIL -->

            <div
                class="px-3 py-3 mt-2 rounded-full"
                style="
                    background:#69aeb2;
                    color:#000;
                "
            >
                E-mail :
                <span class="ml-1">
                    {{ auth()->user()->email ?? '-' }}
                </span>
            </div>


            <!-- LOGIN TERAKHIR -->

            <div
                class="px-3 py-3 mt-2 rounded-full"
                style="
                    background:#69aeb2;
                    color:#000;
                    white-space:nowrap;
                    overflow:hidden;
                "
            >
                Terakhir diperbarui :
                <span class="ml-1">
                    {{ auth()->user()->updated_at?->format('d-m-Y H:i:s') ?? '-' }}
                </span>
            </div>


          

        </div>

    </div>


    <!-- ============================= -->
    <!-- FORM UBAH PASSWORD -->
    <!-- ============================= -->

    <form
        id="passwordBox"
        action="{{ route('profile.password.update') }}"
        method="POST"
        class="bg-white rounded-2xl shadow p-6 mt-6"
        style="display: {{ $errors->hasAny(['current_password', 'password']) ? 'block' : 'none' }};"
    >
        @csrf
        @method('PUT')

        <div class="section-title">
            <i class="ph ph-lock"></i>
            Ubah Password
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- PASSWORD LAMA -->

            <div>
                <label class="block font-semibold mb-2">
                    Password Lama
                </label>

                <input
                    type="password"
                    id="password_lama"
                    name="current_password"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan password lama"
                    required
                >
            </div>


            <!-- PASSWORD BARU -->

            <div>
                <label class="block font-semibold mb-2">
                    Password Baru
                </label>

                <input
                    type="password"
                    id="password_baru"
                    name="password"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan password baru"
                    required
                >
            </div>


            <!-- KONFIRMASI -->

            <div>
                <label class="block font-semibold mb-2">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="password_konfirmasi"
                    name="password_confirmation"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Ulangi password baru"
                    required
                >
            </div>

        </div>


        <!-- BUTTON -->

        <div class="flex gap-3 mt-5">

            <button
                type="submit"
                class="px-5 py-2 rounded-lg bg-blue-600 text-white"
            >
                <i class="ph ph-floppy-disk mr-1"></i>
                Simpan Password
            </button>


            <button
                type="button"
                onclick="tutupPassword()"
                class="px-5 py-2 rounded-lg bg-gray-500 text-white"
            >
                Batal
            </button>

        </div>

    </form>

</div>


<!-- ============================= -->
<!-- JAVASCRIPT -->
<!-- ============================= -->

<script>

function ubahPassword() {

    document.getElementById('passwordBox').style.display = 'block';

    document.getElementById('passwordBox').scrollIntoView({
        behavior: 'smooth'
    });

}


function tutupPassword() {

    document.getElementById('passwordBox').style.display = 'none';

}




</script>

@endsection