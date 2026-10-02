@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Data Guru
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola data guru E-Rapor SMK
                </p>
            </div>

            <a href="{{ route('data-guru.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                <i class="ph ph-plus"></i>

                Tambah Guru
            </a>
        </div>
    </div>


    <!-- FILTER -->
    <div class="mb-6 rounded-xl bg-white p-5 shadow-sm">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            <!-- SEARCH -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Cari Guru
                </label>

                <div class="relative">

                    <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        id="searchGuru"
                        placeholder="Cari nama, NIP, atau NIK..."
                        class="w-full rounded-lg border border-slate-300 py-2.5 pl-10 pr-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        onkeyup="filterGuru()"
                    >

                </div>
            </div>


            <!-- JENIS KELAMIN -->
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Jenis Kelamin
                </label>

                <select
                    id="filterJenisKelamin"
                    onchange="filterGuru()"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >

                    <option value="">Semua</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>

                </select>
            </div>


            <!-- RESET -->
            <div class="flex items-end">

                <button
                    type="button"
                    onclick="resetFilterGuru()"
                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >

                    <i class="ph ph-arrow-counter-clockwise"></i>

                    Reset

                </button>

            </div>

        </div>

    </div>


    <!-- TABLE -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm">

        <!-- TABLE HEADER -->
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">

            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Daftar Guru
                </h2>

                <p class="text-sm text-slate-500">
                    Data guru yang terdaftar dalam sistem
                </p>
            </div>

        </div>


        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-4 font-semibold text-slate-700">
                            No
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-700">
                            NIP
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-700">
                            NIK
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-700">
                            Nama Guru
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-700">
                            Jenis Kelamin
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-700">
                            Email
                        </th>

                        <th class="px-5 py-4 font-semibold text-slate-700">
                            No. Telepon
                        </th>

                        <th class="px-5 py-4 text-center font-semibold text-slate-700">
                            Relasi
                        </th>

                        <th class="px-5 py-4 text-center font-semibold text-slate-700">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody id="guruTableBody" class="divide-y divide-slate-100">

                    @forelse ($guru as $item)

                        <tr
                            class="guru-row transition hover:bg-slate-50"
                            data-nama="{{ strtolower($item->nama_guru ?? '') }}"
                            data-nip="{{ strtolower($item->nip ?? '') }}"
                            data-nik="{{ strtolower($item->nik ?? '') }}"
                            data-jk="{{ $item->jenis_kelamin ?? '' }}"
                        >

                            <!-- NO -->
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                {{ $loop->iteration }}
                            </td>


                            <!-- NIP -->
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                {{ $item->nip ?? '-' }}
                            </td>


                            <!-- NIK -->
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                {{ $item->nik ?? '-' }}
                            </td>


                            <!-- NAMA -->
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $item->nama_guru ?? '-' }}
                                </div>

                            </td>


                            <!-- JENIS KELAMIN -->
                            <td class="whitespace-nowrap px-5 py-4">

                                @if (($item->jenis_kelamin ?? '') === 'L')

                                    <span class="rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                        Laki-laki
                                    </span>

                                @elseif (($item->jenis_kelamin ?? '') === 'P')

                                    <span class="rounded-full bg-pink-100 px-2.5 py-1 text-xs font-semibold text-pink-700">
                                        Perempuan
                                    </span>

                                @else

                                    <span class="text-slate-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            <!-- EMAIL -->
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                {{ $item->email ?? '-' }}
                            </td>


                            <!-- TELEPON -->
                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                {{ $item->no_telepon ?? '-' }}
                            </td>


                            <!-- RELASI -->
                            <td class="px-5 py-4 text-center">

                                <button
                                    type="button"
                                    onclick="lihatRelasi({{ $item->id }})"
                                    class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-blue-700"
                                >

                                    <i class="ph ph-link-simple text-sm"></i>

                                    Relasi

                                </button>

                            </td>


                            <!-- AKSI -->
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- EDIT -->
                                    <a
                                        href="{{ route('data-guru.edit', $item->id) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-100 text-amber-600 transition hover:bg-amber-200"
                                        title="Edit"
                                    >

                                        <i class="ph ph-pencil-simple"></i>

                                    </a>


                                    <!-- DELETE -->
                                    @php
                                        $jumlahRelasi =
                                            ($item->guru_mengajar_count ?? 0) +
                                            ($item->wali_kelas_count ?? 0) +
                                            ($item->rombel_diampu_count ?? 0);
                                    @endphp


                                    @if ($jumlahRelasi > 0)

                                        <button
                                            type="button"
                                            disabled
                                            title="Guru masih memiliki relasi"
                                            class="inline-flex h-9 w-9 cursor-not-allowed items-center justify-center rounded-lg bg-slate-100 text-slate-400"
                                        >

                                            <i class="ph ph-trash"></i>

                                        </button>

                                    @else

                                        <form
                                            action="{{ route('data-guru.destroy', $item->id) }}"
                                            method="POST"
                                            class="delete-guru-form"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="button"
                                                onclick="confirmDeleteGuru(this)"
                                                title="Hapus"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-100 text-red-600 transition hover:bg-red-200"
                                            >

                                                <i class="ph ph-trash"></i>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="px-5 py-10 text-center text-slate-500"
                            >

                                <div class="flex flex-col items-center justify-center">

                                    <i class="ph ph-users-three mb-3 text-4xl text-slate-300"></i>

                                    <p class="font-semibold">
                                        Belum ada data guru
                                    </p>

                                    <p class="mt-1 text-sm">
                                        Silakan tambahkan data guru terlebih dahulu.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- ===================================================== -->
