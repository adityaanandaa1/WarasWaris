<form action="{{ route('dokter.profil.update') }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="space-y-6">
    @csrf
    @method('PUT')

    {{-- Nama --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Nama Dokter
        </label>
        <input 
            type="text" 
            name="nama_dokter"
            value="{{ old('nama_dokter', $dokter->nama_dokter) }}"
            required
            class="w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-blue-500"
        >
    </div>

    {{-- Tanggal lahir --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Tanggal Lahir
        </label>
        <input 
            type="date" 
            name="tanggal_lahir"
            value="{{ old('tanggal_lahir_dokter', optional($dokter->tanggal_lahir_dokter)->format('Y-m-d')) }}"
            max="{{ date('Y-m-d') }}"
            class="w-full px-4 py-3 rounded-xl bg-gray-50 border-0 focus:ring-2 focus:ring-blue-500"
        >
    </div>

    {{-- Upload SIP --}}
    <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700">
            Dokumen SIP (pdf/jpg/png, maks 2MB)
        </label>

        @if($dokter->sip_path)
            <div class="flex items-center gap-3 text-sm">
                <span class="text-green-700 bg-green-50 px-3 py-1 rounded-full">
                    SIP sudah diupload
                </span>
                <a href="{{ route('dokter.sip.download') }}" class="text-blue-600 hover:text-blue-700 underline">
                    Unduh SIP
                </a>
            </div>
        @else
            <p class="text-xs text-gray-500">Belum ada dokumen SIP yang diupload.</p>
        @endif

        <input 
            type="file" 
            name="sip_file"
            accept=".pdf,.jpg,.jpeg,.png"
            class="block w-full text-sm text-gray-700"
        >
    </div>

    <div class="pt-4 flex justify-end">
        <button 
            type="submit"
            class="px-8 py-3 rounded-full bg-blue-600 text-white font-semibold text-sm hover:bg-blue-700 shadow"
        >
            Simpan Perubahan
        </button>
    </div>
</form>
