<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">


    <!-- LOGO -->

    <div class="sidebar-header">

        <i class="ph ph-graduation-cap"></i>

        E-RAPOR SMK

    </div>


    <!-- MENU UTAMA -->

    <div class="menu-section">
        Menu Utama
    </div>


    <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'bg-slate-800' : '' }}"><i
            class="ph ph-gauge"></i> Dashboard </a>
    <a href="{{ route('profile') }}" class="menu-link  {{ request()->routeIs('profile') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-user"></i>
        Profile
    </a>





    <!-- DATA MASTER -->

    <div class="menu-section">
        Data Master
    </div>


    <a href="{{ route('data-sekolah') }}"
        class="menu-link {{ request()->routeIs('data-sekolah') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-graduation-cap"></i>

        Data Sekolah

    </a>


    <a href="{{ route('data-guru') }}" class="menu-link {{ request()->routeIs('data-guru') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-chalkboard-teacher"></i>

        Data Guru

    </a>


    <a href="{{ route('data-siswa') }}" class="menu-link {{ request()->routeIs('data-siswa') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-student"></i>

        Data Siswa

    </a>


    <a href="{{ route('mata-pelajaran') }}"
        class="menu-link {{ request()->routeIs('mata-pelajaran*') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-book"></i>

        Mata Pelajaran

    </a>


    <a href="{{ route('rombel') }}" class="menu-link {{ request()->routeIs('rombel*') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-users-three"></i>

        Rombel

    </a>


    <a href="{{ route('wali-kelas') }}"
        class="menu-link {{ request()->routeIs('wali-kelas*') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-user"></i>

        Wali Kelas

    </a>



    <!-- PENILAIAN -->

    <div class="menu-section">
        Penilaian
    </div>


    <a href="{{ route('input-nilai') }}"
        class="menu-link {{ request()->routeIs('input-nilai') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-pencil-simple"></i>

        Input Nilai

    </a>


    <a href="{{ route('status-penilaian') }}"
        class="menu-link {{ request()->routeIs('status-penilaian') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-check-circle"></i>

        Status Penilaian

    </a>


     <a href="{{ route('perkembangan-nilai') }}"
        class="menu-link {{ request()->routeIs('perkembangan-nilai') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-chart-line-up"></i>

        Perkembangan Nilai

    </a>


    <a href="{{ route('nilai-skill-passport') }}"
        class="menu-link {{ request()->routeIs('nilai-skill-passport') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-identification-card"></i>

        Nilai Skill Passport

    </a>


    <a href="{{ route('nilai-ukk') }}" class="menu-link {{ request()->routeIs('nilai-ukk') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-medal"></i>

        Nilai UKK

    </a>


    <!-- LAPORAN -->

    <div class="menu-section">
        Laporan
    </div>


    <a href="{{ route('cetak-nilai') }}"
        class="menu-link {{ request()->routeIs('cetak-nilai*') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-printer"></i>

        Cetak Nilai

    </a>


    <!-- PENGATURAN -->

    <div class="menu-section">
        Pengaturan
    </div>


    <a href="{{ route('semester') }}"
        class="menu-link {{ request()->routeIs('semester') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-calendar-dots"></i>

        Semester

    </a>

    <a href="{{ route('pengguna') }}"
        class="menu-link {{ request()->routeIs('pengguna') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-users"></i>

        Pengguna

    </a>


    <a href="{{ route('backup.index') }}"
        class="menu-link {{ request()->routeIs('backup*') ? 'bg-slate-800' : '' }}">

        <i class="ph ph-database"></i>

        Backup &amp; Restore

    </a>


    <form action="{{ route('logout') }}" method="POST" class="menu-link bg-transparent border-0 w-full text-left">
        @csrf

        <button
            type="submit"
            class="flex w-full items-center gap-3 border-0 bg-transparent p-0 text-left text-white">

            <i class="ph ph-sign-out"></i>

            <span>Logout</span>

        </button>

    </form>


</div>
