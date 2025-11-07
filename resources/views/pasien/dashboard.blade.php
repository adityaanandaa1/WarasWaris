@extends('layouts.app')

@section('title', 'Dashboard Pasien - WarasWaris')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #CEDEFF;
        overflow: hidden;
        height: 100vh;
    }

    .dashboard-container {
        display: flex;
        height: 100vh;
        max-width: 100vw;
    }

    /* SIDEBAR KIRI - NAVIGASI */
    .sidebar-nav {
        position: fixed;
        right: 558.5px;
        top: 65%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 0;
        z-index: 100;
    }

    .nav-btn {
        width: 42px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0 15px 15px 0;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        border: none;
        font-family: 'Poppins', sans-serif;
    }

    .nav-btn span {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
        font-weight: 700;
        font-size: 12px;
    }

    /* Tab Dashboard - Putih saat aktif, biru muda saat tidak aktif */
    .nav-btn.dashboard {
        background: #FFFFFF;
        color: #464646;
        box-shadow: 10px 0px 7px rgba(0, 0, 0, 0.1);
        z-index: 200;
    }

    .nav-btn.dashboard:not(.active) {
        box-shadow: inset 10px 0 20px rgba(0, 0, 0, 0.3);
        z-index: 100;
    }

    .nav-btn.riwayat:not(.active) {
        box-shadow: inset 10px 0 20px rgba(0, 0, 0, 0.3);
        z-index: 100;
    }
    /* Tab Riwayat - Background #587EF4 saat aktif */
    .nav-btn.riwayat {
        background:#587EF4;
        color: #FFFFFF;
        box-shadow: 10px 0 20px rgba(0, 0, 0, 0.3);
        z-index: 50;
    }

    .nav-btn.riwayat.active {
        background: #587EF4;
        color: #FFFFFF;
        box-shadow: 10px 0px 7px rgba(0, 0, 0, 0.1);
        z-index: 200;
    }

    /* Tab Reservasi - Background #3B41AE saat aktif */
    .nav-btn.reservasi {   
        background: #3B41AE;
        color: #FFFFFF;
        box-shadow:10px 0 20px rgba(0, 0, 0, 0.3);
        z-index: 30;
    }

    .nav-btn.reservasi:not(.active) {
        box-shadow: inset 10px 0 20px rgba(0, 0, 0, 0.3);
        z-index: 100;
    }
    .nav-btn.reservasi.active {
        background: #3B41AE;
        color: #FFFFFF;
        box-shadow: 10px 0px 7px rgba(0, 0, 0, 0.1);
        z-index: 200;
    }

    /* MAIN CONTENT TENGAH */
    .main-content {
        flex: 1;
        background: #FFFFFF;
        border-radius: 0 20px 20px 0;
        padding: 15px 50px;
        box-shadow: 10px 0px 10px rgba(0, 0, 0, 0.25);
        margin-right: 42px;
        max-width: calc(100vw - 600px);
        overflow: hidden;
        transition: background 0.3s ease;
    }

    /* Background untuk tab Dashboard */
    .main-content.bg-dashboard {
        background: #FFFFFF;
    }

    /* Background untuk tab Riwayat */
    .main-content.bg-riwayat {
        background: #587EF4;
    }

    /* Background untuk tab Reservasi */
    .main-content.bg-reservasi {
        background: #3B41AE;
    }

    .content-section {
        display: none;
    }

    .content-section.active {
        display: block;
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    .content-header .headerputih{
        color:white;
    }

    .content-header h1 {
        font-size: 18px;
        font-weight: 700;
        color: #464646;
        margin-bottom: 2px;
    }

    .content-header .date {
        font-size: 11px;
        color: #464646;
    }

    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #5A81FA 0%, #587EF4 100%);
        border-radius: 15px;
        padding: 15px 20px;
        margin-top: 50px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.15);
        height: 120px;
        position: relative;
        overflow: visible;
    }

    .welcome-banner img {
        width: 300px;
        height: auto;
        position: absolute;
        left: -20px;
        top: -75px;
        z-index: 1;
        object-fit: contain;
    }

    .welcome-text {
        flex: 1;
        color: #FFFFFF;
        text-align: left;
        padding-left: 280px;
    }

    .welcome-text h2 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .welcome-text p {
        font-size: 14px;
        font-weight: 300;
        line-height: 20px;
    }

    /* Calendar */
    .calendar-container {
        background: rgba(206, 222, 255, 0.5);
        border-radius: 20px;
        padding: 20px 40px;
        box-shadow: 0px 4px 15px 5px rgba(0, 0, 0, 0.25);
        height: calc(100vh - 278px);
        overflow: hidden;
        margin-top: 20px;
    }

    .calendar-header {
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        color: #5A81FA;
        margin-bottom: 20px;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        text-align: center;
        margin-bottom: 10px;
    }

    .day-name {
        font-size: 16px;
        color: #464646;
        font-weight: 550;
        padding: 8px;
    }

    .day-name.current {
        color: #5A81FA;
    }

    .calendar-dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
        text-align: center;
    }

    .date-cell {
        font-size: 16px;
        padding: 10px;
        cursor: pointer;
        transition: all 0.3s;
        border-radius: 30px;
    }

    .date-cell:hover:not(.prev-month):not(.next-month):not(.current) {
        background: rgba(90, 129, 250, 0.2);
    }

    .date-cell.current {
        background: #5A81FA;
        color: #FFFFFF;
        font-weight: 600;
    }

    .date-cell.prev-month,
    .date-cell.next-month {
        color: rgba(0, 0, 0, 0.5);
        font-weight: 100;
    }

    /* Riwayat Reservasi */
    .riwayat-header {
        background: linear-gradient(135deg, #5A81FA 0%, #587EF4 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.15);
    }

    .riwayat-header h3 {
        font-size: 20px;
        margin-bottom: 5px;
    }

    .riwayat-header p {
        opacity: 0.9;
        font-size: 14px;
    }

    .riwayat-item {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .riwayat-item:hover {
        border-color: #5A81FA;
        box-shadow: 0 5px 15px rgba(90, 129, 250, 0.2);
        transform: translateY(-2px);
    }

    .riwayat-item-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .riwayat-icon {
        width: 40px;
        height: 40px;
        background: #e6f2ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #5A81FA;
    }

    .riwayat-info h4 {
        font-size: 14px;
        color: #718096;
        margin-bottom: 5px;
    }

    .riwayat-info p {
        font-size: 16px;
        font-weight: 600;
        color: #1a202c;
    }

    /* Reservasi */
    .reservasi-banner {
        background: linear-gradient(135deg, #5A81FA 0%, #587EF4 100%);
        color: white;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.15);
    }

    .reservasi-banner svg {
        width: 50px;
        height: 50px;
    }

    .reservasi-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .info-card label {
        display: block;
        font-size: 12px;
        color: #718096;
        margin-bottom: 10px;
    }

    .info-card .value {
        font-size: 36px;
        font-weight: 700;
        color: #5A81FA;
    }

    .info-card .time {
        font-size: 28px;
        font-weight: 700;
        color: #5A81FA;
    }

    .info-card .separator {
        font-size: 20px;
        color: #cbd5e0;
        margin: 5px 0;
    }

    /* Keluhan Box */
    .keluhan-box {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .keluhan-box h4 {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
        color: #5A81FA;
        font-size: 16px;
    }

    .keluhan-box textarea {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 15px;
        font-family: inherit;
        font-size: 14px;
        resize: none;
        transition: border-color 0.3s;
    }

    .keluhan-box textarea:focus {
        outline: none;
        border-color: #5A81FA;
    }

    .keluhan-box .note {
        font-size: 12px;
        color: #718096;
        margin-top: 8px;
        font-style: italic;
    }

    /* Buttons */
    .btn-primary {
        background: white;
        color: #5A81FA;
        border: none;
        padding: 15px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        width: 100%;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn-cancel {
        background: #fc8181;
        color: white;
    }

    /* SIDEBAR KANAN */
    .sidebar-right {
        width: 450px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        height: 100vh;
        margin: 0px 0px 20px 50px;
    }

    .profile-card {
        background: #FFFFFF;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.15);
        padding-bottom: 15px;
    }

    .profile-header {
        background: #5A81FA;
        color: #FFFFFF;
        padding: 10px 40px;
        border-radius: 20px;
        margin: -20px -20px 12px -40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 450px;
        height: 50px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .profile-header h3 {
        font-size: 16px;
        font-weight: 600;
    }

    .profile-dropdown {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        margin-top: 0px;
        margin-right: 0px;
        background: #f7fafc;
        border-radius: 10px;
        padding: 0;
    }

    .profile-dropdown.active {
        max-height: 500px;
        padding: 10px;
    }

    .profile-list {
        max-height: 200px;
        overflow-y: auto;
        margin-bottom: 10px;
    }

    .profile-item {
        width: 100%;
        background: white;
        border: none;
        padding: 12px 15px;
        border-radius: 10px;
        text-align: left;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        margin-bottom: 8px;
        transition: all 0.2s;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profile-item:hover {
        background: #e6f2ff;
    }

    .profile-item.active {
        background: #5A81FA;
        color: white;
        font-weight: 600;
    }

    .profile-item .badge {
        background: #4CAF50;
        color: white;
        font-size: 10px;
        padding: 3px 8px;
        border-radius: 10px;
        font-weight: 600;
    }

    .add-member-btn {
        display: block;
        width: 100%;
        background: #48bb78;
        color: white;
        text-align: center;
        padding: 12px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .add-member-btn:hover {
        background: #38a169;
        transform: translateY(-2px);
    }

    .profile-content {
        display: flex;
        gap: 0px;
    }

    .profile-image {
        width: 60px;
        height: 60px;
        margin-left: 20px;
        margin-top: 0px;
        border-radius: 50%;
        background: #5A81FA;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    .profile-info h4 {
        margin-top: 13px;
        margin-left: 20px;
        font-size: 16px;
        font-weight: 600;
        color: #1F4DD9;
        margin-bottom: 3px;
    }

    .profile-info .phone {
        margin-left: 20px;
        font-size: 10px;
        color: #464646;
        margin-bottom: 10px;
    }

    .profile-details {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 25px;
        margin-left: -50px;
        gap: 40px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex: none;
        width: 100px;
    }

    .detail-item label {
        font-size: 10px;
        color: #464646;
        margin-bottom: 3px;
    }

    .detail-item value {
        font-size: 10px;
        font-weight: 600;
        color: #464646;
    }

    .divider {
        width: 1px;
        height: 25px;
        background: #464646;
        align-self: center;
        margin: 0 20px;
    }

    .reminders-card {
        background: #FFFFFF;
        border-radius: 15px;
        padding: 12px;
        box-shadow: 0px 0px 25px 3px rgba(0, 0, 0, 0.25);
        flex: 1;
        overflow-y: auto;
    }

    .reminders-card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #587EF4;
        text-align: center;
        margin-bottom: 12px;
    }

    .reminder-item {
        padding: 15px;
        background: rgba(90, 129, 250, 0.1);
        border-radius: 12px;
        border-left: 4px solid #fbbf24;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .reminder-item:hover {
        background: rgba(90, 129, 250, 0.2);
    }

    .reminder-item strong {
        display: block;
        color: #1a202c;
        margin-bottom: 5px;
    }

    .reminder-item small {
        color: #718096;
        font-size: 12px;
    }

    .loading {
        text-align: center;
        padding: 20px;
        color: #5A81FA;
        font-size: 11px;
    }

    .logout-btn {
        width: 100%;
        background: rgba(255, 0, 4, 0.5);
        border-radius: 35px;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: inset 0px 4px 15px rgba(0, 0, 0, 0.25);
        transition: all 0.3s;
        border: none;
        font-size: 16px;
        font-weight: 700;
        color: #FFFFFF;
    }

    .logout-btn:hover {
        background: rgba(255, 0, 4, 0.7);
    }

    /* Alert Messages */
    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        z-index: 9999;
        animation: slideIn 0.3s ease;
    }

    .alert-success {
        background: #48bb78;
    }

    .alert-error {
        background: #fc8181;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state svg {
        width: 100px;
        height: 100px;
        color: #cbd5e0;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 24px;
        color: #1a202c;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #718096;
        margin-bottom: 20px;
    }

    /* Scrollbar styling */
    .reminders-card::-webkit-scrollbar,
    .profile-list::-webkit-scrollbar {
        width: 6px;
    }

    .reminders-card::-webkit-scrollbar-track,
    .profile-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .reminders-card::-webkit-scrollbar-thumb,
    .profile-list::-webkit-scrollbar-thumb {
        background: #5A81FA;
        border-radius: 10px;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .dashboard-container {
            flex-direction: column;
        }

        .sidebar-nav {
            position: relative;
            right: auto;
            top: auto;
            transform: none;
            width: 100%;
            flex-direction: row;
        }

        .nav-btn {
            writing-mode: horizontal-tb;
            height: auto;
            flex: 1;
            width: auto;
        }

        .nav-btn span {
            writing-mode: horizontal-tb;
            transform: none;
        }

        .main-content {
            max-width: 100%;
        }

        .sidebar-right {
            width: 100%;
            margin: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    
    <!-- SIDEBAR KIRI - NAVIGASI -->
    <div class="sidebar-nav">
        <button class="nav-btn dashboard active" onclick="switchTab('dashboard')">
            <span>Dashboard</span>
        </button>
        <button class="nav-btn riwayat" onclick="switchTab('riwayat')">
            <span>Riwayat</span>
        </button>
        <button class="nav-btn reservasi" onclick="switchTab('reservasi')">
            <span>Reservasi</span>
        </button>
    </div>

    <!-- MAIN CONTENT TENGAH -->
    <div class="main-content bg-dashboard" id="mainContent">
        
        <!-- TAB 1: DASHBOARD -->
        <div class="content-section active" id="tab-dashboard">
            <div class="content-header">
                <div>
                    <h1>Dashboard</h1>
                    <div class="date" id="currentDate"></div>
                </div>
            </div>

            <div class="welcome-banner">
                <img src="{{ asset('images/dbpasien.png') }}" alt="Dokter" onerror="this.style.display='none'">
                <div class="welcome-text">
                    <h2>Selamat Datang!</h2>
                    <p>Konsultasikan kesehatanmu sekarang juga!</p>
                </div>
            </div>

            <div class="calendar-container">
                <div class="calendar-header" id="calendarMonth"></div>
                <div class="calendar-days">
                    <div class="day-name">Senin</div>
                    <div class="day-name">Selasa</div>
                    <div class="day-name">Rabu</div>
                    <div class="day-name">Kamis</div>
                    <div class="day-name">Jumat</div>
                    <div class="day-name">Sabtu</div>
                    <div class="day-name">Minggu</div>
                </div>
                <div class="calendar-dates" id="calendarDates"></div>
            </div>
        </div>

        <!-- TAB 2: RIWAYAT -->
        <div class="content-section" id="tab-riwayat">
            <div class="content-header">
                <div class="headerputih">
                    <h1>Riwayat Reservasi</h1>
                    <div class="date" id="currentDate2"></div>
                </div>
            </div>

            <div class="riwayat-header">
                <h3>Lihat kembali riwayat reservasi anda!</h3>
                <p>Data ini akan muncul setiap kali Anda membuat reservasi</p>
            </div>

            @if($reservasis->isEmpty())
                <div class="empty-state">
                    <h3>Belum Ada Riwayat</h3>
                    <p>Anda belum pernah melakukan reservasi</p>
                </div>
            @else
                @foreach($reservasis as $reservasi)
                    <div class="riwayat-item" onclick="window.location.href='#'">
                        <div class="riwayat-item-content">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div class="riwayat-icon">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="riwayat-info">
                                    <h4>{{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->locale('id')->isoFormat('D MMMM YYYY') }}</h4>
                                    <p>Ketuk untuk melihat lebih detail tentang catatan riwayat pemeriksaan</p>
                                </div>
                            </div>
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- TAB 3: RESERVASI -->
        <div class="content-section" id="tab-reservasi">
            <div class="content-header">
                <div class="headerputih">
                    <h1>Reservasi Pemeriksaan</h1>
                    <div class="date" id="currentDate3"></div>
                </div>
            </div>

            @if($klinik_tutup)
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <h3>Klinik Tutup</h3>
                    <p>Klinik tidak beroperasi pada hari <strong>{{ $nama_hari }}</strong></p>
                </div>
            @else
                <div class="reservasi-banner">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                    <div>
                        <h3 style="font-size: 18px; margin-bottom: 5px;">Kesehatan Anda, satu klik lebih dekat!</h3>
                        <p style="opacity: 0.9; font-size: 14px;">Isi nomor antrian dan datangi klinik sekarang!</p>
                    </div>
                </div>

                <div class="reservasi-cards">
                    <div class="info-card">
                        <label>Jam Praktik</label>
                        <div class="time">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') }}</div>
                        <div class="separator">-</div>
                        <div class="time">{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') }}</div>
                    </div>
                    <div class="info-card">
                        <label>Nomor Antrian Sekarang</label>
                        <div class="value">{{ $antrian->nomor_sekarang }}</div>
                    </div>
                    <div class="info-card">
                        <label>Nomor Antrian Anda</label>
                        <div class="value">{{ $reservasi_aktif ? $reservasi_aktif->nomor_antrian : '-' }}</div>
                    </div>
                </div>

                @if($reservasi_aktif)
                    <!-- Sudah Reservasi -->
                    <div class="keluhan-box">
                        <h4>
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Keluhan
                        </h4>
                        <div style="background: #f7fafc; padding: 15px; border-radius: 12px; color: #4a5568;">
                            {{ $reservasi_aktif->keluhan ?? 'Tidak ada keluhan spesifik' }}
                        </div>
                        <p class="note">* Keluhan tidak dapat diubah setelah reservasi dikonfirmasi</p>
                    </div>

                    <form action="{{ route('pasien.batalkan_reservasi', $reservasi_aktif->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan?')">
                        @csrf
                        <button type="submit" class="btn-primary btn-cancel">
                            Batalkan Reservasi
                        </button>
                    </form>
                @else
                    <!-- Form Reservasi -->
                    <form action="{{ route('pasien.buat_reservasi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tanggal_reservasi" value="{{ today()->format('Y-m-d') }}">

                        <div class="keluhan-box">
                            <h4>
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Keluhan
                            </h4>
                            <textarea name="keluhan" rows="4" maxlength="500" placeholder="(Opsional) Contoh: Demam 3 hari, batuk, pilek...">{{ old('keluhan') }}</textarea>
                            <p class="note">* Keluhan bersifat opsional, tetapi sangat membantu dokter</p>
                        </div>

                        <button type="submit" class="btn-primary">
                            Reservasi
                        </button>
                    </form>
                @endif
            @endif
        </div>

    </div>

    <!-- SIDEBAR KANAN -->
    <div class="sidebar-right">
        <div class="profile-card">
            <div class="profile-header" onclick="toggleProfileDropdown()">
                <h3>Profil Saya</h3>
                <span>
                    <svg width="23" height="12" viewBox="0 0 23 12" fill="none">
                        <path d="M11.5 12L23 1.61539L21.0833 0L11.5 8.53846L1.91667 0L0 1.61539L11.5 12Z" fill="white"/>
                    </svg>
                </span>
            </div>

            <div class="profile-dropdown" id="profileDropdown">
                <div class="profile-list" id="profileList"></div>
                <a href="{{ route('pasien.tambah_biodata') }}" class="add-member-btn">
                    + Tambah Anggota Keluarga
                </a>
            </div>

            <div class="profile-content">
                <div class="profile-image" id="profileInitial"></div>
                <div class="profile-info">
                    <h4 id="patientName">Loading...</h4>
                    <div class="phone" id="patientPhone">Loading...</div>
                    <div class="profile-details">
                        <div class="detail-item">
                            <label>Jenis Kelamin</label>
                            <value id="gender">-</value>
                        </div>
                        <div class="divider"></div>
                        <div class="detail-item">
                            <label>Umur</label>
                            <value id="age">-</value>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="reminders-card">
            <h3>Reminders</h3>
            <div id="remindersList">
                <div class="loading">Memuat pengingat...</div>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                Keluar Akun
            </button>
        </form>
    </div>

</div>

<script>
    // Data dari Laravel
    const pasienAktif = @json($pasien_aktif);
    const allPasiens = @json($pasiens);

    // Switch Tab Function
    function switchTab(tabName) {
        // Update navigation buttons
        document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Update content sections
        document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
        document.getElementById('tab-' + tabName).classList.add('active');

        // Update main content background
        const mainContent = document.getElementById('mainContent');
        mainContent.className = 'main-content bg-' + tabName;
    }

    // Format tanggal Indonesia
    function formatDate(date) {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return date.toLocaleDateString('id-ID', options);
    }

    // Set tanggal saat ini
    const currentDateStr = formatDate(new Date());
    document.getElementById('currentDate').textContent = currentDateStr;
    document.getElementById('currentDate2').textContent = currentDateStr;
    document.getElementById('currentDate3').textContent = currentDateStr;

    // Load Patient Profile
    function loadPatientProfile() {
        const initial = pasienAktif.nama_pasien ? pasienAktif.nama_pasien.charAt(0).toUpperCase() : '?';
        document.getElementById('profileInitial').textContent = initial;
        document.getElementById('patientName').textContent = pasienAktif.nama_pasien || '-';
        document.getElementById('patientPhone').textContent = pasienAktif.no_telepon || '-';
        
        // Jenis Kelamin
        const gender = pasienAktif.jenis_kelamin === 'L' ? 'L' : (pasienAktif.jenis_kelamin === 'P' ? 'P' : '-');
        document.getElementById('gender').textContent = gender;
        
        // Hitung umur
        if (pasienAktif.tanggal_lahir_pasien) {
            const birthDate = new Date(pasienAktif.tanggal_lahir_pasien);
            const age = new Date().getFullYear() - birthDate.getFullYear();
            document.getElementById('age').textContent = age + ' Tahun';
        } else {
            document.getElementById('age').textContent = '-';
        }
    }

    // Toggle Profile Dropdown
    function toggleProfileDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('active');
        
        if (dropdown.classList.contains('active')) {
            loadProfileList();
        }
    }

    // Load Profile List
    function loadProfileList() {
        const profileList = document.getElementById('profileList');
        let html = '';
        
        allPasiens.forEach(pasien => {
            const isActive = pasien.id === pasienAktif.id ? 'active' : '';
            const badge = pasien.is_primary ? '<span class="badge">Utama</span>' : '';
            
            html += `
                <form action="{{ route('pasien.ganti_profil', '') }}/${pasien.id}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="profile-item ${isActive}">
                        <span>${pasien.nama_pasien}</span>
                        ${badge}
                    </button>
                </form>
            `;
        });
        
        profileList.innerHTML = html;
    }

    // Load Reminders
    function loadReminders() {
        const remindersList = document.getElementById('remindersList');
        
        @if(isset($reminder_aktif))
            remindersList.innerHTML = `
                <div class="reminder-item">
                    <strong>Antrian Hampir Tiba!</strong>
                    <small>Nomor Anda: #{{ $reminder_aktif->nomor_antrian }}<br>
                    Sisa {{ $reminder_aktif->selisih }} antrian lagi</small>
                </div>
            `;
        @else
            remindersList.innerHTML = '<div class="loading">Tidak ada pengingat</div>';
        @endif
    }

    // Generate Calendar
    function generateCalendar() {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();
        const currentDate = today.getDate();

        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        document.getElementById('calendarMonth').textContent = monthNames[month];

        const currentDay = today.getDay();
        const dayNames = document.querySelectorAll('.day-name');

        let adjustedIndex = currentDay - 1;
        if (adjustedIndex < 0) adjustedIndex = 6;

        dayNames.forEach((day, index) => {
            if (index === adjustedIndex) {
                day.classList.add('current');
            }
        });

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();

        const calendarDates = document.getElementById('calendarDates');
        let html = '';

        const startDay = firstDay === 0 ? 6 : firstDay - 1;
        for (let i = startDay; i > 0; i--) {
            html += `<div class="date-cell prev-month">${daysInPrevMonth - i + 1}</div>`;
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const isToday = i === currentDate ? 'current' : '';
            html += `<div class="date-cell ${isToday}">${i}</div>`;
        }

        const remainingCells = 42 - (startDay + daysInMonth);
        for (let i = 1; i <= remainingCells; i++) {
            html += `<div class="date-cell next-month">${i}</div>`;
        }

        calendarDates.innerHTML = html;
    }

    // Show Alert Messages
    @if(session('success'))
        showAlert('{{ session("success") }}', 'success');
    @endif

    @if($errors->any())
        showAlert('{{ $errors->first() }}', 'error');
    @endif

    function showAlert(message, type) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type}`;
        alert.textContent = message;
        document.body.appendChild(alert);

        setTimeout(() => {
            alert.remove();
        }, 3000);
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profileDropdown');
        const header = document.querySelector('.profile-header');
        
        if (dropdown.classList.contains('active') && 
            !dropdown.contains(event.target) && 
            !header.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });

    // Initialize
    window.onload = function() {
        loadPatientProfile();
        loadReminders();
        generateCalendar();
    };
</script>
@endsection