@extends('layouts.dokter')

@section('content')

@php($hari_ini = $hari_ini ?? \Carbon\Carbon::today()->locale('id'))
@php($nama_hari = $nama_hari ?? $hari_ini->translatedFormat('l'))

<div class="dashboard-doctor">
    <div class="welcome-section">
        <div class="welcome-date">
            <svg width="23" height="22" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M26.4685 3.49949H22.9686V6.12445C22.9686 6.37724 22.9188 6.62755 22.8221 6.8611C22.7253 7.09465 22.5835 7.30686 22.4048 7.48561C22.226 7.66436 22.0138 7.80615 21.7803 7.90289C21.5467 7.99963 21.2964 8.04942 21.0436 8.04942C20.7908 8.04942 20.5405 7.99963 20.307 7.90289C20.0734 7.80615 19.8612 7.66436 19.6825 7.48561C19.5037 7.30686 19.3619 7.09465 19.2652 6.8611C19.1685 6.62755 19.1187 6.37724 19.1187 6.12445V3.49949H8.92508V6.12445C8.92508 6.63498 8.72227 7.1246 8.36127 7.48561C8.00027 7.84661 7.51065 8.04942 7.00011 8.04942C6.48958 8.04942 5.99996 7.84661 5.63895 7.48561C5.27795 7.1246 5.07514 6.63498 5.07514 6.12445V3.49949H1.5752C1.36697 3.49712 1.16039 3.53653 0.967657 3.61539C0.774927 3.69425 0.599969 3.81096 0.453129 3.95862C0.30629 4.10627 0.190552 4.28188 0.11276 4.47504C0.0349679 4.6682 -0.00329822 4.87501 0.000224916 5.08321V24.6654C-0.00325142 24.8699 0.0336005 25.0732 0.108676 25.2635C0.183751 25.4537 0.295579 25.6274 0.437772 25.7745C0.579965 25.9215 0.749737 26.0391 0.937393 26.1206C1.12505 26.202 1.32691 26.2457 1.53145 26.2491H26.4685C26.6731 26.2457 26.875 26.202 27.0626 26.1206C27.2503 26.0391 27.42 25.9215 27.5622 25.7745C27.7044 25.6274 27.8162 25.4537 27.8913 25.2635C27.9664 25.0732 28.0033 24.8699 27.9998 24.6654V5.08321C28.0033 4.87868 27.9664 4.67546 27.8913 4.48516C27.8162 4.29487 27.7044 4.12123 27.5622 3.97416C27.42 3.82709 27.2503 3.70948 27.0626 3.62803C26.875 3.54659 26.6731 3.50291 26.4685 3.49949ZM7.00011 20.9992H5.25014V19.2492H7.00011V20.9992ZM7.00011 16.6243H5.25014V14.8743H7.00011V16.6243ZM7.00011 12.2493H5.25014V10.4994H7.00011V12.2493ZM12.25 20.9992H10.5001V19.2492H12.25V20.9992ZM12.25 16.6243H10.5001V14.8743H12.25V16.6243ZM12.25 12.2493H10.5001V10.4994H12.25V12.2493ZM17.4999 20.9992H15.75V19.2492H17.4999V20.9992ZM17.4999 16.6243H15.75V14.8743H17.4999V16.6243ZM17.4999 12.2493H15.75V10.4994H17.4999V12.2493ZM22.7499 20.9992H20.9999V19.2492H22.7499V20.9992ZM22.7499 16.6243H20.9999V14.8743H22.7499V16.6243ZM22.7499 12.2493H20.9999V10.4994H22.7499V12.2493Z" fill="white"/>
                <path d="M7.0002 6.99977C7.23226 6.99977 7.45482 6.90758 7.61891 6.74349C7.783 6.5794 7.87519 6.35684 7.87519 6.12478V0.874864C7.87519 0.642803 7.783 0.420247 7.61891 0.256155C7.45482 0.0920637 7.23226 -0.00012207 7.0002 -0.00012207C6.76814 -0.00012207 6.54558 0.0920637 6.38149 0.256155C6.2174 0.420247 6.12521 0.642803 6.12521 0.874864V6.12478C6.12521 6.35684 6.2174 6.5794 6.38149 6.74349C6.54558 6.90758 6.76814 6.99977 7.0002 6.99977Z" fill="white"/>
                <path d="M20.9999 6.99977C21.232 6.99977 21.4545 6.90758 21.6186 6.74349C21.7827 6.5794 21.8749 6.35684 21.8749 6.12478V0.874864C21.8749 0.642803 21.7827 0.420247 21.6186 0.256155C21.4545 0.0920637 21.232 -0.00012207 20.9999 -0.00012207C20.7679 -0.00012207 20.5453 0.0920637 20.3812 0.256155C20.2171 0.420247 20.1249 0.642803 20.1249 0.874864V6.12478C20.1249 6.35684 20.2171 6.5794 20.3812 6.74349C20.5453 6.90758 20.7679 6.99977 20.9999 6.99977Z" fill="white"/>
            </svg>
            <p id="today" class="welcome-today"></p>
        </div>

        <div class="welcome-greeting">
            <div class="greeting-text">
                <div class="greeting-title">
                    <h1 class="greeting-title-subtitle">Selamat Datang,</h1>
                    <h1 class="greeting-title-subtitle">{{ Auth::user()->dokter->nama_dokter }}</h1>
                </div>
                <p class="greeting-subtitle">Semoga harimu indah!</p>
            </div>
            <div class="greeting-illustration">
            <img src="{{ asset('images/dokter.png') }}" alt="Dokter Waris" width="330">
            </div>
        </div>
    </div>

    <div class="dashboard-profile">
        <div class="profile-header">
            <h1 class="profile-title">Profil Saya</h1>
            <i class="ri-edit-box-line" style="color: #FFFFFF; font-size:18px"></i>
        </div>

        <div class="profile-body">
            <div class="profile-photo">

            </div>
            <div class="profile-info">
                <div class="profile-identity">
                    <p class="profile-name">
                        {{ Auth::user()->dokter->nama_dokter }}
                    </p>
                    <p class="profile-profession">Dokter Umum</p>
                    <div class="profile-location">
                        <i class="ri-map-pin-2-fill" style="font-size: 14px; color: #5A81FA;"></i>
                        <p class="location-text">Kalisat,  Jember</p>
                    </div>
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <p class="detail-label">TTL</p>
                        <p class="detail-value">
                            {{ Auth::user()->dokter->tanggal_lahir_dokter }}
                        </p>
                    </div>
                    <h1 class="profile-separator">|</h1>
                    <div class="detail-item">
                        <p class="detail-label">Pengalaman</p>
                        <p class="detail-value">12 Tahun</p>
                    </div>
                    <h1 class="profile-separator">|</h1>
                    <div class="detail-item">
                        <p class="detail-label">SIP</p>
                        <button type="button" class="download-sip">Unduh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-schedule">
        <h2 class="schedule-title">Jam Praktik</h2>
        <div class="dropdown-schedule">
            <button class="btn dropdown-toggle dropdown-schedule" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                11 November 2025
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>

        @if($jadwal && $jadwal->is_active)
        <div class="schedule-time">
            <div class="time-item">
                <h1 class="time-label">Buka</h1>
                <p class="time-value">{{ $jadwal->jam_mulai ?? '-' }}</p>
            </div>
            <h1 class="time-separator">-</h1>
            <div class="time-item">
                <h1 class="time-label">Tutup</h1>
                <p class="time-value">{{ $jadwal->jam_selesai ?? '-' }}</p>
            </div>
        </div>

        <button onclick="document.getElementById('modalJadwal').classList.remove('hidden')" type="button" class="btn btn-primary btn-sm btn-schedule">
            Atur Ulang
        </button>
        @else
        <div class="time-item">
            <h1 class="time-label">Tidak Ada Jadwal</h1>
            <p class="time-value">{{ $nama_hari }}</p>
        </div>
        @endif
    </div>

    <div class="dashboard-queue">
        <h1 class="queue-title">Nomor Antrean Berjalan</h1>
        <h1 class="queue-number">{{ $antrian->nomor_sekarang ?? 0 }}</h1>
    </div>

    <div class="dashboard-report">
        <h1 class="report-title">Statistik Laporan</h1>
        <div class="report-item">
            <h1 class="report-number-1">{{ $total_reservasi }}</h1>
            <h2 class="report-label">Total Reservasi</h2>
        </div> 

        <div class="report-item">
            <h1 class="report-number-2">{{ $pasien_terlayani }}</h1>
            <h2 class="report-label">Pasien Terlayani</h2>
        </div>

        <div class="report-item">
            <h1 class="report-number-3">{{ $pasien_batal }}</h1>
            <h2 class="report-label">Pasien Tidak Hadir</h2>
        </div>
    </div>

    <div class="dashboard-calendar">
        <div class="calendar-header">
            <h1 class="calendar-title">Kalender Saya</h1>
            <div class="dropdown-calendar">
                <button class="btn dropdown-toggle dropdown-calendar" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    November
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>

        <div class="calendar-body">
                <div class="calendar-month" id="calendarMonth"></div>
                <div class="calendar-weekdays">
                    <div class="weekday">Senin</div>
                    <div class="weekday">Selasa</div>
                    <div class="weekday">Rabu</div>
                    <div class="weekday">Kamis</div>
                    <div class="weekday">Jumat</div>
                    <div class="weekday">Sabtu</div>
                    <div class="weekday">Minggu</div>
                </div>
                <div class="calendar-dates" id="calendarDates"></div>
            </div>
    </div>
