<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_praktik extends Model
{
    use HasFactory;

    protected $table = 'jadwal_praktiks';

    protected $fillable = [
        'hari',
        'tanggal_jadwal_praktik',
        'jam_mulai',
        'jam_selesai',
        'is_active',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'jam_mulai' => 'datetime:H:i', // Format jam saja (08:00)
        'jam_selesai' => 'datetime:H:i',
        'is_active' => 'boolean',
    ];

    // Tidak ada relasi khusus karena jadwal adalah data standalone
}