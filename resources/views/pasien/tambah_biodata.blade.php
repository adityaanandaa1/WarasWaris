@extends('layouts.app')

@section('title', 'Tambah Biodata - WarasWaris')

@section('content')

<div class="min-h-screen bg-[#5A81FA]  overflow-y-auto flex justify-center p-10">
    
    <!-- Modal Container -->
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-7xl relative overflow-auto">
        
        <!-- Close Button (X) -->
        <a 
            href="{{ route('pasien.dashboard') }}"
            class="absolute top-6 left-6 w-8 h-8 bg-[#CEDEFF] hover:bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold transition"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </a>

        <!-- Header -->
        <div class="text-center pt-10 pb-8 px-8">
            <h1 class="text-2xl font-bold text-[#5A81FA]">
                @if($isPrimary)
                    Tambah Biodata Utama
                @else
                    Tambah Anggota Keluarga
                @endif
            </h1>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mx-8 mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('pasien.simpan_biodata') }}" method="POST" enctype="multipart/form-data" class="px-20 pb-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- LEFT SIDE - Form Fields (2 columns) -->
                <div class="lg:col-span-2 space-y-5">
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Nama Lengkap
                        </label>
                        <input 
                            type="text" 
                            name="nama_pasien" 
                            value="{{ old('nama_pasien') }}"
                            placeholder="Isi Nama Lengkap"
                            required
                            class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                        >
                    </div>

                    <!-- Nama Wali (hanya untuk anggota keluarga) -->
                    @if(!$isPrimary)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Nama Wali
                        </label>
                        <input 
                            type="text" 
                            value="{{ Auth::user()->pasiens->where('is_primary', true)->first()->nama_pasien ?? 'Pemilik Akun' }}"
                            disabled
                            class="w-full px-4 py-3 bg-gray-100 border-0 rounded-xl text-[#5A81FA]"
                        >
                    </div>
                    @endif

                    <!-- Row: Jenis Kelamin & No Telepon -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Jenis Kelamin
                            </label>
                            <div class="relative">
                                <select 
                                    name="jenis_kelamin"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl appearance-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                                >
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                No Telepon
                            </label>
                            <input 
                                type="tel" 
                                name="no_telepon" 
                                value="{{ old('no_telepon') }}"
                                placeholder="Isi Nomor Telepon"
                                required
                                class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                            >
                        </div>

                    </div>

                    <!-- Row: Tanggal Lahir & Golongan Darah -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Tanggal Lahir
                            </label>
                            <div class="relative">
                                <input 
                                    type="date" 
                                    name="tanggal_lahir_pasien" 
                                    value="{{ old('tanggal_lahir_pasien') }}"
                                    max="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                                >
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Golongan Darah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Golongan Darah
                            </label>
                            <div class="relative">
                                <select 
                                    name="golongan_darah"
                                    class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl appearance-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                                >
                                    <option value="">Pilih Golongan Darah</option>
                                    <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                                </select>
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Row: Pekerjaan & Alamat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Pekerjaan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Pekerjaan
                            </label>
                            <input 
                                type="text" 
                                name="pekerjaan" 
                                value="{{ old('pekerjaan') }}"
                                placeholder="Isi Pekerjaan"
                                class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                            >
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Alamat
                            </label>
                            <input 
                                type="text" 
                                name="alamat" 
                                value="{{ old('alamat') }}"
                                placeholder="Isi Alamat Lengkap"
                                required
                                class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                            >
                        </div>

                    </div>

                    <!-- Catatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            Catatan
                        </label>
                        <textarea 
                            name="catatan_pasien" 
                            rows="4"
                            placeholder="Catatan tambahan (opsional)"
                            class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition resize-none"
                        >{{ old('catatan_pasien') }}</textarea>
                    </div>

                </div>

                <!-- RIGHT SIDE - Photo Upload -->
                <div class="lg:col-span-1 flex flex-col items-center justify-start pt-4">
                    
                    <!-- Photo Circle (Placeholder) -->
                    <div class="relative mb-4">
                        <div class="w-40 h-40 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        
                        <!-- Camera Icon (Bottom Right) -->
                        <div class="absolute bottom-2 right-2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Upload Text -->
                    <p class="text-sm font-medium text-gray-600 mb-1">Tambahkan Foto</p>
                    <p class="text-xs text-gray-500 text-center px-4">
                        (Fitur upload foto akan segera hadir)
                    </p>

                    <!-- Hidden Input (untuk nanti) -->
                    <input 
                        type="file" 
                        name="foto" 
                        accept="image/*"
                        class="hidden"
                        id="foto-input"
                        disabled
                    >

                </div>

            </div>

            <!-- Submit Button -->
                <button 
                    type="submit"
                    class="ml-auto px-12 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition duration-200 text-lg"
                >
                    Simpan
                </button>


        </form>

    </div>

</div>
@endsection