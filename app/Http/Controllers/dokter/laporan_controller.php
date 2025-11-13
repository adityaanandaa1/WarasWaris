<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\jadwal_praktik;
use App\Models\reservasi;
use App\Models\rekam_medis;
use Carbon\Carbon;

class laporan_controller extends Controller
{
    public function laporan(Request $request)
    {
        $user = Auth::user();
        $dokter = $user->dokter;

        // Ambil tanggal dari request atau default hari ini
        $tanggal_input    = $request->input('tanggal');
        $tanggal_dipilih = $tanggal_input
            ? Carbon::parse($tanggal_input)
            : today();

        // Ambil keyword search jika ada
        $search = $request->input('search');

        // Get nama hari
        $nama_hari = $this->get_nama_hari($tanggal_dipilih);

        // Ambil jadwal praktik sesuai hari
        $jadwal = jadwal_praktik::where('hari', $nama_hari)->first();

        // Query dasar untuk reservasi pada tanggal yang dipilih
        $baseQuery = reservasi::whereDate('tanggal_reservasi', $tanggal_dipilih->toDateString())
            ->with(['data_pasien', 'rekam_medis']);
        
        $query = clone $baseQuery;

        if ($search) {
            $query->whereHas('data_pasien', function($q) use ($search) {
                $q->where('nama_pasien', 'like', '%' . $search . '%')
                  ->orWhere('no_telepon', 'like', '%' . $search . '%');
            });
        }

        // Ambil semua reservasi (untuk daftar)
        $daftar_reservasi = $query->orderBy('nomor_antrian', 'asc')->get();

        // Jika request AJAX, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'count' => $daftar_reservasi->count(),
                'data' => $daftar_reservasi->map(function($reservasi) {
                    return [
                        'id' => $reservasi->id,
                        'nomor_antrian' => $reservasi->nomor_antrian,
                        'nama_pasien' => $reservasi->data_pasien->nama_pasien,
                        'no_telepon' => $reservasi->data_pasien->no_telepon,
                        'jenis_kelamin' => $reservasi->data_pasien->jenis_kelamin,
                        'umur' => $reservasi->data_pasien->tanggal_lahir_pasien->age,
                        'status' => $reservasi->status,
                        'waktu' => $reservasi->rekam_medis ? $reservasi->updated_at->format('H:i') : null,
                        'rekam_medis_id' => $reservasi->rekam_medis ? $reservasi->rekam_medis->id : null,
                        'inisial' => substr($reservasi->data_pasien->nama_pasien, 0, 1)
                    ];
                })
            ]);
        }

        // Statistik
        $total_reservasi     = (clone $baseQuery)->count();
        $pasien_terlayani    = (clone $baseQuery)->where('status', 'selesai')->count();
        $pasien_tidak_datang = (clone $baseQuery)->where('status', 'batal')->count();

        $statistik_status = [
            'menunggu'         => (clone $baseQuery)->where('status', 'menunggu')->count(),
            'sedang_dilayani'  => (clone $baseQuery)->where('status', 'sedang_dilayani')->count(),
            'selesai'          => $pasien_terlayani,
            'batal'            => $pasien_tidak_datang,
        ];

        return view('dokter.laporan', compact(
            'tanggal_dipilih',
            'nama_hari',
            'jadwal',
            'total_reservasi',
            'pasien_terlayani',
            'pasien_tidak_datang',
            'daftar_reservasi',
            'statistik_status',
            'search'
        ));
    }

    public function detail_rekam_medis($id)
    {
        $rekam_medis = rekam_medis::with(['data_pasien', 'reservasi'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $rekam_medis
        ]);
    }

    private function get_nama_hari($tanggal)
    {
        $hari_inggris = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return str_replace($hari_inggris, $hari_indonesia, $tanggal->format('l'));
    }
}