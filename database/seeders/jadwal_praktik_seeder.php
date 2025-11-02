<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\jadwal_praktik;
use Carbon\Carbon;

class jadwal_praktik_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar hari dalam seminggu
        $hari_dalam_seminggu = [
            'Senin',  
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        ];

        $offset = [
            'Senin'=>0,'Selasa'=>1,'Rabu'=>2,'Kamis'=>3,'Jumat'=>4,'Sabtu'=>5,'Minggu'=>6
        ];

        $awalMinggu = Carbon::now('Asia/Jakarta')->startOfWeek(Carbon::MONDAY);

        foreach ($hari_dalam_seminggu as $hari) {
        $tanggal_jadwal_praktik = $awalMinggu->copy()->addDays($offset[$hari])->toDateString();  
        //Hitung tanggal minggu ini mulai Senin lalu tambah offset harinya.

        if ($hari === 'Minggu') {
                // Libur
                jadwal_praktik::updateOrCreate(
                    ['hari' => $hari, 'tanggal_jadwal_praktik' => $tanggal_jadwal_praktik], //tanggal hari ini
                    ['jam_mulai' => null, 'jam_selesai' => null, 'is_active' => false] // NILAI
                );
            } else {
                // Buka 08:00 - 16:00
                jadwal_praktik::updateOrCreate(
                    ['hari' => $hari, 'tanggal_jadwal_praktik' => $tanggal_jadwal_praktik],  // KUNCI
                    ['jam_mulai' => '08:00:00', 'jam_selesai' => '16:00:00', 'is_active' => true]
                );
            }
         }
    }
}
