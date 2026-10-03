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
        @media print {

            #sidebar,
            #sidebarOverlay {
                display: none !important;
            }

            main {
                margin-left: 0 !important;
                width: 100% !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
</head>

<body class="m-0 min-h-screen bg-[#f7f7f8] font-['Satoshi'] text-[#1d2428]">
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 z-[998] hidden bg-black/50"></div>

    <x-sidebar />

    <main class="min-h-screen md:ml-[260px] bg-[#f8f9fc]">
        <x-topbar />

        <div class="p-4 sm:p-6 lg:p-6">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            const chevron = document.querySelector('.user-chevron');

            if (!dropdown) return;

            const isOpen = dropdown.classList.contains('visible');

            if (isOpen) {
                closeUserMenu();
            } else {
                openUserMenu();
            }
        }

        function openUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            const chevron = document.querySelector('.user-chevron');

            if (!dropdown) return;

            dropdown.classList.remove(
                'invisible',
                'opacity-0',
                'scale-95',
                'translate-y-[-6px]'
            );

            dropdown.classList.add(
                'visible',
                'opacity-100',
                'scale-100',
                'translate-y-0'
            );

            if (chevron) {
                chevron.classList.add('rotate-180');
            }
        }

        function closeUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            const chevron = document.querySelector('.user-chevron');

            if (!dropdown) return;

            dropdown.classList.remove(
                'visible',
                'opacity-100',
                'scale-100',
                'translate-y-0'
            );

            dropdown.classList.add(
                'invisible',
                'opacity-0',
                'scale-95',
                'translate-y-[-6px]'
            );

            if (chevron) {
                chevron.classList.remove('rotate-180');
            }
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const userButton = event.target.closest('[onclick="toggleUserMenu()"]');

            if (!dropdown) return;

            if (!dropdown.contains(event.target) && !userButton) {
                closeUserMenu();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeUserMenu();
            }
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (!sidebar || !overlay) return;

            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        }
    </script>
</body>

</html>
