@extends('layouts.antrean')

@section('content')

<style>
    /* Sembunyikan elemen dengan atribut hidden */
  [hidden] { display: none !important; }

  /* Overlay layar penuh */
  #reservasiOverlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.5);
    z-index: 9999;
    display: flex; align-items: center; justify-content: center;
  }

  /* Kotak modal sederhana */
  #reservasiBox {
    background: #fff;
    width: 90%; max-width: 600px;
    padding: 16px;
    border-radius: 8px;
  }
</style>

<div class="parent">
        <div class="header-date"> 
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_291_1315)">
                    <path d="M24.9478 4.64169H21.8535V6.96243C21.8535 7.18592 21.8095 7.40722 21.724 7.61371C21.6384 7.82019 21.5131 8.0078 21.355 8.16583C21.197 8.32387 21.0094 8.44922 20.8029 8.53475C20.5964 8.62028 20.3751 8.6643 20.1516 8.6643C19.9281 8.6643 19.7068 8.62028 19.5004 8.53475C19.2939 8.44922 19.1063 8.32387 18.9482 8.16583C18.7902 8.0078 18.6648 7.82019 18.5793 7.61371C18.4938 7.40722 18.4498 7.18592 18.4498 6.96243V4.64169H9.43757V6.96243C9.43757 7.41379 9.25827 7.84667 8.93911 8.16583C8.61994 8.485 8.18707 8.6643 7.7357 8.6643C7.28434 8.6643 6.85146 8.485 6.5323 8.16583C6.21313 7.84667 6.03383 7.41379 6.03383 6.96243V4.64169H2.93952C2.75542 4.6396 2.57278 4.67444 2.40238 4.74416C2.23199 4.81388 2.07731 4.91707 1.94749 5.04761C1.81767 5.17815 1.71534 5.3334 1.64657 5.50418C1.57779 5.67495 1.54396 5.85779 1.54707 6.04187V23.3546C1.544 23.5354 1.57658 23.7151 1.64296 23.8833C1.70933 24.0515 1.8082 24.2051 1.93391 24.3351C2.05962 24.4651 2.20972 24.5691 2.37563 24.6411C2.54154 24.7131 2.72 24.7517 2.90084 24.7547H24.9478C25.1287 24.7517 25.3071 24.7131 25.473 24.6411C25.6389 24.5691 25.789 24.4651 25.9148 24.3351C26.0405 24.2051 26.1393 24.0515 26.2057 23.8833C26.2721 23.7151 26.3047 23.5354 26.3016 23.3546V6.04187C26.3047 5.86103 26.2721 5.68137 26.2057 5.51313C26.1393 5.34489 26.0405 5.19137 25.9148 5.06135C25.789 4.93133 25.6389 4.82734 25.473 4.75534C25.3071 4.68333 25.1287 4.64471 24.9478 4.64169ZM7.7357 20.1133H6.18854V18.5661H7.7357V20.1133ZM7.7357 16.2454H6.18854V14.6982H7.7357V16.2454ZM7.7357 12.3775H6.18854V10.8303H7.7357V12.3775ZM12.3772 20.1133H10.83V18.5661H12.3772V20.1133ZM12.3772 16.2454H10.83V14.6982H12.3772V16.2454ZM12.3772 12.3775H10.83V10.8303H12.3772V12.3775ZM17.0186 20.1133H15.4715V18.5661H17.0186V20.1133ZM17.0186 16.2454H15.4715V14.6982H17.0186V16.2454ZM17.0186 12.3775H15.4715V10.8303H17.0186V12.3775ZM21.6601 20.1133H20.113V18.5661H21.6601V20.1133ZM21.6601 16.2454H20.113V14.6982H21.6601V16.2454ZM21.6601 12.3775H20.113V10.8303H21.6601V12.3775Z" fill="white"/>
                    <path d="M7.73549 7.73599C7.94066 7.73599 8.13742 7.65449 8.2825 7.50942C8.42757 7.36434 8.50907 7.16758 8.50907 6.96241V2.32094C8.50907 2.11578 8.42757 1.91901 8.2825 1.77394C8.13742 1.62887 7.94066 1.54736 7.73549 1.54736C7.53033 1.54736 7.33356 1.62887 7.18849 1.77394C7.04342 1.91901 6.96191 2.11578 6.96191 2.32094V6.96241C6.96191 7.16758 7.04342 7.36434 7.18849 7.50942C7.33356 7.65449 7.53033 7.73599 7.73549 7.73599Z" fill="white"/>
                    <path d="M20.1134 7.73599C20.3186 7.73599 20.5154 7.65449 20.6604 7.50942C20.8055 7.36434 20.887 7.16758 20.887 6.96241V2.32094C20.887 2.11578 20.8055 1.91901 20.6604 1.77394C20.5154 1.62887 20.3186 1.54736 20.1134 1.54736C19.9083 1.54736 19.7115 1.62887 19.5664 1.77394C19.4213 1.91901 19.3398 2.11578 19.3398 2.32094V6.96241C19.3398 7.16758 19.4213 7.36434 19.5664 7.50942C19.7115 7.65449 19.9083 7.73599 20.1134 7.73599Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_291_1315">
                        <rect width="27.8488" height="27.8488" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            <span>{{ $hari_ini->format('d F Y') }}</span>
        </div>         
            
        <div class="search">
            <input type="text" 
                    id="searchInput"
                    placeholder="Cari">
        </div>
            
    <div class="antrean">
        <h3 class="antrean-header">
            Daftar Pasien Hari Ini
            <span class="antrean-jumlah">
                {{ $daftar_pasien->count() }} Pasien
            </span>
        </h3>

        <div class="antrean-main" id="patientList">
            @forelse($daftar_pasien as $reservasi)
            <div class="antrean-daftar patient-item">
                <div class="antrean-data">
                    <div class="data-nomor">
                        <span>{{ $reservasi->nomor_antrian }}</span>
                    </div>

                    <div class="data-nama">
                        <h4 class="patient-name">{{ $reservasi->nama_pasien }}</h4>
                    </div>

                    <div class="data-status">
                          <button onclick="openReservasiModal({{ $reservasi->getKey() }})" 
                                       class="px-4 py-2  border-2 border-blue-500 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-colors duration-200 flex items-center gap-2">
                                        Lihat Reservasi
                            </button>
                        
                        @if ($reservasi->status === 'selesai')
                            <span>Selesai</span>
                        @else
                            <form action="{{ route('dokter.reservasi.periksa', $reservasi->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="periksa-btn">
                                    Periksa
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="data-kosong">
                <p>Belum ada pasien antrian hari ini</p>
            </div>
            @endforelse
        </div>
    </div>

        <div class="jam">
            @if($jadwal && $jadwal->is_active)
            <h3>Jam Praktik</h3>
            <div class="jam-value">
                <div class="value-wrap">
                    <div class="value-mulai">
                        <p class="value-text">Buka</p>
                        <p class="value-jam">{{ $jadwal->jam_mulai ?? '-' }}</p>
                    </div>
                    <div class="value-strip">-</div>
                    <div class="value-tutup">
                        <p class="value-text">Tutup</p>
                        <p class="value-jam">{{ $jadwal->jam_selesai ?? '-' }}</p>
                    </div>
                </div>
            </div>
            @else
            <div class="jam-kosong">                      
                <p>Tidak Ada Jadwal</p>
            </div>
            @endif
        </div>

        <div class="nomor-antrean">
            <h3>Nomor Antrean Berjalan</h3>
            
            <div class="nomor-wrap">
                <p class="nomor-value">{{ $antrian->nomor_sekarang ?? 0 }}</p>
                <p class="nomor-text">Sedang Dilayani</p>
            </div>
        </div>

        <div class="jumlah-antrean">
            <h3>Jumlah Antrean</h3>
            
            <div class="jumlah-wrap">
                <p class="jumlah-angka">{{ $antrian->total_antrian ?? 0 }}</p>
                <p class="jumlah-text">Pasien Hari Ini</p>
            </div>
        </div>

        <!-- Modal polos (disembunyikan default) -->
        <div id="reservasiOverlay" hidden>
            <div id="reservasiBox" role="dialog" aria-modal="true" aria-labelledby="reservasiTitle">
                <div style="display:flex;justify-content:space-between;align-items:center; margin-bottom:8px;">
                <h3 id="reservasiTitle" style="margin:0;">Detail Reservasi</h3>
                <button type="button" onclick="closeReservasiModal()">Tutup</button>
                </div>

                <div id="reservasi-loading">Memuat data…</div>
                <div id="reservasi-error" style="display:none;color:red;"></div>

                <div id="reservasi-content" hidden>
                <div>Nama Pasien: <span id="m-nama-pasien">-</span></div>
                <div>Nama Wali: <span id="m-nama-wali">-</span></div>
                <div>Jenis Kelamin: <span id="m-jenis-kelamin">-</span></div>
                <div>Tanggal Lahir: <span id="m-tanggal-lahir">-</span></div>
                <div>Umur: <span id="m-umur">-</span></div>
                <div>Gol. Darah: <span id="m-golongan-darah">-</span></div>
                <div>Pekerjaan: <span id="m-pekerjaan">-</span></div>
                <div>Alamat: <span id="m-alamat">-</span></div>
                <div>No. Telepon: <span id="m-no-telepon">-</span></div>
                <div>Keluhan: <span id="m-keluhan">-</span></div>
                <div>Catatan: <span id="m-catatan">-</span></div>
                </div>
            </div>
        </div>

