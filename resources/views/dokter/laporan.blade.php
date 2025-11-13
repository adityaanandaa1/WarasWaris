@extends('layouts.laporan')

@section('content')
<div class="main">
    <div class="judul">
        <h3>Laporan</h3>
    </div>

    <form method="GET" action="{{ route('dokter.laporan') }}">
        <div class="header">
            <div class="header-left">
                <div class="date-selector">
                    <input id="tanggalInput" type="date" 
                            name="tanggal" 
                            value="{{ $tanggal_dipilih->format('Y-m-d') }}">
                </div>
            </div>
            <div class="header-right">
                <div class="search">
                    <input id="searchInput" 
                        type="text" 
                        name="search" 
                        value="{{ $search ?? '' }}"
                        placeholder="Cari"
                        autocomplete="off">
                </div>
            </div>

            <div class="button">
                <button type="submit">
                    <i class="fas fa-search"></i>filter
                </button>
            </div>
        </div>
    </form>

    <div class="stats-container">
        <div class="stat-card jam-praktik">
            <div class="stat-header">Jam Praktik</div>
            <div class="stat-value time-value">
                @if($jadwal && $jadwal->is_active)
                    {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                @else
                    LIBUR
                @endif
            </div>
        </div>

        <div class="stat-card total-reservasi-card">
            <div class="stat-header">Total Reservasi</div>
            <div class="stat-value highlight-pink">{{ $total_reservasi }}</div>
        </div>

        <div class="stat-card pasien-terlayani-card">
            <div class="stat-header">Pasien Terlayani</div>
            <div class="stat-value highlight-ungu">{{ $pasien_terlayani }}</div>
        </div>

        <div class="stat-card pasien-tidak-datang-card">
            <div class="stat-header">Pasien Tidak Datang</div>
            <div class="stat-value highlight-biru">{{ $pasien_tidak_datang }}</div>
        </div>
    </div>

    <div class="patient-list-container">
        <div id="tableContainer">
            @if($daftar_reservasi->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Tidak ada data pasien pada tanggal ini</p>
                </div>
            @else
                @foreach($daftar_reservasi as $reservasi)
                <div class="patient-card">
                    <div class="patient-number">{{ $reservasi->nomor_antrian }}</div>
                    <div class="patient-info">
                        <div class="patient-name">{{ $reservasi->data_pasien->nama_pasien }}</div>
                    </div>
                    <div class="patient-contact">
                        <a href="https://wa.me/{{ $reservasi->data_pasien->no_telepon }}" target="_blank" class="whatsapp-btn">
                            <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 0C29.4937 0 38 8.50629 38 19C38 29.4937 29.4937 38 19 38C15.6422 38.0058 12.3435 37.1171 9.44302 35.4255L0.00762936 38L2.57643 28.5608C0.88345 25.6593 -0.00585509 22.3592 2.90105e-05 19C2.90105e-05 8.50629 8.50633 0 19 0ZM12.5248 10.07L12.1448 10.0852C11.8991 10.1021 11.6591 10.1667 11.438 10.2752C11.232 10.3921 11.0439 10.538 10.8794 10.7084C10.6514 10.9231 10.5222 11.1093 10.3835 11.2898C9.68075 12.2035 9.30237 13.3253 9.30812 14.478C9.31192 15.409 9.55512 16.3153 9.93512 17.1627C10.7122 18.8765 11.9909 20.691 13.6781 22.3725C14.0847 22.7772 14.4837 23.1838 14.9131 23.5619C17.0096 25.4075 19.5078 26.7386 22.2091 27.4493L23.2883 27.6146C23.6398 27.6336 23.9913 27.607 24.3447 27.5899C24.898 27.5607 25.4381 27.4109 25.9274 27.151C26.176 27.0224 26.4188 26.883 26.6551 26.733C26.6551 26.733 26.7355 26.6785 26.8926 26.562C27.1491 26.372 27.3068 26.2371 27.5196 26.0148C27.6792 25.8501 27.8122 25.6588 27.9186 25.441C28.0668 25.1313 28.215 24.5404 28.2758 24.0483C28.3214 23.6721 28.3081 23.4669 28.3024 23.3396C28.2948 23.1363 28.1257 22.9254 27.9414 22.8361L26.8356 22.3402C26.8356 22.3402 25.1826 21.6201 24.1718 21.1603C24.066 21.1142 23.9527 21.0878 23.8374 21.0824C23.7074 21.0688 23.576 21.0833 23.4521 21.1249C23.3282 21.1666 23.2146 21.2343 23.1192 21.3237C23.1097 21.3199 22.9824 21.4282 21.6087 23.0926C21.5299 23.1985 21.4213 23.2786 21.2967 23.3226C21.1722 23.3666 21.0374 23.3725 20.9095 23.3396C20.7857 23.3066 20.6644 23.2647 20.5466 23.2142C20.311 23.1154 20.2293 23.0774 20.0678 23.009C18.977 22.5338 17.9673 21.8908 17.0753 21.1033C16.8359 20.8943 16.6136 20.6663 16.3856 20.4459C15.6382 19.73 14.9867 18.9202 14.4476 18.0367L14.3355 17.8562C14.2562 17.7342 14.1912 17.6035 14.1417 17.4667C14.0695 17.1874 14.2576 16.9632 14.2576 16.9632C14.2576 16.9632 14.7193 16.4578 14.934 16.1842C15.143 15.9182 15.3197 15.6598 15.4337 15.4755C15.6579 15.1145 15.7282 14.744 15.6104 14.4571C15.0784 13.1575 14.5287 11.8649 13.9612 10.5792C13.8491 10.3246 13.5166 10.1422 13.2145 10.1061C13.1119 10.0934 13.0093 10.0833 12.9067 10.0757C12.6516 10.0611 12.3958 10.0636 12.141 10.0833L12.5248 10.07Z" fill="#00C42E" fill-opacity="0.65"/>
                            </svg>
                        </a>
                    </div>

                    <div class="patient-action">
                        @if($reservasi->status == 'selesai' && $reservasi->rekam_medis)
                            <button class="btn-detail" onclick="lihatRekamMedis({{ $reservasi->rekam_medis->id }})">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </button>
                        @elseif($reservasi->status == 'batal')
                            <button class="btn-cancel" disabled>
                                Dibatalkan
                            </button>
                        @else
                            <button class="btn-detail2" disabled>
                                Belum Selesai
                            </button>
                        @endif
                    </div>

                    <div class="patient-status">
                        @switch($reservasi->status)
                            @case('menunggu')
                                <span class="status-badge status-waiting">Sisa Reservasi</span>
                                @break
                            @case('sedang_dilayani')
                                <span class="status-badge status-progress">Sedang Dilayani</span>
                                @break
                            @case('selesai')
                                <span class="status-badge status-complete">Selesai</span>
                                @break
                            @case('batal')
                                <span class="status-badge status-cancel">Dibatalkan</span>
                                @break
                        @endswitch
                    </div>

                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Modal Rekam Medis -->
<div id="modalRekamMedis" class="modal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detail Rekam Medis</h3>
            <button class="modal-close" onclick="tutupModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="kontenModal" class="modal-body">
        </div>
    </div>
</div>
<!-- Link ke file CSS eksternal -->
<link rel="stylesheet" href="{{ asset('css/laporan-pemeriksaan.css') }}">

<script>
// Real-time AJAX Search
(function() {
    const searchInput = document.getElementById('searchInput');
    const tanggalInput = document.getElementById('tanggalInput');
    const tableContainer = document.getElementById('tableContainer');
    let searchTimeout;

    // Fungsi untuk melakukan pencarian
    function doSearch() {
        const searchValue = searchInput.value.trim();
        const tanggal = tanggalInput.value;

        // Update URL tanpa reload
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set('tanggal', tanggal);
        if (searchValue) {
            newUrl.searchParams.set('search', searchValue);
        } else {
            newUrl.searchParams.delete('search');
        }
        window.history.pushState({}, '', newUrl);

        // Buat URL untuk AJAX request
        const url = new URL("{{ route('dokter.laporan') }}", window.location.origin);
        url.searchParams.set('tanggal', tanggal);
        if (searchValue) {
            url.searchParams.set('search', searchValue);
        }

        // Kirim AJAX request
        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateTable(data.data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Fungsi untuk update tabel
    function updateTable(data) {
        if (data.length === 0) {
            tableContainer.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Tidak ada data pasien yang sesuai</p>
                </div>
            `;
            return;
        }

        let cards = '';
        data.forEach(reservasi => {
            const statusBadge = getStatusBadge(reservasi.status);
            const actionButton = getActionButton(reservasi);

            cards += `
                <div class="patient-card">
                    <div class="patient-number">${reservasi.nomor_antrian}</div>
                    <div class="patient-info">
                        <div class="patient-name">${reservasi.nama_pasien}</div>
                        <div class="patient-meta">${reservasi.jenis_kelamin}, ${reservasi.umur} tahun</div>
                    </div>
                    <div class="patient-contact">
                        <a href="https://wa.me/${reservasi.no_telepon}" target="_blank" class="whatsapp-btn">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                    <div class="patient-status">${statusBadge}</div>
                    <div class="patient-action">${actionButton}</div>
                </div>
            `;
        });

        tableContainer.innerHTML = cards;
    }

    function getStatusBadge(status) {
        switch(status) {
            case 'menunggu':
                return '<span class="status-badge status-waiting">Sisa Reservasi</span>';
            case 'sedang_dilayani':
                return '<span class="status-badge status-progress">Sedang Dilayani</span>';
            case 'selesai':
                return '<span class="status-badge status-complete">Selesai</span>';
            case 'batal':
                return '<span class="status-badge status-cancel">Dibatalkan</span>';
            default:
                return '';
        }
    }

    function getActionButton(reservasi) {
        if (reservasi.status === 'selesai' && reservasi.rekam_medis_id) {
            return `<button class="btn-detail" onclick="lihatRekamMedis(${reservasi.rekam_medis_id})">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </button>`;
        } else if (reservasi.status === 'batal') {
            return '<button class="btn-cancel" disabled>Dibatalkan</button>';
        } else {
            return '<button class="btn-detail" disabled>Belum Selesai</button>';
        }
    }

    // Event listeners
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(doSearch, 300);
    });

    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            e.preventDefault();
            searchInput.value = '';
            doSearch();
        }
    });

    tanggalInput.addEventListener('change', function() {
        doSearch();
    });
})();

function lihatRekamMedis(id) {
    const modal = document.getElementById('modalRekamMedis');
    const konten = document.getElementById('kontenModal');
    
    modal.style.display = 'flex';
    konten.innerHTML = '<div style="text-align:center;padding:40px;"><i class="fas fa-spinner fa-spin" style="font-size:32px;color:#5A81FA;"></i><p style="margin-top:16px;color:#718096;">Memuat data...</p></div>';
    
    fetch(`/dokter/rekam-medis/${id}/detail`)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const rm = data.data;
                konten.innerHTML = `
                    <div style="display:flex;flex-direction:column;gap:20px;">
                        <div style="padding:16px;background:#F7FAFC;border-radius:12px;">
                            <div style="font-size:12px;color:#718096;margin-bottom:4px;">Nomor Rekam Medis</div>
                            <div style="font-size:16px;font-weight:600;color:#2D3748;">${rm.nomor_rekam_medis}</div>
                        </div>
                        
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                            <div>
                                <div style="font-size:12px;color:#718096;margin-bottom:4px;">Nama Pasien</div>
                                <div style="font-size:14px;font-weight:600;color:#2D3748;">${rm.data_pasien.nama_pasien}</div>
                            </div>
                            <div>
                                <div style="font-size:12px;color:#718096;margin-bottom:4px;">Tanggal Pemeriksaan</div>
                                <div style="font-size:14px;font-weight:600;color:#2D3748;">${new Date(rm.tanggal_pemeriksaan).toLocaleDateString('id-ID')}</div>
                            </div>
                        </div>
                        
                        <div>
                            <div style="font-size:14px;font-weight:600;color:#2D3748;margin-bottom:12px;">Data Vital</div>
                            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:12px;">
                                <div style="padding:12px;background:#F7FAFC;border-radius:8px;">
                                    <div style="font-size:11px;color:#718096;">Tinggi Badan</div>
                                    <div style="font-size:16px;font-weight:600;color:#2D3748;">${rm.tinggi_badan} cm</div>
                                </div>
                                <div style="padding:12px;background:#F7FAFC;border-radius:8px;">
                                    <div style="font-size:11px;color:#718096;">Berat Badan</div>
                                    <div style="font-size:16px;font-weight:600;color:#2D3748;">${rm.berat_badan} kg</div>
                                </div>
                                <div style="padding:12px;background:#F7FAFC;border-radius:8px;">
                                    <div style="font-size:11px;color:#718096;">Tekanan Darah</div>
                                    <div style="font-size:16px;font-weight:600;color:#2D3748;">${rm.tekanan_darah}</div>
                                </div>
                                <div style="padding:12px;background:#F7FAFC;border-radius:8px;">
                                    <div style="font-size:11px;color:#718096;">Suhu</div>
                                    <div style="font-size:16px;font-weight:600;color:#2D3748;">${rm.suhu}°C</div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div style="font-size:14px;font-weight:600;color:#2D3748;margin-bottom:8px;">Diagnosa</div>
                            <div style="padding:12px;background:#F7FAFC;border-radius:8px;font-size:14px;color:#2D3748;line-height:1.6;">${rm.diagnosa}</div>
                        </div>
                        
                        <div>
                            <div style="font-size:14px;font-weight:600;color:#2D3748;margin-bottom:8px;">Saran</div>
                            <div style="padding:12px;background:#F7FAFC;border-radius:8px;font-size:14px;color:#2D3748;line-height:1.6;">${rm.saran}</div>
                        </div>
                        
                        ${rm.resep_obat ? `
                            <div>
                                <div style="font-size:14px;font-weight:600;color:#2D3748;margin-bottom:8px;">Resep Obat</div>
                                <div style="padding:12px;background:#F7FAFC;border-radius:8px;font-size:14px;color:#2D3748;line-height:1.6;">${rm.resep_obat}</div>
                            </div>
                        ` : ''}
                    </div>
                `;
            }
        })
        .catch(error => {
            konten.innerHTML = '<div style="text-align:center;padding:40px;"><i class="fas fa-exclamation-circle" style="font-size:32px;color:#EF4444;"></i><p style="margin-top:16px;color:#718096;">Gagal memuat data</p></div>';
        });
}

function tutupModal() {
    document.getElementById('modalRekamMedis').style.display = 'none';
}

@if($tanggal_dipilih->isToday())
setInterval(() => {
    if(document.getElementById('modalRekamMedis').style.display !== 'none') return;
    location.reload();
}, 30000);
@endif
</script>
@endsection