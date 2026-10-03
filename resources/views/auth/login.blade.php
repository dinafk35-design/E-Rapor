<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login E-Rapor SMK</title>

    <!-- Satoshi -->
    <link rel="preconnect" href="https://api.fontshare.com">
    <link rel="preconnect" href="https://cdn.fontshare.com" crossorigin>
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,600,700&display=swap">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="min-h-screen bg-[#f5f6fa] font-['Satoshi'] text-slate-800">

    <div class="min-h-screen p-2 sm:p-3 md:p-4">

        <div
            class="mx-auto flex min-h-[calc(100vh-16px)] max-w-[1400px] overflow-hidden rounded-[24px] border border-slate-200/70 bg-white shadow-[0_20px_60px_rgba(37,40,77,0.10)] sm:min-h-[calc(100vh-24px)] md:min-h-[calc(100vh-32px)]">

            <!-- ===================================================== -->
            <!-- LEFT SIDE / BRANDING -->
            <!-- ===================================================== -->
            <div
                class="relative hidden w-[65%] overflow-hidden bg-gradient-to-br from-[#25284d] via-[#37367a] to-[#5148b8] p-10 text-white lg:flex xl:p-12">

                <!-- Decorative shapes -->
                <div class="absolute -right-32 -top-32 h-[420px] w-[420px] rounded-full bg-[#8178df]/20 blur-3xl">
                </div>

                <div class="absolute -bottom-40 -left-32 h-[430px] w-[430px] rounded-full bg-[#6b7be8]/15 blur-3xl">
                </div>

                <div class="absolute right-[18%] top-[38%] h-32 w-32 rounded-full bg-white/5 blur-2xl">
                </div>


                <div class="relative z-10 flex w-full flex-col">

                    <!-- Logo -->
                    <div class="flex items-center gap-3.5">

                        <div
                            class="flex h-[52px] w-[52px] items-center justify-center rounded-[15px] border border-white/10 bg-white/10 shadow-lg backdrop-blur-sm">
                            <i class="ph ph-graduation-cap text-[27px] text-white"></i>
                        </div>

                        <div>
                            <span class="block text-[22px] font-bold tracking-tight">
                                E-Rapor SMK
                            </span>

                            <span class="block text-[10px] font-medium tracking-[1.5px] text-[#bdbce4]">
                                SISTEM INFORMASI RAPOR
                            </span>
                        </div>

                    </div>


                    <!-- Main text -->
                    <div class="flex flex-1 items-center">

                        <div class="w-full max-w-[620px]">

                            <div
                                class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[1.8px] text-[#c5c2f0] backdrop-blur-sm">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#9c94ff]"></span>

                                Workspace Operator Sekolah
                            </div>


                            <h1 class="text-[42px] font-normal leading-[1.08] tracking-[-1.5px] xl:text-[48px]">

                                Sistem Penilaian &

                                <br>

                                <span class="font-bold text-[#aaa3ff]">
                                    Rapor Digital
                                </span>

                                <br>

                                Terpadu.
                            </h1>


                            <p class="mt-6 max-w-[560px] text-[15px] leading-7 text-[#c9c9e2]">
                                Kelola nilai, skill paspor, UKK, PKL, hingga sinkronisasi
                                Dapodik dalam satu ruang kerja yang terintegrasi.
                            </p>


                            <!-- Features -->
                            <div class="mt-8 space-y-3.5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-[21px] w-[21px] shrink-0 items-center justify-center rounded-full border border-[#8f87ed]/60 bg-[#8f87ed]/10 text-[#b0a9ff]">
                                        <i class="ph ph-check text-[11px]"></i>
                                    </div>

                                    <span class="text-[14px] text-[#d0d0e5]">
                                        Terhubung dengan Web Service Dapodik
                                    </span>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-[21px] w-[21px] shrink-0 items-center justify-center rounded-full border border-[#8f87ed]/60 bg-[#8f87ed]/10 text-[#b0a9ff]">
                                        <i class="ph ph-check text-[11px]"></i>
                                    </div>

                                    <span class="text-[14px] text-[#d0d0e5]">
                                        Rekap Skill Paspor & UKK otomatis
                                    </span>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-[21px] w-[21px] shrink-0 items-center justify-center rounded-full border border-[#8f87ed]/60 bg-[#8f87ed]/10 text-[#b0a9ff]">
                                        <i class="ph ph-check text-[11px]"></i>
                                    </div>

                                    <span class="text-[14px] text-[#d0d0e5]">
                                        Backup & restore data kapan saja
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Footer -->
                    <div class="mt-auto pt-10 text-[12px] text-[#aaa9ca]">
                        © {{ date('Y') }} E-Rapor SMK · Sistem Informasi Rapor
                    </div>

                </div>

            </div>


            <!-- ===================================================== -->
            <!-- RIGHT SIDE / LOGIN -->
            <!-- ===================================================== -->
            <div
                class="flex w-full items-center justify-center bg-white px-5 py-8 sm:px-10 sm:py-10 lg:w-[35%] lg:px-12 xl:px-14">

                <div class="w-full max-w-[360px]">


                    <!-- ================================================= -->
                    <!-- MOBILE BRANDING -->
                    <!-- Muncul hanya di HP / responsive -->
                    <!-- ================================================= -->
                    <div class="mb-8 lg:hidden">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-[14px] bg-gradient-to-br from-[#25284d] via-[#37367a] to-[#5148b8] text-white shadow-[0_6px_18px_rgba(81,72,184,0.20)]">
                                <i class="ph ph-graduation-cap text-[24px]"></i>
                            </div>

                            <div class="min-w-0">

                                <h1 class="text-[20px] font-bold tracking-tight text-[#25284d]">
                                    E-Rapor SMK
                                </h1>

                                <p class="mt-0.5 text-[10px] font-semibold uppercase tracking-[1.4px] text-[#7b78a8]">
                                    Sistem Informasi Rapor
                                </p>

                            </div>

                        </div>


                        <!-- Mobile title -->
                        <div
                            class="mt-6 rounded-2xl bg-gradient-to-br from-[#25284d] via-[#37367a] to-[#5148b8] p-5 text-white shadow-[0_10px_25px_rgba(55,53,111,0.16)]">

                            <div
                                class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[1.5px] text-[#c9c7ee]">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#aaa3ff]"></span>

                                Workspace Operator Sekolah

                            </div>

                            <h2 class="mt-2 text-[22px] font-bold leading-tight">
                                Sistem Penilaian &
                                <span class="text-[#aaa3ff]">Rapor Digital</span>
                            </h2>

                            <p class="mt-2 text-[12px] leading-5 text-[#d0d0e4]">
                                Kelola data akademik dan rapor sekolah dalam satu sistem terintegrasi.
                            </p>

                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- LOGIN HEADING -->
                    <!-- ================================================= -->
                    <div class="mb-8">

                        <div class="mb-3 flex items-center gap-2">

                            <span class="h-1.5 w-7 rounded-full bg-gradient-to-r from-[#37367a] to-[#5148b8]"></span>

                            <span class="text-[10px] font-bold uppercase tracking-[1.5px] text-[#7774a4]">
                                Login
                            </span>

                        </div>


                        <h2 class="text-[27px] font-bold leading-tight tracking-[-0.5px] text-[#25284d] sm:text-[29px]">
                            Selamat datang kembali
                        </h2>

                        <p class="mt-2 text-[13px] leading-5 text-slate-500">
                            Silakan masuk menggunakan akun operator sekolah Anda.
                        </p>

                    </div>


                    <!-- ================================================= -->
                    <!-- STATUS -->
                    <!-- ================================================= -->
                    @if (session('status'))
                        <div
                            class="mb-5 flex items-start gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-[12px] font-medium text-emerald-700">

                            <i class="ph ph-check-circle mt-0.5 text-[17px]"></i>

                            <span>
                                {{ session('status') }}
                            </span>

                        </div>
                    @endif


                    <!-- ================================================= -->
                    <!-- ERRORS -->
                    <!-- ================================================= -->
                    @if ($errors->any())
                        <div
                            class="mb-5 flex items-start gap-2.5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-[12px] font-medium text-red-700">

                            <i class="ph ph-warning-circle mt-0.5 text-[17px]"></i>

                            <span>
                                {{ $errors->first() }}
                            </span>

                        </div>
                    @endif


                    <!-- ================================================= -->
                    <!-- LOGIN FORM -->
                    <!-- ================================================= -->
                    <form action="{{ route('login') }}" method="POST">

                        @csrf


                        <!-- Username -->
                        <div class="mb-5">

                            <label for="username" class="mb-2 block text-[12px] font-bold text-slate-700">
                                Username
                            </label>

                            <div class="relative">

                                <i
                                    class="ph ph-user absolute left-3.5 top-1/2 -translate-y-1/2 text-[17px] text-slate-400">
                                </i>

                                <input type="text" id="username" name="username" value="{{ old('username') }}"
                                    placeholder="Masukkan username" required autofocus autocomplete="username"
                                    class="h-[46px] w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-[13px] text-slate-800 outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-[#7169c9] focus:bg-white focus:ring-4 focus:ring-[#5148b8]/10">

                            </div>

                        </div>


                        <!-- Password -->
                        <div class="mb-5">

                            <label for="password" class="mb-2 block text-[12px] font-bold text-slate-700">
                                Password
                            </label>

                            <div class="relative">

                                <i
                                    class="ph ph-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-[17px] text-slate-400">
                                </i>

                                <input type="password" id="password" name="password" placeholder="Masukkan password"
                                    required autocomplete="current-password"
                                    class="h-[46px] w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-11 text-[13px] text-slate-800 outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-[#7169c9] focus:bg-white focus:ring-4 focus:ring-[#5148b8]/10">

                                <button type="button" onclick="togglePassword()" aria-label="Tampilkan password"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 transition hover:text-[#5148b8]">

                                    <i id="passwordIcon" class="ph ph-eye text-[18px]"></i>

                                </button>

                            </div>

                        </div>


                        <!-- Forgot Password -->
                        <div class="mb-7 flex justify-end">

                            <a href="#"
                                class="text-[11px] font-medium text-slate-400 transition hover:text-[#5148b8]">
                                Lupa password?
                            </a>

                        </div>


                        <!-- Login Button -->
                        <button type="submit"
                            class="group flex h-[46px] w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#37367a] to-[#5148b8] text-[13px] font-bold text-white shadow-[0_6px_18px_rgba(81,72,184,0.22)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_22px_rgba(81,72,184,0.28)] active:translate-y-0">

                            <span>
                                Masuk ke Sistem
                            </span>

                            <i
                                class="ph ph-arrow-right text-[15px] transition-transform duration-200 group-hover:translate-x-0.5">
                            </i>

                        </button>

                    </form>


                    <!-- Mobile Footer -->
                    <div class="mt-8 text-center lg:hidden">

                        <p class="text-[10px] text-slate-400">
                            © {{ date('Y') }} E-Rapor SMK
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ===================================================== -->
    <!-- PASSWORD TOGGLE -->
    <!-- ===================================================== -->
    <script>
        function togglePassword() {

            const password = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove('ph-eye');
                icon.classList.add('ph-eye-slash');

            } else {

                password.type = 'password';

                icon.classList.remove('ph-eye-slash');
                icon.classList.add('ph-eye');

            }
        }
    </script>

</body>

</html>
