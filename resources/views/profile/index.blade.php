@extends('layouts.app')

@section('content')

<style>

    /* ==============================
       PROFILE PAGE
    ============================== */

    .profile-page {
        min-height: calc(100vh - 80px);
        margin: -40px;
        padding: 45px 40px;
        background: #c9e3f4;
    }


    /* JUDUL */

    .profile-title {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 20px;
    }


    /* CONTAINER */

    .profile-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        max-width: 1100px;
    }


    /* ==============================
       KARTU PROFILE
    ============================== */

    .profile-card {
        background: #704747;
        border-radius: 45px;
        min-height: 390px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        padding: 35px;
        color: white;

        box-shadow: 0 8px 20px rgba(0,0,0,0.10);
    }


    /* ICON */

    .profile-icon {
        width: 120px;
        height: 120px;

        border: 9px solid white;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 15px;
    }


    .profile-icon span {
        font-size: 65px;
        line-height: 1;
    }


    /* NAMA */

    .profile-name {
        font-size: 20px;
        font-weight: 700;
        margin-top: 3px;
    }


    /* USERNAME */

    .profile-username {
        font-size: 16px;
        margin-top: 3px;
    }


    /* LEVEL */

    .profile-level {
        font-size: 16px;
        margin-top: 2px;
    }


    /* BUTTON */

    .password-button {
        margin-top: 30px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-width: 205px;

        padding: 11px 25px;

        border-radius: 30px;

        background: #3d2b91;
        color: white;

        text-decoration: none;

        font-size: 16px;
        font-weight: 600;

        transition: 0.2s;
    }


    .password-button:hover {
        background: #2f207a;
        transform: translateY(-1px);
    }


    /* ==============================
       DETAIL
    ============================== */

    .detail-container {
        width: 100%;
    }


    .detail-title {
        background: #5076b3;
        color: white;

        padding: 10px 15px;

        font-size: 18px;
        font-weight: 500;
    }


    .detail-item {
        background: #69aeae;

        min-height: 48px;

        margin-top: 5px;

        border-radius: 30px;

        display: flex;
        align-items: center;

        padding: 0 15px;

        font-size: 16px;

        color: #111827;
    }


    .detail-label {
        font-weight: 500;
        margin-right: 7px;
        white-space: nowrap;
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 900px) {

        .profile-container {
            grid-template-columns: 1fr;
        }

        .profile-page {
            margin: -20px;
            padding: 30px 20px;
        }

    }


    @media (max-width: 500px) {

        .profile-card {
            border-radius: 30px;
            padding: 25px 15px;
        }

        .detail-item {
            font-size: 14px;
        }

    }

</style>


<div class="profile-page">

    <!-- ========================= -->
    <!-- JUDUL -->
    <!-- ========================= -->

    <div class="profile-title">
        PROFIL PENGGUNA
    </div>


    <!-- ========================= -->
    <!-- PROFILE CONTAINER -->
    <!-- ========================= -->

    <div class="profile-container">


        <!-- ========================= -->
        <!-- KARTU USER -->
        <!-- ========================= -->

        <div class="profile-card">


            <!-- ICON USER -->

            <div class="profile-icon">

                <span>
                    👤
                </span>

            </div>


            <!-- NAMA -->

            <div class="profile-name">

                {{ $user->name }}

            </div>


            <!-- USERNAME -->

            <div class="profile-username">

                Username : {{ $user->username ?? '-' }}

            </div>


            <!-- LEVEL -->

            <div class="profile-level">

                Level : {{ $user->role ?? 'Pengguna' }}

            </div>


            <!-- UBAH PASSWORD -->

            <a href="#"
               class="password-button">

                🔒 Ubah Password

            </a>

        </div>



        <!-- ========================= -->
        <!-- DETAIL USER -->
        <!-- ========================= -->

        <div class="detail-container">


            <!-- JUDUL DETAIL -->

            <div class="detail-title">

                DETAIL

            </div>


            <!-- NAMA -->

            <div class="detail-item">

                <span class="detail-label">
                    Nama :
                </span>

                {{ $user->name }}

            </div>


            <!-- USERNAME -->

            <div class="detail-item">

                <span class="detail-label">
                    Username :
                </span>

                {{ $user->username ?? '-' }}

            </div>


            <!-- LEVEL -->

            <div class="detail-item">

                <span class="detail-label">
                    Level :
                </span>

                {{ $user->role ?? 'Pengguna' }}

            </div>


            <!-- EMAIL -->

            <div class="detail-item">

                <span class="detail-label">
                    E-mail :
                </span>

                {{ $user->email }}

            </div>


            <!-- LOGIN TERAKHIR -->

            <div class="detail-item">

                <span class="detail-label">
                    Login terakhir :
                </span>

                {{ $user->login_terakhir ?? '-' }}

            </div>


            <!-- IP -->

            <div class="detail-item">

                <span class="detail-label">
                    IP :
                </span>

                {{ $user->ip ?? '-' }}

            </div>

        </div>

    </div>

</div>

@endsection