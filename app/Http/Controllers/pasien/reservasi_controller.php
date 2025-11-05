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
    public function index(Request $request)
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
            return view('pasien.reservasi.index', [
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
            $antrian = Antrian::create([
                'tanggal' => $tanggal_dipilih->format('Y-m-d'),
                'nomor_sekarang' => 0,
                'total_antrian' => 0,
            ]);
        }

        // cek apakah pasien aktif sudah punya reservasi untuk tanggal ini
        $reservasi_aktif = reservasi::where('id_pasien', $pasien_aktif->id)
            ->where('tanggal_reservasi', $tanggal_dipilih->format('Y-m-d'))
            ->whereIn('status', ['menunggu', 'sedang_diperiksa'])
            ->first();
        
        return view('pasien.reservasi.index', [
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
    public function store(Request $request)
    {
        //validasi input
        $validated = $request->validate([
            'tanggal_reservasi' => 'required|date|after_or_equal:today',
            'kelugan' => 'nullable|string|max:500',
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
            ->exist();
        
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

        try {} catch()
    }
}