</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const patientItems = document.querySelectorAll('.patient-item');
    
    patientItems.forEach(item => {
        const patientName = item.querySelector('.patient-name').textContent.toLowerCase();
        
        if (patientName.includes(searchValue)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

// Buka modal + fetch detail berdasarkan ID reservasi
function openReservasiModal(reservasiId) {
    const overlay = document.getElementById('reservasiOverlay');
    const loadEl  = document.getElementById('reservasi-loading');
    const errEl   = document.getElementById('reservasi-error');
    const cntEl   = document.getElementById('reservasi-content');

    // Reset display
    errEl.textContent = '';
    errEl.style.display = 'none';
    loadEl.hidden = false;
    cntEl.hidden  = true;

    // Show overlay
    overlay.hidden = false;
    document.body.style.overflow = 'hidden';

    // Build URL dengan route helper Laravel
    const url = `{{ route('dokter.reservasi.detail', ':id') }}`.replace(':id', reservasiId);
    
    console.log('Fetching URL:', url); // Debug

    fetch(url, { 
        method: 'GET',
        headers: { 
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        credentials: 'same-origin'
    })
    .then(async (response) => {
        console.log('Response status:', response.status); // Debug
        
        if (!response.ok) {
            const text = await response.text();
            console.error('Error response:', text);
            throw new Error(`HTTP ${response.status}: ${text.substring(0, 100)}`);
        }
        return response.json();
    })
    .then((data) => {
        console.log('Data received:', data); // Debug
        
        // Populate modal content
        document.getElementById('m-nama-pasien').textContent = data.nama_pasien || '-';
        document.getElementById('m-nama-wali').textContent = data.nama_wali || '-';
        document.getElementById('m-jenis-kelamin').textContent = data.jenis_kelamin || '-';
        document.getElementById('m-tanggal-lahir').textContent = data.tanggal_lahir || '-';
        document.getElementById('m-umur').textContent = data.umur ? (data.umur + ' tahun') : '-';
        document.getElementById('m-golongan-darah').textContent = data.golongan_darah || '-';
        document.getElementById('m-pekerjaan').textContent = data.pekerjaan || '-';
        document.getElementById('m-alamat').textContent = data.alamat || '-';
        document.getElementById('m-no-telepon').textContent = data.no_telepon || '-';
        document.getElementById('m-keluhan').textContent = data.keluhan || '-';
        document.getElementById('m-catatan').textContent = data.catatan_pasien || 'Tidak ada catatan';

        // Show content
        loadEl.hidden = true;
        cntEl.hidden = false;
    })
    .catch((error) => {
        console.error('Fetch error:', error); // Debug
        loadEl.hidden = true;
        errEl.textContent = 'Gagal memuat detail reservasi: ' + error.message;
        errEl.style.display = 'block';
    });

    // Close on overlay click
    overlay.onclick = function (ev) {
        if (ev.target === overlay) closeReservasiModal();
    };

    // Close with ESC key
    document.addEventListener('keydown', escCloser);
}

function escCloser(ev) {
    if (ev.key === 'Escape') {
        closeReservasiModal();
    }
}

function closeReservasiModal() {
    const overlay = document.getElementById('reservasiOverlay');
    overlay.hidden = true;
    document.body.style.overflow = '';
    document.removeEventListener('keydown', escCloser);
}

</script>

@endsection
