@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="ph ph-student me-2"></i>
                Data Siswa
            </h3>

            <p class="text-muted mb-0">
                Kelola data dan biodata siswa
            </p>
        </div>

        @if($mode === 'index')
            <a href="{{ route('data-siswa.create') }}"
               class="btn btn-primary">
                <i class="ph ph-plus me-1"></i>
                Tambah Siswa
            </a>
        @endif
    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="ph ph-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- ========================= --}}
    {{-- DAFTAR SISWA --}}
    {{-- ========================= --}}

    @if($mode === 'index')

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    Daftar Siswa
                </h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">

                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>L/P</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                        @forelse($siswa as $index => $item)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $item->nisn ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->nis ?? '-' }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $item->nama_siswa }}
                                </td>

                                <td>
                                    {{ $item->jenis_kelamin ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->rombel->nama_rombel ?? '-' }}
                                </td>

                                <td>

                                    <a href="{{ route('data-siswa.show', $item->id) }}"
                                       class="btn btn-sm btn-info text-white"
                                       title="Lihat Biodata">

                                        <i class="ph ph-eye"></i>

                                    </a>

                                    <a href="{{ route('data-siswa.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Edit">

                                        <i class="ph ph-pencil-simple"></i>

                                    </a>

                                    <form action="{{ route('data-siswa.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus siswa ini?')"
                                                title="Hapus">

                                            <i class="ph ph-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-5">

                                    <i class="ph ph-student text-3xl text-muted mb-3"></i>

                                    <p class="text-muted mb-0">
                                        Belum ada data siswa.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


    {{-- ========================= --}}
    {{-- FORM TAMBAH SISWA --}}
    {{-- ========================= --}}

    @elseif($mode === 'create')

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="ph ph-user-plus me-2"></i>
                    Tambah Biodata Siswa
                </h5>
            </div>

            <div class="card-body">

                <form action="{{ route('data-siswa.store') }}"
                      method="POST">

                    @csrf

                    @include('data-siswa-form')

                </form>

            </div>

        </div>


    {{-- ========================= --}}
    {{-- DETAIL BIODATA --}}
    {{-- ========================= --}}

    @elseif($mode === 'show')

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="ph ph-identification-card me-2"></i>
                    Biodata Lengkap Siswa
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    {{-- FOTO --}}
                    <div class="col-md-3 text-center mb-4">

                        <div class="border rounded p-4">

                            <i class="ph ph-student text-5xl text-primary mb-3"></i>

                            <h5 class="fw-bold">
                                {{ $siswa->nama_siswa }}
                            </h5>

                            <p class="text-muted">
                                {{ $siswa->nisn ?? '-' }}
                            </p>

                        </div>

                    </div>


                    {{-- DATA PRIBADI --}}
                    <div class="col-md-9">

                        <h5 class="fw-bold border-bottom pb-2 mb-3">
                            Data Pribadi
                        </h5>

                        <div class="row mb-2">

                            <div class="col-md-4 text-muted">
                                NISN
                            </div>

                            <div class="col-md-8 fw-semibold">
                                {{ $siswa->nisn ?? '-' }}
                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-md-4 text-muted">
                                NIS
                            </div>

                            <div class="col-md-8">
                                {{ $siswa->nis ?? '-' }}
                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-md-4 text-muted">
                                Nama Lengkap
                            </div>

                            <div class="col-md-8 fw-semibold">
                                {{ $siswa->nama_siswa }}
                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-md-4 text-muted">
                                Jenis Kelamin
                            </div>

                            <div class="col-md-8">
                                {{ $siswa->jenis_kelamin ?? '-' }}
                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-md-4 text-muted">
                                Tempat, Tanggal Lahir
                            </div>

                            <div class="col-md-8">

                                {{ $siswa->tempat_lahir ?? '-' }},

                                @if($siswa->tanggal_lahir)
                                    {{ $siswa->tanggal_lahir->format('d-m-Y') }}
                                @else
                                    -
                                @endif

                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-md-4 text-muted">
                                Kelas / Rombel
                            </div>

                            <div class="col-md-8">
                                {{ $siswa->rombel->nama_rombel ?? '-' }}
                            </div>

                        </div>

                        <div class="row mb-2">

                            <div class="col-md-4 text-muted">
                                Alamat
                            </div>

                            <div class="col-md-8">
                                {{ $siswa->alamat ?? '-' }}
                            </div>

                        </div>

                    </div>

                </div>


                <hr>


                {{-- DATA ORANG TUA --}}

                <h5 class="fw-bold border-bottom pb-2 mb-3">

                    <i class="ph ph-users me-2"></i>

                    Data Orang Tua

                </h5>

                <div class="row">

                    <div class="col-md-6">

                        <div class="card bg-light border-0">

                            <div class="card-body">

                                <h6 class="fw-bold">
                                    Nama Ayah
                                </h6>

                                <p class="mb-0">
                                    {{ $siswa->nama_ayah ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="card bg-light border-0">

                            <div class="card-body">

                                <h6 class="fw-bold">
                                    Nama Ibu
                                </h6>

                                <p class="mb-0">
                                    {{ $siswa->nama_ibu ?? '-' }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="mt-4">

                    <a href="{{ route('data-siswa.index') }}"
                       class="btn btn-secondary">

                        <i class="ph ph-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <a href="{{ route('data-siswa.edit', $siswa->id) }}"
                       class="btn btn-warning">

                        <i class="ph ph-pencil-simple me-1"></i>
                        Edit Biodata

                    </a>

                </div>

            </div>

        </div>


    {{-- ========================= --}}
    {{-- FORM EDIT --}}
    {{-- ========================= --}}

    @elseif($mode === 'edit')

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-warning">

                <h5 class="mb-0">
                    <i class="ph ph-user-plus me-2"></i>
                    Edit Biodata Siswa
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('data-siswa.update', $siswa->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    @include('data-siswa-form', [
                        'edit' => true
                    ])

                </form>

            </div>

        </div>

    @endif

</div>

@endsection