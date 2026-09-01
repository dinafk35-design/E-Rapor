@extends('layouts.app')

@section('title', 'Edit Data Sekolah')

@section('page-title', 'Edit Data Sekolah')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                ✏️ Edit Data Sekolah
            </h5>

        </div>


        <div class="card-body">

            <form
                action="{{ route('data-sekolah.update', $dataSekolah->id) }}"
                method="POST">

                @csrf

                @method('PUT')


                <!-- NAMA -->

                <div class="mb-3">

                    <label class="form-label">
                        Nama Sekolah
                    </label>

                    <input
                        type="text"
                        name="nama_sekolah"
                        class="form-control"
                        value="{{ old('nama_sekolah', $dataSekolah->nama_sekolah) }}"
                        required>

                </div>


                <!-- ALAMAT -->

                <div class="mb-3">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4"
                        required>{{ old('alamat', $dataSekolah->alamat) }}</textarea>

                </div>


                <!-- EMAIL -->

                <div class="mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $dataSekolah->email) }}">

                </div>


                <!-- TELEPON -->

                <div class="mb-3">

                    <label class="form-label">
                        Telepon
                    </label>

                    <input
                        type="text"
                        name="telepon"
                        class="form-control"
                        value="{{ old('telepon', $dataSekolah->telepon) }}">

                </div>


                <!-- BUTTON -->

                <div class="mt-4">

                    <a
                        href="{{ route('data-sekolah.index') }}"
                        class="btn btn-secondary">

                        ← Kembali

                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        💾 Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection