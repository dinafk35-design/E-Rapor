<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - E-Rapor SMK</title>

    <!-- Bootstrap -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"> -->

    <!-- Tailwind -->
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
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
            background: rgba(255,255,255,0.12);

            color: white;
        }

        .menu-link.active {
            background: rgba(255,255,255,0.18);

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

            background: linear-gradient(
                135deg,
                #72a0cd,
                #2f6494
            );

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

            box-shadow: 0 5px 18px rgba(0,0,0,0.08);
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

        @media(max-width: 700px) {

            .sidebar {

                position: relative;

                width: 100%;

                height: auto;
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

        }

    </style>

</head>


<body>


<x-sidebar />

<div class="main">

     
    <x-topbar />

    @yield('content')

</div>


</body>

</html>