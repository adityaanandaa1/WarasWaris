<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\data_pasien;

class pasien_controller extends Controller
{
    //tampilkan dashboard pasien
    public function dashboard()
    {
        $user = Auth::user();

        //ambil pasien dalam akun ini
        $pasiens = $user->pasiens()->get();

        if (! $user->pasiens()->exists()) {
        return redirect()->route('pasien.tambah_biodata');
        }

        $pasiens = $user->pasiens()->get();
        $pasien_aktif = $this->get_pasien_aktif();

        //compact berfungsi variabel $pasiens dan $pasien_aktif dikirim ke view pasien.dashboard
        return view('pasien.dashboard', compact('pasiens', 'pasien_aktif'));
    }

    //tampilkan form untuk pasien baru atau anggota keluarga
    public function tambah_biodata()
    {
        $user = Auth::user();
        $pasiens = $user->pasiens;
            
        // Cek apakah ini pasien pertama (pemilik akun)
        $isPrimary = $pasiens->isEmpty();
            
        return view('pasien.tambah_biodata', compact('isPrimary'));
        //menambah akun sebagai pemilik akun(isprimary)
    }

    //simpan biodata baru
    public function simpan_biodata(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'tanggal_lahir_pasien' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'pekerjaan' => 'nullable|string|max:255',
            'catatan_pasien' => 'nullable|string',
        ], [
            'nama_pasien.required' => 'Nama lengkap wajib diisi',
            'tanggal_lahir_pasien.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir_pasien.before' => 'Tanggal lahir harus sebelum hari ini',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid',
            'golongan_darah.in' => 'Golongan darah tidak valid',
            'alamat.required' => 'Alamat wajib diisi',
            'no_telepon.required' => 'Nomor telepon wajib diisi',
        ]);

        $user = Auth::user();
            
        // Cek apakah ini pasien pertama
        $isPrimary = $user->pasiens()->count() === 0;

        // Buat data pasien baru
        $pasien = data_pasien::create([
            'id_akun' => $user->id,
            'nama_pasien' => $validated['nama_pasien'],
            'tanggal_lahir_pasien' => $validated['tanggal_lahir_pasien'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'golongan_darah' => $validated['golongan_darah'],
            'alamat' => $validated['alamat'],
            'no_telepon' => $validated['no_telepon'],
            'pekerjaan' => $validated['pekerjaan'],
            'catatan_pasien' => $validated['catatan_pasein'],
            'is_primary' => $isPrimary, // True jika pasien pertama
        ]);

        // Set sebagai pasien aktif di session
        session(['pasien_aktif_id' => $pasien->id]);

        $message = $isPrimary 
            ? 'Biodata berhasil disimpan! Selamat datang di WarasWaris.' 
            : 'Anggota keluarga berhasil ditambahkan!';

        return redirect()->route('pasien.dashboard')
            ->with('success', $message);
    }


    //edit biodata pasien
    public function edit_biodata($id)
    {
        $user=Auth::user();
        
        $pasien = data_pasien::where('id', $id)
            ->where('id_akun', $user->id)
            ->firstOrFail();
        
        return view('pasien.edit_biodata', compact('pasien'));
    }

    // update biodata pasien
    public function update_biodata(Request $request, $id)
    {
        $user = Auth::user();

        //validasi kepemilikan
        $pasien = data_pasien::where('id', $id)
                ->where('id_akun', $user->id)
                ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'tanggal_lahir_pasien' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'pekerjaan' => 'nullable|string|max:255',
            'catatan_pasien' => 'nullable|string',
        ]);

        // Update data
        $pasien->update($validated);

        return redirect()->route('pasien.dashboard')
            ->with('success', 'Biodata berhasil diperbarui!');
    }

    //hapus anggota keluarga
    public function hapus_biodata($id)
    {
        $user = Auth::user();

        //validasi kepemilikan
        $pasien = data_pasien::where('id', $id)
            ->where('id_akun', $user->id)
            ->firstOrFail();
        
        if ($pasien->is_primary) {
            return back()->withErrors([
                'error' => 'Tidak dapat menghapus data pemilik akun!'
            ]);
        }

        $pasien->delete();

        // Jika pasien yang dihapus adalah pasien aktif, ganti ke pasien utama
        if (session('pasien_aktif_id') == $id) {
            $pasien_utama = $user->pasiens()->where('is_primary', true)->first();
            session(['pasien_aktif_id' => $pasien_utama->id]);
        }

        return redirect()->route('pasien.dashboard')
            ->with('success', 'Anggota keluarga berhasil dihapus!');
    }

    //ganti profile
    public function ganti_profil($id)
    {
        $user = Auth::user();
        
        // Validasi bahwa pasien ini milik user yang login
        $pasien = data_pasien::where('id', $id)
            ->where('id_akun', $user->id)
            ->firstOrFail();

        // Simpan ke session
        session(['pasien_aktif_id' => $pasien->id]);

        return redirect()->route('pasien.dashboard')
            ->with('success', "Beralih ke profil: {$pasien->nama_pasien}");
    }

    //Ambil pasien yang sedang aktif dari session
    //Jika belum ada session, ambil pasien utama (is_primary)
    private function get_pasien_aktif()
    {
        $user = Auth::user();
            
        // Cek session
        $pasien_aktif_id = session('pasien_aktif_id');
            
        if ($pasien_aktif_id) {
            // Ambil dari session
            $pasien = data_pasien::where('id', $pasien_aktif_id)
                ->where('id_akun', $user->id)
                ->first();
                
            if ($pasien) {
                return $pasien;
            }
        }
            
        // Jika tidak ada, ambil pasien utama
        $pasien_utama = $user->pasiens()->where('is_primary', true)->first();
            
        // Simpan ke session untuk selanjutnya
        if ($pasien_utama) {
            session(['pasien_aktif_id' => $pasien_utama->id]);
        }
            
        return $pasien_utama;
    }

    //Tampilkan detail biodata pasien
    public function tampilkan_biodata($id)
    {
        $user = Auth::user();
        
        $pasien = data_pasien::where('id', $id)
            ->where('id_akun', $user->id)
            ->firstOrFail();
        
        return view('pasien.tampilkan_biodata', compact('pasien'));
    }
}