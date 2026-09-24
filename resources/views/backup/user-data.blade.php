<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Data - E-Rapor SMK</title>

    <link rel="preconnect" href="https://api.fontshare.com">
    <link rel="preconnect" href="https://cdn.fontshare.com" crossorigin>
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,600,700&display=swap">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Satoshi', Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .header {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0 0 8px 0;
        }

        .header p {
            margin: 0;
            color: #777;
        }

        .btn {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-warning {
            background: #f59e0b;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        table th {
            background: #f8fafc;
        }

        .role {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e5e7eb;
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 30px;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->

    <div class="header">

        <div>

            <h1>User Data</h1>

            <p>
                Data pengguna sistem E-Rapor SMK
            </p>

        </div>

        <a href="{{ route('user-data.create') }}" class="btn btn-primary">
    + Tambah User
    </a>

    </div>


    <!-- TABLE -->

    <div class="card">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama</th>

                    <th>Username</th>

                    <th>Role</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <!-- DATA CONTOH -->

                <tr>

                    <td>1</td>

                    <td>Administrator</td>

                    <td>admin</td>

                    <td>
                        <span class="role">
                            Admin
                        </span>
                    </td>

                    <td>

                        <div class="actions">

                            <a href="/user-data/1/edit"
                               class="btn btn-warning">
                                Edit
                            </a>

                            <button type="button"
                                    class="btn btn-danger">
                                Hapus
                            </button>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>2</td>

                    <td>Guru</td>

                    <td>guru</td>

                    <td>
                        <span class="role">
                            Guru
                        </span>
                    </td>

                    <td>

                        <div class="actions">

                            <a href="/user-data/2/edit"
                               class="btn btn-warning">
                                Edit
                            </a>

                            <button type="button"
                                    class="btn btn-danger">
                                Hapus
                            </button>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>3</td>

                    <td>Siswa</td>

                    <td>siswa</td>

                    <td>
                        <span class="role">
                            Siswa
                        </span>
                    </td>

                    <td>

                        <div class="actions">

                            <a href="/user-data/3/edit"
                               class="btn btn-warning">
                                Edit
                            </a>

                            <button type="button"
                                    class="btn btn-danger">
                                Hapus
                            </button>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>