@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->
    <div class="welcome">
        <h2 class="italic font-bold">
            Data Guru
        </h2>

        <p>
            Kelola data guru yang terdaftar dalam sistem E-Rapor SMK.
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
    <!-- TABEL DATA GURU -->
    <!-- ============================= -->

     <div class="section-title flex justify-between">

        <div>
            <i class="ph ph-table"></i>
            Data Guru
        </div>

        <a href="{{route('data-guru.create')}}" class="bg-green-300 p-2 border border-gray-200 rounded-lg">

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
                            NIP
                        </th>

                        <th class="border px-4 py-3 text-left">
                            NIK
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Nama Guru
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Jenis Kelamin
                        </th>

                        <th class="border px-4 py-3 text-left">
                            Email
                        </th>

                        <th class="border px-4 py-3 text-left">
                            No. Telepon
                        </th>

                        <th class="border px-4 py-3 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($guru as $item)

                        <tr>

                            <td class="border px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->nip ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->nik ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->nama_guru }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->jenis_kelamin === 'P' ? 'Perempuan' : ($item->jenis_kelamin === 'L' ? 'Laki-laki' : '-') }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->email ?? '-' }}
                            </td>

                            <td class="border px-4 py-3">
                                {{ $item->no_telepon ?? '-' }}
                            </td>

                            <td class="border px-4 py-3 text-center">

                                <a
                                    href="{{ route('data-guru.edit', $item->id) }}"
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
                                Belum ada data guru.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


@endsection