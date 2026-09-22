<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">


    <!-- LOGO -->

    <div class="sidebar-header">

        <i class="fa-solid fa-school"></i>

        E-RAPOR SMK

    </div>


    <!-- MENU UTAMA -->

    <div class="menu-section">
        Menu Utama
    </div>


    <a href="{{ route('dashboard')}}" class="menu-link {{ request()->routeIs('dashboard') ? 'bg-red-400' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard </a>
    <a href="{{ route('profile') }}" class="menu-link "><i class="fa-solid fa-user"></i><span>Profile</span></a>
    <a href="{{ route('user-data') }}" class="menu-link "><i class="fa-solid fa-users"></i><span>User Data</span></a>



    <!-- DATA MASTER -->

    <div class="menu-section">
        Data Master
    </div>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-school"></i>

        Data Sekolah

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-chalkboard-user"></i>

        Data Guru

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-user-graduate"></i>

        Data Siswa

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-book"></i>

        Mata Pelajaran

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-people-group"></i>

        Rombel

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-users-viewfinder"></i>

        Anggota Rombel

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-chalkboard"></i>

        Guru Mengajar

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-user-tie"></i>

        Wali Kelas

    </a>



    <!-- PENILAIAN -->

    <div class="menu-section">
        Penilaian
    </div>


    <a href="{{ route('input-nilai') }}" class="menu-link {{ request()->routeIs('input-nilai') ? 'bg-red-400' : '' }}">

        <i class="fa-solid fa-pen-to-square"></i>

        Input Nilai

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-circle-check"></i>

        Status Penilaian

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-chart-line"></i>

        Perkembangan Nilai

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-id-card"></i>

        Nilai Skill Passport

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-award"></i>

        Nilai UKK

    </a>


    <!-- LAPORAN -->

    <div class="menu-section">
        Laporan
    </div>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-print"></i>

        Cetak Nilai

    </a>


    <!-- PENGATURAN -->

    <div class="menu-section">
        Pengaturan
    </div>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-calendar"></i>

        Tahun Ajaran

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-calendar-days"></i>

        Semester

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-user-gear"></i>

        Pengguna

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-database"></i>

        Backup & Restore

    </a>


    <a href="#" class="menu-link">

        <i class="fa-solid fa-right-from-bracket"></i>

        Logout

    </a>


</div>
