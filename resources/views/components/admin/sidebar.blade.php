<style>
    .sub-menu:hover{
        backdrop-filter: brightness(150%);
        transition;
    }
</style>


<aside class="w-75 overflow-y-auto shadow-xl bg-linear-to-tl from-[#2F3965] to-[#070D29] text-white">
    <!-- LOGO -->
    <div class="text-center py-6 text-2xl font-bold ">
        📊 E-Rapor SMK
    </div>

    <div class=" p-3 gap-y-6 flex flex-col">
        <!-- MENU UTAMA -->
        <div class="">
            <span class="font-bold mb-3">MENU UTAMA</span>
            <ul class="px-3">
                <li class="sub-menu sub-menu p-2 rounded">
                    <a href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="sub-menu p-2 rounded">
                    Profile
                </li>
                <li class="sub-menu p-2 rounded">👥 User Data</>
                </ul>
        </div>

        <div class="">
            <span class="font-bold mb-3">REFERENSI DATA</span>
            <ul class="px-3">
                <li class="sub-menu p-2 rounded hover:backdrop-brightness-150 transition">
                    <a href="{{ route('data-sekolah.index') }}">
                        Data Sekolah
                    </a>
                </li>
                <li class="sub-menu p-2 rounded"><a href="{{ route('data-guru.index') }}">Data Guru</a></li>
                <li class="sub-menu p-2 rounded"><a href="">Mata Pelajaran</a></li>
                <li class="sub-menu p-2 rounded"><a href="">Rombel</a></li>
                <li class="sub-menu p-2 rounded"><a href="">Anggota Rombel</a></li>
                <li class="sub-menu p-2 rounded"><a href="">Guru Mengajar</a></li>
                <li class="sub-menu p-2 rounded" href="#">Wali Kelas</>
                </ul>
        </div>

        <div class="">
            <span class="font-bold mb-3">PENILAIAN</span>
            <ul class="px-3">
                <li class="sub-menu p-2 rounded" href="#">Status Penilaian</li>
                <li class="sub-menu p-2 rounded" href="#">Perkembangan Nilai</li>
                <li class="sub-menu p-2 rounded" href="#">Nilai Skill Passport</>
                <li class="sub-menu p-2 rounded" href="#">Nilai UKK</>
            </ul>
        </div>

        <div class="">
            <span class="font-bold mb-3">LAPORAN</span>
            <ul class="px-3">
                <li class="sub-menu p-2 rounded" href="#">Cetak Nilai</li>
            </ul>
        </div>

        <div class="">
            <span class="font-bold mb-3">Pengaturan</span>
            <ul class="px-3">
                <li class="sub-menu p-2 rounded" href="#">Pengaturan</li>
                <li class="sub-menu p-2 rounded" href="#">Log Out</li>
            </ul>
        </div>
    </div>
</aside>
