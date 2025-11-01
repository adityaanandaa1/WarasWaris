<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'id_pasien',
        'tanggal_reservasi',
        'nomor_antrian',
        'keluhan',
        'status',
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
    ];

    // ========== RELASI ==========

    /**
     * Relasi: Reservasi milik 1 Pasien (belongsTo)
     */
    public function Data_pasien()
    {
        return $this->belongsTo(data_pasien::class);
    }

    /**
     * Relasi: Reservasi punya 1 Rekam Medis (hasOne)
     * 
     * 1 reservasi = 1 kunjungan = 1 rekam medis
     */
    public function Rekam_medis()
    {
        return $this->hasOne(rekam_medis::class);
    }

    // ========== SCOPE (Query Helper) ==========

    /**
     * Scope untuk filter reservasi hari ini
     * 
     * Penggunaan: Reservasi::hariIni()->get()
     */
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal_reservasi', today());
    }

    /**
     * Scope untuk filter berdasarkan status
     * 
     * Penggunaan: Reservasi::status('menunggu')->get()
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}