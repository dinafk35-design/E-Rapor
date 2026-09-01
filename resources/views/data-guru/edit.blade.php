<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Guru - E-Rapor SMK</title>

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

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
        }

        .buttons {
            margin-top: 25px;
        }

        button,
        a {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #0d6efd;
            color: white;
        }

        .back {
            background: #6c757d;
            color: white;
            margin-left: 5px;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>✏️ Edit Data Guru</h1>

        <form
            action="{{ route('data-guru.update', $dataGuru->id) }}"
            method="POST">

            @csrf

            @method('PUT')


            <div class="form-group">

                <label>NIP</label>

                <input
                    type="text"
                    name="nip"
                    value="{{ old('nip', $dataGuru->nip) }}"
                    required>

                @error('nip')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="form-group">

                <label>Nama Guru</label>

                <input
                    type="text"
                    name="nama_guru"
                    value="{{ old('nama_guru', $dataGuru->nama_guru) }}"
                    required>

                @error('nama_guru')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="form-group">

                <label>NIK</label>

                <input
                    type="text"
                    name="nik"
                    value="{{ old('nik', $dataGuru->nik) }}">

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $dataGuru->email) }}">

            </div>


            <div class="form-group">

                <label>No. Telepon</label>

                <input
                    type="text"
                    name="no_telepon"
                    value="{{ old('no_telepon', $dataGuru->no_telepon) }}">

            </div>


            <div class="form-group">

                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin">

                    <option value="">
                        -- Pilih --
                    </option>

                    <option
                        value="Laki-laki"
                        {{ $dataGuru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option
                        value="Perempuan"
                        {{ $dataGuru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Tempat Lahir</label>

                <input
                    type="text"
                    name="tempat_lahir"
                    value="{{ old('tempat_lahir', $dataGuru->tempat_lahir) }}">

            </div>


            <div class="form-group">

                <label>Tanggal Lahir</label>

                <input
                    type="date"
                    name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $dataGuru->tanggal_lahir) }}">

            </div>


            <div class="form-group">

                <label>Alamat</label>

                <textarea
                    name="alamat">{{ old('alamat', $dataGuru->alamat) }}</textarea>

            </div>


            <div class="buttons">

                <button type="submit">
                    💾 Simpan Perubahan
                </button>

                <a
                    href="{{ route('data-guru.index') }}"
                    class="back">
                    ← Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>