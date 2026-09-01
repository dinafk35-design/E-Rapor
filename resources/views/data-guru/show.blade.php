<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Detail Guru - E-Rapor SMK</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.08);
        }

        h1 {
            margin-top: 0;
        }

        .data {
            display: grid;
            grid-template-columns: 200px 1fr;
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .label {
            font-weight: bold;
        }

        .buttons {
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            margin-right: 8px;
        }

        .back {
            background: #6c757d;
        }

        .edit {
            background: #0d6efd;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>👨‍🏫 Detail Data Guru</h1>

        <div class="data">
            <div class="label">NIP</div>
            <div>{{ $dataGuru->nip }}</div>
        </div>

        <div class="data">
            <div class="label">Nama Guru</div>
            <div>{{ $dataGuru->nama_guru }}</div>
        </div>

        <div class="data">
            <div class="label">NIK</div>
            <div>{{ $dataGuru->nik ?? '-' }}</div>
        </div>

        <div class="data">
            <div class="label">Email</div>
            <div>{{ $dataGuru->email ?? '-' }}</div>
        </div>

        <div class="data">
            <div class="label">No. Telepon</div>
            <div>{{ $dataGuru->no_telepon ?? '-' }}</div>
        </div>

        <div class="data">
            <div class="label">Jenis Kelamin</div>
            <div>{{ $dataGuru->jenis_kelamin ?? '-' }}</div>
        </div>

        <div class="data">
            <div class="label">Tempat Lahir</div>
            <div>{{ $dataGuru->tempat_lahir ?? '-' }}</div>
        </div>

        <div class="data">
            <div class="label">Tanggal Lahir</div>
            <div>{{ $dataGuru->tanggal_lahir ?? '-' }}</div>
        </div>

        <div class="data">
            <div class="label">Alamat</div>
            <div>{{ $dataGuru->alamat ?? '-' }}</div>
        </div>

        <div class="buttons">

            <a
                href="{{ route('data-guru.index') }}"
                class="btn back">
                ← Kembali
            </a>

            <a
                href="{{ route('data-guru.edit', $dataGuru->id) }}"
                class="btn edit">
                ✏️ Edit
            </a>

        </div>

    </div>

</div>

</body>
</html>