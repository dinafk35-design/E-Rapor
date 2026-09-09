<style>
    .sub-menu:hover {
        backdrop-filter: brightness(150%);
        transition: 0.2s;
    }

    .sub-menu a {
        text-decoration: none;
        color: white;
        display: block;
    }

    .menu-active {
        background: rgba(255, 255, 255, 0.18);
        border-radius: 8px;
    }
</style>


<aside class="w-75 overflow-y-auto shadow-xl bg-linear-to-tl from-[#2F3965] to-[#070D29] text-white">

    <!-- LOGO -->
    <div class="text-center py-6 text-2xl font-bold">
        📊 E-Rapor SMK
    </div>


    <div class="p-3 gap-y-6 flex flex-col">

        <!-- ============================= -->
        <!-- MENU UTAMA -->
        <!-- ============================= -->

        <div>

            <span class="font-bold mb-3">
                MENU UTAMA
            </span>

            <ul class="px-3">

                <!-- DASHBOARD -->
                <li class="sub-menu p-2 rounded
                    {{ request()->routeIs('dashboard') ? 'menu-active' : '' }}">

                    <a href="{{ route('dashboard') }}">
                        📊 Dashboard
                    </a>

                </li>


                <!-- PROFILE -->
                <li class="sub-menu p-2 rounded
                    {{ request()->routeIs('profile') ? 'menu-active' : '' }}">

                    <a href="{{ route('profile') }}">
                        👤 Profile
                    </a>

                </li>


                <!-- USER DATA -->
                <li class="sub-menu p-2 rounded
                    {{ request()->routeIs('user-data.*') ? 'menu-active' : '' }}">

                    <a href="{{ route('user-data.index') }}">
                        👥 User Data
                    </a>

                </li>

            </ul>

        </div>


        <!-- ============================= -->
        <!-- REFERENSI DATA -->
        <!-- ============================= -->

        <div>

            <span class="font-bold mb-3">
                REFERENSI DATA
            </span>

            <ul class="px-3">

                <!-- DATA SEKOLAH -->
                <li class="sub-menu p-2 rounded
                    {{ request()->routeIs('data-sekolah.*') ? 'menu-active' : '' }}">

                    <a href="{{ route('data-sekolah.index') }}">
                        🏫 Data Sekolah
                    </a>

                </li>


                <!-- DATA GURU -->
                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        👨‍🏫 Data Guru
                    </a>
                </li>


                <!-- DATA SISWA -->
                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        👨‍🎓 Data Siswa
                    </a>
                </li>


                <!-- MATA PELAJARAN -->
                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        📚 Mata Pelajaran
                    </a>
                </li>


                <!-- ROMBEL -->
                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        🏫 Rombel
                    </a>
                </li>


                <!-- ANGGOTA ROMBEL -->
                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        👥 Anggota Rombel
                    </a>
                </li>


                <!-- GURU MENGAJAR -->
                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        👨‍🏫 Guru Mengajar
                    </a>
                </li>


                <!-- WALI KELAS -->
                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        🧑‍🏫 Wali Kelas
                    </a>
                </li>

            </ul>

        </div>


        <!-- ============================= -->
        <!-- PENILAIAN -->
        <!-- ============================= -->

        <div>

            <span class="font-bold mb-3">
                PENILAIAN
            </span>

            <ul class="px-3">

                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        📝 Status Penilaian
                    </a>
                </li>

                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        📊 Perkembangan Nilai
                    </a>
                </li>

                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        📚 Nilai Skill Passport
                    </a>
                </li>

                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        📋 Nilai UKK
                    </a>
                </li>

            </ul>

        </div>


        <!-- ============================= -->
        <!-- LAPORAN -->
        <!-- ============================= -->

        <div>

            <span class="font-bold mb-3">
                LAPORAN
            </span>

            <ul class="px-3">

                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        🖨️ Cetak Nilai
                    </a>
                </li>

            </ul>

        </div>


        <!-- ============================= -->
        <!-- PENGATURAN -->
        <!-- ============================= -->

        <div>

            <span class="font-bold mb-3">
                PENGATURAN
            </span>

            <ul class="px-3">

                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        ⚙️ Pengaturan
                    </a>
                </li>

                <li class="sub-menu p-2 rounded">
                    <a href="#">
                        🚪 Log Out
                    </a>
                </li>

            </ul>

        </div>

    </div>

</aside>
