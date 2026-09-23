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
                        class="fa-solid fa-user"
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
                Administrator
            </h3>


            <!-- USERNAME -->
            <p
                class="text-sm"
                style="color:white;"
            >
                Username : Administrator
            </p>


            <!-- LEVEL -->
            <p
                class="text-sm"
                style="color:white;"
            >
                Level : Pengguna
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
                    🔒 Ubah Password
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
                    Administrator
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
                    Administrator
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
                    Admin
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
                    Adm.rapotsmk@gmail.com
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
                Login terakhir :
                <span class="ml-1">
                    2026-07-29 17:22:21
                </span>
            </div>


          

        </div>

    </div>


    <!-- ============================= -->
    <!-- FORM UBAH PASSWORD -->
    <!-- ============================= -->

    <div
        id="passwordBox"
        class="bg-white rounded-2xl shadow p-6 mt-6"
        style="display:none;"
    >

        <div class="section-title">
            <i class="fa-solid fa-lock"></i>
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
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan password lama"
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
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Masukkan password baru"
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
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Ulangi password baru"
                >
            </div>

        </div>


        <!-- BUTTON -->

        <div class="flex gap-3 mt-5">

            <button
                type="button"
                onclick="simpanPassword()"
                class="px-5 py-2 rounded-lg bg-blue-600 text-white"
            >
                <i class="fa-solid fa-save mr-1"></i>
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

    </div>

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


function simpanPassword() {

    let passwordLama =
        document.getElementById('password_lama').value;

    let passwordBaru =
        document.getElementById('password_baru').value;

    let passwordKonfirmasi =
        document.getElementById('password_konfirmasi').value;


    if (passwordLama === '') {

        alert('⚠️ Password lama harus diisi!');
        return;

    }


    if (passwordBaru === '') {

        alert('⚠️ Password baru harus diisi!');
        return;

    }


    if (passwordKonfirmasi === '') {

        alert('⚠️ Konfirmasi password harus diisi!');
        return;

    }


    if (passwordBaru !== passwordKonfirmasi) {

        alert('❌ Konfirmasi password tidak sama!');
        return;

    }


    alert('✅ Password berhasil diubah!');

    document.getElementById('password_lama').value = '';
    document.getElementById('password_baru').value = '';
    document.getElementById('password_konfirmasi').value = '';

    document.getElementById('passwordBox').style.display = 'none';

}

</script>

@endsection