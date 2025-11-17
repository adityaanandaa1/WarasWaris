@extends('layouts.editprofiledokter')

@section('title', 'Edit Biodata Dokter- WarasWaris')

@section('content')

<form action="{{ route('dokter.profil.update') }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @method('PUT')

    <div class="editprofile-container">
        <div class="editprofile-header">
            <a href="{{ route('dokter.dashboard') }}">
                <svg width="30" height="30" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="10.5" cy="10.2375" rx="10.5" ry="10.2375" fill="#CEDEFF"/>
                    <path d="M13.6948 13.539C13.5294 13.7044 13.3051 13.7974 13.0711 13.7974C12.8372 13.7974 12.6129 13.7044 12.4475 13.539L10.499 11.312L8.55052 13.5383C8.46887 13.6213 8.37159 13.6873 8.2643 13.7325C8.157 13.7777 8.04182 13.8013 7.92539 13.8017C7.80896 13.8022 7.69359 13.7796 7.58593 13.7353C7.47827 13.691 7.38046 13.6257 7.29813 13.5434C7.2158 13.4611 7.15059 13.3633 7.10625 13.2556C7.06191 13.1479 7.03933 13.0326 7.0398 12.9161C7.04028 12.7997 7.0638 12.6845 7.10901 12.5772C7.15422 12.4699 7.22023 12.3727 7.30323 12.291L9.33036 9.97576L7.30249 7.65904C7.2195 7.57739 7.15349 7.48011 7.10828 7.37281C7.06307 7.26552 7.03954 7.15034 7.03907 7.03391C7.0386 6.91748 7.06118 6.80211 7.10552 6.69445C7.14985 6.58679 7.21507 6.48898 7.29739 6.40665C7.37972 6.32432 7.47754 6.25911 7.5852 6.21477C7.69285 6.17043 7.80822 6.14785 7.92465 6.14832C8.04108 6.1488 8.15627 6.17232 8.26356 6.21753C8.37085 6.26274 8.46813 6.32875 8.54979 6.41175L10.499 8.63953L12.4475 6.41175C12.5292 6.32875 12.6264 6.26274 12.7337 6.21753C12.841 6.17232 12.9562 6.1488 13.0726 6.14832C13.1891 6.14785 13.3044 6.17043 13.4121 6.21477C13.5197 6.25911 13.6176 6.32432 13.6999 6.40665C13.7822 6.48898 13.8474 6.58679 13.8918 6.69445C13.9361 6.80211 13.9587 6.91748 13.9582 7.03391C13.9577 7.15034 13.9342 7.26552 13.889 7.37281C13.8438 7.48011 13.7778 7.57739 13.6948 7.65904L11.6677 9.97576L13.6948 12.291C13.7768 12.3729 13.8419 12.4702 13.8862 12.5773C13.9306 12.6843 13.9535 12.7991 13.9535 12.915C13.9535 13.0309 13.9306 13.1457 13.8862 13.2528C13.8419 13.3599 13.7768 13.4571 13.6948 13.539Z" fill="#464646"/>
                </svg>
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
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir_dokter', optional($dokter->tanggal_lahir_dokter)->format('Y-m-d')) }}" max="{{ date('Y-m-d') }}" class="editprofile-input">
                </div>
            </div>
        
            <div class="editprofile-photo">
                <svg class="editprofile-photo-icon" width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="60" cy="60" r="60" fill="#5A81FA"/>
                    <path d="M42 42H48.75L53.25 37.5H66.75L71.25 42H78C79.1935 42 80.3381 42.4741 81.182 43.318C82.0259 44.1619 82.5 45.3065 82.5 46.5V73.5C82.5 74.6935 82.0259 75.8381 81.182 76.682C80.3381 77.5259 79.1935 78 78 78H42C40.8065 78 39.6619 77.5259 38.818 76.682C37.9741 75.8381 37.5 74.6935 37.5 73.5V46.5C37.5 45.3065 37.9741 44.1619 38.818 43.318C39.6619 42.4741 40.8065 42 42 42ZM60 48.75C57.0163 48.75 54.1548 49.9353 52.045 52.045C49.9353 54.1548 48.75 57.0163 48.75 60C48.75 62.9837 49.9353 65.8452 52.045 67.955C54.1548 70.0647 57.0163 71.25 60 71.25C62.9837 71.25 65.8452 70.0647 67.955 67.955C70.0647 65.8452 71.25 62.9837 71.25 60C71.25 57.0163 70.0647 54.1548 67.955 52.045C65.8452 49.9353 62.9837 48.75 60 48.75ZM60 53.25C61.7902 53.25 63.5071 53.9612 64.773 55.227C66.0388 56.4929 66.75 58.2098 66.75 60C66.75 61.7902 66.0388 63.5071 64.773 64.773C63.5071 66.0388 61.7902 66.75 60 66.75C58.2098 66.75 56.4929 66.0388 55.227 64.773C53.9612 63.5071 53.25 61.7902 53.25 60C53.25 58.2098 53.9612 56.4929 55.227 55.227C56.4929 53.9612 58.2098 53.25 60 53.25Z" fill="white"/>
                </svg>
                <p class="editprofile-photo-text">Tambahkan Foto</p>
            </div>
        </div>

        <div class="editprofile-sip-section">
            <label class="editprofile-label">
                Dokumen SIP
            </label>
            <div id="drop-area" class="editprofile-drop-area">
                <i class="ri-upload-2-line"></i>
                <input type="file" id="fileInput" name="sip_file" accept=".pdf,.jpg,.jpeg,.png" hidden>
                <p id="dropText" class="editprofile-drop-text">Drop file here</p>
                <p class="editprofile-drop-description"> pdf/jpg/png, maks 2MB</p>
            </div>
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