@extends('layouts.daftarpasien')

@section('title','Daftar Pasien')

@section('content')

<style>
</style>

<div class="container-pasien">

  <!-- Header: Judul + Search + Total -->
  <div class="header-pasien">
    <div class="judul-section">
      <svg width="50" height="50" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.1465 3.90234C15.29 3.90234 13.5095 4.63984 12.1967 5.9526C10.884 7.26535 10.1465 9.04583 10.1465 10.9023V41.9023H54.1465V10.9023C54.1465 9.04583 53.409 7.26535 52.0962 5.9526C50.7835 4.63984 49.003 3.90234 47.1465 3.90234H17.1465Z" fill="url(#paint0_linear_236_496)"/>
        <path d="M20.1465 41.9023V33.9023C20.1465 32.8415 20.5679 31.8241 21.3181 31.0739C22.0682 30.3238 23.0856 29.9023 24.1465 29.9023H40.1465C41.2073 29.9023 42.2248 30.3238 42.9749 31.0739C43.7251 31.8241 44.1465 32.8415 44.1465 33.9023V41.9023H20.1465Z" fill="url(#paint1_linear_236_496)"/>
        <path d="M40.1465 19.9023C40.1465 22.0241 39.3036 24.0589 37.8033 25.5592C36.303 27.0595 34.2682 27.9023 32.1465 27.9023C30.0248 27.9023 27.9899 27.0595 26.4896 25.5592C24.9893 24.0589 24.1465 22.0241 24.1465 19.9023C24.1465 17.7806 24.9893 15.7458 26.4896 14.2455C27.9899 12.7452 30.0248 11.9023 32.1465 11.9023C34.2682 11.9023 36.303 12.7452 37.8033 14.2455C39.3036 15.7458 40.1465 17.7806 40.1465 19.9023Z" fill="url(#paint2_linear_236_496)"/>
        <path d="M47.1465 59.9023C49.003 59.9023 50.7835 59.1648 52.0962 57.8521C53.409 56.5393 54.1465 54.7589 54.1465 52.9023V39.9023H10.1465V52.9023C10.1465 54.7589 10.884 56.5393 12.1967 57.8521C13.5095 59.1648 15.29 59.9023 17.1465 59.9023H47.1465Z" fill="url(#paint3_linear_236_496)"/>
        <path d="M47.1465 59.9023C49.003 59.9023 50.7835 59.1648 52.0962 57.8521C53.409 56.5393 54.1465 54.7589 54.1465 52.9023V39.9023H10.1465V52.9023C10.1465 54.7589 10.884 56.5393 12.1967 57.8521C13.5095 59.1648 15.29 59.9023 17.1465 59.9023H47.1465Z" fill="url(#paint4_linear_236_496)" fill-opacity="0.7"/>
        <path d="M20.1465 47.9023C19.6161 47.9023 19.1073 48.1131 18.7323 48.4881C18.3572 48.8632 18.1465 49.3719 18.1465 49.9023C18.1465 50.4328 18.3572 50.9415 18.7323 51.3166C19.1073 51.6916 19.6161 51.9023 20.1465 51.9023H44.1465C44.6769 51.9023 45.1856 51.6916 45.5607 51.3166C45.9358 50.9415 46.1465 50.4328 46.1465 49.9023C46.1465 49.3719 45.9358 48.8632 45.5607 48.4881C45.1856 48.1131 44.6769 47.9023 44.1465 47.9023H20.1465Z" fill="url(#paint5_linear_236_496)"/>
        <defs>
          <linearGradient id="paint0_linear_236_496" x1="25.8605" y1="3.90234" x2="38.9005" y2="41.1883" gradientUnits="userSpaceOnUse">
            <stop stop-color="#B3E0FF"/>
            <stop offset="1" stop-color="#8CD0FF"/>
          </linearGradient>
          <linearGradient id="paint1_linear_236_496" x1="25.8545" y1="31.4983" x2="29.7305" y2="43.8783" gradientUnits="userSpaceOnUse">
            <stop offset="0.125" stop-color="#9C6CFE"/>
            <stop offset="1" stop-color="#7A41DC"/>
          </linearGradient>
          <linearGradient id="paint2_linear_236_496" x1="27.9505" y1="14.0283" x2="36.1065" y2="27.0503" gradientUnits="userSpaceOnUse">
            <stop offset="0.125" stop-color="#9C6CFE"/>
            <stop offset="1" stop-color="#7A41DC"/>
          </linearGradient>
          <linearGradient id="paint3_linear_236_496" x1="-0.853515" y1="-0.0576557" x2="55.6925" y2="58.2703" gradientUnits="userSpaceOnUse">
            <stop stop-color="#36DFF1"/>
            <stop offset="1" stop-color="#2764E7"/>
          </linearGradient>
          <linearGradient id="paint4_linear_236_496" x1="32.1465" y1="21.5683" x2="36.6805" y2="69.3703" gradientUnits="userSpaceOnUse">
            <stop offset="0.619" stop-color="#FF6CE8" stop-opacity="0"/>
            <stop offset="1" stop-color="#FF6CE8"/>
          </linearGradient>
          <linearGradient id="paint5_linear_236_496" x1="23.5305" y1="48.2103" x2="24.0205" y2="56.5143" gradientUnits="userSpaceOnUse">
            <stop stop-color="white"/>
            <stop offset="1" stop-color="#B3E0FF"/>
          </linearGradient>
        </defs>
      </svg>
      <div class="title-pasien">
        <h2 class="judul-pasien">Daftar Pasien</h2>
        <p class="subjudul-pasien">Klinik WarasWaris</p>
      </div>
    </div>

    <div class="search-section">
      <div class="search">
        <input type="text" id="searchInput" placeholder="Cari" class="search-form">
        <i class="ri-search-line"></i>
      </div>
      <div class="total-pasien">
        Total Pasien: {{ $total_pasien }}
      </div>
    </div>
  </div>

  <!-- Header kolom -->
  <div class="table-header">
    <div class="col-foto"></div>
    <div class="col-nama">Nama Pasien</div>
    <div class="col-wali">Wali Pasien</div>
    <div class="col-kunjungan">Kunjungan Terakhir</div>
    <div class="col-kontak">Kontak</div>
    <div class="col-detail"></div>
  </div>

  <!-- Rows -->
  <div class="table-body">
    @forelse($pasien_list as $pasien)
      @php
        $tanggal = $pasien->reservasi_terbaru?->tanggal_reservasi;
        $kunjungan_terakhir = $tanggal ? \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') : '-';
        $wali = $pasien->primary_pasien?->nama_pasien ??  '-';
        $wa   = preg_replace('/\D/', '', (string)($pasien->no_telepon ?? ''));
        $initial = strtoupper(mb_substr($pasien->nama_pasien ?? '-', 0, 1));
      @endphp

      <div class="table-row">
        {{-- foto --}}
        <div class="col-foto">
          <div class="avatar">{{ $initial }}</div>
        </div>

        <!-- Nama + avatar -->
        <div class="col-nama-input">
          <div class="nama-pasien">{{ $pasien->nama_pasien }}</div>
        </div>

        <!-- Wali -->
        <div class="col-wali-input">{{ $wali }}</div>

        <!-- Kunjungan terakhir -->
        <div class="col-kunjungan-input">{{ $kunjungan_terakhir }}</div>

        <!-- Kontak -->
        <div class="col-kontak-input">
          @if($wa)
            <a href="https://wa.me/{{ $wa }}" target="_blank" title="WhatsApp" class="link-wa">
              <i class="ri-whatsapp-fill" style="color: #00C42E; font-size: 30px; margin-left: 10px;"></i>
            </a>
          @else
            <span class="wa-disabled">
              <i class="ri-whatsapp-fill" style="color: #aaa; font-size: 30px; margin-left: 10px;"></i>
            </span>
          @endif
        </div>

        {{-- detail --}}
        <div class="col-detail-input">
          <a href="javascript:void(0)" onclick="openPasienModal({{ $pasien->id }})" class="link-detail">Lebih Detail</a>
        </div>
      </div>
    @empty
      <div class="no-data">Belum ada data pasien.</div>
    @endforelse
  </div>

</div>

<!-- Modal polos (disembunyikan default) -->
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
          <div class="avatar-biodata"></div>
        </div>

        <div class="col-data">
          <div class="pasien-identitas">
            <div class="pasien-identitas-title">
              Nama
              <span id="p-nama-pasien" class="pasien-identitas-nama">-</span>
            </div>
            <div class="divider-identitas">
              |
            </div>
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
        <a href="{{ route('dokter.riwayat_rekam_medis') }}" id="btn-rekam-medis" class="btn-rekam-medis">
            Lihat Rekam Medis
        </a>
    </div>
  </div>
</div>

<script>
    const input = document.getElementById('searchInput');
    const baseURL = "{{ route('dokter.daftar_pasien') }}";
    const riwayatRekamMedisBaseURL = "{{ route('dokter.riwayat_rekam_medis') }}";

    // Enter otomatis submit (default behavior form), kita hanya urus reset.
    input.addEventListener('input', () => {
        if (input.value.trim() === '') {
        // kosong → reset ke daftar penuh (tanpa query ?q=)
        window.location.href = baseURL;
        }
    });

    // Bonus: Esc untuk cepat clear + reset
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
        e.preventDefault();
        input.value = '';
        window.location.href = baseURL;
        }
    });



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

    // Show overlay
    overlay.hidden = false;
    document.body.style.overflow = 'hidden';

    // URL ke controller detail_pasien
    const url = "{{ route('dokter.pasien.detail', ['id' => '__ID__']) }}".replace('__ID__', pasienId);
    console.log('Fetching URL:', url);

    fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      credentials: 'same-origin'
    })
    .then(async (response) => {
      console.log('Response status:', response.status);
      const text = await response.text();
      if (!response.ok) {
        console.error('Error response:', text);
        throw new Error(`HTTP ${response.status}: ${text.substring(0, 200)}`);
      }
      try { return JSON.parse(text); }
      catch { throw new Error('Response bukan JSON: ' + text.substring(0, 200)); }
    })
    .then((data) => {
      console.log('Data received:', data);

      // Isi konten modal (tanpa keluhan)
      document.getElementById('p-nama-pasien').textContent    = data.nama_pasien ?? '-';
      document.getElementById('p-nama-wali').textContent      = data.nama_wali ?? '-';
      document.getElementById('p-jenis-kelamin-pasien').textContent  = data.jenis_kelamin_pasien ?? '-';
      document.getElementById('p-tanggal-lahir-pasien').textContent  = data.tanggal_lahir_pasien ?? '-';
      document.getElementById('p-umur').textContent           = (data.umur != null) ? (data.umur + ' tahun') : '-';
      document.getElementById('p-golongan-darah').textContent = data.golongan_darah ?? '-';
      document.getElementById('p-pekerjaan').textContent      = data.pekerjaan ?? '-';
      document.getElementById('p-alamat').textContent         = data.alamat ?? '-';
      document.getElementById('p-no-telepon').textContent     = data.no_telepon ?? '-';
      document.getElementById('p-catatan-pasien').textContent        = data.catatan_pasien ?? '-';
      updateRekamMedisLink(data.id ?? null);

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

  function updateRekamMedisLink(pasienId) {
    const btn = document.getElementById('btn-rekam-medis');
    if (!btn) return;
    let target = riwayatRekamMedisBaseURL;
    if (pasienId) {
      const separator = target.includes('?') ? '&' : '?';
      target = `${target}${separator}pasien_id=${encodeURIComponent(pasienId)}`;
    }
    btn.href = target;
  }

document.getElementById('searchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const patientItems = document.querySelectorAll('.table-row');
    
    patientItems.forEach(item => {
        const patientName = item.querySelector('.nama-pasien').textContent.toLowerCase();
        
        if (patientName.includes(searchValue)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});
</script>
@endsection
