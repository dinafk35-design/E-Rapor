<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Guru - E-Rapor SMK</title>

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
            max-width: 1000px;
            margin: 30px auto;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .header {
            margin-bottom: 25px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 8px;
        }

        .header p {
            margin: 0;
            color: #777;
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
            font-size: 14px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #0d6efd;
        }

        .required {
            color: red;
        }

        .buttons {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 11px 18px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #0d6efd;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            background: #f8d7da;
            color: #842029;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <div class="header">
            <h1>➕ Tambah Data Guru</h1>
            <p>Silakan lengkapi informasi guru berikut.</p>
        </div>


        {{-- ERROR VALIDASI --}}
        @if ($errors->any())

            <div class="alert">

                <strong>Terjadi kesalahan:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        {{-- FORM --}}

        <form
            action="{{ route('data-guru.store') }}"
            method="POST"
        >

            @csrf


            {{-- NIP --}}
            <div class="form-group">

                <label>
                    NIP <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="nip"
                    value="{{ old('nip') }}"
                    placeholder="Masukkan NIP guru"
                    required
                >

                @error('nip')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- NAMA --}}
            <div class="form-group">

                <label>
                    Nama Guru <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="nama_guru"
                    value="{{ old('nama_guru') }}"
                    placeholder="Masukkan nama lengkap guru"
                    required
                >

                @error('nama_guru')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- NIK --}}
            <div class="form-group">

                <label>NIK</label>

                <input
                    type="text"
                    name="nik"
                    value="{{ old('nik') }}"
                    placeholder="Masukkan NIK"
                >

            </div>


            {{-- EMAIL --}}
            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                >

                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- TELEPON --}}
            <div class="form-group">

                <label>No. Telepon</label>

                <input
                    type="text"
                    name="no_telepon"
                    value="{{ old('no_telepon') }}"
                    placeholder="Masukkan nomor telepon"
                >

            </div>


            {{-- JENIS KELAMIN --}}
            <div class="form-group">

                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin">

                    <option value="">
                        -- Pilih Jenis Kelamin --
                    </option>

                    <option
                        value="Laki-laki"
                        {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}
                    >
                        Laki-laki
                    </option>

                    <option
                        value="Perempuan"
                        {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}
                    >
                        Perempuan
                    </option>

                </select>

            </div>


            {{-- TEMPAT LAHIR --}}
            <div class="form-group">

                <label>Tempat Lahir</label>

                <input
                    type="text"
                    name="tempat_lahir"
                    value="{{ old('tempat_lahir') }}"
                    placeholder="Masukkan tempat lahir"
                >

            </div>


            {{-- TANGGAL LAHIR --}}
            <div class="form-group">

                <label>Tanggal Lahir</label>

                <input
                    type="date"
                    name="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}"
                >

                @error('tanggal_lahir')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- ALAMAT --}}
            <div class="form-group">

                <label>Alamat</label>

                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat lengkap"
                >{{ old('alamat') }}</textarea>

            </div>


            {{-- BUTTON --}}

            <div class="buttons">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    💾 Simpan Data
                </button>

                <a
                    href="{{ route('data-guru.index') }}"
                    class="btn btn-secondary"
                >
                    ↩️ Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>