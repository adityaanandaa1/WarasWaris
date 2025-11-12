@extends('layouts.dokter')

@section('content')
<div>
    <div>
        <h1>Laporan Pemeriksaan</h1>
    </div>

<div class="parent">
    
        <form id="filterForm" method="GET" action="{{ route('dokter.laporan') }}">
    <div class="tanggal">
        <label>Tanggal</label>
        <input id="tanggalInput" type="date" 
                name="tanggal" 
                value="{{ $tanggal_dipilih->format('Y-m-d') }}">
    </div>

    <div class="search">
        <label>Cari Pasien</label>
        <input id="searchInput" type="text" 
                name="search" 
                value="{{ $search ?? '' }}"
                placeholder="Nama atau No. Telepon">
    </div>

            <button type="submit">
                <i class="fas fa-search"></i>Cari
            </button>

        </form>
    

    <div>
        <div>
            <div>
                <p>{{ $nama_hari }}, {{ $tanggal_dipilih->format('d F Y') }}</p>
                <h3>Jam Praktik</h3>
            </div>
            <div>
                @if($jadwal && $jadwal->is_active)
                    <p>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                    <span>
                        <i class="fas fa-check-circle"></i>Buka
                    </span>
                @else
                    <p>LIBUR</p>
                    <span>
                        <i class="fas fa-times-circle"></i>Tutup
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div>
        <div>
            <div>
                <div>
                    <p>Total Reservasi</p>
                    <h3>{{ $total_reservasi }}</h3>
                </div>
                <div>
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <div>
            <div>
                <div>
                    <p>Pasien Terlayani</p>
                    <h3>{{ $pasien_terlayani }}</h3>
                </div>
                <div>
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <div>
            <div>
                <div>
                    <p>Tidak Datang</p>
                    <h3>{{ $pasien_tidak_datang }}</h3>
                </div>
                <div>
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div>
            <h3>Daftar Pasien</h3>
            <p>
                Menampilkan {{ $daftar_reservasi->count() }} dari {{ $total_reservasi }} pasien
            </p>
        </div>

        @if($daftar_reservasi->isEmpty())
            <div>
                <i class="fas fa-inbox"></i>
                <p>Tidak ada data pasien pada tanggal ini</p>
            </div>
        @else
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>No. Antrian</th>
                            <th>Nama Pasien</th>
                            <th>No. Telepon</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftar_reservasi as $reservasi)
                        <tr>
                            <td>
                                <span>
                                    {{ $reservasi->nomor_antrian }}
                                </span>
                            </td>
                            <td>
                                <div>
                                    <div>
                                        {{ substr($reservasi->data_pasien->nama_pasien, 0, 1) }}
                                    </div>
                                    <div>
                                        <p>{{ $reservasi->data_pasien->nama_pasien }}</p>
                                        <p>
                                            {{ $reservasi->data_pasien->jenis_kelamin }}, 
                                            {{ $reservasi->data_pasien->tanggal_lahir_pasien->age }} tahun
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="fas fa-phone"></i>
                                    {{ $reservasi->data_pasien->no_telepon }}
                                </div>
                            </td>
                            <td>
                                @switch($reservasi->status)
                                    @case('menunggu')
                                        <span>
                                            <i class="fas fa-clock"></i>Menunggu
                                        </span>
                                        @break
                                    @case('sedang_dilayani')
                                        <span>
                                            <i class="fas fa-stethoscope"></i>Sedang Dilayani
                                        </span>
                                        @break
                                    @case('selesai')
                                        <span>
                                            <i class="fas fa-check-circle"></i>Selesai
                                        </span>
                                        @break
                                    @case('batal')
                                        <span>
                                            <i class="fas fa-times-circle"></i>Tidak Datang
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @if($reservasi->rekam_medis)
                                    {{ $reservasi->updated_at->format('H:i') }} WIB
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($reservasi->status == 'selesai' && $reservasi->rekam_medis)
                                    <button onclick="lihatRekamMedis({{ $reservasi->rekam_medis->id }})">
                                        <i class="fas fa-eye"></i>Lihat Detail
                                    </button>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<div id="modalRekamMedis" style="display:none;">
    <div>
        <div>
            <h3>Detail Rekam Medis</h3>
            <button onclick="tutupModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="kontenModal">
        </div>
    </div>
