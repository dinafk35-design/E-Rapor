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

<body class="min-h-screen bg-[#f1f5f9] font-['Satoshi']">

    <div class="min-h-screen p-2 sm:p-3 md:p-4">

        <div
            class="mx-auto flex min-h-[calc(100vh-32px)] max-w-[1400px] overflow-hidden rounded-[24px] bg-white shadow-2xl">

            <!-- ===================================================== -->
            <!-- LEFT SIDE -->
            <!-- ===================================================== -->
            <div
                class="relative hidden w-[65%] overflow-hidden bg-gradient-to-br from-[#46428c] via-[#38356f] to-[#202444] p-10 text-white lg:flex xl:p-12">

                <!-- Decorative blur -->
                <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-purple-500/20 blur-3xl"></div>
                <div class="absolute -bottom-32 -left-32 h-96 w-96 rounded-full bg-blue-500/10 blur-3xl"></div>

                <div class="relative z-10 flex w-full flex-col">

                    <!-- Logo -->
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-[52px] w-[52px] items-center justify-center rounded-[15px] bg-gradient-to-br from-[#8065ef] to-[#6550df] shadow-lg">
                            <i class="ph ph-graduation-cap text-[27px] text-white"></i>
                        </div>

                        <span class="text-[24px] font-bold tracking-tight">
                            E-Rapor SMK
                        </span>
                    </div>


                    <!-- Main text -->
                    <div class="flex flex-1 items-center">
                        <div class="w-full max-w-[620px]">

                            <p class="mb-4 text-[13px] font-bold uppercase tracking-[2px] text-[#aaa7e0]">
                                Workspace Operator Sekolah
                            </p>

                            <h1 class="text-[42px] font-normal leading-[1.1] tracking-[-1.5px] xl:text-[48px]">
                                Sistem Penilaian &<br>

                                <span class="font-bold text-[#9c8cff]">
                                    Rapor Digital
                                </span>
                                <br>

                                Terpadu.
                            </h1>

                            <p class="mt-6 max-w-[560px] text-[16px] leading-7 text-[#c0c0dc]">
                                Kelola nilai, skill paspor, UKK, PKL, hingga sinkronisasi
                                Dapodik dalam satu ruang kerja yang tenang.
                            </p>


                            <!-- Features -->
                            <div class="mt-8 space-y-4">

                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-[20px] w-[20px] items-center justify-center rounded-full border border-[#8c7cff] text-[#a69bff]">
                                        <i class="ph ph-check text-[12px]"></i>
                                    </div>

                                    <span class="text-[15px] text-[#c7c7df]">
                                        Terhubung dengan Web Service Dapodik
                                    </span>
                                </div>


                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-[20px] w-[20px] items-center justify-center rounded-full border border-[#8c7cff] text-[#a69bff]">
                                        <i class="ph ph-check text-[12px]"></i>
                                    </div>

                                    <span class="text-[15px] text-[#c7c7df]">
                                        Rekap Skill Paspor & UKK otomatis
                                    </span>
                                </div>


                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-[20px] w-[20px] items-center justify-center rounded-full border border-[#8c7cff] text-[#a69bff]">
                                        <i class="ph ph-check text-[12px]"></i>
                                    </div>

                                    <span class="text-[15px] text-[#c7c7df]">
                                        Backup & restore data kapan saja
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>


                    <!-- Footer -->
                    <div class="mt-auto pt-10 text-[13px] text-[#8585ae]">
                        © {{ date('Y') }} E-Rapor SMK · offline workspace
                    </div>

                </div>
            </div>


            <!-- ===================================================== -->
            <!-- RIGHT SIDE / LOGIN -->
            <!-- ===================================================== -->
            <div
                class="flex w-full items-center justify-center bg-white px-6 py-10 sm:px-10 lg:w-[35%] lg:px-12 xl:px-14">

                <div class="w-full max-w-[360px]">

                    <!-- Heading -->
                    <div class="mb-10">

                        <h2 class="text-[28px] font-bold leading-tight text-[#111827]">
                            Sign in to your account
                        </h2>

                        <p class="mt-1 max-w-[270px] text-[14px] font-semibold leading-[17px] text-[#111827]">
                            Please log in using your school operator account.
                        </p>

                    </div>


                    <!-- Status -->
                    @if (session('status'))
                        <div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-sm font-medium text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif


                    <!-- Errors -->
                    @if ($errors->any())
                        <div class="mb-5 rounded-lg bg-red-100 px-4 py-3 text-sm font-medium text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif


                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST">

                        @csrf


                        <!-- Username -->
                        <div class="mb-5">

                            <label for="username" class="mb-2 block text-[14px] font-bold text-[#171717]">
                                Username
                            </label>

                            <div class="relative">

                                <i
                                    class="ph ph-user absolute left-3 top-1/2 -translate-y-1/2 text-[17px] text-[#6b7280]"></i>

                                <input type="text" id="username" name="username" value="{{ old('username') }}"
                                    placeholder="Enter Username" required autofocus
                                    class="h-[44px] w-full rounded-[11px] border-0 bg-[#e8e5e3] pl-9 pr-4 text-[14px] text-[#222] shadow-[0_2px_3px_rgba(0,0,0,0.20)] outline-none transition placeholder:text-[#333] focus:bg-[#e2dfdd] focus:ring-2 focus:ring-[#82acd0]">

                            </div>

                        </div>


                        <!-- Password -->
                        <div class="mb-5">

                            <label for="password" class="mb-2 block text-[14px] font-bold text-[#171717]">
                                Password
                            </label>

                            <div class="relative">

                                <i
                                    class="ph ph-lock absolute left-3 top-1/2 -translate-y-1/2 text-[17px] text-[#6b7280]"></i>

                                <input type="password" id="password" name="password" placeholder="Enter Password"
                                    required
                                    class="h-[44px] w-full rounded-[11px] border-0 bg-[#e8e5e3] pl-9 pr-11 text-[14px] text-[#222] shadow-[0_2px_3px_rgba(0,0,0,0.20)] outline-none transition placeholder:text-[#333] focus:bg-[#e2dfdd] focus:ring-2 focus:ring-[#82acd0]">

                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#555] hover:text-[#222]">
                                    <i id="passwordIcon" class="ph ph-eye text-[18px]"></i>
                                </button>

                            </div>

                        </div>


                        <!-- Forgot Password -->
                        <div class="mb-10 flex justify-end">

                            <a href="#" class="text-[11px] text-[#555] underline hover:text-[#222]">
                                Forgot the password?
                            </a>

                        </div>


                        <!-- Login Button -->
                        <button type="submit"
                            class="h-[44px] w-full rounded-[10px] bg-[#82acd0] text-[14px] font-bold text-[#111827] shadow-[0_2px_3px_rgba(0,0,0,0.20)] transition hover:bg-[#719fc4] active:translate-y-[1px]">
                            Masuk
                        </button>

                    </form>

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
