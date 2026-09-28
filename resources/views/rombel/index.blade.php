@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Data Rombel
        </h2>

        <p>
            Kelola data rombongan belajar beserta anggota siswa yang tergabung
            di dalamnya dalam satu halaman pada sistem E-Rapor SMK.
        </p>

    </div>


    @if (session('status'))

        <div class="mb-4 rounded-lg border border-green-300 bg-green-50 p-3 text-sm text-green-800">
            <i class="ph ph-check-circle mr-1"></i>
            {{ session('status') }}
        </div>

    @endif

    @if ($errors->any())

        <div class="mb-4 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-800">
            <i class="ph ph-warning-circle mr-1"></i>
            {{ $errors->first() }}
        </div>

    @endif


    <!-- ============================= -->
    <!-- TABEL DATA ROMBEL -->
    <!-- ============================= -->

    <div class="section-title flex justify-between">

        <div>

            <i class="ph ph-table"></i>

            Data Rombel

        </div>

        <a href="{{ route('rombel.create') }}" class="bg-green-300 p-2 border border-gray-200 rounded-lg">

            + Tambah Data

        </a>

    </div>


    <div class="bg-white rounded-xl shadow p-6">

        <div class="overflow-x-auto">

            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="border px-4 py-3 text-left">
                            No
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Nama Rombel
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tingkat
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Sekolah
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Wali Kelas
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Anggota
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($rombel as $item)

                        <tr>

                            <td class="border px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->nama_rombel }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->tingkat ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->sekolah?->nama_sekolah ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->wali?->nama_guru ?? '-' }}
                            </td>

                            <td class="border px-4 py-3 text-center">
                                {{ $item->anggota_count }} Siswa
                            </td>

                            <td class="border px-4 py-3 text-center">

                                <a
                                    href="{{ route('rombel.edit', $item->id) }}"
                                    class="px-3 py-2 inline-block rounded-lg bg-yellow-500 text-white"
                                >

                                    <i class="ph ph-pencil-simple"></i>

                                    Edit

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="border px-4 py-6 text-center text-gray-500">
                                Belum ada data rombel.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