</div>
</div>

<script>
function lihatRekamMedis(id) {
    const modal = document.getElementById('modalRekamMedis');
    const konten = document.getElementById('kontenModal');
    
    modal.style.display = 'block';
    konten.innerHTML = '<div><i class="fas fa-spinner fa-spin"></i><p>Memuat data...</p></div>';
    
    fetch(`/dokter/rekam-medis/${id}/detail`)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const rm = data.data;
                konten.innerHTML = `
                    <div>
                        <div>
                            <p>Nomor Rekam Medis</p>
                            <p>${rm.nomor_rekam_medis}</p>
                        </div>
                        
                        <div>
                            <div>
                                <p>Nama Pasien</p>
                                <p>${rm.data_pasien.nama_pasien}</p>
                            </div>
                            <div>
                                <p>Tanggal Pemeriksaan</p>
                                <p>${new Date(rm.tanggal_pemeriksaan).toLocaleDateString('id-ID')}</p>
                            </div>
                        </div>
                        
                        <div>
                            <h4>Data Vital</h4>
                            <div>
                                <div>
                                    <p>Tinggi Badan</p>
                                    <p>${rm.tinggi_badan} cm</p>
                                </div>
                                <div>
                                    <p>Berat Badan</p>
                                    <p>${rm.berat_badan} kg</p>
                                </div>
                                <div>
                                    <p>Tekanan Darah</p>
                                    <p>${rm.tekanan_darah}</p>
                                </div>
                                <div>
                                    <p>Suhu</p>
                                    <p>${rm.suhu}°C</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4>Diagnosa</h4>
                            <p>${rm.diagnosa}</p>
                        </div>
                        
                        <div>
                            <h4>Saran</h4>
                            <p>${rm.saran}</p>
                        </div>
                        
                        ${rm.resep_obat ? `
                            <div>
                                <h4>Resep Obat</h4>
                                <p>${rm.resep_obat}</p>
                            </div>
                        ` : ''}
                    </div>
                `;
            }
        })
        .catch(error => {
            konten.innerHTML = '<div><i class="fas fa-exclamation-circle"></i><p>Gagal memuat data</p></div>';
        });
}

    (function(){
        const form    = document.getElementById('filterForm');
        const input   = document.getElementById('searchInput');
        const tanggal = document.getElementById('tanggalInput');
        const baseURL = "{{ route('dokter.laporan') }}";

        // Enter otomatis submit (default behavior form), kita hanya urus reset.
        input.addEventListener('input', () => {
        if (input.value.trim() === '') {
            const params = new URLSearchParams();

            // pertahankan tanggal (ambil dari input/form)
            if (tanggal && tanggal.value) {
            params.set('tanggal', tanggal.value);
            }

            const url = params.toString() ? `${baseURL}?${params.toString()}` : baseURL;

            // pakai replace agar tidak menumpuk di riwayat back/forward
            window.location.replace(url);
        }
        });

        input.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            e.preventDefault();
            input.value = '';
            const params = new URLSearchParams();
            if (tanggal && tanggal.value) params.set('tanggal', tanggal.value);
            const url = params.toString() ? `${baseURL}?${params.toString()}` : baseURL;
            window.location.replace(url);
        }
        });
    })();

function tutupModal() {
    document.getElementById('modalRekamMedis').style.display = 'none';
}

function exportPDF() {
    const tanggal = '{{ $tanggal_dipilih->format("Y-m-d") }}';
    window.open(`/dokter/laporan/pdf?tanggal=${tanggal}`, '_blank');
}

function exportExcel() {
    const tanggal = '{{ $tanggal_dipilih->format("Y-m-d") }}';
    window.open(`/dokter/laporan/excel?tanggal=${tanggal}`, '_blank');
}

@if($tanggal_dipilih->isToday())
setInterval(() => {
    if(document.getElementById('modalRekamMedis').style.display !== 'none') return;
    location.reload();
}, 30000);
@endif
</script>
@endsection