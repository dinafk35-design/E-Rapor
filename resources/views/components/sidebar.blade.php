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


    @if (auth()->user()?->role == 'admin')
        
    <!-- DATA MASTER -->

    <div class="menu-section">
        Data Master
    </div>

    <a href="{{ route('data-sekolah.index') }}"class="menu-link {{ request()->routeIs('data-sekolah.index') ? 'bg-slate-800' : '' }}">
    <i class="ph ph-chalkboard-teacher"></i>
    <span>Data Sekolah</span>
    </a>

    <a href="{{ route('data-guru.index') }}"class="menu-link {{ request()->routeIs('data-guru.index') ? 'bg-slate-800' : '' }}">
    <i class="ph ph-chalkboard-teacher"></i>
    <span>Data Guru</span>
    </a>

    <a href="{{ route('data-siswa.index') }}"class="menu-link {{ request()->routeIs('data-siswa.index') ? 'bg-slate-800' : '' }}">
    <i class="ph ph-chalkboard-teacher"></i>
    <span>Data Siswa</span>
    </a>

    <a href="{{ route('mata-pelajaran.index') }}"class="menu-link {{ request()->routeIs('mata-pelajaran.index') ? 'bg-slate-800' : '' }}">
    <i class="ph ph-chalkboard-teacher"></i>
    <span>Mata Pelajaran</span>
    </a>

    <a href="{{ route('rombel.index') }}"class="menu-link {{ request()->routeIs('rombel.index') ? 'bg-slate-800' : '' }}">
    <i class="ph ph-chalkboard-teacher"></i>
    <span>Rombel</span>
    </a>

    <a href="{{ route('wali-kelas.index') }}"class="menu-link {{ request()->routeIs('wali-kelas.index') ? 'bg-slate-800' : '' }}">
    <i class="ph ph-chalkboard-teacher"></i>
    <span>Wali Kelas</span>
    </a>
    @endif

    @if (in_array(auth()->user()?->role, ['admin', 'guru']))
        
    <!-- PENILAIAN -->

    <div class="menu-section">
        Penilaian
    </div>

    <a href="{{ route('input-nilai') }}" class="menu-link {{ request()->routeIs('input-nilai') ? 'bg-slate-800' : '' }}">
         <i class="ph ph-pencil-simple"></i>
         Input Nilai
     </a>

    <a href="{{ route('status-penilaian') }}"class="menu-link {{ request()->routeIs('status-penilaian') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-check-circle"></i>
        Status Penilaian
    </a>

    <a href="{{ route('perkembangan-nilai') }}"class="menu-link {{ request()->routeIs('perkembangan-nilai') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-chart-line-up"></i>
        Perkembangan Nilai
    </a>

    <a href="{{ route('nilai-skill-passport') }}"class="menu-link {{ request()->routeIs('nilai-skill-passport') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-identification-card"></i>
        Nilai Skill Passport
    </a>

    <a href="{{ route('nilai-ukk') }}" class="menu-link {{ request()->routeIs('nilai-ukk') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-medal"></i>
        Nilai UKK
    </a>
    @endif

    <!-- LAPORAN -->

    <div class="menu-section">
        Laporan
    </div>

    <a href="{{ route('cetak-nilai') }}"class="menu-link {{ request()->routeIs('cetak-nilai*') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-printer"></i>
        Cetak Nilai
    </a>

    <!-- PENGATURAN -->
    
    <div class="menu-section">
        Pengaturan
    </div>
    
    @if (auth()->user()?->role == 'admin')

    <a href="{{ route('semester') }}" class="menu-link {{ request()->routeIs('semester') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-calendar-dots"></i>
        Semester
    </a>

    <a href="{{ route('pengguna') }}" class="menu-link {{ request()->routeIs('pengguna') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-users"></i>
        Pengguna
    </a>

    <a href="{{ route('backup.index') }}" class="menu-link {{ request()->routeIs('backup*') ? 'bg-slate-800' : '' }}">
        <i class="ph ph-database"></i>
        Backup &amp; Restore
    </a>
    @endif

<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button
        type="submit" 
        class="flex pointer items-center gap-3 px-5 py-3 mx-[10px] my-[3px] text-[#f9f6f6] no-underline rounded-[7px] text-sm transition duration-200 hover:bg-red-600"
    >
        <i class="ph ph-sign-out"></i>
        <span>Logout</span>
    </button>
</form>


</div>
