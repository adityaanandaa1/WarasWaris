<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\data_dokter;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\jadwal_praktik;
use App\Models\reservasi;


class daftar_pasien_controller extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dokter = $user->dokter ?? data_dokter::where('id_akun', $user->id)->first();

        $hari_ini = today();
        $nama_hari = $hari_ini->locale('id')->translatedFormat('l');
        
        // Ambil jadwal dokter hari ini
        $jadwal = jadwal_praktik::where('hari', $nama_hari)->first();
        
        // Ambil daftar pasien yang reservasi hari ini
       $daftar_pasien = reservasi::query()
            ->whereDate('tanggal_reservasi', $hari_ini)
            ->whereIn('status', ['menunggu', 'sedang_diperiksa', 'selesai'])
            ->with(['data_pasien:id,nama_pasien'])
            ->orderBy('nomor_antrian', 'asc')
            ->get();
                
        // Ambil info antrian
        $antrian = (object)[
            'nomor_sekarang' => reservasi::where('tanggal_reservasi', $hari_ini)
                ->where('status', 'sedang_diperiksa')
                ->value('nomor_antrian') ?? 0,
            'total_antrian' => reservasi::where('tanggal_reservasi', $hari_ini)
                ->whereIn('status', ['menunggu', 'sedang_diperiksa', 'selesai'])
                ->count()
        ];
        
        return view('dokter.daftar_pasien', compact(
            'hari_ini',
            'nama_hari',
            'jadwal',
            'daftar_pasien',
            'antrian'
        ));
    }

    public function mark_periksa(Reservasi $reservasi)
    {
        if ($reservasi->status === 'selesai') {
            return back()->withErrors('Reservasi sudah selesai.');
        }

        $reservasi->update(['status' => 'sedang_diperiksa']);

        return redirect()->route('dokter.buat_rekam_medis', $reservasi->id);
    }
    
    // Method untuk detail reservasi (nanti diisi)
    //public function detailReservasi($id)
    //{
        // TODO: Implementasi detail reservasi
        //return view('dokter.detail-reservasi', compact('id'));
    //}
    
    // Method untuk form rekam medis (nanti diisi)
    //public function createRekamMedis($id)
    //{
    //    // TODO: Implementasi form rekam medis
    //    return view('dokter.rekam-medis.create', compact('id'));
    //}
}