<?php

namespace App\Http\Controllers\dokter;

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
use Carbon\Carbon;

class dokter_controller extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $dokter = $user->data;

        //data hari ini
        $hari_ini = today();
        $nama_hari = $this->get_nama_hari($hari_ini);

        //jadwal hari ini
        $jadwal = jadwal_praktik::where('hari', $nama_hari)->first();

        $antrian = antrian::where('tanggal_antrian', $hari_ini)->first();
        if (!$antrian) {
            $antrian = antrian::create([
                'tanggal_antrian' => $hari_ini,
                'nomor_sekarang' => 0,
                'total_antrian' => 0,
            ]);
        }

        $hari_ini = Carbon::today();
        $total_reservasi = reservasi::where('tanggal_reservasi', $hari_ini)
            ->where('status', ['menunggu', 'sedang_dilayani'])
            ->count();
        $pasien_terlayani = reservasi::where('tanggal_reservasi', $hari_ini)
            ->where('status', 'selesai')
            ->count();
        $pasien_batal = reservasi::where('tanggal_reservasi', $hari_ini)
            ->where('status', 'batal')
            ->count();

        $reservasis = reservasi::where('tanggal_reservasi', $hari_ini)
            ->whereIn('status', ['menunggu', 'sedang_diperiksa'])
            ->with('data_pasien')
            ->orderBy('nomor_antrian')
            ->get();

        $statistik = [
            'total_reservasi' => reservasi::where('tanggal_reservasi', $hari_ini)->count(),
            'menunggu' => reservasi::where('tanggal_reservasi', $hari_ini)->where('status', 'menunggu')->count(),
            'selesai' => reservasi::where('tanggal_reservasi', $hari_ini)->where('status', 'selesai')->count(),
            'batal' => reservasi::where('tanggal_reservasi', $hari_ini)->where('status', 'batal')->count(),
        ];

        return view('dokter.dashboard', compact(
            'user',
            'dokter',
            'jadwal',
            'antrian',
            'reservasis',
            'total_reservasi',
            'pasien_terlayani',
            'pasien_batal',
            'statistik',
            'hari_ini',
            'nama_hari'
        ));
    }
    

    public function update_jadwal(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'status' => 'required|in:buka, libur',
            'jam_mulai' => 'nullable|required_if:status,buka|date_format:H:i',
            'jam_selesai' => 'nullable|required_if:status,buka|date_format:H:i',
            'catatan' => 'nullable|required_if:status,libur|string',
        ]);

        DB::beginTransaction();

        try {
            $jadwal = jadwal_praktik::findOrFail($id);

            if ($validated['status'] == 'libur') {
                // Set libur
                $jadwal->update([
                'is_active' => false,
                'jam_mulai' => null,
                'jam_selesai' => null,
            ]);

            // Simpan catatan libur (bisa pakai tabel terpisah atau kolom tambahan)
            // Untuk sekarang kita pakai session flash
            $message = "Jadwal {$jadwal->hari} diset LIBUR. Catatan: " . ($validated['catatan'] ?? '-');
            } else {
                $jadwal->update([
                    'is_active' => true,
                    'jam_mulai' => $validated['jam_mulai'],
                    'jam_selesai' => $validated['jam_selesai'],
                ]);

                $message = "Jadwal {$jadwal->hari} diperbarui: {$validated['jam_mulai']} - {$validated['jam_selesai']}";
            }

            DB::commit();

            return back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal memperbarui jadwal']);
        }
    }

    public function panggil_antrian()
    {
        $antrian = antrian::where('tanggal_antrian', today())->first();

        if(!$antrian) {
            return back()->withErrors(['error' => 'Tidak ada antrian']);
        }

        DB::beginTransaction();

        try{
            //increment nomor sekarang
            $nomor_baru = $antrian->nomor_sekarang + 1;

            //cek apakah ada reservasi dengan nomor tersebut
            $reservasi = reservasi::where('tanggal_reservasi', today())
                ->where('nomor_antrian', $nomor_baru)
                ->where('status', 'menunggu')
                ->first();

            if ($reservasi) {
                // Update status reservasi jadi sedang diperiksa
                $reservasi->update(['status' => 'sedang_diperiksa']);
            }

            $antrian->update(['nomor_sekarang' => $nomor_baru]);

            DB::commit();

            return back()->with('succes', "Nomor Antrian #{$nomor_baru} dipanggil");
        
        } catch(\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal memanggil antrian']);
        }
    }

    public function lewati_antrian($id)
    {
        DB::beginTransaction();

        try{
            $reservasi = reservasi::findOrFail($id);

            //update status
            $reservasi->update(['status' => 'batal']);

            //panggil antrian berikutnya
            $antrian = antrian::where('tanggal_antrian', today())->first();
            if ($antrian) {
                $antrian->increment('nomor_sekarang');
            }

            DB::commit();

            return back()->with('succes', "pasien #{$reservasi->nomor_antrian} dilewati");
        
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors(['error' => 'Gagal melewati antrian']);
        }
    }

    public function simpan_rekam_medis(Request $request, $id_reservasi)
    {
         $validated = $request->validate([
            'tinggi_badan' => 'nullable|numeric|min:0|max:300',
            'berat_badan' => 'nullable|numeric|min:0|max:500',
            'tekanan_darah' => 'nullable|string',
            'suhu' => 'nullable|numeric',
            'diagnosa' => 'required|string',
            'saran' => 'nullable|string',
            'rencana_tindak_lanjut' => 'nullable|string',
            'catatan_tambahan' => 'nullable|string',
            'riwayat_alergi' => 'nullable|string',
            'resep_obat' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try{
            $reservasi = reservasi::findOrFail($id_reservasi);
            $pasien_aktif = $this->get_pasien_aktif();

            //generate nomor rekam medis
            $tanggal = today()->format('Ymd');
            $id_pasien   = str_pad($pasien_aktif->id, 4, '0', STR_PAD_LEFT);
            $nomor_rekam_medis = "RM-{$tanggal}-{$id_pasien}";

             // Simpan atau update rekam medis
            $rekam_medis = rekam_medis::updateOrCreate(
                ['id_reservasi' => $id_reservasi],
                [
                    'nomor_rekam_medis' => $nomor_rekam_medis,
                    'id_pasien' => $reservasi->id_pasien,
                    'tanggal_pemeriksaan' => today(),
                    'tinggi_badan' => $validated['tinggi_badan'],
                    'berat_badan' => $validated['berat_badan'],
                    'tekanan_darah' => $validated['tekanan_darah'],
                    'suhu' => $validated['suhu'],
                    'diagnosa' => $validated['diagnosa'],
                    'saran' => $validated['saran'],
                    'rencana_tindak_lanjut' => $validated['rencana_tindak_lanjut'],
                    'catatan_tambahan' => $validated['catatan_tambahan'],
                    'riwayat_alergi' => $validated['riwayat_alergi'],
                    'resep_obat' => $validated['resep_obat'],
                ]
            );

            // Update status reservasi jadi selesai
            $reservasi->update(['status' => 'selesai']);
            
            DB::commit();
            
            return redirect()->route('dokter.dashboard')
                ->with('success', 'Rekam medis berhasil disimpan');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors(['error' => 'Gagal menyimpan rekam medis'])->withInput();
        }
    }

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

     private function get_nama_hari($tanggal)
    {
        $hari_inggris = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return str_replace($hari_inggris, $hari_indonesia, $tanggal->format('l'));
    }
}
