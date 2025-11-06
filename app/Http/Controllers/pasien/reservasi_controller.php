<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\data_pasien;
use App\Models\jadwal_praktik;
use App\Models\reservasi;
use App\Models\antrian;
use Carbon\Carbon;

class reservasi_controller extends Controller
{
    public function index_reservasi(Request $request)
    {
        $user = Auth::user();
        $pasiens = $user->pasiens;

        //pastikan punya biodata
        if ($pasiens->isEmpty()) {
            return redirect()->route('pasien.tambah_biodata')
                ->withErrors(['error' => 'Silahkan lengkapi biodata']);
        }

        // ambil pasien aktif
        $pasien_aktif = $this->get_pasien_aktif();

        //ambil tanggal yang dipilih
        $tanggal_dipilih = $request->input('tanggal', today()->format('Y-m-d'));
        $tanggal_dipilih = Carbon::parse($tanggal_dipilih);

        //cek tanggal jangan di masa lalu
        if ($tanggal_dipilih->isPast() && !$tanggal_dipilih->isToday()) {
            return back()->withErrors([
                'error' => 'Tidak dapat reservasi untuk tanggal yang sudah lewat'
            ]);
        }

        //ambil nama hari dalam bindo
        $nama_hari = $this->get_nama_hari($tanggal_dipilih);

        $jadwal = jadwal_praktik::where('hari', $nama_hari)->first();

        // Jika tidak ada jadwal atau klinik tutup
        if (!$jadwal || !$jadwal->is_active) {
            return view('pasien.index_reservasi', [
                'pasiens' => $pasiens,
                'pasien_aktif' => $pasien_aktif,
                'tanggal_dipilih' => $tanggal_dipilih,
                'nama_hari' => $nama_hari,
                'jadwal' => null,
                'klinik_tutup' => true,
            ]);
        }

        // Ambil antrian real-time untuk tanggal tersebut
        $antrian = antrian::where('tanggal_antrian', $tanggal_dipilih->format('Y-m-d'))->first();

        // Jika belum ada antrian untuk hari itu, buat baru
        if (!$antrian) {
            $antrian = antrian::firstOrCreate([
                'tanggal_antrian' => today()->toDateString(),
                'nomor_sekarang' => 0,
                'total_antrian' => 0,
            ]);
        }

        // cek apakah pasien aktif sudah punya reservasi untuk tanggal ini
        $reservasi_aktif = reservasi::where('id_pasien', $pasien_aktif->id)
            ->where('tanggal_reservasi', $tanggal_dipilih->format('Y-m-d'))
            ->whereIn('status', ['menunggu', 'sedang_diperiksa'])
            ->first();
        
        return view('pasien.index_reservasi', [
            'pasiens' => $pasiens,
            'pasien_aktif' => $pasien_aktif,
            'tanggal_dipilih' => $tanggal_dipilih,
            'nama_hari' => $nama_hari,
            'jadwal' => $jadwal,
            'antrian' => $antrian,
            'reservasi_aktif' => $reservasi_aktif,
            'klinik_tutup' => false,
        ]);
    }

