<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - E-Rapor SMK</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            background: #f3f4f8;
        }

        /* =========================================
           HALAMAN LOGIN
        ========================================= */

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: #f3f4f8;
        }


        /* =========================================
           CONTAINER UTAMA
        ========================================= */

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;

            display: grid;
            grid-template-columns: 1.1fr 0.9fr;

            background: white;

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.12);
        }


        /* =========================================
           BAGIAN KIRI
        ========================================= */

        .login-left {
            position: relative;

            padding: 55px 55px;

            display: flex;
            flex-direction: column;

            justify-content: space-between;

            color: white;

            background:
                linear-gradient(
                    145deg,
                    #4b4bb5 0%,
                    #303274 50%,
                    #1e234d 100%
                );
        }


        /* =========================================
           LOGO
        ========================================= */

        .brand {
            display: flex;
            align-items: center;

            gap: 14px;
        }

        .brand-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background: rgba(132, 117, 255, 0.8);

            font-size: 25px;
        }

        .brand-name {
            font-size: 25px;
            font-weight: 700;
        }


        /* =========================================
           TEKS KIRI
        ========================================= */

        .left-content {
            margin-top: 30px;
        }

        .small-title {
            margin-bottom: 18px;

            font-size: 13px;
            font-weight: 700;

            letter-spacing: 2px;

            color: #a9adff;
        }

        .left-title {
            font-size: 43px;

            line-height: 1.12;

            font-weight: 400;

            margin-bottom: 22px;
        }

        .left-title span {
            color: #a99cff;

            font-weight: 700;
        }

        .left-description {
            max-width: 540px;

            font-size: 16px;

            line-height: 1.7;

            color: #d3d5ed;

            margin-bottom: 25px;
        }


        /* =========================================
           FITUR
        ========================================= */

        .feature-list {
            list-style: none;

            display: flex;
            flex-direction: column;

            gap: 15px;
        }

        .feature-item {
            display: flex;

            align-items: center;

            gap: 12px;

            color: #d9dbef;

            font-size: 15px;
        }

        .check-icon {
            width: 19px;
            height: 19px;

            border: 2px solid #8d83ff;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #9e95ff;

            font-size: 11px;
        }


        /* =========================================
           FOOTER KIRI
        ========================================= */

        .left-footer {
            font-size: 13px;

            color: #9297c4;
        }


        /* =========================================
           BAGIAN KANAN
        ========================================= */

        .login-right {
            padding: 65px 55px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            background: #ffffff;
        }


        /* =========================================
           JUDUL LOGIN
        ========================================= */

        .login-title {
            margin-bottom: 5px;

            font-size: 28px;

            font-weight: 700;

            color: #111111;
        }

        .login-subtitle {
            margin-bottom: 35px;

            font-size: 14px;

            line-height: 1.5;

            color: #333333;

            font-weight: 600;
        }


        /* =========================================
           FORM
        ========================================= */

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: 700;

            color: #151515;
        }


        /* =========================================
           INPUT
        ========================================= */

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            left: 12px;

            top: 50%;

            transform: translateY(-50%);

            font-size: 16px;

            z-index: 2;
        }

        .form-input,
        .form-select {
            width: 100%;

            height: 45px;

            border: none;

            outline: none;

            border-radius: 11px;

            padding: 0 15px 0 40px;

            background: #e9e6e4;

            color: #222;

            font-size: 14px;

            box-shadow:
                0 2px 4px rgba(0, 0, 0, 0.12);
        }

        .form-select {
            cursor: pointer;
        }

        .form-input::placeholder {
            color: #333;
        }

        .form-input:focus,
        .form-select:focus {
            box-shadow:
                0 0 0 2px rgba(78, 78, 180, 0.25);
        }


        /* =========================================
           PASSWORD
        ========================================= */

        .password-toggle {
            position: absolute;

            right: 14px;

            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            cursor: pointer;

            font-size: 15px;
        }

        .password-input {
            padding-right: 45px;
        }


        /* =========================================
           SELECT
        ========================================= */

        .select-wrapper {
            position: relative;
        }

        .select-wrapper .input-icon {
            pointer-events: none;
        }


        /* =========================================
           ERROR
        ========================================= */

        .error-message {
            margin-top: 6px;

            font-size: 12px;

            color: #dc3545;
        }

        .alert-error {
            margin-bottom: 20px;

            padding: 12px 15px;

            border-radius: 8px;

            background: #ffe8e8;

            color: #b42318;

            font-size: 13px;
        }


        /* =========================================
           FORGOT PASSWORD
        ========================================= */

        .forgot-password {
            display: flex;

            justify-content: flex-end;

            margin-top: -5px;

            margin-bottom: 25px;
        }

        .forgot-password a {
            font-size: 11px;

            color: #555;

            text-decoration: underline;
        }


        /* =========================================
           BUTTON LOGIN
        ========================================= */

        .login-button {
            width: 100%;

            height: 45px;

            border: none;

            border-radius: 10px;

            background: #78a9cb;

            color: #111;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition: 0.2s;
        }

        .login-button:hover {
            background: #6699bd;

            transform: translateY(-1px);
        }

        .login-button:active {
            transform: translateY(0);
        }


        /* =========================================
           RESPONSIVE TABLET
        ========================================= */

        @media (max-width: 850px) {

            .login-container {
                grid-template-columns: 1fr;

                max-width: 550px;
            }

            .login-left {
                min-height: 380px;

                padding: 40px;
            }

            .login-right {
                padding: 45px 40px;
            }

            .left-title {
                font-size: 35px;
            }
        }


        /* =========================================
           RESPONSIVE HP
        ========================================= */

        @media (max-width: 500px) {

            .login-page {
                padding: 10px;
            }

            .login-container {
                border-radius: 15px;
            }

            .login-left {
                padding: 30px 25px;

                min-height: 360px;
            }

            .login-right {
                padding: 35px 25px;
            }

            .brand-name {
                font-size: 21px;
            }

            .left-title {
                font-size: 30px;
            }

            .left-description {
                font-size: 14px;
            }

            .login-title {
                font-size: 24px;
            }
        }

    </style>
