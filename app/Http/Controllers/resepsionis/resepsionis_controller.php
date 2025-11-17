<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\data_dokter;
use App\Models\jadwal_praktik;
use App\Models\reservasi;
use App\Models\antrian;
use App\Models\data_pasien;
use App\Models\rekam_medis;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class resepsionis_controller extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $dokter = $user->data;

        //tanggal dipilih (default hari ini)
        $hari_ini = $request->filled('tanggal')
            ? Carbon::parse($request->input('tanggal'), 'Asia/Jakarta')->startOfDay()
            : Carbon::today('Asia/Jakarta');

        $hari_ini->locale('id');
        $nama_hari = $this->get_nama_hari($hari_ini);
        $hari_enum = strtolower($nama_hari);

        //jadwal hari ini
        $jadwal = jadwal_praktik::firstOrNew([
            'hari' => $hari_enum,
            'tanggal_jadwal_praktik' => $hari_ini->toDateString(),
        ]);

        if (!$jadwal->exists) {
            $jadwal->fill([
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '21:00:00',
                'is_active' => true,
            ])->save();
        }

        $antrian = antrian::whereDate('tanggal_antrian', $hari_ini)->first();
        if (!$antrian && $hari_ini->isToday()) {
            $antrian = antrian::create([
                'tanggal_antrian' => $hari_ini->toDateString(),
                'nomor_sekarang' => 0,
                'total_antrian' => 0,
            ]);
        }

        $nomor_sekarang = $this->get_nomor_antrian_sekarang($hari_ini);
        if ($antrian) {
            $antrian->nomor_sekarang = $nomor_sekarang;
        } else {
            $antrian = (object) [
                'nomor_sekarang' => $nomor_sekarang,
                'total_antrian' => reservasi::whereDate('tanggal_reservasi', $hari_ini)
                    ->whereIn('status', ['menunggu', 'sedang_dilayani'])
                    ->count(),
            ];
        }

        $total_reservasi = reservasi::whereDate('tanggal_reservasi', $hari_ini)
            ->whereIn('status', ['menunggu', 'sedang_dilayani', 'selesai'])
            ->count();
        $pasien_terlayani = reservasi::whereDate('tanggal_reservasi', $hari_ini)
            ->where('status', 'selesai')
            ->count();
        $pasien_batal = reservasi::whereDate('tanggal_reservasi', $hari_ini)
            ->where('status', 'batal')
            ->count();

        $reservasis = reservasi::whereDate('tanggal_reservasi', $hari_ini)
            ->whereIn('status', ['menunggu', 'sedang_diperiksa'])
            ->with('data_pasien')
            ->orderBy('nomor_antrian')
            ->get();

        return view('resepsionis.dashboard', compact(
            'user',
            'dokter',
            'jadwal',
            'antrian',
            'reservasis',
            'total_reservasi',
            'pasien_terlayani',
            'pasien_batal',
            'hari_ini',
            'nama_hari'
        ));
    }

    private function get_nomor_antrian_sekarang(Carbon $tanggal): int
    {
        $sedang_dilayani = reservasi::whereDate('tanggal_reservasi', $tanggal)
            ->whereIn('status', ['sedang_dilayani', 'sedang_diperiksa'])
            ->orderByDesc('updated_at')
            ->value('nomor_antrian');

        if ($sedang_dilayani) {
            return (int) $sedang_dilayani;
        }

        $terakhir_selesai = reservasi::whereDate('tanggal_reservasi', $tanggal)
            ->where('status', 'selesai')
            ->max('nomor_antrian');

        return (int) ($terakhir_selesai ?? 0);
    }

    private function get_nama_hari($tanggal)
    {
        $hari_inggris = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return str_replace($hari_inggris, $hari_indonesia, $tanggal->format('l'));
    }
}