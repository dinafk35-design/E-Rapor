@extends('layouts.app')

@section('content')
    <div class="content">
        <!-- WELCOME -->
        <div class="welcome">
            <h2 class="italic font-bold">
                Selamat Datang, {{ auth()->user()?->name ?? auth()->user()?->username ?? 'Pengguna' }}!
            </h2>
            <p>
                Kelola sistem E-Rapor SMK sesuai hak akses akun Anda.
            </p>
        </div>

        <div class="grid grid-cols-4 gap-4">


            <!-- SISWA -->

            <div class="col-md-6 col-xl-3">

                <div class="stat-card bg-primary">

                    <div class="stat-icon">

                        <i class="ph ph-student"></i>

                    </div>

                    <div>

                        <div class="stat-number">
                            350
                        </div>

                        <div class="stat-title">
                            Total Siswa
                        </div>

                    </div>

                </div>
            </div>



            <!-- GURU -->

            <div class="col-md-6 col-xl-3">

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="ph ph-chalkboard-teacher"></i>

                    </div>

                    <div>

                        <div class="stat-number">
                            70
                        </div>

                        <div class="stat-title">
                            Total Guru
                        </div>

                    </div>

                </div>

            </div>



            <!-- MAPEL -->

            <div class="col-md-6 col-xl-3">

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="ph ph-book"></i>

                    </div>

                    <div>

                        <div class="stat-number">
                            10
                        </div>

                        <div class="stat-title">
                            Mata Pelajaran
                        </div>

                    </div>

                </div>

            </div>



            <!-- ROMBEL -->

            <div class="col-md-6 col-xl-3">

                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="ph ph-users-three"></i>

                    </div>

                    <div>

                        <div class="stat-number">
                            100
                        </div>

                        <div class="stat-title">
                            Total Rombel
                        </div>

                    </div>

                </div>

            </div>


        </div>



        <!-- =================================================
                     TUGAS ADMIN
                ================================================= -->

        <div class="section-title">

            <i class="ph ph-list-checks"></i>

            Tugas Admin

        </div>


        <div class="grid grid-cols-3 gap-4">


            <!-- DATA SEKOLAH -->

            <div class="col-md-6 col-lg-4">

                <div class="task-card">

                    <div class="task-icon">

                        <i class="ph ph-graduation-cap"></i>

                    </div>

                    <h5>
                        Data Sekolah
                    </h5>

                    <p>
                        Mengelola identitas dan informasi sekolah yang digunakan dalam sistem E-Rapor.
                    </p>

                    <a href="{{ url('/data-sekolah') }}" class="task-button">
                        Kelola Data
                    </a>

                </div>

            </div>

            



            <!-- DATA GURU -->

            <div class="col-md-6 col-lg-4">

                <div class="task-card">

                    <div class="task-icon">

                        <i class="ph ph-chalkboard-teacher"></i>

                    </div>

                    <h5>
                        Data Guru
                    </h5>

                    <p>
                        Menambah, mengubah, melihat dan mengelola data guru.
                    </p>

                    <a href="{{ url('/data-guru') }}" class="task-button">
                        Kelola Data
                    </a>

                </div>

            </div>



            <!-- DATA SISWA -->

            <div class="col-md-6 col-lg-4">

                <div class="task-card">

                    <div class="task-icon">

                        <i class="ph ph-student"></i>

                    </div>

                    <h5>
                        Data Siswa
                    </h5>

                    <p>
                        Mengelola data siswa yang terdaftar pada sistem E-Rapor.
                    </p>

                    <a href="{{ url('/data-siswa') }}" class="task-button">
                        Kelola Data
                    </a>

                </div>

            </div>



            <!-- MATA PELAJARAN -->

            <div class="col-md-6 col-lg-4">

                <div class="task-card">

                    <div class="task-icon">

                        <i class="ph ph-book"></i>

                    </div>

                    <h5>
                        Mata Pelajaran
                    </h5>

                    <p>
                        Mengatur daftar mata pelajaran yang digunakan dalam penilaian.
                    </p>

                    <a href="{{ url('/mata-pelajaran') }}" class="task-button">
                        Kelola Data
                    </a>

                </div>

            </div>



            <!-- ROMBEL -->

            <div class="col-md-6 col-lg-4">

                <div class="task-card">

                    <div class="task-icon">

                        <i class="ph ph-users-three"></i>

                    </div>

                    <h5>
                        Rombel
                    </h5>

                    <p>
                        Mengatur rombongan belajar dan pembagian siswa.
                    </p>

                    <a href="{{ url('/rombel') }}" class="task-button">
                        Kelola Data
                    </a>

                </div>

            </div>



            <!-- INPUT NILAI -->

            <div class="col-md-6 col-lg-4">

                <div class="task-card">

                    <div class="task-icon">

                        <i class="ph ph-pencil-simple"></i>

                    </div>

                    <h5>
                        Penilaian
                    </h5>

                    <p>
                        Memantau proses input dan pengelolaan nilai siswa.
                    </p>

                    <a href="{{ url('/penilaian') }}" class="task-button">
                        Kelola Nilai
                    </a>

                </div>

            </div>


        </div>



        <!-- =================================================
                     AKTIVITAS
                ================================================= -->

        <div class="section-title">

            <i class="ph ph-clock-counter-clockwise"></i>

            Aktivitas Sistem

        </div>


        <div class="activity-box">


            <div class="activity">

                <div class="activity-icon">

                    <i class="ph ph-user"></i>

                </div>

                <div>

                    <div class="activity-text">
                        Administrator membuka Dashboard
                    </div>

                    <div class="activity-time">
                        Baru saja
                    </div>

                </div>

            </div>


            <div class="activity">

                <div class="activity-icon">

                    <i class="ph ph-database"></i>

                </div>

                <div>

                    <div class="activity-text">
                        Sistem E-Rapor siap digunakan
                    </div>

                    <div class="activity-time">
                        Hari ini
                    </div>

                </div>

            </div>


            <div class="activity">

                <div class="activity-icon">

                    <i class="ph ph-shield-check"></i>

                </div>

                <div>

                    <div class="activity-text">
                        Pengelolaan data dilakukan oleh Administrator
                    </div>

                    <div class="activity-time">
                        Hari ini
                    </div>

                </div>

            </div>


        </div>


    </div>
@endsection
