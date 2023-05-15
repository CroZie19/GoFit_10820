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
        Schema::create('transaksi__booking__gyms', function (Blueprint $table) {
            $table->string('id_booking_gym', 10)->primary();
            $table->foreignId('id_member')->constrained('member');
            $table->foreignId('id_pegawai')->constrained('pegawai');
            $table->string('sesi_gym');
            $table->Integer('jumlah_kapasitas_gym');
            $table->date('tanggal_booking_gym');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi__booking__gyms');
    }
};
