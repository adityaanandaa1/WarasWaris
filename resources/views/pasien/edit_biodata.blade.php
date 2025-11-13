@extends('layouts.app')

@section('title', 'Edit Biodata - WarasWaris')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center p-4">
    
    <!-- Modal Container -->
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl relative">
        
        <!-- Close Button (X) -->
        <a 
            href="{{ route('pasien.dashboard') }}"
            class="absolute top-6 left-6 w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-600 transition"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </a>

        <!-- Header -->
        <div class="text-center pt-12 pb-8 px-8">
            <h1 class="text-3xl font-bold text-blue-600">
                @if($pasien->is_primary)
                    Edit Biodata Utama
                @else
                    Edit Anggota Keluarga
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
        <form action="{{ route('pasien.update_biodata', $pasien->id) }}" method="POST" enctype="multipart/form-data" class="px-8 pb-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- LEFT SIDE - Form Fields (2 columns) -->
                <div class="lg:col-span-2 space-y-5">
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <input 
                            type="text" 
                            name="nama_pasien" 
                            value="{{ old('nama_pasien', $pasien->nama_pasien) }}"
                            placeholder="Isi Nama Lengkap"
                            required
                            class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                        >
                    </div>

                    <!-- Nama Wali (hanya untuk anggota keluarga) -->
                    @if(!$pasien->is_primary)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Wali
                        </label>
                        <input 
                            type="text" 
                            value="{{ Auth::user()->pasiens->where('is_primary', true)->first()->nama_pasien ?? 'Pemilik Akun' }}"
                            disabled
                            class="w-full px-4 py-3 bg-gray-100 border-0 rounded-xl text-gray-600"
                        >
                    </div>
                    @endif

                    <!-- Row: Jenis Kelamin & No Telepon -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Kelamin
                            </label>
                            <div class="relative">
                                <select 
                                    name="jenis_kelamin"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl appearance-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                                >
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                No Telepon
                            </label>
                            <input 
                                type="tel" 
                                name="no_telepon" 
                                value="{{ old('no_telepon', $pasien->no_telepon) }}"
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Lahir
                            </label>
                            <div class="relative">
                                <input 
                                    type="date" 
                                    name="tanggal_lahir_pasien" 
                                    value="{{ old('tanggal_lahir_pasien', optional($pasien->tanggal_lahir_pasien)->format('Y-m-d')) }}"
                                    max="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                                >
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                </div>
                            </div>
                        </div>

                        <!-- Golongan Darah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Golongan Darah
                            </label>
                            <div class="relative">
                                <select 
                                    name="golongan_darah"
                                    class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl appearance-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                                >
                                    <option value="">Pilih Golongan Darah</option>
                                    <option value="A" {{ old('golongan_darah', $pasien->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('golongan_darah', $pasien->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('golongan_darah', $pasien->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('golongan_darah', $pasien->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pekerjaan
                            </label>
                            <input 
                                type="text" 
                                name="pekerjaan" 
                                value="{{ old('pekerjaan', $pasien->pekerjaan) }}"
                                placeholder="Isi Pekerjaan"
                                class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                            >
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat
                            </label>
                            <input 
                                type="text" 
                                name="alamat" 
                                value="{{ old('alamat', $pasien->alamat) }}"
                                placeholder="Isi Alamat Lengkap"
                                required
                                class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                            >
                        </div>

                    </div>

                    <!-- Catatan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan
                        </label>
                        <textarea 
                            name="catatan" 
                            rows="4"
                            placeholder="Catatan tambahan (opsional)"
                            class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition resize-none"
                        >{{ old('catatan', $pasien->catatan) }}</textarea>
                    </div>

                </div>

                <!-- RIGHT SIDE - Photo Display/Upload -->
                <div class="lg:col-span-1 flex flex-col items-center justify-start pt-4">
                    
                    <!-- Photo Circle -->
                    <div class="relative mb-4">
                        @if($pasien->foto)
                            <div class="w-40 h-40 rounded-full overflow-hidden shadow-lg">
                                <img src="{{ asset('storage/' . $pasien->foto) }}" alt="Foto Pasien" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-40 h-40 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Camera Icon (Bottom Right) -->
                        <div class="absolute bottom-2 right-2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Upload Text -->
                    <p class="text-sm font-medium text-gray-700 mb-1">Ubah Foto</p>
                    <p class="text-xs text-gray-500 text-center px-4 mb-4">
                        Pilih file untuk mengganti foto saat ini
                    </p>

                    <!-- File Input -->
                    <input 
                        type="file" 
                        name="foto" 
                        accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        id="foto-input"
                    >

                </div>

            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-between items-center">
                <!-- Delete Button (only for non-primary profiles) -->
                @if(!$pasien->is_primary)
                <form action="{{ route('pasien.hapus_biodata', $pasien->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus biodata ini?')"
                        class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition duration-200 text-sm"
                    >
                        Hapus
                    </button>
                </form>
                @else
                <div></div> <!-- Empty div to maintain flex spacing -->
                @endif

                <!-- Update Button -->
                <button 
                    type="submit"
                    class="px-12 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition duration-200 text-lg"
                >
                    Perbarui
                </button>
            </div>

        </form>

    </div>

</div>

<!-- Script for image preview -->
<script>
    document.getElementById('foto-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Replace the current image with the new one
                const photoContainer = document.querySelector('.relative.mb-4');
                photoContainer.innerHTML = `
                    <div class="w-40 h-40 rounded-full overflow-hidden shadow-lg">
                        <img src="${e.target.result}" alt="Preview Foto" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute bottom-2 right-2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                `;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection