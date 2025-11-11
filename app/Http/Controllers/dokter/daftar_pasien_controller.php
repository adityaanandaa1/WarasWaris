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
    public function daftar_pasien()
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
            ->whereIn('status', ['menunggu', 'sedang_dilayani', 'selesai'])
            ->with(['data_pasien:id,nama_pasien'])
            ->orderByRaw('CAST(nomor_antrian AS UNSIGNED) ASC')
            ->get();

        $nomor_terakhir = reservasi::whereDate('tanggal_reservasi', $hari_ini)
            ->where('status', 'selesai')
            ->max('nomor_antrian'); // yang terakhir selesai

        $sedang_dilayani = reservasi::whereDate('tanggal_reservasi', $hari_ini)
            ->where('status', 'sedang_dilayani')
            ->orderByDesc('updated_at')
            ->value('nomor_antrian');
                
        // Ambil info antrian
        $antrian = (object)[
            'nomor_sekarang' => $sedang_dilayani ?? $nomor_terakhir ?? 0,
            'total_antrian' => reservasi::whereDate('tanggal_reservasi', $hari_ini)
                ->whereIn('status', ['menunggu', 'sedang_dilayani', 'selesai'])
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