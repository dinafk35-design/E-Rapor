@extends('layouts.app')

@section('title', 'Dashboard - E-Rapor SMK')

@section('page-title', 'Dashboard')

@section('content')

<div class="mb-4">

    <h3>Dashboard</h3>

    <p class="text-muted">
        Selamat datang di Sistem E-Rapor SMK
    </p>

</div>


<div class="row g-4">


    <!-- DATA SISWA -->

    <div class="col-md-3">

        <div class="stat-card">

            <div class="stat-title">
                👨‍🎓 DATA SISWA
            </div>

            <div class="stat-number">
                0
            </div>

            <small class="text-muted">
                Total siswa
            </small>

        </div>

    </div>


    <!-- DATA GURU -->

    <div class="col-md-3">

        <div class="stat-card">

            <div class="stat-title">
                👨‍🏫 DATA GURU
            </div>

            <div class="stat-number">
                0
            </div>

            <small class="text-muted">
                Total guru
            </small>

        </div>

    </div>


    <!-- MATA PELAJARAN -->

    <div class="col-md-3">

        <div class="stat-card">

            <div class="stat-title">
                📚 MATA PELAJARAN
            </div>

            <div class="stat-number">
                0
            </div>

            <small class="text-muted">
                Total mata pelajaran
            </small>

        </div>

    </div>


    <!-- ROMBEL -->

    <div class="col-md-3">

        <div class="stat-card">

            <div class="stat-title">
                🏫 ROMBEL
            </div>

            <div class="stat-number">
                0
            </div>

            <small class="text-muted">
                Total rombel
            </small>

        </div>

    </div>

</div>


<!-- INFORMASI -->

<div class="row mt-4">


    <div class="col-md-8">

        <div class="stat-card">

            <h5>
                📊 Informasi E-Rapor
            </h5>

            <hr>

            <p>
                Sistem E-Rapor SMK digunakan untuk membantu
                pengelolaan data sekolah, guru, siswa,
                mata pelajaran, rombel, dan penilaian.
            </p>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stat-card">

            <h5>
                📅 Tahun Ajaran
            </h5>

            <hr>

            <h4>
                2026 / 2027
            </h4>

            <p class="text-muted">
                Semester Ganjil
            </p>

        </div>

    </div>


</div>

@endsection