<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\rekam_medis;
use Illuminate\Http\Request;
use Carbon\Carbon;


class rekam_medis_controller extends Controller
{
    public function buat_rekam_medis(Reservasi $reservasi)
    {
        // (Opsional) cek jika sudah ada rekam medis → bisa redirect ke edit
        return view('dokter.buat_rekam_medis', compact('reservasi'));
    }

        public function simpan_rekam_medis(Request $request, Reservasi $reservasi)
    {
        $data = $request->validate([
            'tinggi_badan'           => 'required|integer|min:30|max:250',
            'berat_badan'            => 'required|numeric|min:1|max:500',
            'tekanan_darah'          => 'required|string|max:15',
            'suhu'                   => 'required|numeric|min:30|max:45',
            'diagnosa'               => 'required|string',
            'saran'                  => 'required|string',
            'rencana_tindak_lanjut'  => 'required|string',
            'catatan_tambahan'       => 'nullable|string',
            'riwayat_alergi'         => 'nullable|string',
            'resep_obat'             => 'required|string',
        ]);

        // Ambil pasien_id dari reservasi (support dua nama kolom)
        $pasienId = $reservasi->id_pasien;
        if (!$pasienId) {
            return back()->withErrors('Reservasi tidak memiliki pasien yang terkait.');
        }

        // Tanggal pemeriksaan & nomor RM
        $tglObj = $reservasi->tanggal_reservasi
            ? Carbon::parse($reservasi->tanggal_reservasi)
            : now();

        $data['tanggal_pemeriksaan'] = $tglObj->toDateString();
        $data['nomor_rekam_medis']   = 'RM-' . $tglObj->format('Ymd') . '-00' . $pasienId;

        // ---- KUNCI RELASI KE RESERVASI & PASIEN (SESUAIKAN NAMA KOLOM DI TABELMU) ----
        $data['id_reservasi'] = $reservasi->id;  // ganti ke 'id_reservasi' bila kolommu itu
        $data['id_pasien']    = $pasienId;       // ganti ke 'id_pasien' bila kolommu itu
        // -------------------------------------------------------------------------------

        // Simpan (1 reservasi = 1 rekam medis)
        rekam_medis::updateOrCreate(
            ['id_reservasi' => $reservasi->id],  // ganti ke 'id_reservasi' jika pakai itu
            $data
        );

        // Tandai pasien selesai
        $reservasi->update(['status' => 'selesai']);

        // Kembali ke daftar pasien
        return redirect()
            ->route('dokter.daftar_pasien')
            ->with('success', 'Rekam medis tersimpan dan pasien ditandai selesai.');
    }
}