</div>

<!-- Modal Atur Jadwal -->
<div id="modalJadwal" class="modal-overlay hidden">
    <div class="modal-container">
        <div class="modal-header">
            <button onclick="document.getElementById('modalJadwal').classList.add('hidden')" 
                    class="modal-close-btn">
                <svg class="icon-close" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('dokter.update.jadwal',  $jadwal->id ?? 0) }}"  method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <div class="date-picker">
                    <svg width="23" height="22" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.4685 3.49949H22.9686V6.12445C22.9686 6.37724 22.9188 6.62755 22.8221 6.8611C22.7253 7.09465 22.5835 7.30686 22.4048 7.48561C22.226 7.66436 22.0138 7.80615 21.7803 7.90289C21.5467 7.99963 21.2964 8.04942 21.0436 8.04942C20.7908 8.04942 20.5405 7.99963 20.307 7.90289C20.0734 7.80615 19.8612 7.66436 19.6825 7.48561C19.5037 7.30686 19.3619 7.09465 19.2652 6.8611C19.1685 6.62755 19.1187 6.37724 19.1187 6.12445V3.49949H8.92508V6.12445C8.92508 6.63498 8.72227 7.1246 8.36127 7.48561C8.00027 7.84661 7.51065 8.04942 7.00011 8.04942C6.48958 8.04942 5.99996 7.84661 5.63895 7.48561C5.27795 7.1246 5.07514 6.63498 5.07514 6.12445V3.49949H1.5752C1.36697 3.49712 1.16039 3.53653 0.967657 3.61539C0.774927 3.69425 0.599969 3.81096 0.453129 3.95862C0.30629 4.10627 0.190552 4.28188 0.11276 4.47504C0.0349679 4.6682 -0.00329822 4.87501 0.000224916 5.08321V24.6654C-0.00325142 24.8699 0.0336005 25.0732 0.108676 25.2635C0.183751 25.4537 0.295579 25.6274 0.437772 25.7745C0.579965 25.9215 0.749737 26.0391 0.937393 26.1206C1.12505 26.202 1.32691 26.2457 1.53145 26.2491H26.4685C26.6731 26.2457 26.875 26.202 27.0626 26.1206C27.2503 26.0391 27.42 25.9215 27.5622 25.7745C27.7044 25.6274 27.8162 25.4537 27.8913 25.2635C27.9664 25.0732 28.0033 24.8699 27.9998 24.6654V5.08321C28.0033 4.87868 27.9664 4.67546 27.8913 4.48516C27.8162 4.29487 27.7044 4.12123 27.5622 3.97416C27.42 3.82709 27.2503 3.70948 27.0626 3.62803C26.875 3.54659 26.6731 3.50291 26.4685 3.49949ZM7.00011 20.9992H5.25014V19.2492H7.00011V20.9992ZM7.00011 16.6243H5.25014V14.8743H7.00011V16.6243ZM7.00011 12.2493H5.25014V10.4994H7.00011V12.2493ZM12.25 20.9992H10.5001V19.2492H12.25V20.9992ZM12.25 16.6243H10.5001V14.8743H12.25V16.6243ZM12.25 12.2493H10.5001V10.4994H12.25V12.2493ZM17.4999 20.9992H15.75V19.2492H17.4999V20.9992ZM17.4999 16.6243H15.75V14.8743H17.4999V16.6243ZM17.4999 12.2493H15.75V10.4994H17.4999V12.2493ZM22.7499 20.9992H20.9999V19.2492H22.7499V20.9992ZM22.7499 16.6243H20.9999V14.8743H22.7499V16.6243ZM22.7499 12.2493H20.9999V10.4994H22.7499V12.2493Z" fill="white"/>
                        <path d="M7.0002 6.99977C7.23226 6.99977 7.45482 6.90758 7.61891 6.74349C7.783 6.5794 7.87519 6.35684 7.87519 6.12478V0.874864C7.87519 0.642803 7.783 0.420247 7.61891 0.256155C7.45482 0.0920637 7.23226 -0.00012207 7.0002 -0.00012207C6.76814 -0.00012207 6.54558 0.0920637 6.38149 0.256155C6.2174 0.420247 6.12521 0.642803 6.12521 0.874864V6.12478C6.12521 6.35684 6.2174 6.5794 6.38149 6.74349C6.54558 6.90758 6.76814 6.99977 7.0002 6.99977Z" fill="white"/>
                        <path d="M20.9999 6.99977C21.232 6.99977 21.4545 6.90758 21.6186 6.74349C21.7827 6.5794 21.8749 6.35684 21.8749 6.12478V0.874864C21.8749 0.642803 21.7827 0.420247 21.6186 0.256155C21.4545 0.0920637 21.232 -0.00012207 20.9999 -0.00012207C20.7679 -0.00012207 20.5453 0.0920637 20.3812 0.256155C20.2171 0.420247 20.1249 0.642803 20.1249 0.874864V6.12478C20.1249 6.35684 20.2171 6.5794 20.3812 6.74349C20.5453 6.90758 20.7679 6.99977 20.9999 6.99977Z" fill="white"/>
                    </svg>
                    <input id="myDate" type="text" name="tanggal" value="{{ $hari_ini->format('Y-m-d') }}" required class="date-input">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" id="statusSelect" required onchange="toggleJamInput()"
                    class="form-input">
                    <option value="buka">Buka</option>
                    <option value="libur">Libur</option>
                </select>
            </div>

            <div id="jamInputs" class="form-group-jam">
                <div class="time-inputs-grid">
                    <div>
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai"  value="{{ old('jam_mulai', $jadwal && $jadwal->jam_mulai ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '09:00') }}"
                            class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai"  value="{{ old('jam_selesai', $jadwal && $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '21:00') }}"
                            class="form-input">
                    </div>
                </div>
            </div>

            <div id="catatanInput" class="form-group hidden">
                <label class="form-label">Catatan Libur</label>
                <textarea name="catatan" rows="3" 
                          class="form-input form-textarea"
                          placeholder="Alasan libur praktik..."></textarea>
            </div>

            <div class="form-actions">
                <button type="button" 
                        onclick="document.getElementById('modalJadwal').classList.add('hidden')"
                        class="btn-cancel">
                    Batal
                </button>
                <button type="submit" 
                        class="btn-submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleJamInput() {
    const status = document.getElementById('statusSelect').value;
    const jamInputs = document.getElementById('jamInputs');
    const catatanInput = document.getElementById('catatanInput');
    
    if (status === 'libur') {
        jamInputs.classList.add('hidden');
        catatanInput.classList.remove('hidden');
    } else {
        jamInputs.classList.remove('hidden');
        catatanInput.classList.add('hidden');
    }
}

function generateCalendar() {
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();
        const currentDate = today.getDate();

        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        document.getElementById('calendarMonth').textContent = monthNames[month];

        const currentDay = today.getDay();
        const dayNames = document.querySelectorAll('.day-name');

        let adjustedIndex = currentDay - 1;
        if (adjustedIndex < 0) adjustedIndex = 6;

        dayNames.forEach((day, index) => {
            if (index === adjustedIndex) {
                day.classList.add('current');
            }
        });

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();

        const calendarDates = document.getElementById('calendarDates');
        let html = '';

        const startDay = firstDay === 0 ? 6 : firstDay - 1;
        for (let i = startDay; i > 0; i--) {
            html += `<div class="date-cell prev-month">${daysInPrevMonth - i + 1}</div>`;
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const isToday = i === currentDate ? 'current' : '';
            html += `<div class="date-cell ${isToday}">${i}</div>`;
        }

        const remainingCells = 42 - (startDay + daysInMonth);
        for (let i = 1; i <= remainingCells; i++) {
            html += `<div class="date-cell next-month">${i}</div>`;
        }

        calendarDates.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', generateCalendar);
</script>
@endsection