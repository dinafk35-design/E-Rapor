<header
    class="sticky top-3 z-40 mx-3 flex min-h-[68px] items-center justify-between
           rounded-2xl border border-slate-200/80 bg-white/95
           px-3 shadow-[0_8px_30px_rgba(15,23,42,0.07)]
           backdrop-blur-md
           sm:mx-4 sm:px-5
           lg:mx-6 lg:px-6">

    {{-- LEFT --}}
    <div class="flex min-w-0 items-center gap-2.5">

        {{-- HAMBURGER --}}
        <button type="button" onclick="toggleSidebar()"
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-[21px] text-[#273d53] transition-all duration-200 hover:bg-slate-100 hover:text-[#5148b8] active:scale-95 md:hidden"
            aria-label="Buka menu">
            <i class="ph ph-list"></i>
        </button>

        {{-- PAGE TITLE --}}
        <div class="min-w-0">
            <div class="flex items-center gap-2">
                <span class="hidden h-2 w-2 rounded-full bg-[#5148b8] sm:block"></span>

                <h1 class="truncate text-[15px] font-bold tracking-tight text-[#193b5d] sm:text-base lg:text-lg">
                    Dashboard Admin
                </h1>
            </div>

            <p class="mt-0.5 hidden text-[11px] text-slate-400 sm:block">
                Panel administrasi E-Rapor SMK
            </p>
        </div>

    </div>


    {{-- RIGHT --}}
    <div class="relative shrink-0">

        {{-- USER BUTTON --}}
        <button type="button" onclick="toggleUserMenu()" aria-expanded="false" aria-controls="userDropdown"
            class="group flex items-center gap-2 rounded-xl border border-transparent bg-slate-50/80 p-1.5 pr-2 transition-all duration-200 hover:border-slate-200 hover:bg-slate-100 sm:gap-2.5 sm:pr-2.5">

            {{-- AVATAR --}}
            <span
                class="relative flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#25284d] via-[#37367a] to-[#5148b8] text-white shadow-sm sm:h-10 sm:w-10">
                <i class="ph ph-user text-[17px] sm:text-[18px]"></i>

                {{-- ONLINE DOT --}}
                <span
                    class="absolute -right-0.5 -top-0.5 h-2.5 w-2.5 rounded-full border-2 border-white bg-emerald-500">
                </span>
            </span>

            {{-- USER INFO --}}
            <span class="hidden min-w-0 text-left leading-tight sm:block">
                <span class="block max-w-[150px] truncate text-[13px] font-semibold text-slate-800">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </span>

                <span class="mt-0.5 flex items-center gap-1 text-[10px] font-medium text-slate-400">
                    <i class="ph ph-shield-check text-[11px] text-[#5148b8]"></i>
                    {{ ucfirst(auth()->user()->role ?? 'Admin') }}
                </span>
            </span>

            {{-- CHEVRON --}}
            <i
                class="user-chevron ph ph-caret-down hidden text-[13px] text-slate-400 transition-transform duration-200 sm:block">
            </i>

        </button>


        {{-- USER DROPDOWN --}}
        <div id="userDropdown"
            class="invisible absolute right-0 top-[calc(100%+10px)] z-[1000] w-[250px] origin-top-right translate-y-[-6px] scale-95 rounded-2xl border border-slate-200 bg-white p-2 opacity-0 shadow-[0_20px_45px_rgba(15,23,42,0.12),0_4px_12px_rgba(15,23,42,0.05)] transition-all duration-200">

            {{-- PROFILE SUMMARY --}}
            <div class="rounded-xl bg-gradient-to-br from-slate-50 to-indigo-50/50 p-3">
                <div class="flex items-center gap-3">

                    <span
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#25284d] via-[#37367a] to-[#5148b8] text-white shadow-sm">
                        <i class="ph ph-user text-[19px]"></i>
                    </span>

                    <div class="min-w-0">
                        <p class="truncate text-[13px] font-bold text-slate-800">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </p>

                        <p class="mt-0.5 truncate text-[11px] text-slate-500">
                            {{ auth()->user()->email ?? 'Administrator' }}
                        </p>

                        <span
                            class="mt-1.5 inline-flex items-center gap-1 rounded-full bg-white px-2 py-0.5 text-[9px] font-semibold text-[#5148b8] shadow-sm">
                            <i class="ph ph-shield-check text-[10px]"></i>
                            {{ ucfirst(auth()->user()->role ?? 'Admin') }}
                        </span>
                    </div>

                </div>
            </div>


            {{-- MENU --}}
            <div class="mt-2 space-y-0.5">

                {{-- PROFILE --}}
                <a href="{{ route('profile') }}"
                    class="group flex w-full items-center gap-3 rounded-xl p-2.5 text-[12px] font-medium text-slate-600 transition-all duration-150 hover:bg-indigo-50 hover:text-[#5148b8]">

                    <span
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition group-hover:bg-indigo-100 group-hover:text-[#5148b8]">
                        <i class="ph ph-user text-[16px]"></i>
                    </span>

                    <span class="flex-1">
                        <span class="block font-semibold">
                            Profile
                        </span>
                        <span class="block text-[10px] text-slate-400 group-hover:text-indigo-400">
                            Kelola informasi akun
                        </span>
                    </span>

                    <i
                        class="ph ph-caret-right text-[12px] text-slate-300 transition-transform duration-150 group-hover:translate-x-0.5 group-hover:text-[#5148b8]">
                    </i>
                </a>


                {{-- DIVIDER --}}
                <div class="my-1.5 h-px bg-slate-100"></div>


                {{-- LOGOUT --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="group flex w-full items-center gap-3 rounded-xl p-2.5 text-left text-[12px] font-medium text-slate-600 transition-all duration-150 hover:bg-red-50 hover:text-red-600">

                        <span
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition group-hover:bg-red-100 group-hover:text-red-600">
                            <i class="ph ph-sign-out text-[16px]"></i>
                        </span>

                        <span class="flex-1">
                            <span class="block font-semibold">
                                Logout
                            </span>
                            <span class="block text-[10px] text-slate-400 group-hover:text-red-400">
                                Keluar dari akun
                            </span>
                        </span>

                    </button>
                </form>

            </div>

        </div>

    </div>

</header>


<script>
    function toggleUserMenu() {
        const dropdown = document.getElementById('userDropdown');
        const button = document.querySelector('[aria-controls="userDropdown"]');
        const chevron = document.querySelector('.user-chevron');

        const isOpen = dropdown.classList.contains('visible');

        if (isOpen) {
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

            chevron?.classList.remove('rotate-180');
            button?.setAttribute('aria-expanded', 'false');

        } else {
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

            chevron?.classList.add('rotate-180');
            button?.setAttribute('aria-expanded', 'true');
        }
    }


    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.querySelector('[aria-controls="userDropdown"]');

        if (!dropdown || !button) return;

        if (
            !dropdown.contains(event.target) &&
            !button.contains(event.target)
        ) {
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

            document.querySelector('.user-chevron')?.classList.remove('rotate-180');
            button.setAttribute('aria-expanded', 'false');
        }
    });
</script>
