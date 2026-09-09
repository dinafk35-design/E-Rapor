<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - E-Rapor SMK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            display: flex;
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            width: 260px;
            background: #1a3a5c;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #1a3a5c;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #3a7aaa;
            border-radius: 10px;
        }

        .sidebar-brand {
            padding: 25px 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand h1 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .sidebar-brand .subtitle {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 3px;
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            padding: 15px 0 20px;
            flex: 1;
        }

        .sidebar-menu .menu-label {
            font-size: 11px;
            text-transform: uppercase;
            opacity: 0.5;
            padding: 10px 20px 5px;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .sidebar-menu .menu-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
            cursor: pointer;
            border-left: 3px solid transparent;
            position: relative;
        }

        .sidebar-menu .menu-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .sidebar-menu .menu-item.active {
            background: rgba(255, 255, 255, 0.08);
            color: white;
            border-left-color: #4a9eff;
        }

        .sidebar-menu .menu-item i {
            width: 22px;
            font-size: 16px;
            margin-right: 12px;
            text-align: center;
        }

        .sidebar-menu .menu-item .arrow {
            margin-left: auto;
            font-size: 12px;
            transition: transform 0.3s;
        }

        .sidebar-menu .menu-item .arrow.open {
            transform: rotate(90deg);
        }

        .sidebar-menu .sub-menu {
            padding-left: 20px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .sidebar-menu .sub-menu.open {
            max-height: 500px;
        }

        .sidebar-menu .sub-menu .menu-item {
            padding: 8px 20px 8px 54px;
            font-size: 13px;
        }

        .sidebar-menu .sub-menu .menu-item i {
            width: 18px;
            font-size: 13px;
            margin-right: 10px;
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 25px 30px 30px;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .top-bar .page-title h2 {
            font-size: 24px;
            color: #1a3a5c;
            font-weight: 700;
        }

        .top-bar .page-title .breadcrumb {
            font-size: 13px;
            color: #888;
            margin-top: 3px;
        }

        .top-bar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top-bar .user-info .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2c5a8c;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }

        .top-bar .user-info .name {
            font-weight: 600;
            color: #1a3a5c;
            font-size: 14px;
        }

        .top-bar .user-info .role {
            font-size: 12px;
            color: #888;
        }

        /* ========== CARDS ========== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border-left: 4px solid #2c5a8c;
        }

        .stat-card .number {
            font-size: 28px;
            font-weight: 700;
            color: #1a3a5c;
        }

        .stat-card .label {
            font-size: 13px;
            color: #888;
            margin-top: 2px;
        }

        /* ========== TWO COLUMN LAYOUT ========== */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            padding: 20px 25px;
        }

        .card .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a3a5c;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card .card-title .badge {
            font-size: 12px;
            font-weight: 400;
            background: #e8f0fe;
            color: #2c5a8c;
            padding: 2px 12px;
            border-radius: 20px;
        }

        .card .card-title .toggle-btn {
            background: #2c5a8c;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
        }

        .card .card-title .toggle-btn:hover {
            background: #1a3a5c;
        }

        /* ========== LINK FORM ========== */
        .link-form {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .link-form a {
            color: #2c5a8c;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: block;
            padding: 5px 0;
        }

        .link-form a:hover {
            text-decoration: underline;
        }

        /* ========== ACTIVITY LIST ========== */
        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item .icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e8f0fe;
            color: #2c5a8c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .activity-item .text {
            font-size: 14px;
            color: #333;
        }

        .activity-item .text small {
            display: block;
            font-size: 12px;
            color: #999;
        }

        /* ========== WORK ITEMS ========== */
        .work-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            font-size: 14px;
            color: #333;
        }

        .work-item i {
            color: #2c5a8c;
            width: 18px;
            font-size: 14px;
        }

        .work-item .check {
            margin-left: auto;
            color: #28a745;
        }

        /* ========== TABLE TOOLBAR ========== */
        .table-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .table-toolbar .btn {
            padding: 5px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            font-size: 13px;
            cursor: pointer;
            color: #333;
            transition: all 0.2s;
        }

        .table-toolbar .btn:hover {
            background: #f0f0f0;
        }

        .table-toolbar .btn-primary {
            background: #2c5a8c;
            color: white;
            border-color: #2c5a8c;
        }

        .table-toolbar .btn-primary:hover {
            background: #1a3a5c;
        }

        .table-toolbar .show-rows {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #666;
            margin-left: auto;
        }

        .table-toolbar .show-rows select {
            padding: 4px 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
        }

        /* ========== STATUS BAR ========== */
        .status-bar {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 15px 0;
            border-top: 1px solid #e0e0e0;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .status-bar .status-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #333;
        }

        .status-bar .status-item .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-bar .status-item .dot.green {
            background: #28a745;
        }

        .status-bar .status-item .dot.red {
            background: #dc3545;
        }

        .status-bar .status-item .dot.yellow {
            background: #ffc107;
        }

        /* ========== RESPONSIVE ========== */
        .hamburger {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #1a3a5c;
            cursor: pointer;
            padding: 5px;
        }

        .close-sidebar {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            padding: 10px 20px;
            text-align: right;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        @media (max-width: 1024px) {
            .two-col {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .close-sidebar {
                display: block;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .hamburger {
                display: block;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .status-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .table-toolbar .show-rows {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- ===== SIDEBAR OVERLAY ===== -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="close-sidebar" onclick="toggleSidebar()">
            <i class="fas fa-times"></i>
        </div>

        <div class="sidebar-brand">
            <h1>E-Rapor SMK</h1>
            <div class="subtitle">WORKSPACE OPERATOR SEKOLAH</div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Menu</div>

            <a href="#" class="menu-item active">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-user"></i> Profile
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-users"></i> User Data
            </a>

            <div class="menu-item" onclick="toggleSubMenu(this)">
                <i class="fas fa-database"></i> Reference Data
                <span class="arrow"><i class="fas fa-chevron-right"></i></span>
            </div>
            <div class="sub-menu">
                <a href="#" class="menu-item"><i class="fas fa-school"></i> Data Sekolah</a>
                <a href="#" class="menu-item"><i class="fas fa-chalkboard-teacher"></i> Data Guru</a>
                <a href="#" class="menu-item"><i class="fas fa-user-graduate"></i> Data Siswa</a>
                <a href="#" class="menu-item"><i class="fas fa-book"></i> Mata Pelajaran</a>
                <a href="#" class="menu-item"><i class="fas fa-layer-group"></i> Rombel</a>
            </div>

            <a href="#" class="menu-item">
                <i class="fas fa-users-cog"></i> Anggota Rombel
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-chalkboard"></i> Guru Mengajar
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-user-tie"></i> Wali Kelas
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-check-circle"></i> Assessment Status
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-id-card"></i> Nilai Skill Pasport
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-certificate"></i> Nilai UKK
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-chart-bar"></i> Status Penilaian
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-chart-line"></i> Perkembangan Nilai
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-print"></i> Cetak Nilai
            </a>
        </nav>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <button class="hamburger" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h2>Dashboard</h2>
                <div class="breadcrumb">E-Rapor SMK / Dashboard</div>
            </div>
            <div class="user-info">
                <div>
                    <div class="name">{{ Auth::user()->username ?? 'Operator' }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="avatar">{{ substr(Auth::user()->username ?? 'OP', 0, 2) }}</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="number">1,205</div>
                <div class="label">Pengguna</div>
            </div>
            <div class="stat-card">
                <div class="number">50</div>
                <div class="label">Rombel</div>
            </div>
            <div class="stat-card">
                <div class="number">205</div>
                <div class="label">Aktif</div>
            </div>
            <div class="stat-card">
                <div class="number">215</div>
                <div class="label">Pembelajaran</div>
            </div>
            <div class="stat-card">
                <div class="number">5</div>
                <div class="label">Kelas Aktif</div>
            </div>
            <div class="stat-card">
                <div class="number">40</div>
                <div class="label">Guru & Kepala sekolah</div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="two-col">
            <!-- Left Column -->
            <div>
                <!-- Link Form -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-title">
                        <span><i class="fas fa-link" style="margin-right: 8px; color: #2c5a8c;"></i> LINK FORM PENDAIAN DAN PANDUAN APLIKASI</span>
                    </div>
                    <div class="link-form">
                        <a href="#"><i class="fas fa-external-link-alt" style="margin-right: 8px;"></i> Lapor Sebagai Pengguna Aplikasi e-Rapor</a>
                        <a href="#"><i class="fas fa-external-link-alt" style="margin-right: 8px;"></i> Panduan Penggunaan Aplikasi E-Rapor</a>
                    </div>
                </div>

                <!-- Status Kerja Administrator -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-title">
                        <span><i class="fas fa-tasks" style="margin-right: 8px; color: #2c5a8c;"></i> Status Kerja Administrator</span>
                    </div>
                    <div style="font-weight: 600; color: #1a3a5c; margin-bottom: 12px; font-size: 14px;">
                        <i class="fas fa-clock" style="margin-right: 8px;"></i> Aktivitas Terbaru
                    </div>
                    <div style="color: #888; font-size: 13px; margin-bottom: 15px;">
                        Aktivitas Operator dan Guru dalam sistem
                    </div>
                    <div style="font-weight: 600; color: #1a3a5c; margin: 15px 0 10px; font-size: 14px;">
                        Jenis Pekerjaan
                    </div>
                    <div class="work-item">
                        <i class="fas fa-circle" style="font-size: 8px;"></i> Menyimpan data koneksi webservice
                    </div>
                    <div class="work-item">
                        <i class="fas fa-circle" style="font-size: 8px;"></i> Memahami data administrator
                    </div>
                    <div class="work-item">
                        <i class="fas fa-circle" style="font-size: 8px;"></i> Generate User Guru dan Siswa
                    </div>
                    <div class="work-item">
                        <i class="fas fa-circle" style="font-size: 8px;"></i> Edit data kepala sekolah
                    </div>
                    <div class="work-item">
                        <i class="fas fa-circle" style="font-size: 8px;"></i> Update data Siswa
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- STATUS KERJA ADMINISTRATOR -->
                <div class="card" style="margin-bottom: 25px;">
                    <div class="card-title">
                        <span><i class="fas fa-clipboard-list" style="margin-right: 8px; color: #2c5a8c;"></i> STATUS KERJA ADMINISTRATOR</span>
                    </div>
                    <div style="font-weight: 600; color: #1a3a5c; margin-bottom: 12px; font-size: 14px;">
                        Rincian Kerja Utama Administrator
                    </div>

                    <div class="table-toolbar">
                        <button class="btn"><i class="fas fa-copy"></i> Copy</button>
                        <button class="btn"><i class="fas fa-file-excel"></i> Excel</button>
                        <button class="btn"><i class="fas fa-file-pdf"></i> Pdf</button>
                        <button class="btn"><i class="fas fa-print"></i> Print</button>
                        <div class="show-rows">
                            Show <select><option>10</option><option>25</option><option>50</option></select> rows
                        </div>
                    </div>

                    <div style="background: #f8f9fa; border-radius: 8px; padding: 15px; min-height: 100px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 14px; border: 1px dashed #ddd;">
                        <i class="fas fa-table" style="margin-right: 10px;"></i> Data table akan ditampilkan di sini
                    </div>
                </div>

                <!-- Input Nilai Status -->
                <div class="card">
                    <div class="card-title">
                        <span><i class="fas fa-pen-fancy" style="margin-right: 8px; color: #2c5a8c;"></i> Input nilai oleh Guru dan Wali Dibuka</span>
                        <button class="toggle-btn" onclick="alert('Fungsi tutup input nilai')">Tutup Input nilai</button>
                    </div>
                    <div style="display: flex; gap: 20px; flex-wrap: wrap; padding: 10px 0;">
                        <div class="status-item">
                            <span class="dot green"></span> Sudah dikerjakan
                        </div>
                        <div class="status-item">
                            <span class="dot green"></span> Sudah dikerjakan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Bar -->
        <div class="status-bar">
            <div class="status-item">
                <span class="dot green"></span> Sistem Online
            </div>
            <div class="status-item">
                <span class="dot green"></span> Dapodik Terhubung
            </div>
            <div class="status-item">
                <span class="dot yellow"></span> Sinkronisasi: 85%
            </div>
            <div class="status-item" style="margin-left: auto;">
                <i class="fas fa-user-circle" style="color: #2c5a8c;"></i> {{ Auth::user()->username ?? 'Operator' }} | <span style="color: #999;">Online</span>
            </div>
        </div>
    </main>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        // Close sidebar when clicking overlay
        document.getElementById('sidebarOverlay').addEventListener('click', toggleSidebar);

        // Toggle Sub Menu
        function toggleSubMenu(element) {
            const subMenu = element.nextElementSibling;
            const arrow = element.querySelector('.arrow');
            subMenu.classList.toggle('open');
            if (arrow) {
                arrow.classList.toggle('open');
            }
        }

        // Close sidebar on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                if (sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                }
            }
        });

        // Make submenu open by default on page load (optional)
        document.addEventListener('DOMContentLoaded', function() {
            // Example: open Reference Data submenu by default
            const refData = document.querySelector('.menu-item:has(.fa-database)');
            if (refData) {
                const subMenu = refData.nextElementSibling;
                const arrow = refData.querySelector('.arrow');
                if (subMenu) {
                    subMenu.classList.add('open');
                    if (arrow) arrow.classList.add('open');
                }
            }
        });
    </script>

</body>
</html>