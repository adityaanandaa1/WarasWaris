@extends('layouts.app')

@section('title', 'Dashboard Pasien - WarasWaris')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .dashboard-container {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 20px;
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
        min-height: 100vh;
    }

    /* SIDEBAR KIRI - NAVIGASI */
    .sidebar-nav {
        width: 120px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .nav-btn {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        padding: 15px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        writing-mode: vertical-rl;
        text-orientation: mixed;
        height: 150px;
    }

    .nav-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateX(-5px);
    }

    .nav-btn.active {
        background: white;
        color: #667eea;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    /* MAIN CONTENT TENGAH */
    .main-content {
        background: white;
        border-radius: 25px;
        padding: 30px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        min-height: 80vh;
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
        margin-bottom: 30px;
    }

    .content-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 5px;
    }

    .content-header .date {
        color: #718096;
        font-size: 14px;
    }

    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
        color: white;
    }

    .welcome-banner img {
        width: 120px;
        height: 120px;
        object-fit: contain;
    }

    .welcome-text h2 {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .welcome-text p {
        opacity: 0.9;
    }

    /* Calendar */
    .calendar-container {
        background: #f7fafc;
        border-radius: 20px;
        padding: 25px;
    }

    .calendar-header {
        font-size: 20px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 20px;
        text-align: center;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        margin-bottom: 10px;
    }

    .day-name {
        text-align: center;
        font-size: 12px;
        font-weight: 600;
        color: #4a5568;
        padding: 8px;
    }

    .day-name.current {
        color: #667eea;
        background: #e6f2ff;
        border-radius: 8px;
    }

    .calendar-dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
    }

    .date-cell {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .date-cell:hover {
        background: #e6f2ff;
    }

    .date-cell.current {
        background: #667eea;
        color: white;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(102, 126, 234, 0.4);
    }

    .date-cell.prev-month,
    .date-cell.next-month {
        color: #cbd5e0;
    }

    /* Riwayat Reservasi */
    .riwayat-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 15px;
        margin-bottom: 20px;
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
        border-color: #667eea;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
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
        color: #667eea;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
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
        color: #667eea;
    }

    .info-card .time {
        font-size: 28px;
        font-weight: 700;
        color: #667eea;
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
        color: #667eea;
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
        border-color: #667eea;
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
        color: #667eea;
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
        width: 320px;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .profile-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        border-radius: 12px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        transition: all 0.3s;
    }

    .profile-header:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .profile-header h3 {
        font-size: 16px;
        font-weight: 600;
    }

    .profile-dropdown {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .profile-dropdown.active {
        max-height: 500px;
    }

    .profile-list {
        margin-bottom: 15px;
    }

    .profile-item {
        width: 100%;
        background: #f7fafc;
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
        background: #667eea;
        color: white;
        font-weight: 600;
    }

    .profile-item .badge {
        background: #fbbf24;
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
    }

    .add-member-btn:hover {
        background: #38a169;
        transform: translateY(-2px);
    }

    .profile-content {
        text-align: center;
    }

    .profile-image {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: 700;
        color: white;
        margin: 0 auto 15px;
    }

    .profile-info h4 {
        font-size: 18px;
        color: #1a202c;
        margin-bottom: 5px;
    }

    .profile-info .phone {
        font-size: 12px;
        color: #718096;
        margin-bottom: 15px;
    }

    .profile-details {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .detail-item {
        flex: 1;
        text-align: center;
    }

    .detail-item label {
        display: block;
        font-size: 11px;
        color: #718096;
        margin-bottom: 5px;
    }

    .detail-item value {
        display: block;
        font-size: 16px;
        font-weight: 700;
        color: #667eea;
    }

    .divider {
        width: 1px;
        background: #e2e8f0;
    }

    .reminders-card {
        background: #e6f2ff;
        border-radius: 20px;
        padding: 20px;
    }

    .reminders-card h3 {
        color: #667eea;
        font-size: 18px;
        margin-bottom: 15px;
    }

    .reminder-item {
        background: white;
        padding: 15px;
        border-radius: 12px;
        border-left: 4px solid #fbbf24;
        margin-bottom: 10px;
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
        color: #718096;
        padding: 20px;
    }

    .logout-btn {
        width: 100%;
        background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
        color: white;
        border: none;
        padding: 15px;
        border-radius: 15px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(252, 129, 129, 0.4);
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(252, 129, 129, 0.5);
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

    /* Responsive */
    @media (max-width: 1200px) {
        .dashboard-container {
            grid-template-columns: 1fr;
        }

        .sidebar-nav {
            width: 100%;
            flex-direction: row;
        }

        .nav-btn {
            writing-mode: horizontal-tb;
            height: auto;
            flex: 1;
        }

        .sidebar-right {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    
    <!-- SIDEBAR KIRI - NAVIGASI -->
    <div class="sidebar-nav">
        <button class="nav-btn active" onclick="switchTab('dashboard')">
            Dashboard
        </button>
        <button class="nav-btn" onclick="switchTab('riwayat')">
            Riwayat
        </button>
        <button class="nav-btn" onclick="switchTab('reservasi')">
            Reservasi
        </button>
    </div>

    <!-- MAIN CONTENT TENGAH -->
    <div class="main-content">
        
        <!-- TAB 1: DASHBOARD -->
        <div class="content-section active" id="tab-dashboard">
            <div class="content-header">
                <h1>Dashboard</h1>
                <div class="date" id="currentDate"></div>
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
                <h1>Riwayat Reservasi</h1>
                <div class="date" id="currentDate2"></div>
            </div>

            <div class="riwayat-header">
                <h3>Lihat kembali riwayat reservasi anda!</h3>
                <p>Data ini akan muncul setiap kali Anda membuat reservasi</p>
            </div>

            @if($reservasis->isEmpty())
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3>Belum Ada Riwayat</h3>
                    <p>Anda belum pernah melakukan reservasi</p>
                    <button class="btn-primary" onclick="switchTab('reservasi')">
                        Buat Reservasi Sekarang
                    </button>
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
                <h1>Reservasi Pemeriksaan</h1>
                <div class="date" id="currentDate3"></div>
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