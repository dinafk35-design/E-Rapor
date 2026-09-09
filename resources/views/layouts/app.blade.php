<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Rapor SMK - @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f0f2f5;
            overflow-x: hidden;
        }
        
        /* ===== SIDEBAR ===== */
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background: #1a2332;
            color: #fff;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1050;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: #1a2332;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #4a5a7a;
            border-radius: 10px;
        }
        
        .sidebar .brand {
            padding: 20px 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .sidebar .brand h4 {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar .brand h4 i {
            color: #4fc3f7;
            font-size: 22px;
        }
        
        .sidebar .nav-section-title {
            padding: 20px 20px 8px;
            font-size: 11px;
            text-transform: uppercase;
            color: #6b7a8f;
            font-weight: 600;
            letter-spacing: 1.5px;
        }
        
        .sidebar .nav-link {
            color: #a0b3c9;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.2s;
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }
        
        .sidebar .nav-link.active {
            background: rgba(79, 195, 247, 0.1);
            color: #4fc3f7;
            border-left-color: #4fc3f7;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }
        
        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 260px;
            padding: 20px 30px;
            min-height: 100vh;
            background: #f0f2f5;
        }
        
        /* ===== HEADER ===== */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .top-header .page-title {
            font-size: 20px;
            font-weight: 700;
            color: #1a2332;
        }
        
        .top-header .header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        /* ===== CARDS ===== */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        
        .stat-card .stat-number {
            font-size: 28px;
            font-weight: 800;
            color: #1a2332;
            line-height: 1.2;
        }
        
        .stat-card .stat-label {
            font-size: 14px;
            color: #6b7a8f;
            font-weight: 500;
            margin-top: 4px;
        }
        
        /* ===== CUSTOM CARDS ===== */
        .custom-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            border: none;
            height: 100%;
        }
        
        .custom-card .card-header {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 16px 20px;
            font-weight: 700;
            font-size: 15px;
            color: #1a2332;
            border-radius: 12px 12px 0 0;
        }
        
        .custom-card .card-header i {
            color: #4fc3f7;
            margin-right: 10px;
        }
        
        .custom-card .card-body {
            padding: 20px;
        }
        
        /* ===== TABLE ===== */
        .table-custom {
            font-size: 13px;
            margin-bottom: 0;
        }
        
        .table-custom th {
            background: #f8f9fa;
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
            padding: 10px 12px;
        }
        
        .table-custom td {
            padding: 10px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }
        
        .table-custom tbody tr:hover {
            background: #f8f9fa;
        }
        
        /* ===== BADGES ===== */
        .badge-status {
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .badge-selesai {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-berjalan {
            background: #fff3cd;
            color: #856404;
        }
        
        .badge-return {
            background: #f8d7da;
            color: #721c24;
        }
        
        /* ===== BUTTONS ===== */
        .btn-action {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #495057;
            transition: all 0.2s;
        }
        
        .btn-action:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }
        
        .btn-action i {
            font-size: 13px;
        }
        
        .btn-primary-custom {
            background: #4fc3f7;
            border: none;
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
        }
        
        .btn-primary-custom:hover {
            background: #29b6f6;
            color: #fff;
        }
        
        .btn-danger-custom {
            background: #ef5350;
            border: none;
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.2s;
        }
        
        .btn-danger-custom:hover {
            background: #d32f2f;
            color: #fff;
        }
        
        .btn-outline-custom {
            background: transparent;
            border: 1px solid #dee2e6;
            color: #495057;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            transition: all 0.2s;
        }
        
        .btn-outline-custom:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .menu-toggle {
                display: block !important;
            }
            
            .stat-card .stat-number {
                font-size: 22px;
            }
            
            .top-header .page-title {
                font-size: 17px;
            }
        }
        
        @media (min-width: 769px) {
            .menu-toggle {
                display: none !important;
            }
        }
        
        /* ===== OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1040;
        }
        
        .sidebar-overlay.active {
            display: block;
        }
        
        /* ===== LINK FORM ===== */
        .link-form-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            color: #495057;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
            background: #fff;
        }
        
        .link-form-item:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
            color: #1a2332;
        }
        
        .link-form-item i {
            font-size: 14px;
        }
        
        /* ===== ACTIVITY LIST ===== */
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .activity-list li {
            padding: 6px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #495057;
        }
        
        .activity-list li .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #4fc3f7;
            flex-shrink: 0;
        }
        
        /* ===== SEARCH ===== */
        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 6px 14px;
            background: #fff;
        }
        
        .search-box input {
            border: none;
            outline: none;
            font-size: 13px;
            padding: 4px 0;
            width: 150px;
        }
        
        .search-box input::placeholder {
            color: #adb5bd;
        }
        
        .search-box button {
            background: none;
            border: none;
            color: #6b7a8f;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- ===== SIDEBAR ===== -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <h4>
                <i class="fas fa-graduation-cap"></i>
                E-Rapor SMK
            </h4>
        </div>
        
        <nav>
            <!-- MENU UTAMA -->
            <div class="nav-section-title">MENU UTAMA</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('user-data') }}" class="nav-link {{ request()->routeIs('user-data') ? 'active' : '' }}">
                <i class="fas fa-users"></i> User Data
            </a>
            
            <!-- REFERENSI DATA -->
            <div class="nav-section-title">REFERENSI DATA</div>
            <a href="{{ route('data-sekolah') }}" class="nav-link {{ request()->routeIs('data-sekolah') ? 'active' : '' }}">
                <i class="fas fa-school"></i> Data Sekolah
            </a>
            <a href="{{ route('data-guru') }}" class="nav-link {{ request()->routeIs('data-guru') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> Data Guru
            </a>
            <a href="{{ route('data-siswa') }}" class="nav-link {{ request()->routeIs('data-siswa') ? 'active' : '' }}">
                <i class="fas fa-user-graduate"></i> Data Siswa
            </a>
            <a href="{{ route('mata-pelajaran') }}" class="nav-link {{ request()->routeIs('mata-pelajaran') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Mata Pelajaran
            </a>
            <a href="{{ route('rombel') }}" class="nav-link {{ request()->routeIs('rombel') ? 'active' : '' }}">
                <i class="fas fa-users-between-lines"></i> Rombel
            </a>
            <a href="{{ route('anggota-rombel') }}" class="nav-link {{ request()->routeIs('anggota-rombel') ? 'active' : '' }}">
                <i class="fas fa-user-plus"></i> Anggota Rombel
            </a>
            <a href="{{ route('guru-mengajar') }}" class="nav-link {{ request()->routeIs('guru-mengajar') ? 'active' : '' }}">
                <i class="fas fa-chalkboard"></i> Guru Mengajar
            </a>
            <a href="{{ route('wali-kelas') }}" class="nav-link {{ request()->routeIs('wali-kelas') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> Wali Kelas
            </a>
            
            <!-- PENILAIAN -->
            <div class="nav-section-title">PENILAIAN</div>
            <a href="{{ route('status-penilaian') }}" class="nav-link {{ request()->routeIs('status-penilaian') ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i> Status Penilaian
            </a>
            <a href="{{ route('perkembangan-nilai') }}" class="nav-link {{ request()->routeIs('perkembangan-nilai') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Perkembangan Nilai
            </a>
            <a href="{{ route('nilai-skill-passport') }}" class="nav-link {{ request()->routeIs('nilai-skill-passport') ? 'active' : '' }}">
                <i class="fas fa-passport"></i> Nilai Skill Passport
            </a>
            <a href="{{ route('nilai-ukk') }}" class="nav-link {{ request()->routeIs('nilai-ukk') ? 'active' : '' }}">
                <i class="fas fa-certificate"></i> Nilai UKK
            </a>
            
            <!-- TAMBAHAN DARI GAMBAR PERTAMA -->
            <div class="nav-section-title">LAINNYA</div>
            <a href="{{ route('assessment-status') }}" class="nav-link">
                <i class="fas fa-clipboard-check"></i> Assessment Status
            </a>
            <a href="{{ route('cetak-nilai') }}" class="nav-link">
                <i class="fas fa-print"></i> Cetak Nilai
            </a>
        </nav>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content" id="mainContent">
        <!-- Mobile Menu Toggle -->
        <div class="menu-toggle" style="display:none; margin-bottom:15px;">
            <button class="btn btn-dark" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>
        
        @yield('content')
    </div>

    <!-- ===== SCRIPTS ===== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }
        
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        }
        
        // Show menu toggle on mobile
        if (window.innerWidth <= 768) {
            document.querySelector('.menu-toggle').style.display = 'block';
        }
        
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                document.querySelector('.menu-toggle').style.display = 'block';
            } else {
                document.querySelector('.menu-toggle').style.display = 'none';
                closeSidebar();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>