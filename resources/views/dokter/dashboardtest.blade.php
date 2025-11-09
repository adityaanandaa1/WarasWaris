@extends('layouts.app')

@section('title', 'Dashboard Dokter - WarasWaris')

@push('styles')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: #f7fafc;
    }

    .dokter-container {
        display: grid;
        grid-template-columns: 250px 1fr;
        min-height: 100vh;
    }

    /* SIDEBAR */
    .sidebar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px 20px;
    }

    .sidebar-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidebar-header h2 {
        font-size: 20px;
        margin-bottom: 5px;
    }

    .sidebar-header p {
        font-size: 12px;
        opacity: 0.8;
    }

    .sidebar-menu {
        list-style: none;
    }

    .sidebar-menu li {
        margin-bottom: 10px;
    }

    .sidebar-menu a {
        display: block;
        padding: 12px 15px;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s;
        font-size: 14px;
    }

    .sidebar-menu a:hover,
    .sidebar-menu a.active {
        background: rgba(255, 255, 255, 0.2);
        transform: translateX(5px);
    }

    /* MAIN CONTENT */
    .main-content {
        padding: 30px;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .content-header h1 {
        font-size: 28px;
        color: #1a202c;
    }

    .content-header .date {
        color: #718096;
        font-size: 14px;
    }

    .logout-btn {
        background: #fc8181;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: #f56565;
    }

    /* STATS CARDS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .stat-card label {
        display: block;
        font-size: 12px;
        color: #718096;
        margin-bottom: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .stat-card .value {
        font-size: 32px;
        font-weight: 700;
        color: #667eea;
    }

    /* JADWAL INFO */
    .jadwal-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .jadwal-info h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .jadwal-info p {
        opacity: 0.9;
    }

    /* ANTRIAN CONTROL */
    .antrian-control {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        text-align: center;
    }

    .antrian-control h3 {
        font-size: 20px;
        color: #1a202c;
        margin-bottom: 15px;
    }

    .nomor-sekarang {
        font-size: 72px;
        font-weight: 700;
        color: #667eea;
        margin: 20px 0;
    }

    .btn-panggil {
        background: #48bb78;
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-panggil:hover {
        background: #38a169;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
    }

    /* LIST ANTRIAN */
    .list-antrian {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .list-antrian h3 {
        font-size: 18px;
        color: #1a202c;
        margin-bottom: 20px;
    }

    .antrian-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.3s;
    }

    .antrian-item:hover {
        border-color: #667eea;
        box-shadow: 0 2px 10px rgba(102, 126, 234, 0.2);
    }

    .antrian-item.active {
        border-color: #48bb78;
        background: #f0fff4;
    }

    .antrian-number {
        width: 50px;
        height: 50px;
        background: #667eea;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
    }

    .antrian-info {
        flex: 1;
        margin-left: 15px;
    }

    .antrian-info h4 {
        font-size: 16px;
        color: #1a202c;
        margin-bottom: 3px;
    }

    .antrian-info p {
        font-size: 13px;
        color: #718096;
    }

    .antrian-actions {
        display: flex;
        gap: 10px;
    }

    .btn-action {
        padding: 8px 15px;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-periksa {
        background: #667eea;
        color: white;
    }

    .btn-periksa:hover {
        background: #5568d3;
    }

    .btn-lewati {
        background: #fc8181;
        color: white;
    }

    .btn-lewati:hover {
        background: #f56565;
    }

    /* ALERTS */
    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-success {
        background: #c6f6d5;
        color: #22543d;
    }

    .alert-error {
        background: #fed7d7;
        color: #742a2a;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #a0aec0;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="dokter-container">
    
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>WarasWaris</h2>
            <p>Sistem Dokter</p>
        </div>

        <ul class="sidebar-menu">
            <li>
                    📊 Dashboard
                
            </li>
            <li>
                    👥 Daftar Pasien
                
            </li>
            <li>
                    📅 Jadwal Praktik
                
            </li>
            <li>
                    📈 Laporan Klinik
                
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        
        <!-- HEADER -->
        <div class="content-header">
            <div>
                <h1>Dashboard Dokter</h1>
                <div class="date">{{ $hari_ini->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </div>

        <!-- ALERTS -->
        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                ✗ {{ $errors->first() }}
            </div>
        @endif

        <!-- STATS -->
        <div class="stats-grid">
            <div class="stat-card">
                <label>Total Reservasi</label>
                <div class="value">{{ $statistik['total_reservasi'] }}</div>
            </div>
            <div class="stat-card">
                <label>Menunggu</label>
                <div class="value" style="color: #f6ad55;">{{ $statistik['menunggu'] }}</div>
            </div>
            <div class="stat-card">
                <label>Selesai</label>
                <div class="value" style="color: #48bb78;">{{ $statistik['selesai'] }}</div>
            </div>
            <div class="stat-card">
                <label>Tidak Hadir</label>
                <div class="value" style="color: #fc8181;">{{ $statistik['batal'] }}</div>
            </div>
        </div>

        <!-- JADWAL INFO -->
        @if($jadwal && $jadwal->is_active)
            <div class="jadwal-info">
                <h3>✓ Klinik Buka Hari Ini</h3>
                <p>{{ $nama_hari }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }} WIB</p>
            </div>
        @else
            <div class="jadwal-info" style="background: #fc8181;">
                <h3>✗ Klinik Tutup</h3>
                <p>{{ $nama_hari }} - Tidak ada jadwal praktik</p>
            </div>
        @endif

        <!-- ANTRIAN CONTROL -->
        <div class="antrian-control">
            <h3>Nomor Antrian Sekarang</h3>
            <div class="nomor-sekarang">{{ $antrian->nomor_sekarang }}</div>
            <p style="color: #718096; margin-bottom: 20px;">
                Total Antrian: <strong>{{ $antrian->total_antrian }}</strong>
            </p>

            @if($antrian->nomor_sekarang < $antrian->total_antrian)
                <form action="{{ route('dokter.antrian.panggil') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-panggil">
                        Panggil Antrian Berikutnya
                    </button>
                </form>
            @else
                <p style="color: #48bb78; font-weight: 600;">✓ Semua antrian sudah selesai</p>
            @endif
        </div>

        <!-- LIST ANTRIAN -->
        <div class="list-antrian">
            <h3>Daftar Antrian Hari Ini</h3>

            @if($reservasis->isEmpty())
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p>Belum ada reservasi hari ini</p>
                </div>
            @else
                @foreach($reservasis as $reservasi)
                    <div class="antrian-item {{ $reservasi->nomor_antrian == $antrian->nomor_sekarang ? 'active' : '' }}">
                        <div class="antrian-number">
                            {{ $reservasi->nomor_antrian }}
                        </div>
                        <div class="antrian-info">
                            <h4>{{ $reservasi->pasien->nama_pasien }}</h4>
                            <p>
                                {{ $reservasi->pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}, 
                                {{ \Carbon\Carbon::parse($reservasi->pasien->tanggal_lahir_pasien)->age }} tahun
                            </p>
                            @if($reservasi->keluhan)
                                <p style="color: #667eea; margin-top: 5px;">
                                    <strong>Keluhan:</strong> {{ Str::limit($reservasi->keluhan, 50) }}
                                </p>
                            @endif
                        </div>
                        <div class="antrian-actions">
                            @if($reservasi->status == 'sedang_diperiksa')
                                <a href="{{ route('dokter.rekam-medis.form', $reservasi->id) }}" class="btn-action btn-periksa">
                                    Isi Rekam Medis
                                </a>
                            @elseif($reservasi->status == 'menunggu')
                                <form action="{{ route('dokter.antrian.lewati', $reservasi->id) }}" method="POST" onsubmit="return confirm('Lewati pasien ini?')">
                                    @csrf
                                    <button type="submit" class="btn-action btn-lewati">
                                        Lewati
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

</div>
@endsection