<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        DB::statement(<<<SQL
            CREATE OR REPLACE VIEW riwayat_pemeriksaan_view AS
            SELECT
                rm.id,
                rm.nomor_rekam_medis,
                rm.id_pasien,
                rm.id_reservasi,
                rm.tanggal_pemeriksaan,
                rm.diagnosa,
                rm.tekanan_darah,
                rm.tinggi_badan,
                rm.berat_badan,
                rm.suhu,
                rm.saran,
                rm.rencana_tindak_lanjut,
                rm.catatan_tambahan,
                rm.created_at
            FROM rekam_medis rm
        SQL);
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS riwayat_pemeriksaan_view');
    }
};
