@extends('layouts.app')

@section('title', 'Login - WarasWaris')

@push('styles')
<!-- Google Fonts - Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(to right, #5A81FA 50%, white 50%);
        padding: 1rem;
    }

    .login-card {
        width: 100%;
        max-width: 70rem;
        background: white;
        border-radius: 3.5rem;
        box-shadow: 0px 4px 70px 0px rgba(0, 0, 0, 0.5);
        overflow: hidden;
        display: flex;
        height: 35rem;
    }

    /* Login Form Section */
    .login-form-section {
        width: 100%;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (min-width: 1024px) {
        .login-form-section {
            width: 50%;
            padding: 3rem;
        }
    }

    /* Form Wrapper */
    .form-wrapper {
        width: 100%;
        max-width: 24rem;
    }

    /* Form Title */
    .form-title {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-title h2 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #464646;
    }

    /* Alert Messages */
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

    /* Login Form */
    .login-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    /* Form Group */
    .form-group {
        width: 100%;
    }

    /* Input Wrapper */
    .input-wrapper {
        position: relative;
    }

    /* Input Icon */
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

    /* Form Input */
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

    /* Remember Me */
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

    /* Submit Button */
    .btn-submit {
        display: block;           
        margin: 0 auto;           
        justify-content: center;
        width: 50%;
        background-color: #5A81FA;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1rem;
        border-radius: 9999px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: inset 0 4px 20.3px rgba(0,0,0,0.3);
    }

    .btn-submit:hover {
        background-color: #ffffff;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 4px 20.3px rgba(0,0,0,0.3);
        color:#464646;
    }

    /* Welcome Section */
    .welcome-section {
        display: none;
        position: relative;
        background: #5A81FA;
        padding: 3rem;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    @media (min-width: 1024px) {
        .welcome-section {
            display: flex;
            width: 50%;
        }
    }


    /* Welcome Content */
    .welcome-content {
        color: white;
        text-align: center;
        position: relative;
        z-index: 10;
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

    .welcome-text {
        color: #dbeafe;
        font-size: 1rem;
        line-height: 1.75rem;
        margin-bottom: 2rem;
    }

    /* Register Button */
    .btn-register {
        display: inline-block;
        background-color: white;
        color: #2563eb;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 9999px;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: inset 0 4px 10px rgba(0,0,0,0.3);
    }

    .btn-register:hover {
        background-color:#5A81FA;
        color:white;
    }
</style>
@endpush

@section('content')
<div class="login-container">
    
    <div class="login-card">
        
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
                        <label for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn-submit">
                        MASUK
                    </button>
                </form>

            </div>
        </div>

        <div class="welcome-section">
            
            <div class="welcome-content">
                <h1 class="welcome-title">Selamat Datang</h1>
                <h1 class="welcome-subtitle">di Waras Waris</h1>
                <p class="welcome-text">
                    Belum memiliki akun?
                </p>
                <a href="{{ route('register') }}" class="btn-register">
                    DAFTAR
                </a>
            </div>
        </div>

    </div>

</div>
@endsection