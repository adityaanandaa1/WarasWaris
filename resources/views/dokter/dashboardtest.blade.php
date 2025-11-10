@extends('layouts.app')

@section('content')

@php($hari_ini = $hari_ini ?? \Carbon\Carbon::today())
@php($nama_hari = $nama_hari ?? $hari_ini->locale('id')->translatedFormat('l'))

<div class="w-full bg-gradient-to-br from-blue-50 to-indigo-100 py-6 px-4 sm:px-6 lg:px-8 pb-12">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Welcome Banner -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-3xl shadow-xl p-6 md:p-8 mb-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl px-4 py-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-white text-sm font-medium">{{ $nama_hari }}, {{ $hari_ini->format('d F Y') }} </span>
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                        Selamat Datang, {{ Auth::user()->dokter->nama_dokter }}!
                    </h1>
                    <p class="text-blue-100 text-lg">Semoga harimu menyenangkan dan produktif! 🎉</p>
                </div>
                
                <!-- Ilustrasi Dokter -->
                <div class="hidden md:block">
                    <div class="w-48 h-48 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-red-700 font-medium">{{ $errors->first() }}</p>
            </div>
        </div>
        @endif

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            
            <!-- Left Column - Jam Praktik & Nomor Antrian -->
            <div class="space-y-6">
                
                <!-- Card Jam Praktik -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Jam Praktik
                        </h3>
                    </div>

                    @if($jadwal && $jadwal->is_active)
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-4">
                        <div class="flex justify-center items-center gap-4">
                            <div class="text-center">
                                <p class="text-xs text-gray-500 mb-1">Buka</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $jadwal->jam_mulai ?? '-' }}</p>
                            </div>
                            <div class="text-2xl font-bold text-blue-500">-</div>
                            <div class="text-center">
                                <p class="text-xs text-gray-500 mb-1">Tutup</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $jadwal->jam_selesai ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <button onclick="document.getElementById('modalJadwal').classList.remove('hidden')" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-xl transition-colors duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Atur Ulang Jadwal
                    </button>
                    @else
                    <div class="bg-gray-100 rounded-xl p-6 mb-4 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <p class="text-gray-600 font-medium">Tidak Ada Jadwal Hari Ini</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $nama_hari }}</p>
                    </div>
                    @endif
                </div>

                <!-- Card Nomor Antrian -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Nomor Antrian Berjalan
                    </h3>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-8 text-center mb-4">
                        <p class="text-7xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            {{ $antrian->nomor_sekarang }}
                        </p>
                        <p class="text-sm text-gray-600 mt-2">dari {{ $antrian->total_antrian }} total antrian</p>
                    </div>
                </div>

            </div>

            <!-- Middle Column - Statistik Laporan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Statistik Laporan
                    </h3>
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">
                        Hari Ini
                    </span>
                </div>

                <div class="space-y-6">
                    <!-- Total Reservasi -->
                    <div class="bg-gradient-to-br from-pink-50 to-rose-50 rounded-xl p-6 border border-pink-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Reservasi</p>
                                <p class="text-5xl font-bold text-pink-600">{{ $total_reservasi }}</p>
                            </div>
                            <div class="w-16 h-16 bg-pink-200 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pasien Terlayani -->
                    <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-6 border border-purple-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Pasien Terlayani</p>
                                <p class="text-5xl font-bold text-purple-600">{{ $pasien_terlayani }}</p>
                            </div>
                            <div class="w-16 h-16 bg-purple-200 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>

                    </div>

                    <!-- Pasien Tidak Hadir -->
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Pasien Tidak Hadir</p>
                                <p class="text-5xl font-bold text-blue-600">{{ $pasien_batal }}</p>
                            </div>
                            <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Profil & Kalender -->
            <div class="space-y-6">
                
                <!-- Card Profil Dokter -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </h3>

                    <div class="text-center mb-4">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                            {{ substr(Auth::user()->dokter->nama_dokter, 0, 2) }}
                        </div>
                        <h4 class="text-lg font-bold text-gray-800">{{ Auth::user()->dokter->nama_dokter }}</h4>
                        <p class="text-sm text-gray-600 mt-1">Dokter Umum</p>
                        <p class="text-sm text-gray-600 mt-1">Kalisat, Jember</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-4 border-t">
                        <div class="text-center">
                            <p class="text-xs text-gray-500">No. SIP</p>
                            <p class="text-sm font-semibold text-gray-800 mt-1">{{ Auth::user()->dokter->nomor_sip ?? '-' }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xs text-gray-500">Pengalaman</p>
                            <p class="text-sm font-semibold text-gray-800 mt-1">12 Tahun</p>
                        </div>
                    </div>
                </div>

                <!-- Card Kalender Mini -->
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Kalender
                    </h3>

                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4">
                        <div class="text-center mb-3">
                            <h4 class="text-2xl font-bold">{{ $hari_ini->format('F Y') }}</h4>
                        </div>
                        
                        <div class="grid grid-cols-7 gap-2 text-center text-xs mb-2">
                            <div class="font-semibold">Sen</div>
                            <div class="font-semibold">Sel</div>
                            <div class="font-semibold">Rab</div>
                            <div class="font-semibold">Kam</div>
                            <div class="font-semibold">Jum</div>
                            <div class="font-semibold">Sab</div>
                            <div class="font-semibold">Min</div>
                        </div>

                        <div class="grid grid-cols-7 gap-2 text-center text-sm">
                            @php
                                $startOfMonth = $hari_ini->copy()->startOfMonth();
                                $endOfMonth = $hari_ini->copy()->endOfMonth();
                                $startDayOfWeek = $startOfMonth->dayOfWeek == 0 ? 7 : $startOfMonth->dayOfWeek;
                                
                                // Hari-hari dari bulan sebelumnya
                                for($i = 1; $i < $startDayOfWeek; $i++) {
                                    echo '<div class="text-white text-opacity-40 py-1"></div>';
                                }
                                
                                // Hari-hari bulan ini
                                for($day = 1; $day <= $endOfMonth->day; $day++) {
                                    $isToday = $day == $hari_ini->day;
                                    $class = $isToday 
                                        ? 'bg-white text-blue-600 font-bold rounded-lg py-1' 
                                        : 'text-white py-1 hover:bg-white hover:bg-opacity-20 rounded-lg cursor-pointer';
                                    echo "<div class='$class'>$day</div>";
                                }
                            @endphp
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal Atur Jadwal -->
<div id="modalJadwal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800">Atur Jadwal Praktik</h3>
            <button onclick="document.getElementById('modalJadwal').classList.add('hidden')" 
                    class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form action="{{ route('dokter.update.jadwal',  $jadwal->id ?? 0) }}"  method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" value="{{ $hari_ini->format('Y-m-d') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" id="statusSelect" required onchange="toggleJamInput()"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="buka">Buka</option>
                    <option value="libur">Libur</option>
                </select>
            </div>

            <div id="jamInputs">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                        <input type="time" name="jam_mulai"  value="{{ old('jam_mulai', $jadwal && $jadwal->jam_mulai ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '09:00') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                        <input type="time" name="jam_selesai"  value="{{ old('jam_selesai', $jadwal && $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '21:00') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <div id="catatanInput" class="hidden">
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Libur</label>
                <textarea name="catatan" rows="3" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Alasan libur praktik..."></textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" 
                        onclick="document.getElementById('modalJadwal').classList.add('hidden')"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors">
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
</script>

@endsection