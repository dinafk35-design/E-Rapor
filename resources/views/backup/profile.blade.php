@extends('layouts.app')
@section('content')
<div class="container mx-auto max-w-2xl px-6 py-8">

    <div class="rounded-xl bg-white p-8 shadow-md">

        <h1 class="mb-8 text-2xl font-bold text-gray-800">
            Profile Admin
        </h1>

        <div class="mb-5">
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Nama
            </label>
            <input
                type="text"
                placeholder="Masukkan nama"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
            >
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Username
            </label>
            <input
                type="text"
                placeholder="Masukkan username"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
            >
        </div>

        <div class="mb-5">
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Email
            </label>
            <input
                type="email"
                placeholder="Masukkan email"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
            >
        </div>

        <div class="mb-6">
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                No. Telepon
            </label>
            <input
                type="text"
                placeholder="Masukkan nomor telepon"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
            >
        </div>

        <button
            type="button"
            class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
        >
            Simpan
        </button>

    </div>

</div>

@endsection 