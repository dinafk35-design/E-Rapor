<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login E-Rapor SMK</title>

    <link rel="preconnect" href="https://api.fontshare.com">
    <link rel="preconnect" href="https://cdn.fontshare.com" crossorigin>
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=satoshi@400,500,600,700&display=swap">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Satoshi', Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f1f5f9;
        }

        .login-container {
            width: 420px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-icon {
            width: 75px;
            height: 75px;
            background: #2563eb;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 30px;
            font-weight: bold;
        }

        .logo h2 {
            margin-top: 15px;
            color: #1e293b;
        }

        .logo p {
            color: #64748b;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #334155;
        }

        .form-control {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: #2563eb;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="logo">
            <div class="logo-icon">
                ER
            </div>

            <h2>E-Rapor SMK</h2>
            <p>Silakan login untuk melanjutkan</p>
        </div>

        @if (session('status'))
            <div class="alert" style="background:#dcfce7; color:#166534;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="username">
                    Username
                </label>

                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}"
                    placeholder="Masukkan username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">
                    Password
                </label>

                <input type="password" id="password" name="password" class="form-control"
                    placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>

        </form>

        <div class="footer">
            Sistem Informasi E-Rapor SMK
        </div>

    </div>

</body>

</html>
