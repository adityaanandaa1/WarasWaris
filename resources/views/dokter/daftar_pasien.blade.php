@extends('layouts.app')

@section('content')

@php($hari_ini = $hari_ini ?? \Carbon\Carbon::today())
@php($nama_hari = $nama_hari ?? $hari_ini->locale('id')->translatedFormat('l'))

<div class="w-full bg-gradient-to-br from-blue-50 to-indigo-100 h-screen overflow-y-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header with Date -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Daftar Pasien Antrian</h1>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">{{ $nama_hari }}, {{ $hari_ini->format('d F Y') }}</span>
                    </div>
                </div>
                
                <!-- Search Box -->
                <div class="relative w-full max-w-md">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Cari pasien berdasarkan nama..."
                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:outline-none transition-colors">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column - Daftar Pasien (2/3 width) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Daftar Pasien Hari Ini
                        <span class="ml-auto bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $daftar_pasien->count() }} Pasien
                        </span>
                    </h3>

                    <!-- List Pasien -->
                    <div class="space-y-3" id="patientList">
                        @forelse($daftar_pasien as $pasien)
                        <div class="patient-item bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 hover:shadow-md transition-shadow duration-200 border border-blue-100">
                            <div class="flex items-center gap-4">
                                <!-- Nomor Antrian -->
                                <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-3xl font-bold text-white">{{ $pasien->nomor_antrian }}</span>
                                </div>

                                <!-- Info Pasien -->
                                <div class="flex-grow">
                                    <h4 class="text-lg font-bold text-gray-800 patient-name">{{ $pasien->nama_pasien }}</h4>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex-shrink-0 flex gap-2">
                                    <a 
                                       class="px-4 py-2 bg-white border-2 border-blue-500 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-colors duration-200 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Lihat Reservasi
                                    </a>
                                    @if ($pasien->status === 'selesai')
                                    <span class="px-3 py-2 bg-green-100 text-green-700 rounded-lg font-semibold">Selesai</span>

                                    @else
                                        <form action="{{ route('dokter.reservasi.periksa', $pasien->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                                            Periksa
                                        </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-gray-500 text-lg font-medium">Belum ada pasien antrian hari ini</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column - Info Cards -->
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
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
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
                    @else
                    <div class="bg-gray-100 rounded-xl p-6 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <p class="text-gray-600 font-medium">Tidak Ada Jadwal</p>
                    </div>
                    @endif
                </div>

                <!-- Card Nomor Antrian Berjalan -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Nomor Antrian Berjalan
                    </h3>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-8 text-center">
                        <p class="text-7xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            {{ $antrian->nomor_sekarang ?? 0 }}
                        </p>
                        <p class="text-sm text-gray-600 mt-2">Sedang Dilayani</p>
                    </div>
                </div>

                <!-- Card Total Antrian -->
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Jumlah Antrian
                    </h3>
                    
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-8 text-center">
                        <p class="text-6xl font-bold">{{ $antrian->total_antrian ?? 0 }}</p>
                        <p class="text-sm mt-2 text-blue-100">Total Pasien Hari Ini</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
// Real-time Search Functionality
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
</script>

@endsection