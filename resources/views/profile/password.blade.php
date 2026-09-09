@extends('layouts.app')

@section('content')

<style>

    /* ===============================
       HALAMAN PASSWORD
    =============================== */

    .password-page {
        min-height: calc(100vh - 80px);

        margin: -40px;

        padding: 45px 55px;

        background: #c5c3c3;
    }


    .password-wrapper {
        display: grid;

        grid-template-columns: 1.2fr 1fr;

        gap: 48px;

        max-width: 1000px;

        margin: 0 auto;
    }


    /* ===============================
       PROFILE CARD
    =============================== */

    .user-profile-card {

        background: #777171;

        min-height: 400px;

        padding: 25px;

        color: white;

    }


    .user-profile-title {

        background: #4ca5b5;

        padding: 12px 17px;

        margin: -25px -25px 20px;

        font-size: 22px;

        font-weight: bold;

    }


    .user-icon {

        width: 120px;

        height: 120px;

        border: 9px solid #211f27;

        border-radius: 50%;

        margin: 20px auto 8px;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #211f27;

    }


    .user-icon span {

        font-size: 60px;

    }


    .user-name {

        text-align: center;

        font-size: 17px;

        font-weight: bold;

    }


    .user-info {

        text-align: center;

        font-size: 15px;

        margin-top: 3px;

    }


    .password-button {

        display: block;

        width: 210px;

        margin: 18px auto 0;

        padding: 12px;

        text-align: center;

        background: #3d2b91;

        color: white;

        border-radius: 30px;

        font-weight: bold;

        text-decoration: none;

    }


    /* ===============================
       FORM PASSWORD
    =============================== */

    .password-form-card {

        background: #777171;

        color: white;

        padding: 20px 27px 17px;

        min-height: 320px;

    }


    .password-title {

        font-size: 22px;

        font-weight: bold;

        margin-bottom: 24px;

    }


    .form-row {

        display: grid;

        grid-template-columns: 165px 15px 1fr;

        align-items: center;

        margin-bottom: 14px;

        font-size: 14px;

        font-weight: bold;

    }


    .form-input {

        width: 100%;

        height: 28px;

        border: none;

        outline: none;

        background: #4ca5b5;

        color: white;

        padding: 5px 10px;

        box-sizing: border-box;

    }


    .form-input:focus {

        box-shadow: 0 0 0 2px rgba(255,255,255,0.5);

    }


    .button-area {

        display: flex;

        justify-content: flex-end;

        gap: 25px;

        margin-top: 75px;

    }


    .btn-close {

        border: none;

        background: #4ca5b5;

        color: white;

        padding: 4px 15px;

        font-weight: bold;

        cursor: pointer;

        text-decoration: none;

    }


    .btn-save {

        border: none;

        background: #4ca5b5;

        color: white;

        padding: 4px 15px;

        font-weight: bold;

        cursor: pointer;

    }


    .btn-save:hover,

    .btn-close:hover {

        opacity: 0.85;

    }


    /* ===============================
       ERROR
    =============================== */

    .error-message {

        color: #ffdddd;

        font-size: 12px;

        margin-top: -8px;

        margin-bottom: 8px;

    }


    /* ===============================
       SUCCESS POPUP
    =============================== */

    .success-overlay {

        position: fixed;

        inset: 0;

        background: rgba(0, 0, 0, 0.25);

        display: flex;

        align-items: center;

        justify-content: center;

        z-index: 9999;

    }


    .success-box {

        width: 270px;

        background: #777171;

        padding: 18px;

        text-align: center;

        color: white;

        box-shadow: 0 8px 25px rgba(0,0,0,0.2);

    }


    .success-icon {

        width: 55px;

        height: 45px;

        border: 5px solid #211f27;

        margin: 0 auto 8px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 28px;

        color: #211f27;

    }


    .success-title {

        font-size: 15px;

        font-weight: bold;

    }


    .success-text {

        font-size: 10px;

        margin-bottom: 35px;

    }


    .success-ok {

        border: none;

        background: #4ca5b5;

        color: white;

        padding: 4px 20px;

        cursor: pointer;

        font-weight: bold;

    }


    /* ===============================
       RESPONSIVE
    =============================== */

    @media (max-width: 800px) {

        .password-wrapper {

            grid-template-columns: 1fr;

        }

        .password-page {

            margin: -20px;

            padding: 30px 20px;

        }

        .button-area {

            margin-top: 30px;

        }

    }

</style>


<div class="password-page">

    <div class="password-wrapper">


        <!-- ================================= -->
        <!-- PROFILE PENGGUNA -->
        <!-- ================================= -->

        <div class="user-profile-card">

            <div class="user-profile-title">

                Profile Pengguna

            </div>


            <div class="user-icon">

                <span>👤</span>

            </div>


            <div class="user-name">

                {{ $user->name }}

            </div>


            <div class="user-info">

                Username: {{ $user->username ?? '-' }}

            </div>


            <div class="user-info">

                Level : {{ $user->role ?? 'Pengguna' }}

            </div>


            <a href="{{ route('profile') }}"
               class="password-button">

                🔒 Ubah Password

            </a>

        </div>



        <!-- ================================= -->
        <!-- FORM UBAH PASSWORD -->
        <!-- ================================= -->

        <div class="password-form-card">

            <div class="password-title">

                Ubah Password {{ $user->name }}

            </div>


            <form
                action="{{ route('profile.password.update') }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <!-- USERNAME -->

                <div class="form-row">

                    <label>
                        Username
                    </label>

                    <span>:</span>

                    <input
                        type="text"
                        class="form-input"
                        value="{{ $user->username }}"
                        readonly
                    >

                </div>


                <!-- PASSWORD LAMA -->

                <div class="form-row">

                    <label>
                        Password Lama
                    </label>

                    <span>:</span>

                    <input
                        type="password"
                        name="password_lama"
                        class="form-input"
                        placeholder="Password Lama"
                        required
                    >

                </div>

                @error('password_lama')

                    <div class="error-message">
                        {{ $message }}
                    </div>

                @enderror


                <!-- PASSWORD BARU -->

                <div class="form-row">

                    <label>
                        Password Baru
                    </label>

                    <span>:</span>

                    <input
                        type="password"
                        name="password_baru"
                        class="form-input"
                        placeholder="Password Baru"
                        required
                    >

                </div>

                @error('password_baru')

                    <div class="error-message">
                        {{ $message }}
                    </div>

                @enderror


                <!-- KONFIRMASI -->

                <div class="form-row">

                    <label>
                        Konfirmasi Password Baru
                    </label>

                    <span>:</span>

                    <input
                        type="password"
                        name="password_baru_confirmation"
                        class="form-input"
                        placeholder="Konfirmasi Password Baru"
                        required
                    >

                </div>

                @error('password_baru_confirmation')

                    <div class="error-message">
                        {{ $message }}
                    </div>

                @enderror


                <!-- BUTTON -->

                <div class="button-area">

                    <a
                        href="{{ route('profile') }}"
                        class="btn-close"
                    >
                        Close
                    </a>


                    <button
                        type="submit"
                        class="btn-save"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- ================================= -->
<!-- POPUP BERHASIL -->
<!-- ================================= -->

@if(session('success'))

    <div
        class="success-overlay"
        id="successPopup"
    >

        <div class="success-box">

            <div class="success-icon">

                ✓

            </div>


            <div class="success-title">

                Berhasil!

            </div>


            <div class="success-text">

                {{ session('success') }}

            </div>


            <button
                class="success-ok"
                onclick="document.getElementById('successPopup').style.display='none'"
            >

                Ok

            </button>

        </div>

    </div>

@endif

@endsection