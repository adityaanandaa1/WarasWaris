<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_pasien extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (opsional, Laravel auto-detect)
     * Karena nama model = Pasien, Laravel cari tabel "pasiens"
     */
    protected $table = 'data_pasiens';

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'id_akun',
        'nama_pasien',
        'tanggal_lahir_pasien',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'pekerjaan',
        'catatan_pasien',
        'is_primary',
    ];

    /**
     * Cast tipe data otomatis
     */
    protected $casts = [
        'tanggal_lahir' => 'date', // Otomatis jadi Carbon object
        'is_primary' => 'boolean', // Otomatis jadi true/false
    ];

    // ========== RELASI ==========

    /**
     * Relasi: Pasien milik 1 User (belongsTo)
     * 
     * Kebalikan dari hasMany di User
     * Contoh: $pasien->user (ambil data akun pemilik)
     */
    public function akun()
    {
        return $this->belongsTo(\App\Models\akun_user::class, 'id_akun');
    }

    /**
     * Relasi: Pasien punya banyak Reservasi (hasMany)
     * 
     * Contoh: $pasien->reservasis (semua reservasi pasien ini)
     */
    public function Reservasis()
    {
        return $this->hasMany(reservasi::class);
    }

    /**
     * Relasi: Pasien punya banyak Rekam Medis (hasMany)
     * 
     * Contoh: $pasien->rekamMedis (semua riwayat pemeriksaan)
     */
    public function Rekam_medis()
    {
        return $this->hasMany(rekam_medis::class);
    }
}