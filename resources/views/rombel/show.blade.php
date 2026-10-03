@extends('layouts.app')

@section('content')

    <div class="content">

        {{-- HEADER --}}
        <div
            class="mb-6 overflow-hidden rounded-xl bg-gradient-to-r from-[#25284d] via-[#37367a] to-[#5148b8] px-6 py-5 text-white shadow-sm">

            <x-breadcrumb :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Data Master'],
                ['label' => 'Rombel', 'url' => route('rombel.index')],
                ['label' => 'Detail'],
            ]" />

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15">
                        <i class="ph ph-users-three text-2xl"></i>
                    </div>

                    <div>

                        <h2 class="text-xl font-bold">
                            {{ $rombel->nama_rombel }}
                        </h2>

                        <p class="mt-1 text-xs text-indigo-100">
                            Detail informasi rombongan belajar dan anggota siswa.
                        </p>

                    </div>

                </div>


                <div class="flex items-center gap-2">

                    <div class="rounded-lg border border-white/10 bg-white/10 px-4 py-2 text-center">
                        <p class="text-[9px] uppercase tracking-wide text-indigo-200">
                            Anggota
                        </p>

                        <p class="text-lg font-bold">
                            {{ $rombel->anggota->count() }}
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- ACTION --}}
        <div class="mb-6 flex flex-wrap gap-2">

            <a href="{{ route('rombel.index') }}"
                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">
                <i class="ph ph-arrow-left"></i>
                Kembali
            </a>

            <a href="{{ route('rombel.edit', $rombel->id) }}"
                class="inline-flex items-center gap-1.5 rounded-lg bg-amber-500 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-amber-600">
                <i class="ph ph-pencil-simple"></i>
                Edit Rombel
            </a>

            <form action="{{ route('rombel.destroy', $rombel->id) }}" method="POST" data-hapus-form>
                @csrf
                @method('DELETE')

                <button type="submit" data-nama="{{ $rombel->nama_rombel }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-red-500 px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-red-600">
                    <i class="ph ph-trash"></i>
                    Hapus
                </button>

            </form>

        </div>


        {{-- INFORMASI ROMBEL --}}
        <div class="mb-3">

            <div class="flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <i class="ph ph-info"></i>
                </div>

                <h3 class="text-sm font-bold text-slate-800">
                    Informasi Rombel
                </h3>

            </div>

            <p class="mt-1 ml-10 text-xs text-slate-500">
                Informasi dasar mengenai rombongan belajar.
            </p>

        </div>


        <div class="mb-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">


                {{-- NAMA --}}
                <div class="rounded-lg border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-2 flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <i class="ph ph-users-three text-indigo-500"></i>
                        Nama Rombel
                    </div>

                    <p class="text-sm font-bold text-slate-800">
                        {{ $rombel->nama_rombel }}
                    </p>

                </div>


                {{-- TINGKAT --}}
                <div class="rounded-lg border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-2 flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <i class="ph ph-stairs text-indigo-500"></i>
                        Tingkat
                    </div>

                    @if ($rombel->tingkat)
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700">
                            Tingkat {{ $rombel->tingkat }}
                        </span>
                    @else
                        <p class="text-sm text-slate-400">
                            Belum ditentukan
                        </p>
                    @endif

                </div>


                {{-- SEKOLAH --}}
                <div class="rounded-lg border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-2 flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <i class="ph ph-buildings text-indigo-500"></i>
                        Sekolah
                    </div>

                    <p class="text-sm font-semibold text-slate-800">
                        {{ $rombel->sekolah?->nama_sekolah ?? '-' }}
                    </p>

                </div>


                {{-- WALI --}}
                <div class="rounded-lg border border-slate-100 bg-slate-50 p-4">

                    <div class="mb-2 flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <i class="ph ph-chalkboard-teacher text-indigo-500"></i>
                        Wali Kelas
                    </div>

                    <p class="text-sm font-semibold text-slate-800">
                        {{ $rombel->wali?->nama_guru ?? 'Belum ditentukan' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- RINGKASAN --}}
        <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="ph ph-users-three text-xl"></i>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Nama Rombel
                        </p>

                        <p class="mt-0.5 text-sm font-bold text-slate-800">
                            {{ $rombel->nama_rombel }}
                        </p>
                    </div>

                </div>

            </div>


            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <i class="ph ph-student text-xl"></i>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Jumlah Siswa
                        </p>

                        <p class="mt-0.5 text-sm font-bold text-slate-800">
                            {{ $rombel->anggota->count() }} Siswa
                        </p>
                    </div>

                </div>

            </div>


            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                        <i class="ph ph-chalkboard-teacher text-xl"></i>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                            Wali Kelas
                        </p>

                        <p class="mt-0.5 truncate text-sm font-bold text-slate-800">
                            {{ $rombel->wali?->nama_guru ?? 'Belum ditentukan' }}
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- ANGGOTA --}}
        <div class="mb-3">

            <div class="flex items-center justify-between">

                <div>

                    <div class="flex items-center gap-2">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <i class="ph ph-student"></i>
                        </div>

                        <h3 class="text-sm font-bold text-slate-800">
                            Anggota Rombel
                        </h3>

                        <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-700">
                            {{ $rombel->anggota->count() }} Siswa
                        </span>

                    </div>

                    <p class="mt-1 ml-10 text-xs text-slate-500">
                        Daftar siswa yang tergabung dalam rombongan belajar ini.
                    </p>

                </div>

            </div>

        </div>


        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            @if ($rombel->anggota->isEmpty())
                <div class="flex flex-col items-center justify-center px-6 py-12 text-center">

                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <i class="ph ph-student text-2xl"></i>
                    </div>

                    <p class="text-sm font-semibold text-slate-600">
                        Belum ada anggota
                    </p>

                    <p class="mt-1 max-w-md text-xs text-slate-400">
                        Belum ada siswa yang terdaftar dalam rombel ini.
                        Gunakan menu edit untuk menambahkan anggota.
                    </p>

                    <a href="{{ route('rombel.edit', $rombel->id) }}"
                        class="mt-4 inline-flex items-center gap-1.5 rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700">
                        <i class="ph ph-plus"></i>
                        Tambah Anggota
                    </a>

                </div>
            @else
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[700px] text-left text-sm">

                        <thead class="border-b border-slate-200 bg-slate-50">

                            <tr>

                                <th class="w-12 px-5 py-3 text-[10px] font-bold uppercase tracking-wide text-slate-500">
                                    No
                                </th>

                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wide text-slate-500">
                                    Siswa
                                </th>

                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wide text-slate-500">
                                    NISN
                                </th>

                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wide text-slate-500">
                                    Tahun Ajaran
                                </th>

                                <th class="px-5 py-3 text-[10px] font-bold uppercase tracking-wide text-slate-500">
                                    Semester
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($rombel->anggota as $item)
                                <tr class="transition hover:bg-slate-50">

                                    <td class="px-5 py-3 text-xs text-slate-400">
                                        {{ $loop->iteration }}
                                    </td>


                                    <td class="px-5 py-3">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                                <i class="ph ph-student"></i>
                                            </div>

                                            <div>

                                                <p class="text-xs font-semibold text-slate-800">
                                                    {{ $item->siswa?->nama_siswa ?? '-' }}
                                                </p>

                                                <p class="text-[10px] text-slate-400">
                                                    Anggota rombel
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    <td class="px-5 py-3">

                                        <span class="text-xs text-slate-600">
                                            {{ $item->siswa?->nisn ?? '-' }}
                                        </span>

                                    </td>


                                    <td class="px-5 py-3">

                                        @if ($item->tahun_ajaran)
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-[10px] font-semibold text-indigo-700">
                                                <i class="ph ph-calendar"></i>
                                                {{ $item->tahun_ajaran }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400">
                                                -
                                            </span>
                                        @endif

                                    </td>


                                    <td class="px-5 py-3">

                                        @if ($item->semester)
                                            <span
                                                class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-[10px] font-semibold
                                            {{ $item->semester === 'Ganjil' ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700' }}">
                                                <i class="ph ph-calendar-check"></i>
                                                {{ $item->semester }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            @endif

        </div>

    </div>


    <script>
        document.querySelectorAll('form[data-hapus-form]').forEach(function(form) {

            form.addEventListener('submit', function(event) {

                const button =
                    form.querySelector('button[data-nama]');

                const nama =
                    button ? button.dataset.nama : 'rombel ini';

                const yakin = confirm(
                    'Yakin ingin menghapus rombel "' +
                    nama +
                    '"?\n\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'
                );

                if (!yakin) {
                    event.preventDefault();
                }

            });

        });
    </script>

@endsection
