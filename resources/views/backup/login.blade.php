<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Rapor SMK - Login</title>
    <link rel="preconnect" href="https://api.fontshare.com">
    <link rel="preconnect" href="https://cdn.fontshare.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Satoshi', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            display: flex;
            max-width: 1100px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
        }

        /* Left Panel */
        .left-panel {
            flex: 1;
            padding: 50px 40px;
            background: linear-gradient(180deg, #1a3a5c 0%, #2c5a8c 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .left-panel .logo h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .left-panel .logo .subtitle {
            font-size: 14px;
            opacity: 0.8;
            margin-top: 5px;
            font-weight: 300;
        }

        .left-panel .hero {
            margin: 30px 0;
        }

        .left-panel .hero h2 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .left-panel .hero p {
            font-size: 15px;
            opacity: 0.85;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .left-panel .features {
            list-style: none;
            margin: 20px 0;
        }

        .left-panel .features li {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            opacity: 0.9;
        }

        .left-panel .features li::before {
            content: "\e182";
            font-family: "Phosphor";
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            font-size: 12px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .left-panel .footer-text {
            font-size: 12px;
            opacity: 0.6;
            margin-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }

        /* Right Panel */
        .right-panel {
            flex: 0 0 420px;
            padding: 50px 40px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel .welcome-text {
            margin-bottom: 30px;
        }

        .right-panel .welcome-text h2 {
            font-size: 24px;
            color: #1a3a5c;
            font-weight: 700;
        }

        .right-panel .welcome-text p {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            background: #f8f9fa;
            color: #333;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2c5a8c;
            box-shadow: 0 0 0 3px rgba(44, 90, 140, 0.1);
            background: white;
        }

        .form-group input::placeholder {
            color: #aaa;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .forgot-password {
            text-align: right;
            margin: 5px 0 20px;
        }

        .forgot-password a {
            color: #2c5a8c;
            text-decoration: none;
            font-size: 13px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #1a3a5c;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #2c5a8c;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 15px;
            border-left: 4px solid #c33;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
            }

            .right-panel {
                flex: 1;
                padding: 30px 25px;
            }

            .left-panel {
                padding: 30px 25px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .right-panel {
                padding: 20px;
            }

            .left-panel {
                padding: 20px;
            }

            .left-panel .hero h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="logo">
                <h1>E-Rapor SMK</h1>
                <div class="subtitle">WORKSPACE OPERATOR SEKOLAH</div>
            </div>

            <div class="hero">
                <h2>Sistem Penilaian & Rapor Digital Terpadu.</h2>
                <p>Kelola nilai, skill paspor, UKK, PKL, hingga sinkronisasi Dapodik dalam satu ruang kerja yang tenang.</p>

                <ul class="features">
                    <li>Terhubung dengan Web Service Dapodik</li>
                    <li>Rekap Skill Paspor & UKK otomatis</li>
                    <li>Backup & restore data kapan saja</li>
                </ul>
            </div>

            <div class="footer-text">
                © 2026 E-Rapor SMK - offline workspace
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <div class="welcome-text">
                <h2>Sign in to your account</h2>
                <p>Please log in using your school operator account.</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter Username" value="{{ old('username') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select id="kelas" name="kelas">
                            <option value="">Pilih Kelas Kamu</option>
                            <option value="10">Kelas 10</option>
                            <option value="11">Kelas 11</option>
                            <option value="12">Kelas 12</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="1">Semester 1 (Ganjil)</option>
                            <option value="2">Semester 2 (Genap)</option>
                        </select>
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="#">Forgot the password?</a>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>