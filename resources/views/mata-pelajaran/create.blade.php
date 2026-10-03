@extends('layouts.app')

@section('content')

    <div class="content">

        {{-- =====================================================
            HEADER
        ====================================================== --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Mata Pelajaran', 'url' => route('mata-pelajaran.index')],
                ['label' => 'Tambah Data Mata Pelajaran'],
            ]" />

            <div class="mt-1 flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10">
                    <i class="ph ph-book-open text-2xl"></i>
                </div>

                <div>
                    <h1 class="text-xl font-bold">
                        Tambah Mata Pelajaran
                    </h1>

                    <p class="mt-1 text-xs text-[#c2c2dc]">
                        Tambahkan mata pelajaran dan tentukan guru yang mengajar.
                    </p>
                </div>

            </div>

        </div>


        {{-- =====================================================
            ERROR
        ====================================================== --}}
        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 shadow-sm">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <i class="ph ph-warning-circle text-lg"></i>
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-red-800">
                            Data belum dapat disimpan
                        </p>

                        <p class="mt-1 text-xs text-red-700">
                            Periksa kembali data yang ditandai sebelum menyimpan.
                        </p>

                    </div>

                </div>

            </div>
        @endif


        <form method="POST" action="{{ route('mata-pelajaran.store') }}" id="formMataPelajaran">

            @csrf


            {{-- =====================================================
                INFORMASI MATA PELAJARAN
            ====================================================== --}}
            <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

                <div class="mb-5 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-book-open text-lg"></i>
                    </div>

                    <div>

                        <h2 class="text-base font-bold text-slate-800">
                            Informasi Mata Pelajaran
                        </h2>

                        <p class="text-[11px] text-slate-400">
                            Masukkan identitas dasar mata pelajaran yang akan digunakan dalam E-Rapor.
                        </p>

                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- KODE --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Kode Mata Pelajaran
                        </label>

                        <div class="relative">

                            <i class="ph ph-hash absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <input type="text" name="kode_mata_pelajaran" value="{{ old('kode_mata_pelajaran') }}"
                                placeholder="Contoh: RPL001"
                                class="w-full rounded-lg border border-slate-200 py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        </div>

                        <p class="mt-1.5 text-[10px] text-slate-400">
                            Gunakan kode yang konsisten dengan sistem akademik sekolah.
                        </p>

                        @error('kode_mata_pelajaran')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- NAMA --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Nama Mata Pelajaran
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-book-bookmark absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <input type="text" name="nama_mata_pelajaran" value="{{ old('nama_mata_pelajaran') }}"
                                placeholder="Contoh: Pemrograman Web"
                                class="w-full rounded-lg border border-slate-200 py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                                required>

                        </div>

                        <p class="mt-1.5 text-[10px] text-slate-400">
                            Masukkan nama mata pelajaran secara lengkap.
                        </p>

                        @error('nama_mata_pelajaran')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- KELOMPOK --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Kelompok
                        </label>

                        <div class="relative">

                            <i class="ph ph-stack absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <select name="kelompok"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Kelompok --
                                </option>

                                <option value="A" @selected(old('kelompok') === 'A')>
                                    Kelompok A
                                </option>

                                <option value="B" @selected(old('kelompok') === 'B')>
                                    Kelompok B
                                </option>

                                <option value="C" @selected(old('kelompok') === 'C')>
                                    Kelompok C
                                </option>

                                <option value="Muatan Lokal" @selected(old('kelompok') === 'Muatan Lokal')>
                                    Muatan Lokal
                                </option>

                            </select>

                        </div>

                        <p class="mt-1.5 text-[10px] text-slate-400">
                            Tentukan kelompok mata pelajaran sesuai struktur kurikulum.
                        </p>

                    </div>


                    {{-- SEKOLAH --}}
                    <div>

                        <label class="mb-2 block text-xs font-semibold text-slate-700">
                            Sekolah
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <i class="ph ph-buildings absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <select name="sekolah_id"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    -- Pilih Sekolah --
                                </option>

                                @foreach ($sekolah as $item)
                                    <option value="{{ $item->id }}" @selected((string) old('sekolah_id') === (string) $item->id)>
                                        {{ $item->nama_sekolah }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <p class="mt-1.5 text-[10px] text-slate-400">
                            Pilih sekolah tempat mata pelajaran ini digunakan.
                        </p>

                        @error('sekolah_id')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- =====================================================
                GURU MENGAJAR
            ====================================================== --}}
            <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

                <div class="mb-5 flex flex-wrap items-start justify-between gap-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <i class="ph ph-chalkboard-teacher text-lg"></i>
                        </div>

                        <div>

                            <h2 class="text-base font-bold text-slate-800">
                                Guru yang Mengajar
                            </h2>

                            <p class="mt-1 max-w-2xl text-[11px] leading-relaxed text-slate-400">
                                Hubungkan mata pelajaran dengan guru, rombel, tahun ajaran,
                                dan semester. Relasi ini juga dapat dikelola kembali melalui halaman edit.
                            </p>

                        </div>

                    </div>


                    <button type="button" onclick="tambahBarisGuru()"
                        class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        <i class="ph ph-plus"></i>
                        Tambah Guru
                    </button>

                </div>


                @if ($guru->isEmpty())
                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                        <div class="flex items-start gap-3">

                            <i class="ph ph-warning-circle mt-0.5 text-lg text-amber-600"></i>

                            <div>

                                <p class="text-sm font-semibold text-amber-800">
                                    Belum ada data guru
                                </p>

                                <p class="mt-1 text-xs text-amber-700">
                                    Tambahkan data guru terlebih dahulu sebelum membuat relasi guru mengajar.
                                </p>

                            </div>

                        </div>

                    </div>
                @else
                    <div class="overflow-x-auto rounded-xl border border-slate-200">

                        <table class="w-full text-sm">

                            <thead class="border-b border-slate-200 bg-slate-50">

                                <tr>

                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">
                                        No
                                    </th>

                                    <th class="min-w-[240px] px-4 py-3 text-left text-xs font-semibold text-slate-600">
                                        Guru
                                    </th>

                                    <th class="min-w-[180px] px-4 py-3 text-left text-xs font-semibold text-slate-600">
                                        Rombel
                                    </th>

                                    <th class="min-w-[160px] px-4 py-3 text-left text-xs font-semibold text-slate-600">
                                        Tahun Ajaran
                                    </th>

                                    <th class="min-w-[140px] px-4 py-3 text-left text-xs font-semibold text-slate-600">
                                        Semester
                                    </th>

                                    <th class="px-4 py-3 text-center text-xs font-semibold text-slate-600">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="wrapperGuruMengajar">

                                @php
                                    $barisGuruLama = (array) old('guru_id', []);
                                    $barisRombelLama = (array) old('rombel_id', []);
                                    $barisTahunLama = (array) old('tahun_ajaran', []);
                                    $barisSemesterLama = (array) old('semester', []);

                                    $jumlahBaris = $barisGuruLama === [] ? 1 : count($barisGuruLama);
                                @endphp

                                @for ($i = 0; $i < $jumlahBaris; $i++)
                                    <tr class="border-b border-slate-100">

                                        <td class="px-4 py-3 text-sm text-slate-500 nomor-guru">
                                            {{ $i + 1 }}
                                        </td>


                                        <td class="px-4 py-3">

                                            <select name="guru_id[]"
                                                class="pilihan-guru w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                                <option value="">
                                                    -- Pilih Guru --
                                                </option>

                                                @foreach ($guru as $item)
                                                    <option value="{{ $item->id }}" @selected((string) ($barisGuruLama[$i] ?? '') === (string) $item->id)>
                                                        {{ $item->nama_guru }}
                                                        @if ($item->nip)
                                                            - {{ $item->nip }}
                                                        @endif
                                                    </option>
                                                @endforeach

                                            </select>

                                        </td>


                                        <td class="px-4 py-3">

                                            <select name="rombel_id[]"
                                                class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                                <option value="">
                                                    -- Pilih Rombel --
                                                </option>

                                                @foreach ($rombel as $item)
                                                    <option value="{{ $item->id }}" @selected((string) ($barisRombelLama[$i] ?? '') === (string) $item->id)>
                                                        {{ $item->nama_rombel }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('rombel_id.' . $i)
                                                <p class="mt-1 text-xs text-red-500">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </td>


                                        <td class="px-4 py-3">

                                            <select name="tahun_ajaran[]"
                                                class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                                <option value="">
                                                    -- Tahun Ajaran --
                                                </option>

                                                @foreach (['2025/2026', '2026/2027', '2027/2028'] as $tahun)
                                                    <option value="{{ $tahun }}" @selected(($barisTahunLama[$i] ?? '') === $tahun)>
                                                        {{ $tahun }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </td>


                                        <td class="px-4 py-3">

                                            <select name="semester[]"
                                                class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                                <option value="">
                                                    -- Semester --
                                                </option>

                                                @foreach (['Ganjil', 'Genap'] as $pilihanSemester)
                                                    <option value="{{ $pilihanSemester }}" @selected(($barisSemesterLama[$i] ?? '') === $pilihanSemester)>
                                                        {{ $pilihanSemester }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </td>


                                        <td class="px-4 py-3 text-center">

                                            <button type="button" onclick="hapusBarisGuru(this)"
                                                class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                                <i class="ph ph-trash"></i>
                                                Hapus
                                            </button>

                                        </td>

                                    </tr>
                                @endfor

                            </tbody>

                        </table>

                    </div>
                @endif

            </div>


            {{-- =====================================================
                ACTION
            ====================================================== --}}
            <div
                class="flex flex-col-reverse gap-3 rounded-xl bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">

                <a href="{{ route('mata-pelajaran.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-100 px-5 py-2.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                    <i class="ph ph-arrow-left"></i>
                    Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                    <i class="ph ph-floppy-disk"></i>
                    Simpan Mata Pelajaran
                </button>

            </div>

        </form>

    </div>


    {{-- =====================================================
        TEMPLATE BARIS GURU
    ====================================================== --}}
    <template id="templateBarisGuru">

        <tr class="border-b border-slate-100">

            <td class="px-4 py-3 text-sm text-slate-500 nomor-guru"></td>

            <td class="px-4 py-3">

                <select name="guru_id[]"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    <option value="">
                        -- Pilih Guru --
                    </option>

                    @foreach ($guru as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_guru }}
                            @if ($item->nip)
                                - {{ $item->nip }}
                            @endif
                        </option>
                    @endforeach

                </select>

            </td>


            <td class="px-4 py-3">

                <select name="rombel_id[]"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    <option value="">
                        -- Pilih Rombel --
                    </option>

                    @foreach ($rombel as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_rombel }}
                        </option>
                    @endforeach

                </select>

            </td>


            <td class="px-4 py-3">

                <select name="tahun_ajaran[]"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    <option value="">
                        -- Tahun Ajaran --
                    </option>

                    <option value="2025/2026">2025/2026</option>
                    <option value="2026/2027">2026/2027</option>
                    <option value="2027/2028">2027/2028</option>

                </select>

            </td>


            <td class="px-4 py-3">

                <select name="semester[]"
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    <option value="">
                        -- Semester --
                    </option>

                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>

                </select>

            </td>


            <td class="px-4 py-3 text-center">

                <button type="button" onclick="hapusBarisGuru(this)"
                    class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                    <i class="ph ph-trash"></i>
                    Hapus
                </button>

            </td>

        </tr>

    </template>


    <script>
        function tambahBarisGuru() {

            const wrapper =
                document.getElementById('wrapperGuruMengajar');

            const template =
                document.getElementById('templateBarisGuru');

            if (!wrapper || !template) {
                return;
            }

            wrapper.appendChild(
                template.content.cloneNode(true)
            );

            perbaruiNomorGuru();

        }


        function hapusBarisGuru(tombol) {

            const baris = tombol.closest('tr');

            if (!baris) {
                return;
            }

            const wrapper =
                document.getElementById('wrapperGuruMengajar');

            const jumlahBaris =
                wrapper.querySelectorAll('tr').length;

            if (jumlahBaris <= 1) {
                alert('Minimal harus tersedia satu baris guru.');
                return;
            }

            baris.remove();

            perbaruiNomorGuru();

        }


        function perbaruiNomorGuru() {

            document
                .querySelectorAll('#wrapperGuruMengajar .nomor-guru')
                .forEach(function(kolom, index) {

                    kolom.textContent = index + 1;

                });

        }
    </script>

@endsection
