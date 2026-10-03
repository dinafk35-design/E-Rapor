<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-[999] flex w-[260px] -translate-x-full flex-col overflow-y-auto bg-gradient-to-b from-[#25284d] via-[#37367a] to-[#5148b8] pb-8 text-white transition-transform duration-300 ease-in-out md:translate-x-0">

    {{-- LOGO --}}
    <div
        class="border-b border-[rgba(191,168,39,0.15)] px-5 py-6 text-[22px] font-bold max-md:px-[15px] max-md:py-5 max-md:text-lg">
        <i class="ph ph-graduation-cap mr-2"></i>
        E-RAPOR SMK
    </div>


    {{-- MENU UTAMA --}}
    <div class="px-5 pb-2 pt-5 text-[11px] font-bold uppercase text-gray-100 max-md:px-[15px] max-md:pt-[15px]">
        Menu Utama
    </div>


    <a href="{{ route('dashboard') }}"
        class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('dashboard') ? 'bg-slate-800/60' : '' }}">
        <i class="ph ph-gauge w-5 text-center"></i>
        <span>Dashboard</span>
    </a>


    <a href="{{ route('profile') }}"
        class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('profile') ? 'bg-slate-800/60' : '' }}">
        <i class="ph ph-user-circle w-5 text-center"></i>
        <span>Profile</span>
    </a>


    @if (auth()->user()?->role == 'admin')
        <div class="px-5 pb-2 pt-5 text-[11px] font-bold uppercase text-gray-100 max-md:px-[15px] max-md:pt-[15px]">
            Data Master
        </div>

        <a href="{{ route('data-sekolah.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('data-sekolah.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-buildings w-5 text-center"></i>
            <span>Data Sekolah</span>
        </a>

        <a href="{{ route('data-guru.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('data-guru.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-chalkboard-teacher w-5 text-center"></i>
            <span>Data Guru</span>
        </a>

        <a href="{{ route('data-siswa.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('data-siswa.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-student w-5 text-center"></i>
            <span>Data Siswa</span>
        </a>

        <a href="{{ route('mata-pelajaran.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('mata-pelajaran.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-book-open w-5 text-center"></i>
            <span>Mata Pelajaran</span>
        </a>

        <a href="{{ route('guru-mengajar.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('guru-mengajar.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-chalkboard-teacher w-5 text-center"></i>
            <span>Guru Mengajar</span>
        </a>

        <a href="{{ route('rombel.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('rombel.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-users-three w-5 text-center"></i>
            <span>Rombel</span>
        </a>

        <a href="{{ route('wali-kelas.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('wali-kelas.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-identification-card w-5 text-center"></i>
            <span>Wali Kelas</span>
        </a>
    @endif


    @if (in_array(auth()->user()?->role, ['admin', 'guru']))
        <div class="px-5 pb-2 pt-5 text-[11px] font-bold uppercase text-gray-100 max-md:px-[15px] max-md:pt-[15px]">
            Penilaian
        </div>

        <a href="{{ route('input-nilai') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('input-nilai') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-pencil-simple-line w-5 text-center"></i>
            <span>Input Nilai</span>
        </a>

        <a href="{{ route('status-penilaian') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('status-penilaian') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-clipboard-text w-5 text-center"></i>
            <span>Status Penilaian</span>
        </a>

        <a href="{{ route('perkembangan-nilai') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('perkembangan-nilai') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-chart-line-up w-5 text-center"></i>
            <span>Perkembangan Nilai</span>
        </a>

        <a href="{{ route('nilai-skill-passport') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('nilai-skill-passport') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-medal w-5 text-center"></i>
            <span>Nilai Skill Passport</span>
        </a>

        <a href="{{ route('nilai-ukk') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('nilai-ukk') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-exam w-5 text-center"></i>
            <span>Nilai UKK</span>
        </a>
    @endif


    {{-- LAPORAN --}}
    <div class="px-5 pb-2 pt-5 text-[11px] font-bold uppercase text-gray-100 max-md:px-[15px] max-md:pt-[15px]">
        Laporan
    </div>


    <a href="{{ route('cetak-nilai') }}"
        class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('cetak-nilai*') ? 'bg-slate-800/60' : '' }}">
        <i class="ph ph-printer w-5 text-center"></i>
        <span>Cetak Nilai</span>
    </a>


    {{-- PENGATURAN --}}
    <div class="px-5 pb-2 pt-5 text-[11px] font-bold uppercase text-gray-100 max-md:px-[15px] max-md:pt-[15px]">
        Pengaturan
    </div>


    @if (auth()->user()?->role == 'admin')
        <a href="{{ route('semester') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('semester') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-calendar-blank w-5 text-center"></i>
            <span>Semester</span>
        </a>

        <a href="{{ route('pengguna') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('pengguna') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-users w-5 text-center"></i>
            <span>Pengguna</span>
        </a>

        <a href="{{ route('backup.index') }}"
            class="mx-2.5 my-[3px] flex items-center gap-3 rounded-[7px] px-5 py-3 text-sm text-[#f9f6f6] transition hover:bg-white/10 max-md:px-[15px] max-md:py-2.5 max-md:text-[13px] {{ request()->routeIs('backup.*') ? 'bg-slate-800/60' : '' }}">
            <i class="ph ph-database w-5 text-center"></i>
            <span>Backup &amp; Restore</span>
        </a>
    @endif


    {{-- LOGOUT --}}
    <form action="{{ route('logout') }}" method="POST" class="mt-1">
        @csrf

        <button type="submit"
            class="mx-2.5 flex w-[calc(100%-20px)] items-center gap-3 rounded-[7px] border-0 bg-transparent px-5 py-3 text-left text-sm text-[#f9f6f6] transition hover:bg-red-600 hover:text-white max-md:px-[15px] max-md:py-2.5 max-md:text-[13px]">
            <i class="ph ph-sign-out w-5 text-center"></i>
            <span>Logout</span>
        </button>
    </form>

</aside>
