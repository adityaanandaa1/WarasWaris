@extends('layouts.app')

@section('title', 'Isi Biodata - WarasWaris')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4">
        
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                @if($isPrimary)
                    Lengkapi Biodata Anda
                @else
                    Tambah Anggota Keluarga
                @endif
            </h1>
            <p class="text-gray-600 mt-2">
                @if($isPrimary)
                    Silakan isi biodata Anda untuk melanjutkan
                @else
                    Tambahkan data anggota keluarga yang ingin didaftarkan
                @endif
            </p>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('pasien.simpan_biodata') }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
            @csrf
            
            <div class="space-y-6">
                
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_pasien" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="nama_pasien" 
                        id="nama_pasien" 
                        value="{{ old('nama_pasien') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: Budi Santoso"
                    >
                </div>

                <!-- Tanggal Lahir & Jenis Kelamin -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir_pasien" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="date" 
                            name="tanggal_lahir_pasien" 
                            id="tanggal_lahir_pasien" 
                            value="{{ old('tanggal_lahir_pasien') }}"
                            max="{{ date('Y-m-d') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-4 mt-3">
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="jenis_kelamin" 
                                    value="Laki-laki" 
                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}
                                    required
                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                >
                                <span class="ml-2 text-gray-700">Laki-laki</span>
                            </label>
                            <label class="flex items-center">
                                <input 
                                    type="radio" 
                                    name="jenis_kelamin" 
                                    value="Perempuan" 
                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}
                                    required
                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                >
                                <span class="ml-2 text-gray-700">Perempuan</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="alamat" 
                        id="alamat" 
                        rows="3"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: Jl. Merdeka No. 123, Malang"
                    >{{ old('alamat') }}</textarea>
                </div>

                <!-- No Telepon & Pekerjaan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- No Telepon -->
                    <div>
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="tel" 
                            name="no_telepon" 
                            id="no_telepon" 
                            value="{{ old('no_telepon') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: 081234567890"
                        >
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label for="pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">
                            Pekerjaan
                        </label>
                        <input 
                            type="text" 
                            name="pekerjaan" 
                            id="pekerjaan" 
                            value="{{ old('pekerjaan') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: Guru"
                        >
                    </div>

                </div>

                <!-- Catatan -->
                <div>
                    <label for="catatan_pasien" class="block text-sm font-medium text-gray-700 mb-2">
                        Catatan Tambahan
                    </label>
                    <textarea 
                        name="catatan_pasien" 
                        id="catatan_pasien" 
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Contoh: Alergi udang, riwayat asma"
                    >{{ old('catatan_pasien') }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">
                        Informasi penting seperti alergi, riwayat penyakit, dll.
                    </p>
                </div>

            </div>

            <!-- Buttons -->
            <div class="flex gap-4 mt-8">
                @if(!$isPrimary)
                    <a 
                        href="{{ route('pasien.dashboard') }}"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition"
                    >
                        Batal
                    </a>
                @endif
                <button 
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition"
                >
                    Simpan Biodata
                </button>
            </div>

        </form>

    </div>
</div>
@endsection