<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\reservasi;
use App\Models\rekam_medis;
use App\Models\data_pasien;
use App\Models\data_dokter;
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
        // ---- KUNCI RELASI KE RESERVASI & PASIEN (SESUAIKAN NAMA KOLOM DI TABELMU) ----
        $data['id_reservasi'] = $reservasi->id;  // ganti ke 'id_reservasi' bila kolommu itu
        $data['id_pasien']    = $pasienId;       // ganti ke 'id_pasien' bila kolommu itu

        $rekam = rekam_medis::firstOrNew(['id_reservasi' => $reservasi->id]);

        DB::transaction(function () use (&$rekam, $data, $tglObj, $pasienId, $reservasi) {
        if (!$rekam->exists || empty($rekam->nomor_rekam_medis)) {

            // KUNCI semua RM milik pasien ini supaya urutan aman saat concurrency
            // (memang lebih berat dari COUNT(*), tapi aman; jumlah per pasien biasanya kecil)
            $existingRows = rekam_medis::where('id_pasien', $pasienId)
                ->lockForUpdate()
                ->select('id')
                ->get();

            $seqKe = $existingRows->count() + 1;                 // urutan RM ke-berapa untuk pasien ini
            $SS    = str_pad($seqKe, 2, '0', STR_PAD_LEFT);      // 2 digit
            $PPPP  = str_pad($pasienId, 4, '0', STR_PAD_LEFT);   // 4 digit

            $tglCompact = $tglObj->format('Ymd'); // contoh: 20251113
            $rekam->nomor_rekam_medis = "RM-{$tglCompact}-{$SS}-{$PPPP}";
        }

        // isi & simpan
        $rekam->fill($data);
        $rekam->save();
    });


        // Simpan (1 reservasi = 1 rekam medis)
        rekam_medis::updateOrCreate(
            ['id_reservasi' => $reservasi->id],  // ganti ke 'id_reservasi' jika pakai itu
            $data
        );

        // Tandai pasien selesai
        $reservasi->update(['status' => 'selesai']);

        // Kembali ke daftar pasien
        return redirect()
            ->route('dokter.daftar_antrian')
            ->with('success', 'Rekam medis tersimpan dan pasien ditandai selesai.');
    }

    public function riwayat_rekam_medis(Request $request)
    {
        $user = Auth::user();
        $pasienAktif = null;

        if ($request->filled('pasien_id')) {
            $pasienAktif = data_pasien::find($request->input('pasien_id'));
        }

        if (!$pasienAktif) {
            $pasienAktif = $this->getPasienAktif();
        }

        if (!$pasienAktif) {
            return view('dokter.riwayat_rekam_medis', [
                'riwayatRekamMedis' => collect(),
                'rekamMedisAktif'   => null,
                'pasienData'        => null,
                'dokterData'        => null,
                'pasienAktif'       => null,
            ])->with('warning', 'Belum ada pasien aktif yang dapat ditampilkan.');
        }

        // Ambil semua rekam medis untuk pasien ini
        $riwayatRekamMedis = rekam_medis::query()
            ->select('rekam_medis.*')
            ->join('reservasis', 'rekam_medis.id_reservasi', '=', 'reservasis.id')
            ->where('reservasis.id_pasien', $pasienAktif->id)
            ->where('reservasis.status', 'selesai')
            ->orderBy('rekam_medis.tanggal_pemeriksaan', 'desc')
            ->get();

        // Jika ada parameter ID, ambil rekam medis spesifik
        // Jika tidak, ambil yang pertama/terbaru
        $selectedId = $request->get('id');
        
        if ($selectedId) {
            $rekamMedisAktif = rekam_medis::with(['reservasi.data_pasien'])
                ->whereHas('reservasi', function($q) use ($pasienAktif) {
                    $q->where('id_pasien', $pasienAktif->id);
                })
                ->find($selectedId);
        } else {
            $rekamMedisAktif = $riwayatRekamMedis->first();
        }

        // Data pasien dan dokter
        $pasienData = null;
        $dokterData = null;

        if ($rekamMedisAktif) {
            $pasienData = $rekamMedisAktif->reservasi->data_pasien;
            
            // Ambil data dokter dari rekam medis atau dari user dokter yang sedang login
            // Sesuaikan dengan struktur database Anda
            $dokterData = data_dokter::first(); // Untuk sementara ambil dokter pertama
            
            // Atau jika ada relasi dokter di reservasi:
            // $dokterData = $rekamMedisAktif->reservasi->dokter;
        }

        return view('dokter.riwayat_rekam_medis', compact(
            'riwayatRekamMedis',
            'rekamMedisAktif',
            'pasienData',
            'dokterData',
            'pasienAktif'
        ));
    }

    /**
     * Helper: Ambil pasien aktif dari session
     */
    private function getPasienAktif(): ?data_pasien
    {
        $user = Auth::user();

        // 1. Coba dari session
        $pasienAktifId = session('pasien_aktif_id');
        
        if ($pasienAktifId) {
            $pasien = data_pasien::where('id', $pasienAktifId)
                ->where('id_akun', $user->id)
                ->first();

            if ($pasien) {
                return $pasien;
            }

            session()->forget('pasien_aktif_id');
        }

        // 2. Fallback ke pasien utama
        $pasienUtama = $user->pasiens()
            ->where('is_primary', true)
            ->first();

        if ($pasienUtama) {
            session(['pasien_aktif_id' => $pasienUtama->id]);
        }

        return $pasienUtama;
    }
}
