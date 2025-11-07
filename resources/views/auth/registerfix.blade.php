<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #FFFFFF 50%, #5A81FA 50%);
        }

        .form {
            display: flex;
            justify-content: center;
            border-radius: 30px;
            padding: 15px 100px;
        }

        .form-login {
            background: #5A81FA;
            width: 50%;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .form-register {
            background: #ffffff;
            width: 50%;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; 
        }

        .login-title {
            color: #ffffff;
            font-size: 40px;
            text-align: center;
        }

        .login-description {
            color: #ffffff;
            font-size: 19px;
            text-align: center;
            font-weight: normal;
        }

        .button-login {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px;
        }

        .btn-login {
            background-color: white;
            color: #464646;
            font-size: 15px;
            text-align: center;
            font-weight: bold;
            padding: 10px 50px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: inset 0 4px 10px rgba(0,0,0,0.3);
        }

        .btn-login:hover {
            background-color: #5A81FA;
            color: #ffffff;
            transition: all 0.2s;
            box-shadow: inset 0 4px 10px rgba(0,0,0,0.3);
        }

        .register-title {
            color: #464646;
            font-size: 37px;
            text-align: center;
        }

        .register-input {
            border: 1px solid #d1d5db;
            border-radius: 20px;
            padding: 20px 0px;
            padding-left: 60px;
            padding right: 30px;
            font-size: 15px;
            width: 300px;
        }

        .register {
            margin-top: 20px;
            position: relative;
        }

        .register i {
            position: absolute;
            left: 12px; 
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 25px;
        }

        .divider {
            position: absolute;
            left: 50px;
            width: 1px;
            top: 1px;
            height: 65px;
            background-color: #ccc;
        }

        .button-register {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px;
        }

        .btn-register {
            background-color: #5A81FA;
            color: #ffffff;
            font-size: 15px;
            text-align: center;
            font-weight: bold;
            padding: 10px 50px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            box-shadow: inset 0 4px 10px rgba(108, 108, 108, 0.3);
        }

        .btn-register:hover {
            background-color: #ffffff;
            color: #464646;
            transition: all 0.2s;
            box-shadow: inset 0 4px 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div class="form">
        <div class="form-login">
            <h1 class="login-title">Selamat Datang di WarasWaris</h1>
            <p class="login-description">Sudah memiliki akun?</p>
            <div class="button-login">
                <a href="{{ route('login') }}" class="btn-login">
                    MASUK
                </a>
            </div>
        </div>

        <div class="form-register">
            <h1 class="register-title">Buat Akun</h1>

            <form action="{{ route('register.post') }}" method="POST" class="form-action-register">
                @csrf
        
                <!-- Email -->
                <div class="register">
                    <i class="ri-mail-line"></i>
                    <div class="divider"></div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        required
                        class="register-input"
                        placeholder="Email"
                    >
                </div>

                <!-- Password -->
                <div class="register">
                    <i class="ri-key-line"></i>
                    <div class="divider"></div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required
                        class="register-input"
                        placeholder="Kata Sandi"
                    >
                </div>

                <!-- Confirm Password -->
                <div class="register">
                    <i class="ri-key-fill"></i>
                    <div class="divider"></div>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        required
                        class="register-input"
                        placeholder="Konfirmasi Kata Sandi"
                    >
                </div>

                <!-- Submit Button -->
                <div class="button-register">
                    <button type="submit" class="btn-register">
                        DAFTAR
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>