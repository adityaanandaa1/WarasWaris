<!-- Sidebar Profil -->
<div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
    
    <!-- Profil Saya - Dropdown -->
    <div class="mb-6">
        <button 
            onclick="toggleProfilDropdown()"
            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-4 hover:from-blue-600 hover:to-blue-700 transition"
        >
            <div class="flex items-center justify-between">
                <span class="font-semibold">Profil Saya</span>
                <svg id="dropdown-icon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </button>

        <!-- Dropdown Content -->
        <div id="profil-dropdown" class="hidden mt-3 space-y-3">
            
            <!-- Pasien Aktif -->
            <div class="bg-blue-50 rounded-xl p-4 border-2 border-blue-200">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-xl">
                            {{ substr($pasien_aktif->nama_pasien, 0, 1) }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-900">{{ $pasien_aktif->nama_pasien }}</p>
                        <p class="text-xs text-gray-600">{{ $pasien_aktif->no_telepon }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="text-center p-2 bg-white rounded-lg">
                        <p class="text-gray-500 text-xs">Jenis Kelamin</p>
                        <p class="font-semibold text-gray-900">
                            {{ $pasien_aktif->jenis_kelamin == 'L' ? 'L' : 'P' }}
                        </p>
                    </div>
                    <div class="text-center p-2 bg-white rounded-lg">
                        <p class="text-gray-500 text-xs">Umur</p>
                        <p class="font-semibold text-gray-900">
                            @if($pasien_aktif && $pasien_aktif->tanggal_lahir_pasien)
                                {{ $pasien_aktif->tanggal_lahir_pasien->age }} Tahun
                                @else
                                -
                                @endif
                    </div>
                </div>
            </div>

            <!-- List Anggota Keluarga -->
            @if($pasiens->count() > 1)
                <div class="space-y-2">
                    <p class="text-xs font-medium text-gray-500 px-2">Anggota Keluarga:</p>
                    @foreach($pasiens as $pasien)
                        @if($pasien->id != $pasien_aktif->id)
                            <form action="{{ route('pasien.ganti_profil', $pasien->id) }}" method="POST">
                                @csrf
                                <button 
                                    type="submit"
                                    class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition"
                                >
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                            <span class="text-gray-700 font-semibold text-sm">
                                                {{ substr($pasien->nama_lengkap, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900 text-sm">{{ $pasien->nama_lengkap }}</p>
                                            <p class="text-xs text-gray-500">{{ $pasien->tanggal_lahir_pasien->age }} tahun</p>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        @endif
                    @endforeach
                </div>
            @endif

            <!-- Tombol Tambah Anggota -->
            <a 
                href="{{ route('pasien.tambah_biodata') }}"
                class="block w-full text-center px-4 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg transition font-medium text-sm"
            >
                + Tambah Anggota Keluarga
            </a>

        </div>
    </div>

    <!-- Reminders -->
    <div class="bg-blue-50 rounded-xl p-4">
        <h3 class="font-semibold text-blue-900 mb-3">Reminders</h3>
        
        <div id="reminder-content" class="text-sm text-blue-800">
            @if(isset($reminderAktif))
                <div class="flex items-start gap-2 p-3 bg-yellow-100 border border-yellow-300 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-yellow-900">Antrian Hampir Tiba!</p>
                        <p class="text-xs text-yellow-800 mt-1">
                            Nomor antrian Anda: <strong>#{{ $reminderAktif->nomor_antrian }}</strong>
                            <br>Nomor sekarang: <strong>#{{ $reminderAktif->nomor_sekarang }}</strong>
                            <br>Sisa <strong>{{ $reminderAktif->nomor_antrian - $reminderAktif->nomor_sekarang }}</strong> antrian lagi
                        </p>
                    </div>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Tidak ada reminder</p>
            @endif
        </div>
    </div>

    <!-- Tombol Keluar Akun -->
    <form action="{{ route('logout') }}" method="POST" class="mt-6">
        @csrf
        <button 
            type="submit"
            class="w-full bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-semibold py-3 rounded-xl transition shadow-lg flex items-center justify-center gap-2"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Keluar Akun
        </button>
    </form>

</div>

<script>
function toggleProfilDropdown() {
    const dropdown = document.getElementById('profil-dropdown');
    const icon = document.getElementById('dropdown-icon');
    
    dropdown.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>