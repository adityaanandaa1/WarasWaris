@extends('layouts.app')

@section('title', 'Dashboard Pasien - WarasWaris')

@section('content')
<div class="min-h-screen bg-gray-50">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-blue-600">WarasWaris</h1>
                </div>

                <!-- User Menu -->
                <div class="flex items-center gap-4">
                    <span class="text-gray-700">{{ Auth::user()->email }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition"
                        >
                            Keluar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- SIDEBAR -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    
                    <!-- Pasien Aktif Info -->
                    <div class="mb-6 pb-6 border-b">
                        <h3 class="text-sm font-medium text-gray-500 mb-3">Profil Aktif</h3>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-lg">
                                    {{ strtoupper(substr(($pasien_aktif->nama_pasien ?? ''), 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $pasien_aktif->nama_pasien }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $pasien_aktif->jenis_kelamin_pasien == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- List Semua Pasien -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-500 mb-3">Daftar Pasien</h3>
                        <div class="space-y-2">
                            @foreach($pasiens as $pasien)
                                <form action="{{ route('pasien.ganti_profil', $pasien->id) }}" method="POST">
                                    @csrf
                                    <button 
                                        type="submit"
                                        class="w-full text-left px-3 py-2 rounded-lg transition
                                            {{ $pasien->id == $pasien_aktif->id 
                                                ? 'bg-blue-50 text-blue-700 font-medium' 
                                                : 'hover:bg-gray-50 text-gray-700' 
                                            }}"
                                    >
                                        <div class="flex items-center justify-between">
                                            <span>{{ $pasien->nama_pasien }}</span>
                                            @if($pasien->is_primary)
                                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Utama</span>
                                            @endif
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol Tambah Anggota -->
                    <a 
                        href="{{ route('pasien.tambah_biodata') }}"
                        class="block w-full text-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition"
                    >
                        + Tambah Anggota Keluarga
                    </a>

                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="lg:col-span-3">
                
                <!-- Header -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Dashboard Pasien</h2>
                    <p class="text-gray-600 mt-1">Kelola data kesehatan Anda dan keluarga</p>
                </div>

                <!-- Biodata Card -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Biodata</h3>
                        <a 
                            href="{{ route('pasien.edit_biodata', $pasien_aktif->id) }}"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition text-sm"
                        >
                            Edit Biodata
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="font-medium text-gray-900">{{ $pasien_aktif->nama_pasien }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Lahir</p>
                            <p class="font-medium text-gray-900">
                        @php
                            // Normalisasi ke Carbon (tanpa "use" supaya tak tabrakan)
                            $dobRaw = $pasien_aktif->tanggal_lahir_pasien ?? null;

                            $dob = ($dobRaw instanceof \Carbon\Carbon || $dobRaw instanceof \Illuminate\Support\Carbon)
                                ? $dobRaw
                                : ($dobRaw ? \Illuminate\Support\Carbon::parse($dobRaw) : null);

                            // (opsional) bulan Indonesia
                            if ($dob) { $dob->locale('id'); }

                            $tanggalFmt = $dob ? $dob->translatedFormat('d F Y') : '-';
                            $umur       = $dob ? $dob->age : '-';
                        @endphp

                        {{ $tanggalFmt }} ({{ $umur }} tahun)

                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jenis Kelamin</p>
                            <p class="font-medium text-gray-900">
                                {{ $pasien_aktif->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Golongan Darah</p>
                            <p class="font-medium text-gray-900">{{ $pasien_aktif->golongan_darah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nomor Telepon</p>
                            <p class="font-medium text-gray-900">{{ $pasien_aktif->no_telepon }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="font-medium text-gray-900">{{ $pasien_aktif->alamat }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Pekerjaan</p>
                            <p class="font-medium text-gray-900">{{ $pasien_aktif->pekerjaan ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Catatan</p>
                            <p class="font-medium text-gray-900">{{ $pasien_aktif->catatan_pasien ?? '-' }}</p>
                        </div>
                    </div>

                    

                    <!-- Tombol Hapus (hanya untuk anggota keluarga) -->
                    @if(!$pasien_aktif->is_primary)
                        <div class="mt-6 pt-6 border-t">
                            <form 
                                action="{{ route('pasien.hapus_biodata', $pasien_aktif->id) }}" 
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $pasien_aktif->nama_pasien}}?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition text-sm"
                                >
                                    Hapus Anggota Keluarga
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Menu Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Reservasi Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Reservasi</h3>
                                <p class="text-sm text-gray-500">Ambil nomor antrian</p>
                            </div>
                        </div>
                        <a 
                            href="{{ route('pasien.index_reservasi') }}"
                            class="mt-4 block text-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition"
                        >
                            Buat Reservasi
                        </a>
                    </div>

                    <!-- Riwayat Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">Riwayat Pemeriksaan</h3>
                                <p class="text-sm text-gray-500">Lihat riwayat medis</p>
                            </div>
                        </div>
                        <a 
                            href="{{ route('pasien.riwayat_reservasi') }}"
                            class="mt-4 block text-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition"
                        >
                            Lihat Riwayat
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection