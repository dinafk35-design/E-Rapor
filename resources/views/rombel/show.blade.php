@extends('layouts.app')

@section('content')

<div class="content">

    <!-- HEADER -->

    <div class="welcome">

        <h2 class="italic font-bold">
            Detail Rombel
        </h2>

        <p>
            Rincian data rombongan belajar {{ $rombel->nama_rombel }}
            beserta daftar anggota siswa yang tergabung di dalamnya.
        </p>

    </div>


    <!-- ============================= -->
    <!-- TOMBOL AKSI                   -->
    <!-- ============================= -->

    <div class="mb-6 flex flex-wrap gap-3">

        <a
            href="{{ route('rombel') }}"
            class="inline-flex items-center gap-1 rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-600"
        >
            <i class="ph ph-arrow-left"></i>
            Kembali
        </a>

        <a
            href="{{ route('rombel.edit', $rombel->id) }}"
            class="inline-flex items-center gap-1 rounded-lg bg-yellow-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-yellow-600"
        >
            <i class="ph ph-pencil-simple"></i>
            Edit
        </a>

        <form
            action="{{ route('rombel.destroy', $rombel->id) }}"
            method="POST"
            data-hapus-form
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                data-nama="{{ $rombel->nama_rombel }}"
                class="inline-flex items-center gap-1 rounded-lg bg-red-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-600"
            >
                <i class="ph ph-trash"></i>
                Hapus
            </button>

        </form>

    </div>


    <!-- ============================= -->
    <!-- INFORMASI ROMBEL              -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-users-three"></i>
        Informasi Rombel
    </div>

    <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">

        <!-- 1 kolom di HP, 2 kolom di tablet, 4 kolom di layar besar -->
        <dl class="grid grid-cols-1 gap-x-8 gap-y-5 sm:grid-cols-2 lg:grid-cols-4">

            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Nama Rombel
                </dt>
                <dd class="mt-1 text-base font-semibold text-gray-800">
                    {{ $rombel->nama_rombel }}
                </dd>
            </div>

            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Tingkat
                </dt>
                <dd class="mt-1 text-base text-gray-700">
                    {{ $rombel->tingkat ?? '-' }}
                </dd>
            </div>

            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Sekolah
                </dt>
                <dd class="mt-1 text-base text-gray-700">
                    {{ $rombel->sekolah?->nama_sekolah ?? '-' }}
                </dd>
            </div>

            <div>
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Wali Kelas
                </dt>
                <dd class="mt-1 text-base text-gray-700">
                    {{ $rombel->wali?->nama_guru ?? '-' }}
                </dd>
            </div>

        </dl>

    </div>


    <!-- ============================= -->
    <!-- ANGGOTA ROMBEL                -->
    <!-- ============================= -->

    <div class="section-title">
        <i class="ph ph-student"></i>
        Anggota Rombel
    </div>

    <div class="rounded-xl bg-white shadow-sm">

        @if ($rombel->anggota->isEmpty())

            <p class="p-6 text-sm text-gray-500">
                Belum ada anggota pada rombel ini.
            </p>

        @else

            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left text-sm">

                    <thead class="border-b border-gray-200 bg-gray-50 text-xs uppercase text-gray-600">
                        <tr>
                            <th class="px-6 py-4 w-12">No</th>
                            <th class="px-6 py-4">NISN</th>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">Tahun Ajaran</th>
                            <th class="px-6 py-4">Semester</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($rombel->anggota as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $item->siswa?->nisn ?? '-' }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ $item->siswa?->nama_siswa ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $item->tahun_ajaran ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $item->semester ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        @endif

    </div>

</div>

<!-- JAVASCRIPT -->
<script>
    document.querySelectorAll('form[data-hapus-form]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const nama = form.querySelector('button[data-nama]').dataset.nama;

            const yakin = confirm(
                'Yakin ingin menghapus rombel "' + nama + '"?\n' +
                'Data yang sudah dihapus tidak dapat dikembalikan.'
            );

            if (!yakin) {
                event.preventDefault();
            }
        });
    });
</script>

@endsection
