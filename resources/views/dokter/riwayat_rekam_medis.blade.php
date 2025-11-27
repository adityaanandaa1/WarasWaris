@extends('layouts.dokter_modal')

@section('title', 'Rekam Medis - {{ $rekamMedisAktif->nomor_rekam_medis }}')

<div class="medicalrecord-wrapper">
    <!-- Tombol Aksi -->
    <div class="medicalrecord-action-buttons">
        <button class="medicalrecord-btn-print" onclick="window.print()">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/>
            </svg>
            Print / PDF
        </button>
    </div>

    <!-- WRAPPER: sidebar kiri + dokumen kanan -->
    <div class="medicalrecord-page">
        <!-- SIDEBAR RIWAYAT -->
        <div class="medicalrecord-sidebar">
            <div class="medicalrecord-sidebar-header">
                <a href="{{ route('dokter.daftar_pasien') }}" class="medicalrecord-sidebar-back">
                    <i class="ri-arrow-left-line"></i>
                </a>
                <h2 class="medicalrecord-sidebar-title">Riwayat Rekam Medis</h2>
            </div>

            @foreach($riwayatRekamMedis as $rekam)
                <button type="button"
                        class="medicalrecord-sidebar-item {{ optional($rekamMedisAktif)->id === $rekam->id ? 'active' : '' }}"
                        onclick="loadRekamMedis({{ $rekam->id }})">
                    <div class="medicalrecord-sidebar-item-wrapper">
                        <div class="medicalrecord-sidebar-item-date">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_345_2057)">
                                    <path d="M17.917 3.33307H15.6948V4.99974C15.6948 5.16024 15.6632 5.31918 15.6018 5.46746C15.5403 5.61575 15.4503 5.75049 15.3368 5.86398C15.2233 5.97747 15.0886 6.0675 14.9403 6.12892C14.792 6.19035 14.6331 6.22196 14.4726 6.22196C14.3121 6.22196 14.1531 6.19035 14.0049 6.12892C13.8566 6.0675 13.7218 5.97747 13.6083 5.86398C13.4948 5.75049 13.4048 5.61575 13.3434 5.46746C13.282 5.31918 13.2504 5.16024 13.2504 4.99974V3.33307H6.77814V4.99974C6.77814 5.32389 6.64937 5.63477 6.42016 5.86398C6.19095 6.09319 5.88007 6.22196 5.55592 6.22196C5.23176 6.22196 4.92088 6.09319 4.69167 5.86398C4.46246 5.63477 4.33369 5.32389 4.33369 4.99974V3.33307H2.11147C1.97926 3.33157 1.84809 3.35659 1.72572 3.40666C1.60335 3.45673 1.49227 3.53084 1.39903 3.62459C1.3058 3.71834 1.23232 3.82983 1.18292 3.95248C1.13353 4.07512 1.10923 4.20643 1.11147 4.33863V16.772C1.10926 16.9018 1.13266 17.0309 1.18033 17.1517C1.228 17.2725 1.299 17.3828 1.38928 17.4761C1.47957 17.5695 1.58736 17.6442 1.70651 17.6959C1.82566 17.7476 1.95382 17.7753 2.08369 17.7775H17.917C18.0469 17.7753 18.1751 17.7476 18.2942 17.6959C18.4134 17.6442 18.5212 17.5695 18.6114 17.4761C18.7017 17.3828 18.7727 17.2725 18.8204 17.1517C18.8681 17.0309 18.8915 16.9018 18.8892 16.772V4.33863C18.8915 4.20876 18.8681 4.07973 18.8204 3.95891C18.7727 3.83808 18.7017 3.72783 18.6114 3.63446C18.5212 3.54108 18.4134 3.4664 18.2942 3.41469C18.1751 3.36298 18.0469 3.33524 17.917 3.33307ZM5.55592 14.4442H4.4448V13.3331H5.55592V14.4442ZM5.55592 11.6664H4.4448V10.5553H5.55592V11.6664ZM5.55592 8.88863H4.4448V7.77752H5.55592V8.88863ZM8.88925 14.4442H7.77814V13.3331H8.88925V14.4442ZM8.88925 11.6664H7.77814V10.5553H8.88925V11.6664ZM8.88925 8.88863H7.77814V7.77752H8.88925V8.88863ZM12.2226 14.4442H11.1115V13.3331H12.2226V14.4442ZM12.2226 11.6664H11.1115V10.5553H12.2226V11.6664ZM12.2226 8.88863H11.1115V7.77752H12.2226V8.88863ZM15.5559 14.4442H14.4448V13.3331H15.5559V14.4442ZM15.5559 11.6664H14.4448V10.5553H15.5559V11.6664ZM15.5559 8.88863H14.4448V7.77752H15.5559V8.88863Z" fill="white"/>
                                    <path d="M5.55556 5.55577C5.7029 5.55577 5.84421 5.49724 5.94839 5.39305C6.05258 5.28887 6.11111 5.14756 6.11111 5.00022V1.66688C6.11111 1.51954 6.05258 1.37823 5.94839 1.27405C5.84421 1.16986 5.7029 1.11133 5.55556 1.11133C5.40821 1.11133 5.26691 1.16986 5.16272 1.27405C5.05853 1.37823 5 1.51954 5 1.66688V5.00022C5 5.14756 5.05853 5.28887 5.16272 5.39305C5.26691 5.49724 5.40821 5.55577 5.55556 5.55577Z" fill="white"/>
                                    <path d="M14.4442 5.55577C14.5916 5.55577 14.7329 5.49724 14.8371 5.39305C14.9413 5.28887 14.9998 5.14756 14.9998 5.00022V1.66688C14.9998 1.51954 14.9413 1.37823 14.8371 1.27405C14.7329 1.16986 14.5916 1.11133 14.4442 1.11133C14.2969 1.11133 14.1556 1.16986 14.0514 1.27405C13.9472 1.37823 13.8887 1.51954 13.8887 1.66688V5.00022C13.8887 5.14756 13.9472 5.28887 14.0514 5.39305C14.1556 5.49724 14.2969 5.55577 14.4442 5.55577Z" fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_345_2057">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            {{ \Carbon\Carbon::parse($rekam->created_at)->format('j F Y') }}
                        </div>
                        <div class="medicalrecord-sidebar-item-content">
                            <p class="medicalrecord-sidebar-item-subtitle">Ketuk untuk melihat lebih detail tentang riwayat rekam medis</p>
                        </div>
                    </div>
                    <i class="ri-arrow-right-s-line"></i>
                </button>
            @endforeach
        </div>

        <!-- AREA DOKUMEN (KANAN) -->
        <div class="medicalrecord-content">
            <div class="medicalrecord-document">
                @if($rekamMedisAktif)
                <!-- Header -->
                <div class="medicalrecord-header">
                    <div class="medicalrecord-header-brand">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        </svg>
                        <h1 class="medicalrecord-header-title">WarasWaris</h1>
                    </div>
                    <div class="medicalrecord-header-number">Nomor Rekam Medis: {{ $rekamMedisAktif->nomor_rekam_medis }}</div>
                </div>

                <!-- Biodata Pasien -->
                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Nama Pasien</div>
                    
                    <div class="medicalrecord-row">
                        <div class="medicalrecord-label">Nama Pasien</div>
                        <div class="medicalrecord-value">{{ $pasienData->nama_pasien }}</div>
                        <div class="medicalrecord-label">Golongan Darah</div>
                        <div class="medicalrecord-value">{{ $pasienData->golongan_darah ?? 'A+' }}</div>
                    </div>

                    <div class="medicalrecord-row">
                        <div class="medicalrecord-label">Tanggal Lahir</div>
                        <div class="medicalrecord-value">
                            {{ \Carbon\Carbon::parse($pasienData->tanggal_lahir_pasien)->format('d-m-Y') }}
                            / {{ $pasienData->umur }} tahun
                        </div>
                        <div class="medicalrecord-label">Pekerjaan</div>
                        <div class="medicalrecord-value">{{ $pasienData->pekerjaan ?? 'Petani' }}</div>
                    </div>

                    <div class="medicalrecord-row">
                        <div class="medicalrecord-label">Jenis Kelamin</div>
                        <div class="medicalrecord-value">{{ $pasienData->jenis_kelamin }}</div>
                        <div class="medicalrecord-label">No. Telepon</div>
                        <div class="medicalrecord-value">{{ $pasienData->no_telepon ?? '-' }}</div>
                    </div>

                    <div class="medicalrecord-row medicalrecord-row-full">
                        <div class="medicalrecord-label">Alamat</div>
                        <div class="medicalrecord-value">{{ $pasienData->alamat }}</div>
                    </div>
                </div>

                <!-- Data Dokter -->
                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Nama Dokter</div>
                    
                    <div class="medicalrecord-row medicalrecord-row-full">
                        <div class="medicalrecord-label">Nama Dokter</div>
                        <div class="medicalrecord-value">{{ $dokterData->nama_dokter }}</div>
                    </div>

                    <div class="medicalrecord-row medicalrecord-row-full">
                        <div class="medicalrecord-label">Alamat</div>
                        <div class="medicalrecord-value">{{ $dokterData->alamat }}</div>
                    </div>
                </div>

                <!-- Pemeriksaan Fisik -->
                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Pemeriksaan Fisik</div>
                    
                    <div class="medicalrecord-row">
                        <div class="medicalrecord-label">Tekanan Darah</div>
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->tekanan_darah }} mmHg</div>
                        <div class="medicalrecord-label">Tinggi Badan</div>
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->tinggi_badan }} cm</div>
                    </div>

                    <div class="medicalrecord-row">
                        <div class="medicalrecord-label">Suhu Tubuh</div>
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->suhu }} °C</div>
                        <div class="medicalrecord-label">Berat Badan</div>
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->berat_badan }} kg</div>
                    </div>
                </div>

                <!-- Keluhan Pasien -->
                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Keluhan Pasien</div>
                    <div class="medicalrecord-row medicalrecord-textarea">
                        <div class="medicalrecord-value">
                            {{ $rekamMedisAktif->reservasi->keluhan ?? 'Faringitis ringan disertai gejala batuk kering dan demam ringan.' }}
                        </div>
                    </div>
                </div>

                <!-- Diagnosa & Saran -->
                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Diagnosa</div>
                    <div class="medicalrecord-row medicalrecord-textarea">
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->diagnosa }}</div>
                    </div>
                </div>

                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Saran</div>
                    <div class="medicalrecord-row medicalrecord-textarea">
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->saran }}</div>
                    </div>
                </div>

                <!-- Rencana Tindak Lanjut & Riwayat Alergi -->
                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Rencana Tindak Lanjut</div>
                    <div class="medicalrecord-row medicalrecord-textarea">
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->rencana_tindak_lanjut }}</div>
                    </div>
                </div>

                <div class="medicalrecord-section">
                    <div class="medicalrecord-section-title">Riwayat Alergi</div>
                    <div class="medicalrecord-row medicalrecord-textarea">
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->alergi ?? '-' }}</div>
                    </div>
                </div>

                <!-- Catatan Tambahan -->
                <div class="medicalrecord-section">
                <div class="medicalrecord-section-title">Catatan Tambahan</div>
                    <div class="medicalrecord-row medicalrecord-textarea">
                        <div class="medicalrecord-value">{{ $rekamMedisAktif->catatan_tambahan ?? '-' }}</div>
                    </div>
                </div>
                @else
                    <p class="medicalrecord-empty">Tidak ada rekam medis yang dipilih.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function previewPDF() {
        window.print();
    }

    function loadRekamMedis(id) {
        const url = new URL(window.location.href);
        url.searchParams.set('id', id); // pasien_id tetap ikut kalau sudah ada
        window.location.href = url.toString();
    }

    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            window.print();
        }
    });

    window.addEventListener('beforeprint', function() {
        const now = new Date();
        const dateStr = now.toLocaleDateString('id-ID', { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        console.log('Dokumen dicetak pada: ' + dateStr);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.medicalrecord-content');
        if (container) {
            container.scrollTop = 0;
        }
    });
</script>