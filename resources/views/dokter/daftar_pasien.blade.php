@extends('layouts.antrean')

@section('title','Daftar Pasien')

@section('content')
<div class="p-4 md:p-6">

  {{-- Header: Judul + Search + Total --}}
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
    <div>
      <div class="text-xl font-bold">Daftar Pasien</div>
      <div class="text-sm text-gray-500">Klinik WarasWaris</div>
    </div>

    <div class="flex items-center gap-3">
      <form method="GET" action="{{ route('dokter.daftar_pasien') }}">
        <input id="searchInput" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama pasien…"
               class="border rounded px-3 py-2 w-64" />
        <button type="submit" class="px-3 py-2 border rounded">Search</button>
      </form>
      <div class="text-sm text-gray-600">Total Pasien: <strong>{{ $total_pasien }}</strong></div>
    </div>
  </div>

  {{-- Header kolom --}}
  <div class="grid grid-cols-12 text-sm font-semibold bg-gray-100 rounded px-3 py-2">
    <div class="col-span-4">Nama Pasien</div>
    <div class="col-span-3">Wali Pasien</div>
    <div class="col-span-3">Kunjungan Terakhir</div>
    <div class="col-span-2 text-center">Kontak</div>
  </div>

  {{-- Rows --}}
  <div class="mt-2 space-y-2">
    @forelse($pasien_list as $pasien)
      @php
        $tanggal = $pasien->reservasi_terbaru?->tanggal_reservasi;
        $kunjungan_terakhir = $tanggal ? \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') : '-';
        $wali = $pasien->wali_pasien?->nama_pasien ??  '-';
        $wa   = preg_replace('/\D/', '', (string)($pasien->no_telepon ?? ''));
        $initial = strtoupper(mb_substr($pasien->nama_pasien ?? '-', 0, 1));
      @endphp

      <div class="grid grid-cols-12 items-center bg-white rounded border px-3 py-2">
        {{-- Nama + avatar placeholder --}}
        <div class="col-span-4 flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-sm font-bold">
            {{ $initial }}
          </div>
          <div class="font-medium">{{ $pasien->nama_pasien }}</div>
        </div>

        {{-- Wali --}}
        <div class="col-span-3">
          {{ $wali }}
        </div>

        {{-- Kunjungan terakhir --}}
        <div class="col-span-3">
          {{ $kunjungan_terakhir }}
        </div>

        {{-- Kontak + Lebih Detail --}}
        <div class="col-span-2 flex items-center justify-center gap-3">
          @if($wa)
            <a href="https://wa.me/{{ $wa }}" target="_blank" title="WhatsApp">WA</a>
          @else
            <span class="text-gray-400">WA</span>
          @endif

          <a href="javascript:void(0)" onclick="openPasienModal({{ $pasien->id }})" class="text-blue-600 underline">
            Lebih Detail
          </a>
        </div>
      </div>
    @empty
      <div class="text-sm text-gray-600 p-3">Belum ada data pasien.</div>
    @endforelse
  </div>

</div>

<!-- Modal polos (disembunyikan default) -->
<div id="pasienOverlay" hidden>
  <div id="pasienBox" role="dialog" aria-modal="true" aria-labelledby="pasienTitle">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
      <h3 id="pasienTitle" style="margin:0;">Detail Pasien</h3>
      <button type="button" onclick="closePasienModal()">Tutup</button>
    </div>

    <div id="pasien-loading">Memuat data…</div>
    <div id="pasien-error" style="display:none;color:red;"></div>

    <div id="pasien-content" hidden>
      <div>Nama Pasien: <span id="p-nama-pasien">-</span></div>
      <div>Nama Wali: <span id="p-nama-wali">-</span></div>
      <div>Jenis Kelamin: <span id="p-jenis-kelamin-pasien">-</span></div>
      <div>Tanggal Lahir: <span id="p-tanggal-lahir-pasien">-</span></div>
      <div>Umur: <span id="p-umur">-</span></div>
      <div>Gol. Darah: <span id="p-golongan-darah">-</span></div>
      <div>Pekerjaan: <span id="p-pekerjaan">-</span></div>
      <div>Alamat: <span id="p-alamat">-</span></div>
      <div>No. Telepon: <span id="p-no-telepon">-</span></div>
      <div>Catatan: <span id="p-catatan-pasien">-</span></div>
    </div>
  </div>
</div>

<script>
    const input = document.getElementById('searchInput');
    const baseURL = "{{ route('dokter.daftar_pasien') }}";

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

</script>
@endsection
