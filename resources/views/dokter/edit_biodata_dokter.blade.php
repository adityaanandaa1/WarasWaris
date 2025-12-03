@extends('layouts.editprofiledokter')

@section('title', 'Edit Biodata Dokter- WarasWaris')

@section('content')

@php
    $tanggalLahirValue = old('tanggal_lahir_dokter');
    if ($tanggalLahirValue === null && $dokter->tanggal_lahir_dokter) {
        try {
            $tanggalLahirValue = \Carbon\Carbon::parse($dokter->tanggal_lahir_dokter)->format('Y-m-d');
        } catch (\Exception $e) {
            $tanggalLahirValue = $dokter->tanggal_lahir_dokter; // fallback tampilkan apa adanya
        }
    }

    $sipPath     = $dokter->sip_path ?? null;
    $sipFileName = $sipPath ? basename($sipPath) : null;
@endphp

<form action="{{ route('dokter.profil.update') }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @method('PUT')

    <div class="editprofile-container">
        <div class="editprofile-header">
            <a href="{{ route('dokter.dashboard') }}">
                <i class="icon-back fa-solid fa-x"></i>
            </a>
            <h1 class="editprofile-title">Biodata Dokter</h1>
        </div>
        
        <div class="editprofile-top">
            <div class="editprofile-left">
                <div class="editprofile-field">
                    <label class="editprofile-label">
                        Nama Lengkap
                    </label>
                    <input type="text" name="nama_dokter" value="{{ old('nama_dokter', $dokter->nama_dokter) }}" required class="editprofile-input">
                </div>
            
                <div class="editprofile-field">
                    <label class="editprofile-label">
                        Tanggal Lahir
                    </label>
                    <input 
                        type="date" 
                        name="tanggal_lahir_dokter" 
                        value="{{ $tanggalLahirValue }}" 
                        max="{{ date('Y-m-d') }}" 
                        class="editprofile-input">
                </div>
            </div>
        
            <div class="editprofile-photo">
                @php
                    $fotoUrl = $dokter->foto_path ? asset('storage/'.$dokter->foto_path) : null;
                    $initial = strtoupper(mb_substr($dokter->nama_dokter ?? 'D', 0, 1));
                @endphp
                <label class="editprofile-photo-wrapper">
                    <div class="editprofile-photo-preview">
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" 
                                 alt="{{ $dokter->nama_dokter }}" 
                                 class="profile-img"
                                 onerror="this.style.display='none'; document.getElementById('fotoFallback').style.display='flex';">
                        @else
                            <div id="fotoFallback" class="fallback">
                                {{ $initial }}
                                <p class="editprofile-photo-text">Tambahkan Foto</p>
                            </div>
                        @endif
                        
                        <i class="icon-kamera fa-solid fa-camera"></i>
                    </div>
                
                    <input type="file" name="foto" accept="image/*" class="editprofile-photo-input">
                </label>
            </div>
        </div>

        <div class="editprofile-sip-section">
            <label class="editprofile-label">
                Dokumen SIP
            </label>
            <div id="drop-area" class="editprofile-drop-area">
                <i class="ri-upload-2-line"></i>
                <input type="file" id="fileInput" name="sip_file" accept=".pdf,.jpg,.jpeg,.png" hidden>
                <p id="dropText" class="editprofile-drop-text">
                    {{ $sipFileName ?? 'Drop file here' }}
                </p>
                <p class="editprofile-drop-description"> pdf/jpg/png, maks 2MB</p>
            </div>
            @if($sipPath)
                <p class="mt-2 text-sm text-gray-600">
                    File saat ini: 
                    <a href="{{ route('dokter.sip.download') }}" class="text-blue-600 underline" target="_blank" rel="noopener">
                        {{ $sipFileName }}
                    </a>
                </p>
            @endif
        </div>
        
        <div class="editprofile-submit">
            <button type="submit" class="editprofile-button">
                Simpan
            </button>
        </div>
    </div>
</form>

<script>
const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("fileInput");
const dropText = document.getElementById("dropText");

dropArea.addEventListener("click", () => fileInput.click());

// Saat drag di atas
dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.classList.add("dragover");
});

// Saat drag keluar
dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("dragover");
});

// Saat file di-drop
dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.classList.remove("dragover");

    const files = e.dataTransfer.files;
    fileInput.files = files; // Masukkan ke input file

    dropText.textContent = files[0].name; // Tampilkan nama file
});

fileInput.addEventListener("change", function () {
    if (this.files.length > 0) {
        dropText.textContent = this.files[0].name;
    }
});
</script>
