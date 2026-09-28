@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Siswa
        </h2>

        <p>
            Kelola data siswa yang terdaftar dalam sistem E-Rapor SMK.
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
    <!-- TABEL DATA SISWA -->
    <!-- ============================= -->

    <div class="section-title flex justify-between">

        <div>
            <i class="ph ph-table"></i>
            Data Siswa
        </div>

        <a href="{{route('data-siswa.create')}}" class="bg-green-300 p-2 border border-gray-200 rounded-lg">

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
                            NISN
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Nama Siswa
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Jenis Kelamin
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tempat Lahir
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Tanggal Lahir
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Rombel
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($siswa as $item)

                        <tr>

                            <td class="border px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->nisn ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->nama_siswa }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->jenis_kelamin === 'P' ? 'Perempuan' : ($item->jenis_kelamin === 'L' ? 'Laki-laki' : '-') }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->tempat_lahir ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->tanggal_lahir?->format('d-m-Y') ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->rombel?->nama_rombel ?? '-' }}
                            </td>

                            <td class="border px-4 py-3 text-center">

                                <a
                                    href="{{ route('data-siswa.edit', $item->id) }}"
                                    class="px-3 py-2 inline-block rounded-lg bg-yellow-500 text-white"
                                >

                                    <i class="ph ph-pencil-simple"></i>

                                    Edit

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="border px-4 py-6 text-center text-gray-500">
                                Belum ada data siswa.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection