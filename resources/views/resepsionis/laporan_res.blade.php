@extends('layouts.laporan_resepsionis')

@section('content')
<div class="main">
    <div class="judul">
        <h3>Laporan</h3>
    </div>

    <form method="GET" action="{{ route('resepsionis.laporan_res') }}">
        <div class="header">
            <div class="header-left">
                <input id="tanggalInput" 
                        class="date-selector"
                        type="date" 
                        name="tanggal" 
                        value="{{ $tanggal_dipilih->format('Y-m-d') }}">
            </div>
            <div class="header-right">
                <div class="search">
                    <input id="searchInput" 
                        type="text" 
                        name="search" 
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama pasien..."
                        autocomplete="off">
                </div>
                <button type="submit" class="btn-filter">
                   Filter
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
                            <i class="ri-whatsapp-fill" style="color: #00C42E; font-size: 30px; margin-left: 10px;"></i>
                        </a>
                    </div>

                    <div class="patient-action">
                        @if($reservasi->status == 'selesai' && $reservasi->rekam_medis)
                            <button class="btn-detail" onclick="openPasienModal({{ $reservasi->data_pasien->id }})">
                                <i class="fas fa-eye"></i> Lebih Detail
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
<div id="pasienOverlay" class="pasien-overlay" hidden>
    <div id="pasienBox" role="dialog" aria-modal="true" aria-labelledby="pasienTitle" class="pasien-box">
        <div class="pasien-header">
            <button type="button" class="pasien-close-btn" onclick="closePasienModal()"><i class="ri-close-line"></i></button>
            <h3 id="pasienTitle" class="pasien-title">Biodata Pasien</h3>
        </div>

        <div id="pasien-loading" class="pasien-loading">Memuat data…</div>
        <div id="pasien-error" class="pasien-error">Terjadi kesalahan saat memuat data.</div>

        <div id="pasien-content" hidden class="pasien-content">
            <div class="pasien-biodata">
                <div class="col-foto">
                    <div id="lap-avatar" class="avatar-biodata" style="width:72px;height:72px;border-radius:9999px;overflow:hidden;"></div>
                </div>

                <div class="col-data">
                    <div class="pasien-identitas">
                        <div class="pasien-identitas-title">
                            Nama
                            <span id="p-nama-pasien" class="pasien-identitas-nama">-</span>
                        </div>
                        <div class="divider-identitas">|</div>
                        <div class="pasien-identitas-title">
                            Wali
                            <span id="p-nama-wali" class="pasien-identitas-nama">-</span>
                        </div>
                    </div>
                    
                    <div class="pasien-detail">
                        <div class="pasien-detail-label">
                            <strong>Jenis Kelamin</strong>
                            <span id="p-jenis-kelamin-pasien">-</span>
                        </div>
                        <div class="pasien-detail-label">
                            <strong>Tanggal Lahir</strong>
                            <span id="p-tanggal-lahir-pasien">-</span>
                        </div>
                        <div class="pasien-detail-label">
                            <strong>Umur</strong>
                            <span id="p-umur">-</span>
                        </div>
                        <div class="pasien-detail-label">
                            <strong>Gol. Darah</strong>
                            <span id="p-golongan-darah">-</span>
                        </div>
                        <div class="pasien-detail-label">
                            <strong>Pekerjaan</strong>
                            <span id="p-pekerjaan">-</span>
                        </div>
                        <div class="pasien-detail-label">
                            <strong>Alamat</strong>
                            <span id="p-alamat">-</span>
                        </div>
                        <div class="pasien-detail-label">
                            <strong>No. Telepon</strong>
                            <span id="p-no-telepon">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pasien-catatan">
                <strong>Catatan Pasien</strong> <br>
                <span id="p-catatan-pasien">-</span>
            </div>
        </div>

        <div class="pasien-button">
            <a href="#" class="btn-rekam-medis">Lihat Rekam Medis</a>
        </div>
    </div>
</div>

<script>
const assetBase = "{{ asset('') }}";
// ========================================
// AJAX SEARCH (TANPA RELOAD HALAMAN)
// ========================================
(function() {
    const searchInput = document.getElementById('searchInput');
    const tanggalInput = document.getElementById('tanggalInput');
    const tableContainer = document.getElementById('tableContainer');
    let searchTimeout;

    // Fungsi untuk melakukan pencarian dengan AJAX
    function doSearch() {
        const searchValue = searchInput.value.trim();
        const tanggal = tanggalInput.value;

        // Buat URL untuk AJAX request
        const url = new URL(window.location.origin + '{{ route("resepsionis.laporan_res") }}');
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
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            if (data.success) {
                updateTable(data.data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            tableContainer.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>Terjadi kesalahan saat memuat data</p>
                </div>
            `;
        });
    }

    // Fungsi untuk update tabel dengan data hasil search
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
                    </div>
                    <div class="patient-contact">
                        <a href="https://wa.me/${reservasi.no_telepon}" target="_blank" class="whatsapp-btn">
                            <i class="ri-whatsapp-fill" style="color: #00C42E; font-size: 30px; margin-left: 10px;"></i>
                        </a>
                    </div>
                    <div class="patient-action">${actionButton}</div>
                    <div class="patient-status">${statusBadge}</div>
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
            return `<button class="btn-detail" onclick="openPasienModal(${reservasi.id_pasien})">
                        <i class="fas fa-eye"></i> Lebih Detail
                    </button>`;
        } else if (reservasi.status === 'batal') {
            return '<button class="btn-cancel" disabled>Dibatalkan</button>';
        } else {
            return '<button class="btn-detail2" disabled>Belum Selesai</button>';
        }
    }

    // Event listener untuk search input (dengan debounce)
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(doSearch, 300); // Delay 300ms
    });

    // Clear search dengan ESC
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            e.preventDefault();
            searchInput.value = '';
            doSearch();
        }
    });

    // PENTING: Tanggal input TIDAK pakai AJAX, langsung submit form
    // Tidak ada event listener untuk tanggalInput.addEventListener('change')
})();

// ========================================
// AUTO-RELOAD HANYA UNTUK HARI INI
// ========================================
@if($tanggal_dipilih->isToday())
setInterval(() => {
    // Jangan reload jika modal sedang terbuka
    const modal = document.getElementById('pasienOverlay');
    if (modal && !modal.hidden) return;
    
    location.reload();
}, 30000); // Reload setiap 30 detik
@endif

// ========================================
// MODAL BIODATA PASIEN
// ========================================
function openPasienModal(pasienId) {
    const overlay = document.getElementById('pasienOverlay');
    const loadEl  = document.getElementById('pasien-loading');
    const errEl   = document.getElementById('pasien-error');
    const cntEl   = document.getElementById('pasien-content');

    // Reset display
    errEl.textContent = '';
    errEl.style.display = 'none';
    loadEl.hidden = false;
    cntEl.hidden  = true;
    renderLapAvatar(null, '');

    // Show overlay
    overlay.hidden = false;
    document.body.style.overflow = 'hidden';

    // URL ke controller detail_pasien
    const url = "{{ route('resepsionis.pasien.detail', ['id' => '__ID__']) }}".replace('__ID__', pasienId);

    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(async (response) => {
        const text = await response.text();
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${text.substring(0, 200)}`);
        }
        try { return JSON.parse(text); }
        catch { throw new Error('Response bukan JSON: ' + text.substring(0, 200)); }
    })
    .then((data) => {
        // Isi konten modal
        document.getElementById('p-nama-pasien').textContent = data.nama_pasien ?? '-';
        document.getElementById('p-nama-wali').textContent = data.nama_wali ?? '-';
        document.getElementById('p-jenis-kelamin-pasien').textContent = data.jenis_kelamin_pasien ?? '-';
        document.getElementById('p-tanggal-lahir-pasien').textContent = data.tanggal_lahir_pasien ?? '-';
        document.getElementById('p-umur').textContent = (data.umur != null) ? (data.umur + ' tahun') : '-';
        document.getElementById('p-golongan-darah').textContent = data.golongan_darah ?? '-';
        document.getElementById('p-pekerjaan').textContent = data.pekerjaan ?? '-';
        document.getElementById('p-alamat').textContent = data.alamat ?? '-';
        document.getElementById('p-no-telepon').textContent = data.no_telepon ?? '-';
        document.getElementById('p-catatan-pasien').textContent = data.catatan_pasien ?? '-';
        renderLapAvatar(data.foto_path ?? null, data.nama_pasien ?? '-');

        loadEl.hidden = true;
        cntEl.hidden  = false;
    })
    .catch((error) => {
        console.error('Fetch error:', error);
        loadEl.hidden = true;
        errEl.textContent = 'Gagal memuat detail pasien: ' + error.message;
        errEl.style.display = 'block';
    });

    // Tutup saat klik area luar
    overlay.onclick = function (ev) {
        if (ev.target === overlay) closePasienModal();
    };

    // Tutup dengan ESC
    document.addEventListener('keydown', escCloserPasien);
}

function escCloserPasien(ev) {
    if (ev.key === 'Escape') {
        closePasienModal();
    }
}

function closePasienModal() {
    const overlay = document.getElementById('pasienOverlay');
    overlay.hidden = true;
    document.body.style.overflow = '';
    document.removeEventListener('keydown', escCloserPasien);
}

function renderLapAvatar(fotoPath, namaPasien) {
    const avatarEl = document.getElementById('lap-avatar');
    if (!avatarEl) return;

    const initial = (namaPasien || '?').toString().trim().charAt(0).toUpperCase() || '?';
    if (fotoPath) {
        const fotoUrl = fotoPath.startsWith('http') ? fotoPath : assetBase + fotoPath;
        avatarEl.innerHTML = `
            <img 
                src="${fotoUrl}" 
                alt="${namaPasien || 'Pasien'}"
                style="width:100%;height:100%;object-fit:cover;"
                onerror="this.onerror=null; this.parentElement.innerHTML='<div style=&quot;width:100%;height:100%;background:linear-gradient(135deg,#60a5fa,#2563eb);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;&quot;>${initial}</div>';"
            >
        `;
    } else {
        avatarEl.innerHTML = `
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#60a5fa,#2563eb);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;">
                ${initial}
            </div>
        `;
    }
}
</script>
@endsection