    //ambil no antrian
    public function buat_reservasi(Request $request)
    {
        //validasi input
        $validated = $request->validate([
            'tanggal_reservasi' => 'required|date|after_or_equal:today',
            'keluhan' => 'nullable|string|max:500',
        ],[
            'tanggal_reservasi.required' => 'Tanggal reservasi wajib dipilih',
            'tanggal_reservasi.after_or_equal' => 'Tidak dapat reservasi untuk tanggal yang sudah lewat',
        ]);

        $user = Auth::user();
        $pasien_aktif = $this->get_pasien_aktif();
        $tanggal = Carbon::parse($validated['tanggal_reservasi']);

        //cek apakah sudah punya reservasi aktif
        $reservasi_ditemukan = reservasi::where('id_pasien', $pasien_aktif->id)
            ->where('tanggal_reservasi', $tanggal->format('Y-m-d'))
            ->whereIn('status', ['menunggu', 'sedang_diperiksa'])
            ->exists();
        
        if($reservasi_ditemukan) {
            return back()->withErrors([
                'error' => 'Anda sudah memiliki reservasi'
            ]);
        }

        //cek jadwal praktik
        $nama_hari = $this->get_nama_hari($tanggal);
        $jadwal = jadwal_praktik::where('hari', $nama_hari)
            ->where('is_active', true)
            ->first();
        
        if(!$jadwal) {
            return back()->withErrors([
                'error' => 'Klinik tutup pada hari' . $nama_hari
            ]);
        }

        //gunakan transaction untuk konsistensi data
        DB::beginTransaction();

        try {
            //ambil atau buat antrian
            $antrian = antrian::firstOrCreate(
                ['tanggal_antrian' => $tanggal->format('Y-m-d')],
                ['nomor_sekarang' => 0, 'total_antrian' => 0]
            );
            
            //hitung nomor berikutnya
            $nomor_antrian = $antrian->total_antrian + 1;

            //buat reservasi
            $reservasi = reservasi::create([
                'id_pasien' => $pasien_aktif->id,
                'tanggal_antrian' => $tanggal->format('Y-m-d'),
                'nomor_antrian' => $nomor_antrian,
                'keluhan' => $validated['keluhan'],
                'status' => 'menunggu',
            ]);

             // Update total antrian
            $antrian->increment('total_antrian');
            
            DB::commit();
            
            return redirect()->route('pasien.dashboard', [
                'tanggal' => $tanggal->format('Y-m-d')
            ])->with('success', "Reservasi berhasil! Nomor antrian Anda: #{$nomor_antrian}");
        } catch(\Exception $e) {
         DB::rollBack();
            
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat membuat reservasi. Silakan coba lagi.'
            ]);
        }
    }

    public function batalkan_reservasi($id)
    {
        $user = Auth::user();
        $pasien_aktif = $this->get_pasien_aktif();

        $reservasi = reservasi::where('id', $id)
            ->where('id_pasien', $pasien_aktif->id)
            ->whereIn('status', ['menunggu'])
            ->firstOrFail();

        $reservasi->update(['status' => 'batal']);
        
        // Update total antrian (decrement)
        $antrian = antrian::where('tanggal_antrian', $reservasi->tanggal_reservasi)->first();
        if ($antrian && $antrian->total_antrian > 0) {
            $antrian->decrement('total_antrian');
        }
        
        return redirect()->route('pasien.dashboard', [
            'tanggal' => $reservasi->tanggal_reservasi
        ])->with('success', 'Reservasi berhasil dibatalkan');
    }

    public function riwayat_reservasi()
    {
        $user = Auth::user();
        $pasiens = $user->pasiens;
        $pasien_aktif = $this->get_pasien_aktif();

        // Ambil semua reservasi pasien aktif (urutkan terbaru)
        $reservasis = Reservasi::where('id_pasien', $pasien_aktif->id)
            ->orderBy('tanggal_reservasi', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        
        return view('pasien.riwayat_reservasi', [
            'pasiens' => $pasiens,
            'pasien_aktif' => $pasien_aktif,
            'reservasis' => $reservasis,
        ]);
    }

     private function get_pasien_aktif()
    {
        $user = Auth::user();
        $pasien_aktif_id = session('pasien_aktif_id');
        
        if ($pasien_aktif_id) {
            $pasien = data_pasien::where('id', $pasien_aktif_id)
                ->where('id_akun', $user->id)
                ->first();
            
            if ($pasien) {
                return $pasien;
            }
        }
        
        // Fallback ke pasien utama
        $pasien_utama = $user->pasiens()->where('is_primary', true)->first();
        
        if ($pasien_utama) {
            session(['pasien_aktif_id' => $pasien_utama->id]);
        }
        
        return $pasien_utama;
    }
    
    /**
     * Konversi Carbon date ke nama hari dalam Bahasa Indonesia
     */
    private function get_nama_hari($tanggal)
    {
        $hari_inggris = [
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 
            'Friday', 'Saturday', 'Sunday'
        ];
        
        $hari_indonesia = [
            'Senin', 'Selasa', 'Rabu', 'Kamis', 
            'Jumat', 'Sabtu', 'Minggu'
        ];
        
        return str_replace($hari_inggris, $hari_indonesia, $tanggal->format('l'));
    }
}
