@extends('layouts.app')

@section('title', 'Login - WarasWaris')

@push('styles')
<style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    .login-container {
        min-height: 100vh;
        min-width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 1rem;
        overflow: hidden;
    }

    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 200%;
        height: 100%;
        background: linear-gradient(to right, #5A81FA 25%, white 25%, white 75%, #5A81FA 75%);
        transition: transform 1s cubic-bezier(0.645, 0.045, 0.355, 1);
        z-index: 0;
    }

    .login-container.register-mode::before {
        transform: translateX(-50%);
    }

    .login-card {
        width: 100%;
        max-width: 60rem;
        background: white;
        border-radius: 3.5rem;
        box-shadow: 0px 4px 70px 0px rgba(0, 0, 0, 0.5);
        overflow: hidden;
        display: flex;
        height: calc(100vh - 4rem);
        position: relative;
        z-index: 1;
        transition: transform 1s cubic-bezier(0.645, 0.045, 0.355, 1);
        transform-style: preserve-3d;
    }

    .register-mode .login-card {
        transform: rotateY(180deg);
    }

    .login-form-section {
        width: 100%;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        height: 100%;
        left: 0;
        z-index: 2;
    }

    .register-form-section {
        width: 100%;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        height: 100%;
        left: 0;
        transform: rotateY(180deg);
        z-index: 0;
    }

    @media (min-width: 1024px) {
        .login-form-section,
        .register-form-section {
            width: 50%;
            padding: 3rem;
        }
    }

    .register-mode .login-form-section {
        z-index: 0;
    }

    .register-mode .register-form-section {
        z-index: 2;
    }

    .form-wrapper {
        width: 100%;
        max-width: 24rem;
        transform: translateX(0);
        opacity: 1;
        transition: all 0.5s ease-in-out 0.6s;
    }

    .register-mode .login-form-section .form-wrapper {
        transform: translateX(30px);
        opacity: 0;
        transition-delay: 0s;
    }

    .register-form-section .form-wrapper {
        transform: translateX(-30px);
        opacity: 0;
        transition-delay: 0s;
    }

    .register-mode .register-form-section .form-wrapper {
        transform: translateX(0);
        opacity: 1;
        transition-delay: 0.6s;
    }

    .form-title {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-title h2 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #464646;
    }

    .alert {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }

    .alert-error {
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
    }

    .alert-error ul {
        list-style: disc;
        padding-left: 1.25rem;
    }

    .alert-success {
        background-color: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #15803d;
    }

    .login-form,
    .register-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .form-group {
        width: 100%;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        top: 0;
        left: 0;
        padding-left: 1rem;
        height: 100%;
        display: flex;
        align-items: center;
        pointer-events: none;
    }

    .input-icon .icon {
        width: 1.25rem;
        height: 1.25rem;
        color: #9ca3af;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        font-size: 1rem;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px #3b82f6;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me .checkbox {
        width: 1rem;
        height: 1rem;
        color: #2563eb;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    .remember-me label {
        margin-left: 0.5rem;
        font-size: 0.875rem;
        color: #4b5563;
        cursor: pointer;
    }

    .btn-submit {
        display: block;
        margin: 0 auto;
        width: 50%;
        background-color: #5A81FA;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 9999px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: inset 0 4px 20.3px rgba(0, 0, 0, 0.3);
    }

    .btn-submit:hover {
        background-color: #ffffff;
        box-shadow: inset 0 4px 20.3px rgba(0, 0, 0, 0.3);
        color: #464646;
    }

    .welcome-section,
    .welcome-register-section {
        display: none;
        position: absolute;
        background: #5A81FA;
        padding: 3rem;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        height: 100%;
    }

    @media (min-width: 1024px) {
        .welcome-section,
        .welcome-register-section {
            display: flex;
            width: 50%;
        }
    }

    .welcome-section {
        right: 0;
        z-index: 2;
    }

    .register-mode .welcome-section {
        z-index: 0;
    }

    .welcome-register-section {
        right: 0;
        transform: rotateY(180deg);
        z-index: 0;
    }

    .register-mode .welcome-register-section {
        z-index: 2;
    }

    .welcome-content {
        color: white;
        text-align: center !important;
        position: relative;
        z-index: 10;
        transform: translateX(0);
        opacity: 1;
        transition: all 0.5s ease-in-out 0.6s;
    }

    .register-mode .welcome-section .welcome-content {
        transform: translateX(-30px);
        opacity: 0;
        transition-delay: 0s;
    }

    .welcome-register-section .welcome-content {
        transform: translateX(30px);
        opacity: 0;
        transition-delay: 0s;
    }

    .register-mode .welcome-register-section .welcome-content {
        transform: translateX(0);
        opacity: 1;
        transition-delay: 0.6s;
    }

    .welcome-title {
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .welcome-subtitle {
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 2rem;
    }
    .welcome-subtitle2 {
        font-size: 1rem;
        color: #dbeafe;
        margin-bottom: 2rem;
    }


    .btn-toggle {
        display: inline-block;
        background-color: white;
        color: #2563eb;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 9999px;
        text-decoration: none;
        transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: inset 0 4px 10px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        border: none;
    }

    .btn-toggle:hover {
        background-color: #5A81FA;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="login-container" id="container">
    <div class="login-card">
        
        <!-- Login Form Section -->
        <div class="login-form-section">
            <div class="form-wrapper">
                <div class="form-title">
                    <h2>Masuk</h2>
                </div>

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="login-form">
                    @csrf
                    
                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}"
                                required
                                class="form-input"
                                placeholder="Email"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required
                                class="form-input"
                                placeholder="Kata Sandi"
                            >
                        </div>
                    </div>

                    <div class="remember-me">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            class="checkbox"
                        >
                        <label for="remember">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn-submit">MASUK</button>
                </form>
            </div>
        </div>

        <!-- Welcome Section for Register -->
        <div class="welcome-register-section">
            <div class="welcome-content">
                <h1 class="welcome-title">Selamat Datang</h1>
                <h1 class="welcome-subtitle">di Waras Waris</h1>
                <p class="welcome-subtitle2">Sudah memiliki akun?</p>
                <button class="btn-toggle" id="loginBtn">MASUK</button>
            </div>
        </div>

        <!-- Register Form Section -->
        <div class="register-form-section">
            <div class="form-wrapper">
                <div class="form-title">
                    <h2>Buat Akun</h2>
                </div>

                <form action="{{ route('register.post') }}" method="POST" class="register-form">
                    @csrf
            
                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                id="register_email" 
                                value="{{ old('email') }}"
                                required
                                class="form-input"
                                placeholder="Email"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                id="register_password" 
                                required
                                class="form-input"
                                placeholder="Kata Sandi"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                required
                                class="form-input"
                                placeholder="Konfirmasi Kata Sandi"
                            >
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">DAFTAR</button>
                </form>
            </div>
        </div>

        <!-- Welcome Section for Login -->
        <div class="welcome-section">
            <div class="welcome-content">
                <h1 class="welcome-title">Selamat Datang Kembali</h1>
                <h1 class="welcome-subtitle">di Waras Waris</h1>
                <p class="welcome-subtitle2">Belum memiliki akun?</p>
                <button class="btn-toggle" id="registerBtn">DAFTAR</button>
            </div>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('registerBtn');
    const loginBtn = document.getElementById('loginBtn');

    const urlParams = new URLSearchParams(window.location.search);
    const mode = urlParams.get('mode');
    
    if (mode === 'register') {
        container.classList.add('register-mode');
    }

    registerBtn.addEventListener('click', () => {
        container.classList.add('register-mode');
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove('register-mode');
    });
</script>
@endsection