<!-- JAVASCRIPT -->
<!-- ===================================================== -->

<script>

    /*
    |--------------------------------------------------------------------------
    | DATA RELASI GURU
    |--------------------------------------------------------------------------
    */

    const dataGuruRelasi = @js(
        $guru->mapWithKeys(function ($item) {

            return [

                $item->id => [

                    'nama' => $item->nama_guru,

                    'mata_pelajaran' => $item->guruMengajar
                        ->map(function ($relasi) {

                            return $relasi->mataPelajaran->nama_mata_pelajaran ?? '-';

                        })
                        ->filter()
                        ->unique()
                        ->values()
                        ->toArray(),

                ],

            ];

        })->toArray()
    );


    /*
    |--------------------------------------------------------------------------
    | LIHAT RELASI
    |--------------------------------------------------------------------------
    */

    function lihatRelasi(id)
    {

        const data = dataGuruRelasi[id];


        if (!data) {

            alert('Data guru tidak ditemukan.');

            return;

        }


        let pesan =
            'Relasi Mata Pelajaran\n\n' +
            'Guru: ' +
            data.nama +
            '\n\n';


        if (
            !data.mata_pelajaran ||
            data.mata_pelajaran.length === 0
        ) {

            pesan +=
                'Guru ini belum memiliki mata pelajaran.';

        } else {

            pesan +=
                'Mata Pelajaran:\n';


            data.mata_pelajaran.forEach(function (
                mapel,
                index
            ) {

                pesan +=
                    (index + 1) +
                    '. ' +
                    mapel +
                    '\n';

            });

        }


        alert(pesan);

    }


    /*
    |--------------------------------------------------------------------------
    | FILTER GURU
    |--------------------------------------------------------------------------
    */

    function filterGuru()
    {

        const search =
            document
                .getElementById('searchGuru')
                .value
                .toLowerCase()
                .trim();


        const jenisKelamin =
            document
                .getElementById('filterJenisKelamin')
                .value;


        const rows =
            document.querySelectorAll('.guru-row');


        rows.forEach(function (row)
        {

            const nama =
                row.dataset.nama || '';


            const nip =
                row.dataset.nip || '';


            const nik =
                row.dataset.nik || '';


            const jk =
                row.dataset.jk || '';


            const cocokSearch =
                nama.includes(search) ||
                nip.includes(search) ||
                nik.includes(search);


            const cocokJenisKelamin =
                jenisKelamin === '' ||
                jk === jenisKelamin;


            if (
                cocokSearch &&
                cocokJenisKelamin
            ) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | RESET FILTER
    |--------------------------------------------------------------------------
    */

    function resetFilterGuru()
    {

        document.getElementById('searchGuru').value = '';

        document.getElementById('filterJenisKelamin').value = '';

        filterGuru();

    }


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI HAPUS
    |--------------------------------------------------------------------------
    */

    function confirmDeleteGuru(button)
    {

        const form =
            button.closest('.delete-guru-form');


        const yakin =
            confirm(
                'Apakah Anda yakin ingin menghapus data guru ini?'
            );


        if (yakin) {

            form.submit();

        }

    }

</script>

@endsection