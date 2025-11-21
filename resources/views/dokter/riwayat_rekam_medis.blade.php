<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis - {{ $rekamMedisAktif->nomor_rekam_medis }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 0;
            margin: 0;
        }

        /* Wrapper untuk layout */
        .page-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Container untuk preview */
        .container {
            flex: 1;
            max-width: 100%;
            margin: 0;
            background: white;
            padding: 0;
            overflow-y: auto;
        }

        /* Tombol aksi - hidden saat print */
        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-preview {
            background-color: #3B82F6;
            color: white;
        }

        .btn-preview:hover {
            background-color: #2563EB;
        }

        .btn-print {
            background-color: #10B981;
            color: white;
        }

        .btn-print:hover {
            background-color: #059669;
        }

        /* Dokumen rekam medis */
        .document {
            background: white;
            padding: 40px;
            box-shadow: none;
            min-height: 100vh;
            max-width: 210mm;
            margin: 0 auto;
        }

        /* Header */
        .header {
            text-align: left;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #2563EB;
            font-size: 24px;
            margin-bottom: 0;
        }

        .header .subtitle {
            display: none;
        }

        .nomor-rm {
            display: inline-block;
            background: transparent;
            color: #333;
            padding: 0;
            border-radius: 0;
            font-weight: 400;
            font-size: 13px;
        }

        /* Section */
        .section {
            margin-bottom: 25px;
        }

        .section-title {
            background: transparent;
            padding: 8px 0;
            font-weight: 600;
            color: #333;
            font-size: 13px;
            text-transform: none;
            letter-spacing: 0;
            margin-bottom: 10px;
            margin-top: 15px;
            border-left: none;
            border-bottom: 1px solid #ddd;
        }



        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #E2E8F0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        .signature-box {
            text-align: center;
        }

        .signature-label {
            font-size: 12px;
            color: #64748B;
            margin-bottom: 60px;
        }

        .signature-name {
            font-weight: 700;
            color: #1E293B;
            padding-top: 10px;
            border-top: 2px solid #1E293B;
        }

        /* Layout dua kolom untuk data */
        .data-row {
            display: grid;
            grid-template-columns: 200px 1fr 200px 1fr;
            gap: 10px 20px;
            margin-bottom: 10px;
            align-items: center;
        }

        .data-row .data-label {
            text-align: left;
            font-size: 13px;
            color: #333;
            font-weight: 500;
            background: none;
            padding: 0;
            border: none;
        }

        .data-row .data-value {
            font-size: 13px;
            color: #000;
            padding: 6px 10px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .data-row.full-row {
            grid-template-columns: 200px 1fr;
        }

        .data-row.full-row .data-value {
            grid-column: 2 / -1;
        }

        /* Style untuk textarea yang lebih tinggi */
        .data-row.textarea-row {
            grid-template-columns: 1fr;
            align-items: start;
        }

        .data-row.textarea-row .data-label {
            display: none;
        }

        .data-row.textarea-row .data-value {
            min-height: 80px;
            grid-column: 1 / -1;
        }

        /* Print styles */
        @media print {
            body {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* Sembunyikan semua kecuali container */
            .page-wrapper > *:not(.container) {
                display: none !important;
            }

            /* Sembunyikan sidebar dan buttons */
            .sidebar-riwayat,
            .action-buttons,
            .rekam-medis-container {
                display: none !important;
            }

            /* Container full width untuk print */
            .page-wrapper {
                display: block !important;
                background: white !important;
            }

            .container {
                max-width: 100% !important;
                width: 100% !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
            }

            .document {
                box-shadow: none !important;
                padding: 15mm !important;
                margin: 0 !important;
                max-width: 100% !important;
            }

            /* Hindari page break di tengah section */
            .section {
                page-break-inside: avoid;
            }

            /* Ukuran kertas A4 dengan margin */
            @page {
                size: A4 portrait;
                margin: 10mm;
            }

            /* Reset header untuk print */
            .header {
                margin-bottom: 15px;
                padding-bottom: 10px;
            }
        }

        /* Responsive untuk layar kecil */
        @media (max-width: 768px) {
            .page-wrapper {
                flex-direction: column;
            }

            .sidebar-riwayat {
                width: 100%;
            }

            .data-row {
                grid-template-columns: 1fr;
            }

            .data-row.full-row {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                position: static;
                margin-bottom: 20px;
                justify-content: center;
            }

            .document {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Tombol Aksi -->
    <div class="action-buttons">
        <button class="btn btn-preview" onclick="previewPDF()">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
            </svg>
            Preview
        </button>
        <button class="btn btn-print" onclick="window.print()">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"/>
            </svg>
            Print / PDF
        </button>
    </div>

    <!-- WRAPPER: sidebar kiri + dokumen kanan -->
    <div class="page-wrapper">
        <!-- SIDEBAR RIWAYAT -->
        <aside class="sidebar-riwayat">
            <h2>Riwayat Rekam Medis</h2>

            @foreach($riwayatRekamMedis as $rekam)
                <button type="button"
                        class="riwayat-item {{ optional($rekamMedisAktif)->id === $rekam->id ? 'active' : '' }}"
                        onclick="loadRekamMedis({{ $rekam->id }})">
                    <div class="riwayat-item-tanggal">
                        {{ \Carbon\Carbon::parse($rekam->created_at)->format('j F Y') }}
                    </div>
                    <div class="riwayat-item-subtitle">
                        Ketuk untuk melihat lebih detail tentang riwayat rekam medis
                    </div>
                </button>
            @endforeach
        </aside>

        <!-- AREA DOKUMEN (KANAN) -->
        <div class="container">
            <div class="document">
                @if($rekamMedisAktif)
                <!-- Header -->
                <div class="header">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="18" fill="#2563EB"/>
                            <path d="M20 10v20M10 20h20" stroke="white" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                        <h1>WarasWaris</h1>
                    </div>
                    <div class="nomor-rm">Nomor Rekam Medis: {{ $rekamMedisAktif->nomor_rekam_medis }}</div>
                </div>

                <!-- Biodata Pasien -->
                <div class="section">
                    <div class="section-title">Nama Pasien</div>
                    
                    <div class="data-row">
                        <div class="data-label">Nama Pasien</div>
                        <div class="data-value">{{ $pasienData->nama_pasien }}</div>
                        <div class="data-label">Golongan Darah</div>
                        <div class="data-value">{{ $pasienData->golongan_darah ?? 'A+' }}</div>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Tanggal Lahir</div>
                        <div class="data-value">
                            {{ \Carbon\Carbon::parse($pasienData->tanggal_lahir_pasien)->format('d-m-Y') }}
                            / {{ $pasienData->umur }} tahun
                        </div>
                        <div class="data-label">Pekerjaan</div>
                        <div class="data-value">{{ $pasienData->pekerjaan ?? 'Petani' }}</div>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Jenis Kelamin</div>
                        <div class="data-value">{{ $pasienData->jenis_kelamin }}</div>
                        <div class="data-label">No. Telepon</div>
                        <div class="data-value">{{ $pasienData->no_telepon ?? '-' }}</div>
                    </div>

                    <div class="data-row full-row">
                        <div class="data-label">Alamat</div>
                        <div class="data-value">{{ $pasienData->alamat }}</div>
                    </div>
                </div>

                <!-- Data Dokter -->
                <div class="section">
                    <div class="section-title">Nama Dokter</div>
                    
                    <div class="data-row full-row">
                        <div class="data-label">Nama Dokter</div>
                        <div class="data-value">{{ $dokterData->nama_dokter }}</div>
                    </div>

                    <div class="data-row full-row">
                        <div class="data-label">Alamat</div>
                        <div class="data-value">{{ $dokterData->alamat }}</div>
                    </div>
                </div>

                <!-- Pemeriksaan Fisik -->
                <div class="section">
                    <div class="section-title">Pemeriksaan Fisik</div>
                    
                    <div class="data-row">
                        <div class="data-label">Tekanan Darah</div>
                        <div class="data-value">{{ $rekamMedisAktif->tekanan_darah }} mmHg</div>
                        <div class="data-label">Tinggi Badan</div>
                        <div class="data-value">{{ $rekamMedisAktif->tinggi_badan }} cm</div>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Suhu Tubuh</div>
                        <div class="data-value">{{ $rekamMedisAktif->suhu }} °C</div>
                        <div class="data-label">Berat Badan</div>
                        <div class="data-value">{{ $rekamMedisAktif->berat_badan }} kg</div>
                    </div>
                </div>

                <!-- Keluhan Pasien -->
                <div class="section">
                    <div class="section-title">Keluhan Pasien</div>
                    <div class="data-row textarea-row">
                        <div class="data-value">
                            {{ $rekamMedisAktif->reservasi->keluhan ?? 'Faringitis ringan disertai gejala batuk kering dan demam ringan.' }}
                        </div>
                    </div>
                </div>

                <!-- Diagnosa & Saran -->
                <div class="section">
                    <div class="section-title">Diagnosa</div>
                    <div class="data-row textarea-row">
                        <div class="data-value">{{ $rekamMedisAktif->diagnosa }}</div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">Saran</div>
                    <div class="data-row textarea-row">
                        <div class="data-value">{{ $rekamMedisAktif->saran }}</div>
                    </div>
                </div>

                <!-- Rencana Tindak Lanjut & Riwayat Alergi -->
                <div class="section">
                    <div class="section-title">Rencana Tindak Lanjut</div>
                    <div class="data-row textarea-row">
                        <div class="data-value">{{ $rekamMedisAktif->rencana_tindak_lanjut }}</div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-title">Riwayat Alergi</div>
                    <div class="data-row textarea-row">
                        <div class="data-value">{{ $rekamMedisAktif->alergi ?? '-' }}</div>
                    </div>
                </div>

                <!-- Catatan Tambahan -->
                <div class="section">
                    <div class="section-title">Catatan Tambahan</div>
                    <div class="data-row textarea-row">
                        <div class="data-value">{{ $rekamMedisAktif->catatan_tambahan ?? '-' }}</div>
                    </div>
                </div>
                @else
                    <p>Tidak ada rekam medis yang dipilih.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function previewPDF() {
            window.print();
        }

        function loadRekamMedis(id) {
            const currentUrl = window.location.href.split('?')[0];
            window.location.href = currentUrl + '?id=' + id;
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
            const container = document.querySelector('.container');
            if (container) {
                container.scrollTop = 0;
            }
        });
    </script>
</body>

</html>