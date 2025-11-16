@extends('layouts.app')

@section('content')

<style>
    .rekam-medis-container {
        display: flex;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .sidebar-riwayat {
        width: 280px;
        background: rgba(255, 255, 255, 0.95);
        padding: 20px;
        overflow-y: auto;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar-title {
        color: #667eea;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .back-button {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 20px;
        padding: 8px 12px;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .back-button:hover {
        background: #f0f0f0;
    }

    .riwayat-item {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .riwayat-item:hover {
        border-color: #667eea;
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .riwayat-item.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .riwayat-date {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .riwayat-no {
        font-size: 12px;
        opacity: 0.8;
    }

    .content-area {
        flex: 1;
        padding: 30px;
        overflow-y: auto;
    }

    .rekam-medis-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        max-width: 900px;
        margin: 0 auto;
    }

    .rekam-medis-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 3px solid #667eea;
    }

    .rekam-medis-header h1 {
        color: #667eea;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .nomor-rekam-medis {
        font-size: 18px;
        color: #6b7280;
        font-weight: 600;
    }

    .section-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        margin: 30px 0 15px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .data-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .data-item {
        background: #f9fafb;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }

    .data-label {
        font-size: 12px;
        color: #6b7280;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .data-value {
        font-size: 15px;
        color: #1f2937;
        font-weight: 500;
    }

    .data-full {
        grid-column: 1 / -1;
    }

    .vital-signs {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .vital-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
    }

    .vital-label {
        font-size: 12px;
        opacity: 0.9;
        margin-bottom: 8px;
    }

    .vital-value {
        font-size: 24px;
        font-weight: bold;
    }

    .vital-unit {
        font-size: 12px;
        opacity: 0.8;
        margin-top: 5px;
    }

    .textarea-display {
        background: #f9fafb;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        min-height: 80px;
        line-height: 1.6;
        color: #374151;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: white;
    }

    .empty-state svg {
        width: 120px;
        height: 120px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    @media print {
        .sidebar-riwayat {
            display: none;
        }
        .rekam-medis-container {
            background: white;
        }
        .content-area {
            padding: 0;
        }
    }
</style>

<div class="rekam-medis-container">
    <!-- Sidebar Riwayat -->
    <div class="sidebar-riwayat">
        <a href="{{ route('dokter.daftar_pasien') }}" class="back-button">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div class="sidebar-title">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
            </svg>
            Riwayat Rekam Medis
        </div>

        @php
            $activeRekamId = optional($rekamMedisAktif)->id ?? request('id');
        @endphp
        @forelse($riwayatRekamMedis as $index => $rekam)
        <div class="riwayat-item {{ $rekam->id == $activeRekamId ? 'active' : '' }}" 
             onclick="loadRekamMedis({{ $rekam->id }})" 
             id="item-{{ $rekam->id }}">
            <div class="riwayat-date">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ \Carbon\Carbon::parse($rekam->tanggal_pemeriksaan)->format('d M Y') }}
            </div>
            <div class="riwayat-no">{{ $rekam->nomor_rekam_medis }}</div>
        </div>
        @empty
        <div style="text-align: center; padding: 20px; color: #6b7280;">
            <p>Belum ada riwayat rekam medis</p>
        </div>
        @endforelse
    </div>

    <!-- Content Area -->
    <div class="content-area">
        @if($rekamMedisAktif)
        <div class="rekam-medis-card" id="rekam-medis-content">
            <!-- Header -->
            <div class="rekam-medis-header">
                <h1>WarasWaris</h1>
                <div class="nomor-rekam-medis">Nomor Rekam Medis: {{ $rekamMedisAktif->nomor_rekam_medis }}</div>
            </div>

            <!-- Biodata Pasien -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
                Nama Pasien
            </div>
            <div class="data-grid">
                <div class="data-item data-full">
                    <div class="data-label">Nama Pasien</div>
                    <div class="data-value">{{ $pasienData->nama_pasien }}</div>
                </div>
                <div class="data-item">
                    <div class="data-label">Tanggal Lahir</div>
                    <div class="data-value">{{ \Carbon\Carbon::parse($pasienData->tanggal_lahir_pasien)->format('d-m-Y') }} / {{ $pasienData->umur }} tahun</div>
                </div>
                <div class="data-item">
                    <div class="data-label">Jenis Kelamin</div>
                    <div class="data-value">{{ $pasienData->jenis_kelamin }}</div>
                </div>
                <div class="data-item">
                    <div class="data-label">No. Telepon</div>
                    <div class="data-value">{{ $pasienData->no_telepon ?? '-' }}</div>
                </div>
                <div class="data-item">
                    <div class="data-label">Golongan Darah</div>
                    <div class="data-value">{{ $pasienData->golongan_darah ?? 'A+' }}</div>
                </div>
                <div class="data-item">
                    <div class="data-label">Pekerjaan</div>
                    <div class="data-value">{{ $pasienData->pekerjaan ?? 'Petani' }}</div>
                </div>
                <div class="data-item data-full">
                    <div class="data-label">Alamat</div>
                    <div class="data-value">{{ $pasienData->alamat }}</div>
                </div>
            </div>

            <!-- Data Dokter -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z"/>
                </svg>
                Nama Dokter
            </div>
            <div class="data-grid">
                <div class="data-item data-full">
                    <div class="data-label">Nama Dokter</div>
                    <div class="data-value">{{ $dokterData->nama_dokter }}</div>
                </div>
                <div class="data-item data-full">
                    <div class="data-label">Alamat</div>
                    <div class="data-value">{{ $dokterData->alamat }}</div>
                </div>
            </div>

            <!-- Pemeriksaan Fisik -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
                Pemeriksaan Fisik
            </div>
            <div class="vital-signs">
                <div class="vital-box">
                    <div class="vital-label">Tekanan Darah</div>
                    <div class="vital-value">{{ $rekamMedisAktif->tekanan_darah }}</div>
                    <div class="vital-unit">mmHg</div>
                </div>
                <div class="vital-box">
                    <div class="vital-label">Suhu Tubuh</div>
                    <div class="vital-value">{{ $rekamMedisAktif->suhu }}</div>
                    <div class="vital-unit">°C</div>
                </div>
                <div class="vital-box">
                    <div class="vital-label">Tinggi Badan</div>
                    <div class="vital-value">{{ $rekamMedisAktif->tinggi_badan }}</div>
                    <div class="vital-unit">cm</div>
                </div>
                <div class="vital-box">
                    <div class="vital-label">Berat Badan</div>
                    <div class="vital-value">{{ $rekamMedisAktif->berat_badan }}</div>
                    <div class="vital-unit">kg</div>
                </div>
            </div>

            <!-- Keluhan Pasien -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                </svg>
                Keluhan Pasien
            </div>
            <div class="textarea-display">
                {{ $rekamMedisAktif->reservasi->keluhan ?? 'Faringitis ringan disertai gejala batuk kering dan demam ringan.' }}
            </div>

            <!-- Riwayat Alergi -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                Riwayat Alergi
            </div>
            <div class="textarea-display">
                {{ $rekamMedisAktif->alergi ?? '-' }}
            </div>

            <!-- Diagnosa -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
                Diagnosa
            </div>
            <div class="textarea-display">
                {{ $rekamMedisAktif->diagnosa }}
            </div>

            <!-- Saran -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                Saran
            </div>
            <div class="textarea-display">
                {{ $rekamMedisAktif->saran }}
            </div>

            <!-- Rencana Tindak Lanjut -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Rencana Tindak Lanjut
            </div>
            <div class="textarea-display">
                {{ $rekamMedisAktif->rencana_tindak_lanjut }}
            </div>

            <!-- Resep Obat -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                </svg>
                Resep Obat
            </div>
            <div class="textarea-display">
                {{ $rekamMedisAktif->resep_obat }}
            </div>

            <!-- Catatan Tambahan -->
            <div class="section-title">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                Catatan Tambahan
            </div>
            <div class="textarea-display">
                {{ $rekamMedisAktif->catatan_tambahan ?? '-' }}
            </div>
        </div>
        @else
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h2>Belum Ada Rekam Medis</h2>
            <p>Silakan lakukan pemeriksaan terlebih dahulu</p>
        </div>
        @endif
    </div>
</div>

<script>
const pasienId = @json(request('pasien_id'));

function loadRekamMedis(id) {
    // Remove active class from all items
    document.querySelectorAll('.riwayat-item').forEach(item => {
        item.classList.remove('active');
    });
    
    // Add active class to clicked item
    document.getElementById('item-' + id).classList.add('active');
    
    // Reload page with selected rekam medis
    let targetUrl = "{{ route('dokter.riwayat_rekam_medis') }}?id=" + id;
    if (pasienId) {
        targetUrl += "&pasien_id=" + pasienId;
    }
    window.location.href = targetUrl;
}
</script>

@endsection
