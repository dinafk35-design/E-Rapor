@extends('layouts.app')

@section('title', 'Detail Data Sekolah')

@section('page-title', 'Detail Data Sekolah')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                🏫 Detail Data Sekolah
            </h5>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <tr>

                        <th width="250">
                            Nama Sekolah
                        </th>

                        <td>
                            {{ $dataSekolah->nama_sekolah }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Alamat
                        </th>

                        <td>
                            {{ $dataSekolah->alamat }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Email
                        </th>

                        <td>
                            {{ $dataSekolah->email ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Telepon
                        </th>

                        <td>
                            {{ $dataSekolah->telepon ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Dibuat
                        </th>

                        <td>
                            {{ $dataSekolah->created_at ?? '-' }}
                        </td>

                    </tr>

                </table>

            </div>


            <a
                href="{{ route('data-sekolah.index') }}"
                class="btn btn-secondary">

                ← Kembali

            </a>


            <a
                href="{{ route('data-sekolah.edit', $dataSekolah->id) }}"
                class="btn btn-warning">

                ✏️ Edit

            </a>

        </div>

    </div>

</div>

@endsection