@extends('layouts.app')

@section('title', 'Data Guru')

@section('page-title', 'Data Guru')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="mb-4">
    <span class="text-3xl font-bold">Data Guru</span>
    <p class="text-muted">
        Kelola informasi Data Guru
    </p>
</div>

<div class="bg-white rounded-xl shadow-lg border border-gray-300 p-5 h-auto grid gap-10">
    
    <!-- PESAN BERHASIL -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- ERROR -->
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- TABEL -->
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <strong>
                Daftar Sekolah
            </strong>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama Sekolah
                            </th>

                            <th>
                                Alamat
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Telepon
                            </th>

                            <th width="230">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($dataSekolah as $sekolah)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $sekolah->nama_sekolah }}
                                </strong>
                            </td>

                            <td>
                                {{ $sekolah->alamat }}
                            </td>

                            <td>
                                {{ $sekolah->email ?? '-' }}
                            </td>

                            <td>
                                {{ $sekolah->telepon ?? '-' }}
                            </td>

                            <td>

                                <a href="{{ route('data-sekolah.show', $sekolah->id) }}"
                                   class="btn btn-info btn-sm">

                                    👁 Detail

                                </a>


                                <a href="{{ route('data-sekolah.edit', $sekolah->id) }}"
                                   class="btn btn-warning btn-sm">

                                    ✏ Edit

                                </a>


                                <form
                                    action="{{ route('data-sekolah.destroy', $sekolah->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">

                                        🗑 Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-4 text-muted">

                                🏫 Belum ada data sekolah.

                                <br>

                                <a href="{{ route('data-sekolah.create') }}"
                                   class="btn btn-primary btn-sm mt-3">

                                    + Tambah Data Sekolah

                                </a>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>



@endsection