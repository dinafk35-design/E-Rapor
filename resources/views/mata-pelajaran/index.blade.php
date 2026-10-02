@extends('layouts.app')

@section('content')

    <div class="content">

        ```
        <!-- ============================= -->
        <!-- HEADER -->
        <!-- ============================= -->

        <div class="welcome">
            <h2 class="italic font-bold">
                Data Mata Pelajaran
            </h2>

            <p>
                Kelola data mata pelajaran yang digunakan dalam sistem E-Rapor SMK.
            </p>
        </div>


        <!-- ============================= -->
        <!-- PESAN BERHASIL -->
        <!-- ============================= -->

        @if (session('status'))
            <div class="mb-4 rounded-lg border border-green-300 bg-green-50 p-3 text-sm text-green-800">
                <i class="ph ph-check-circle mr-1"></i>
                {{ session('status') }}
            </div>
        @endif


        <!-- ============================= -->
        <!-- PESAN ERROR -->
        <!-- ============================= -->

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
                <i class="ph ph-warning-circle mr-1"></i>
                {{ $errors->first() }}
            </div>
        @endif


        <!-- ============================= -->
        <!-- FILTER -->
        <!-- ============================= -->

        <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                <!-- PENCARIAN -->

                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Pencarian
                    </label>

                    <input type="text" id="searchMapel"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                        placeholder="Cari kode atau nama mata pelajaran...">

                </div>


                <!-- KELOMPOK -->

                <div>

                    <label class="mb-2 block text-sm font-semibold text-gray-700">
                        Kelompok
                    </label>

                    <select id="kelompokMapel"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                        <option value="">
                            Semua
                        </option>

                        <option value="A">
                            Kelompok A
                        </option>

                        <option value="B">
                            Kelompok B
                        </option>

                        <option value="C">
                            Kelompok C
                        </option>

                    </select>

                </div>

            </div>


            <!-- TOMBOL FILTER -->

            <div class="mt-5 flex flex-wrap gap-3">

                <button type="button" onclick="filterMapel()"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                    <i class="ph ph-magnifying-glass mr-1"></i>

                    Cari

                </button>


                <button type="button" onclick="resetFilterMapel()"
                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-300">

                    <i class="ph ph-arrow-counter-clockwise mr-1"></i>

                    Reset

                </button>

            </div>

        </div>


        <!-- ============================= -->
        <!-- TABEL MATA PELAJARAN -->
        <!-- ============================= -->

        <x-table-card title="Data Mata Pelajaran"
            subtitle="Menampilkan daftar seluruh mata pelajaran yang terdaftar dalam sistem." :createRoute="route('mata-pelajaran.create')"
            :items="$mataPelajaran">

            <!-- HEADER TABEL -->

            <x-slot:thead>

                <th class="px-6 py-4">
                    No
                </th>

                <th class="px-6 py-4">
                    Kode Mata Pelajaran
                </th>

                <th class="px-6 py-4">
                    Nama Mata Pelajaran
                </th>

                <th class="px-6 py-4">
                    Kelompok
                </th>

                <th class="px-6 py-4">
                    Sekolah
                </th>

                <th class="px-6 py-4">
                    Guru Mengajar
                </th>

                <th class="px-6 py-4 text-center min-w-[220px]">
                    Aksi
                </th>

            </x-slot:thead>


            <!-- BODY TABEL -->

            @forelse ($mataPelajaran as $item)
                <tr class="status-row transition hover:bg-gray-50">

                    <!-- NOMOR -->

                    <td class="px-6 py-5">
                        {{ $loop->iteration }}
                    </td>


                    <!-- KODE -->

                    <td class="px-6 py-5 font-medium text-gray-700">
                        {{ $item->kode_mata_pelajaran ?? '-' }}
                    </td>


                    <!-- NAMA -->

                    <td class="px-6 py-5">

                        <div class="font-semibold text-gray-800">
                            {{ $item->nama_mata_pelajaran ?? '-' }}
                        </div>

                    </td>


                    <!-- KELOMPOK -->

                    <td class="px-6 py-5">

                        @if ($item->kelompok)
                            <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">

                                Kelompok {{ $item->kelompok }}

                            </span>
                        @else
                            <span class="text-gray-500">
                                -
                            </span>
                        @endif

                    </td>

                    <!-- SEKOLAH -->

                    <td class="px-6 py-5 text-gray-600">
                        {{ $item->sekolah->nama_sekolah ?? '-' }}
                    </td>


                    <!-- GURU PENGAJAR -->

                    <td class="px-6 py-5">

                        @if ($item->guruMengajar && $item->guruMengajar->count() > 0)
                            @foreach ($item->guruMengajar as $relasi)
                                <div class="mb-1">
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">

                                        <i class="ph ph-user"></i>

                                        {{ $relasi->guru->nama_guru ?? '-' }}

                                    </span>
                                </div>
                            @endforeach
                        @else
                            <span class="text-gray-500">
                                Belum ada guru
                            </span>
                        @endif

                    </td>

                    <!-- AKSI -->

                    <td class="px-6 py-5 text-center whitespace-nowrap">

                        <!-- EDIT -->

                        <a href="{{ route('mata-pelajaran.edit', $item->id) }}"
                            class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">

                            <i class="ph ph-pencil-simple text-sm"></i>

                            Edit

                        </a>


                        <!-- RELASI -->

                        <a href="#"
                            onclick="lihatRelasi('{{ $item->id }}', '{{ addslashes($item->nama_mata_pelajaran) }}')"
                            class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700">

                            <i class="ph ph-link-simple text-sm"></i>

                            Relasi

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">

                        Belum ada data mata pelajaran.

                    </td>

                </tr>
            @endforelse

        </x-table-card>
        ```

    </div>

    <!-- ============================= -->

    <!-- JAVASCRIPT -->

    <!-- ============================= -->

    <script>
        /* ============================= */
        /* FILTER MATA PELAJARAN */
        /* ============================= */

        function filterMapel() {

            const search =
                document.getElementById('searchMapel').value.toLowerCase();

            const kelompok =
                document.getElementById('kelompokMapel').value.toLowerCase();

            const rows =
                document.querySelectorAll('.status-row');


            rows.forEach(function(row) {

                const text =
                    row.innerText.toLowerCase();

                const cocokSearch =
                    search === '' || text.includes(search);

                const cocokKelompok =
                    kelompok === '' || text.includes('kelompok ' + kelompok);

                if (cocokSearch && cocokKelompok) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        }


        /* ============================= */
        /* RESET FILTER */
        /* ============================= */

        function resetFilterMapel() {

            document.getElementById('searchMapel').value = '';

            document.getElementById('kelompokMapel').value = '';

            document.querySelectorAll('.status-row')
                .forEach(function(row) {

                    row.style.display = '';

                });

        }


        /* ============================= */
        /* LIHAT RELASI */
        /* ============================= */

        function lihatRelasi(id, nama) {

            alert(
                'Relasi Mata Pelajaran\n\n' +
                'Mata Pelajaran: ' + nama + '\n\n' +
                'ID: ' + id
            );

        }
    </script>

@endsection
