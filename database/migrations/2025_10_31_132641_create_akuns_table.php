<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akuns', function (Blueprint $table) {
            $table->id('id_akun');
            $table->enum('role', ['resepsionis', 'pasien', 'dokter'])->default('pasien');
            $table->string('nama_akun', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes(); // untuk soft delete (opsional)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akuns');
    }
};
