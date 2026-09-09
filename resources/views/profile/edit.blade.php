@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <div class="bg-[#4f76b3] text-white px-6 py-4">

            <h1 class="text-xl font-bold">
                Ubah Profile Pengguna
            </h1>

        </div>


        <div class="p-6">

            <form
                action="{{ route('profile.update') }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <!-- NAMA -->

                <div class="mb-5">

                    <label class="block font-semibold mb-2">

                        Nama

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full border rounded-lg px-4 py-3"
                        required
                    >

                    @error('name')

                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <!-- USERNAME -->

                <div class="mb-5">

                    <label class="block font-semibold mb-2">

                        Username

                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full border rounded-lg px-4 py-3"
                        required
                    >

                    @error('username')

                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <!-- EMAIL -->

                <div class="mb-5">

                    <label class="block font-semibold mb-2">

                        E-mail

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full border rounded-lg px-4 py-3"
                        required
                    >

                    @error('email')

                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <!-- BUTTON -->

                <div class="flex gap-3">

                    <a
                        href="{{ route('profile') }}"
                        class="px-5 py-3 rounded-lg bg-gray-500 text-white"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="px-5 py-3 rounded-lg bg-blue-600 text-white"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection