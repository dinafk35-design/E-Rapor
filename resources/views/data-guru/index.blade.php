<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Guru - E-Rapor SMK</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        .container {
            width: 95%;
            max-width: 1400px;
            margin: 30px auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .header h1 {
            margin: 0 0 8px 0;
            font-size: 28px;
        }

        .header p {
            margin: 0;
            color: #777;
        }

        .toolbar {
            background: white;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #0d6efd;
            color: white;
        }

        .btn-info {
            background: #0dcaf0;
            color: #000;
        }

        .btn-warning {
            background: #ffc107;
            color: #000;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            background: #212529;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .action {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .alert {
            padding: 14px 18px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            background: #e9ecef;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="container">

    {{-- HEADER --}}
    <div class="header">
        <h1>👨‍🏫 Data Guru</h1>
        <p>Kelola data guru pada sistem E-Rapor SMK</p>
    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif


    {{-- TOOLBAR --}}
    <div class="toolbar">

        <div>
            <strong>Daftar Guru</strong>
        </div>

        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-info">
                🏠 Dashboard
            </a>

            <a href="{{ route('data-guru.create') }}" class="btn btn-primary">
                ➕ Tambah Guru
            </a>
        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-container">

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>NIK</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($dataGuru as $guru)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $guru->nip }}
                        </td>

                        <td>
                            <strong>
                                {{ $guru->nama_guru }}
                            </strong>
                        </td>

                        <td>
                            {{ $guru->nik ?? '-' }}
                        </td>

                        <td>
                            {{ $guru->email ?? '-' }}
                        </td>

                        <td>
                            {{ $guru->no_telepon ?? '-' }}
                        </td>

                        <td>
                            @if($guru->jenis_kelamin)
                                <span class="badge">
                                    {{ $guru->jenis_kelamin }}
                                </span>
                            @else
                                -
                            @endif
                        </td>

                        <td>

                            <div class="action">

                                {{-- DETAIL --}}
                                <a
                                    href="{{ route('data-guru.show', $guru->id) }}"
                                    class="btn btn-info"
                                >
                                    👁️ Detail
                                </a>


                                {{-- EDIT --}}
                                <a
                                    href="{{ route('data-guru.edit', $guru->id) }}"
                                    class="btn btn-warning"
                                >
                                    ✏️ Edit
                                </a>


                                {{-- HAPUS --}}
                                <form
                                    action="{{ route('data-guru.destroy', $guru->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data guru ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        🗑️ Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="empty">
                            📭 Belum ada data guru.
                            <br><br>

                            <a
                                href="{{ route('data-guru.create') }}"
                                class="btn btn-primary"
                            >
                                ➕ Tambahkan Guru
                            </a>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>