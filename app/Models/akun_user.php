<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * Kolom-kolom yang boleh diisi secara massal (bulk insert/update)
     */
    protected $fillable = [
        'email',
        'password',
        'role', // Tambahan: role pengguna
    ];

    /**
     * The attributes that should be hidden for serialization.
     * 
     * Kolom yang disembunyikan saat data dikonversi ke JSON/Array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * 
     * Mengubah tipe data kolom otomatis
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Otomatis hash password
        ];
    }

    // ========== RELASI ==========
    
    /**
     * Relasi: User bisa punya banyak Pasien (hasMany)
     * 
     * Contoh penggunaan: $user->pasiens (dapat semua pasien dalam 1 akun)
     */
    public function pasiens()
    {
        return $this->hasMany(data_pasien::class);
    }

    /**
     * Relasi: User punya 1 Dokter (hasOne)
     * 
     * Contoh: $user->dokter (jika role = dokter)
     */
    public function dokter()
    {
        return $this->hasOne(data_dokter::class);
    }

    /**
     * Relasi: User punya 1 Resepsionis (hasOne)
     * 
     * Contoh: $user->resepsionis (jika role = resepsionis)
     */
    public function resepsionis()
    {
        return $this->hasOne(data_resepsionis::class);
    }
}