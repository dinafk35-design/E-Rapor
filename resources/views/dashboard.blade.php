@extends('layouts.app')

@section('title', 'Dashboard - E-Rapor SMK')

@section('page-title', 'Dashboard')

@section('content')

{{-- Judul Atas setiap halaman berbeda --}}
<div class="mb-4">
    <span class="text-3xl font-bold">Dashboard</span>
    <p class="text-muted">
        Selamat datang di Sistem E-Rapor SMK
    </p>
</div>

<div class="bg-white rounded-xl shadow-lg border border-gray-300 p-5 h-auto grid gap-10">
    <div class="grid grid-cols-4 gap-4">
        <div class="grid grid-rows-2 rounded-xl border border-gray-300 px-4 py-4 bg-white shadow-lg">
            <span class="text-md font-bold">Data Siswa</span>
            <span class="text-4xl text-purple-900 font-bold">20</span>
            <span class="text-xs mt-2">Total Siswa</span>
        </div>
        <div class="grid grid-rows-2 rounded-xl border border-gray-300 px-4 py-4 bg-white shadow-lg">
            <span class="text-md font-bold">Data Siswa</span>
            <span class="text-4xl text-purple-900 font-bold">20</span>
            <span class="text-xs mt-2">Total Siswa</span>
        </div>
        <div class="grid grid-rows-2 rounded-xl border border-gray-300 px-4 py-4 bg-white shadow-lg">
            <span class="text-md font-bold">Data Siswa</span>
            <span class="text-4xl text-purple-900 font-bold">20</span>
            <span class="text-xs mt-2">Total Siswa</span>
        </div>
        <div class="grid grid-rows-2 rounded-xl border border-gray-300 px-4 py-4 bg-white shadow-lg">
            <span class="text-md font-bold">Data Siswa</span>
            <span class="text-4xl text-purple-900 font-bold">20</span>
            <span class="text-xs mt-2">Total Siswa</span>
        </div>
    </div>

    <div>
        <span class="text-xl font-bold">Informasi e-Rapor</spna>
    </div>
</div>



<!-- INFORMASI -->

<div class="row mt-4">


    <div class="col-md-8">

        <div class="stat-card">

            <h5>
                📊 Informasi E-Rapor
            </h5>

            <hr>

            <p>
                Sistem E-Rapor SMK digunakan untuk membantu
                pengelolaan data sekolah, guru, siswa,
                mata pelajaran, rombel, dan penilaian.
            </p>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stat-card">

            <h5>
                📅 Tahun Ajaran
            </h5>

            <hr>

            <h4>
                2026 / 2027
            </h4>

            <p class="text-muted">
                Semester Ganjil
            </p>

        </div>

    </div>


</div>

@endsection