</head>


<body>

<div class="login-page">

    <div class="login-container">


        <!-- =====================================
             BAGIAN KIRI
        ====================================== -->

        <div class="login-left">

            <div>

                <!-- LOGO -->

                <div class="brand">

                    <div class="brand-icon">
                        🎓
                    </div>

                    <div class="brand-name">
                        E-Rapor SMK
                    </div>

                </div>


                <!-- KONTEN -->

                <div class="left-content">

                    <div class="small-title">
                        WORKSPACE OPERATOR SEKOLAH
                    </div>

                    <h1 class="left-title">

                        Sistem Penilaian &

                        <br>

                        <span>Raport Digital</span>

                        <br>

                        Terpadu.

                    </h1>


                    <p class="left-description">

                        Kelola nilai, skill paspor, UKK, PKL,
                        hingga sinkronisasi Dapodik dalam satu
                        ruang kerja yang tenang.

                    </p>


                    <!-- FITUR -->

                    <ul class="feature-list">

                        <li class="feature-item">

                            <span class="check-icon">
                                ✓
                            </span>

                            Terhubung dengan Web Service Dapodik

                        </li>


                        <li class="feature-item">

                            <span class="check-icon">
                                ✓
                            </span>

                            Rekap Skill Paspor & UKK otomatis

                        </li>


                        <li class="feature-item">

                            <span class="check-icon">
                                ✓
                            </span>

                            Backup & restore data kapan saja

                        </li>

                    </ul>

                </div>

            </div>


            <!-- FOOTER -->

            <div class="left-footer">

                © 2026 E-Rapor SMK · offline workspace

            </div>

        </div>



        <!-- =====================================
             BAGIAN KANAN
        ====================================== -->

        <div class="login-right">


            <h2 class="login-title">
                Sign in to your account
            </h2>


            <p class="login-subtitle">
                Please log in using your school operator account.
            </p>


            <!-- ERROR -->

            @if ($errors->any())

                <div class="alert-error">

                    {{ $errors->first() }}

                </div>

            @endif


            <!-- FORM LOGIN -->

            <form
                action="{{ route('login.process') }}"
                method="POST"
            >

                @csrf


                <!-- USERNAME -->

                <div class="form-group">

                    <label class="form-label">
                        Username
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            👤
                        </span>

                        <input
                            type="text"
                            name="username"
                            class="form-input"
                            placeholder="Enter Username"
                            value="{{ old('username') }}"
                            required
                        >

                    </div>

                    @error('username')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input password-input"
                            placeholder="Enter Password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                        >
                            👁
                        </button>

                    </div>

                    @error('password')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- KELAS -->

                <div class="form-group">

                    <label class="form-label">
                        Kelas
                    </label>

                    <div class="input-wrapper select-wrapper">

                        <span class="input-icon">
                            📁
                        </span>

                        <select
                            name="kelas"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Pilih Kelas Kamu
                            </option>

                            <option
                                value="X"
                                {{ old('kelas') == 'X' ? 'selected' : '' }}
                            >
                                X
                            </option>

                            <option
                                value="XI"
                                {{ old('kelas') == 'XI' ? 'selected' : '' }}
                            >
                                XI
                            </option>

                            <option
                                value="XII"
                                {{ old('kelas') == 'XII' ? 'selected' : '' }}
                            >
                                XII
                            </option>

                        </select>

                    </div>

                    @error('kelas')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- SEMESTER -->

                <div class="form-group">

                    <label class="form-label">
                        Semester
                    </label>

                    <div class="input-wrapper select-wrapper">

                        <span class="input-icon">
                            📋
                        </span>

                        <select
                            name="semester"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Pilih Semester
                            </option>

                            <option
                                value="1"
                                {{ old('semester') == '1' ? 'selected' : '' }}
                            >
                                Semester 1
                            </option>

                            <option
                                value="2"
                                {{ old('semester') == '2' ? 'selected' : '' }}
                            >
                                Semester 2
                            </option>

                        </select>

                    </div>

                    @error('semester')

                        <div class="error-message">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- FORGOT PASSWORD -->

                <div class="forgot-password">

                    <a href="#">
                        Forgot the password?
                    </a>

                </div>


                <!-- BUTTON -->

                <button
                    type="submit"
                    class="login-button"
                >

                    Masuk

                </button>

            </form>

        </div>

    </div>

</div>


<!-- =====================================
     JAVASCRIPT PASSWORD
====================================== -->

<script>

function togglePassword() {

    const password =
        document.getElementById('password');

    if (password.type === 'password') {

        password.type = 'text';

    } else {

        password.type = 'password';

    }

}

</script>

</body>

</html>