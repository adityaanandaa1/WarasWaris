@extends('layouts.app')

@section('content')

<div class="w-full bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        <!-- Back Button -->
        <a href="{{ route('pasien.dashboard') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold mb-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Riwayat
        </a>

        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-3xl shadow-xl p-6 md:p-8 mb-6 text-white">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 bg-white bg-opacity-20 backdrop-blur-sm rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Detail Rekam Medis</h1>
                    <p class="text-blue-100 mt-1">{{ $pasien_aktif->nama_pasien }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-white bg-opacity-10 backdrop-blur-sm rounded-xl p-4">
                <div>
                    <p class="text-sm text-blue-100">No. Rekam Medis</p>
                    <p class="text-lg font-bold">{{ $dataPublik['nomor_rekam_medis'] }}</p>
                </div>
                <div>
                    <p class="text-sm text-blue-100">Tanggal Pemeriksaan</p>
                    <p class="text-lg font-bold">{{ $dataPublik['tanggal_pemeriksaan'] }}</p>
                </div>
            </div>
        </div>

        <!-- Data Vital Signs -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Tanda Vital
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Tinggi Badan -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                        <p class="text-xs text-gray-600 font-medium">Tinggi Badan</p>
                    </div>
                    <p class="text-2xl font-bold text-blue-700">{{ $dataPublik['tinggi_badan'] ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-1">cm</p>
                </div>

                <!-- Berat Badan -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                        </svg>
                        <p class="text-xs text-gray-600 font-medium">Berat Badan</p>
                    </div>
                    <p class="text-2xl font-bold text-green-700">{{ $dataPublik['berat_badan'] ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-1">kg</p>
                </div>

                <!-- Tekanan Darah -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-4 border border-red-200">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <p class="text-xs text-gray-600 font-medium">Tekanan Darah</p>
                    </div>
                    <p class="text-2xl font-bold text-red-700">{{ $dataPublik['tekanan_darah'] ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-1">mmHg</p>
                </div>

                <!-- Suhu -->
                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-4 border border-orange-200">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <p class="text-xs text-gray-600 font-medium">Suhu Tubuh</p>
                    </div>
                    <p class="text-2xl font-bold text-orange-700">{{ $dataPublik['suhu'] ?? '-' }}</p>
                    <p class="text-xs text-gray-500 mt-1">°C</p>
                </div>
            </div>
        </div>

        <!-- Diagnosa -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Diagnosa
            </h2>
            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100">
                <p class="text-gray-800 leading-relaxed">{{ $dataPublik['diagnosa'] ?? 'Tidak ada diagnosa' }}</p>
            </div>
        </div>

        <!-- Saran & Tindak Lanjut -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Saran -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Saran Dokter
                </h2>
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $dataPublik['saran'] ?? 'Tidak ada saran' }}</p>
                </div>
            </div>

            <!-- Rencana Tindak Lanjut -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Rencana Tindak Lanjut
                </h2>
                <div class="bg-green-50 rounded-xl p-4 border border-green-100">
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $dataPublik['rencana_tindak_lanjut'] ?? 'Tidak ada rencana tindak lanjut' }}</p>
                </div>
            </div>
        </div>

        <!-- Catatan Tambahan -->
        @if($dataPublik['catatan_tambahan'])
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
                Catatan Tambahan
            </h2>
            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-6 border border-amber-100">
                <p class="text-gray-700 leading-relaxed">{{ $dataPublik['catatan_tambahan'] }}</p>
            </div>
        </div>
        @endif

        <!-- Info Privacy -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mt-6">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <div>
                    <p class="text-sm text-blue-800 font-medium">Informasi Privasi</p>
                    <p class="text-sm text-blue-700 mt-1">
                        Data alergi, riwayat penyakit, dan resep obat tidak ditampilkan untuk menjaga privasi Anda. 
                        Silakan berkonsultasi langsung dengan dokter untuk informasi lengkap.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection