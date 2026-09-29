<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - E-Rapor SMK</title>
    <!-- Bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"> -->
    <!-- Satoshi Font -->
    <link rel="preconnect" href="https://api.fontshare.com">
    <link rel="preconnect" href="https://cdn.fontshare.com" crossorigin>
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,600,700&display=swap">
    <!-- Phosphor Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <!-- Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Satoshi', Arial, Helvetica, sans-serif;
            background: #f7f7f8;
            color: #1d2428;
        }

        /* =========================
           SIDEBAR
        ========================= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: #273d53;
            color: rgb(244, 239, 239);
            overflow-y: auto;
            padding-bottom: 30px;
        }

        .sidebar-header {
            padding: 25px 20px;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 1px solid rgba(191, 168, 39, 0.15);
        }

        .sidebar-header i {
            margin-right: 8px;
        }

        .menu-section {
            padding: 20px 20px 8px;
            font-size: 11px;
            text-transform: uppercase;
            color: #f8f9fa;
            font-weight: bold;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            margin: 3px 10px;
            color: #f9f6f6;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
        }

        .menu-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: white;
        }

        .menu-link.active {
            background: rgba(255, 255, 255, 0.18);
            color: white;
        }

        /* =========================
           LOGOUT LINK
        ========================= */

        .logout-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            margin: 3px 10px;
            color: #f9f6f6;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            transition: 0.2s;
        }

        .logout-link i {
            width: 20px;
            text-align: center;
        }

        .logout-link:hover {
            background: rgba(255, 0, 0, 100);
            color: white;
        }

        /* =========================
           MAIN
        ========================= */
        .main {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================= */
        .topbar {
            height: 70px;
            background: rgb(163, 218, 241);
            border-bottom: 1px solid #eef1f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-title {
            font-size: 20px;
            font-weight: bold;
            color: #193b5d;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #193b5d;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-name {
            font-weight: bold;
            font-size: 14px;
        }

        .admin-role {
            color: #888;
            font-size: 12px;
        }

        /* =========================
           CONTENT
        ========================= */
        .content {
            padding: 30px;
        }

        /* =========================
           WELCOME
        ========================= */
        .welcome {
            background: linear-gradient(135deg,
                    #72a0cd,
                    #2f6494);
            color: white;
            padding: 28px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .welcome h2 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .welcome p {
            margin: 0;
            opacity: 0.9;
        }

        /* =========================
           STATISTICS
        ========================= */
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e6e9ed;
            display: flex;
            align-items: center;
            gap: 15px;
            height: 100%;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 10px;
            background: #f4f4f7;
            color: #080841;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-number {
            font-size: 25px;
            font-weight: bold;
        }

        .stat-title {
            font-size: 13px;
            color: #22123d;
        }

        /* =========================
           SECTION TITLE
        ========================= */
        .section-title {
            font-size: 19px;
            font-weight: bold;
            margin: 30px 0 15px;
            color: #193b5d;
        }

        /* =========================
           TASK CARD
        ========================= */
        .task-card {
            background: white;
            border: 1px solid #e6e9ed;
            border-radius: 12px;
            padding: 22px;
            height: 100%;
            transition: 0.2s;
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
        }

        .task-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #eaf2f8;
            color: #193b5d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .task-card h5 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .task-card p {
            color: #777;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .task-button {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 6px;
            background: #193b5d;
            color: white;
            text-decoration: none;
            font-size: 12px;
        }

        .task-button:hover {
            color: white;
            background: #285d88;
        }

        /* =========================
           AKTIVITAS
        ========================= */
        .activity-box {
            background: rgb(194, 230, 247);
            border: 1px solid #e6e9ed;
            border-radius: 12px;
            padding: 20px;
        }

        .activity {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 0;
            border-bottom: 1px solid #eeeeee;
        }

        .activity:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #eaf2f8;
            color: #193b5d;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-text {
            font-size: 14px;
        }

        .activity-time {
            color: #999;
            font-size: 12px;
        }

        /* =========================
           HAMBURGER TOGGLE
        ========================= */
        .hamburger-btn {
            display: none;
            background: none;
            border: none;
            color: #193b5d;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .hamburger-btn:hover {
            background: rgba(0, 0, 0, 0.08);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* =========================
           RESPONSIVE
        ========================= */
        @media(max-width: 900px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }
        }

        @media(max-width: 768px) {
            .hamburger-btn {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 260px;
                height: 100vh;
                z-index: 999;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                overflow-y: auto;
                padding-bottom: 30px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                padding: 0 15px;
            }

            .content {
                padding: 15px;
            }

            .welcome {
                padding: 20px;
            }

            .welcome h2 {
                font-size: 20px;
            }

            .admin-name,
            .admin-role {
                display: none;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-icon {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .stat-number {
                font-size: 20px;
            }

            .task-card {
                padding: 15px;
            }

            .activity-box {
                padding: 15px;
            }

            .section-title {
                font-size: 16px;
                margin: 20px 0 10px;
            }

            .task-button {
                font-size: 11px;
                padding: 6px 10px;
            }

            .activity-icon {
                width: 32px;
                height: 32px;
                font-size: 14px;
            }

            .activity-text {
                font-size: 12px;
            }

            .activity-time {
                font-size: 11px;
            }

            .menu-link {
                padding: 10px 15px;
                font-size: 13px;
            }

            .menu-section {
                padding: 15px 15px 6px;
                font-size: 10px;
            }

            .sidebar-header {
                padding: 20px 15px;
                font-size: 18px;
            }

            .logout-link {
                padding: 10px 15px;
                font-size: 13px;
            }

            .stat-title {
                font-size: 11px;
            }

            .task-card h5 {
                font-size: 14px;
            }

            .task-card p {
                font-size: 12px;
            }

            .hamburger-btn {
                font-size: 20px;
                padding: 6px;
            }

            .topbar-left {
                gap: 8px;
            }

            .admin-info {
                gap: 8px;
            }

            .menu-link i {
                width: 18px;
                font-size: 16px;
            }

            .logout-link i {
                width: 18px;
                font-size: 16px;
            }

            .sidebar-header i {
                font-size: 18px;
            }

            .admin-avatar i {
                font-size: 18px;
            }

            .stat-icon i {
                font-size: 18px;
            }

            .task-icon i {
                font-size: 16px;
            }

            .activity-icon i {
                font-size: 14px;
            }
        }

        @media(max-width: 480px) {
            .content {
                padding: 10px;
            }

            .welcome {
                padding: 15px;
            }

            .welcome h2 {
                font-size: 18px;
            }

            .welcome p {
                font-size: 12px;
            }

            .topbar {
                height: 60px;
                padding: 0 10px;
            }

            .topbar-title {
                font-size: 14px;
            }

            .admin-avatar {
                width: 36px;
                height: 36px;
            }

            .stat-card {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .task-card {
                padding: 12px;
            }

            .task-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .activity {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }

            .section-title {
                font-size: 14px;
            }

            .task-button {
                font-size: 10px;
                padding: 5px 8px;
            }

            .activity-icon {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .activity-text {
                font-size: 11px;
            }

            .activity-time {
                font-size: 10px;
            }

            .menu-link {
                padding: 8px 12px;
                font-size: 12px;
            }

            .menu-section {
                padding: 12px 12px 5px;
                font-size: 9px;
            }

            .sidebar-header {
                padding: 15px 12px;
                font-size: 16px;
            }

            .logout-link {
                padding: 8px 12px;
                font-size: 12px;
            }

            .stat-title {
                font-size: 10px;
            }

            .task-card h5 {
                font-size: 13px;
            }

            .task-card p {
                font-size: 11px;
            }

            .hamburger-btn {
                font-size: 18px;
                padding: 5px;
            }

            .topbar-left {
                gap: 6px;
            }

            .admin-info {
                gap: 6px;
            }

            .menu-link i {
                width: 16px;
                font-size: 14px;
            }

            .logout-link i {
                width: 16px;
                font-size: 14px;
            }

            .sidebar-header i {
                font-size: 14px;
            }

            .admin-avatar i {
                font-size: 14px;
            }

            .stat-icon i {
                font-size: 14px;
            }

            .task-icon i {
                font-size: 14px;
            }

            .activity-icon i {
                font-size: 12px;
            }

            .stat-number {
                font-size: 18px;
            }
        }

        /* =========================
           PRINT
        ========================= */
        @page {
            size: A4;
            margin: 15mm 12mm;
        }

        @media print {

            html,
            body {
                background: white !important;
            }

            /* Sembunyikan sidebar dan topbar */
            .sidebar,
            .topbar {
                display: none !important;
            }

            /* Hilangkan pergeseran konten akibat sidebar */
            .main {
                margin-left: 0 !important;
                min-height: auto !important;
            }

            .content {
                padding: 0 !important;
            }

            /* Hindari isi terpotong antar halaman */
            tr,
            .cetak-avoid {
                page-break-inside: avoid;
                break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    <x-sidebar />
    <div class="main">

        <x-topbar />
        @yield('content')
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        // Close sidebar when resizing to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.querySelector('.sidebar').classList.remove('active');
                document.getElementById('sidebarOverlay').classList.remove('active');
            }
        });
    </script>
</body>

</html>
