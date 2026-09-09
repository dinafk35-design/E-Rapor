@extends('layouts.app')

@section('title', 'Detail Data Guru')

@section('page-title', 'Detail Data Guru')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                🏫 Detail Data Guru
            </h5>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <tr>

                        <th width="250">
                            Nama Guru
                        </th>

                        <td>
                            {{ $dataSekolah->nama_guru }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Alamat
                        </th>

                        <td>
                            {{ $dataGuru->alamat }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Email
                        </th>

                        <td>
                            {{ $dataGuru->email ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Telepon
                        </th>

                        <td>
                            {{ $dataGuru->telepon ?? '-' }}
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Dibuat
                        </th>

                        <td>
                            {{ $dataGuru->created_at ?? '-' }}
                        </td>

                    </tr>

                </table>

            </div>


            <a
                href="{{ route('data-guru.index') }}"
                class="btn btn-secondary">

                ← Kembali

            </a>


            <a
                href="{{ route('data-guru.edit', $dataGuru->id) }}"
                class="btn btn-warning">

                ✏️ Edit

            </a>

        </div>

    </div>

</div>

@endsection