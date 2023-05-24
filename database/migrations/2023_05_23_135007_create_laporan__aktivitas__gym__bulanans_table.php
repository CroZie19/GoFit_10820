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
        Schema::create('laporan__aktivitas__gym__bulanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_member')->constrained('member');
            $table->string('id_booking_gym');
            $table->foreign('id_booking_gym')->references('id_booking_gym')->on('transaksi__booking__gyms'); 
            $table->string('bulan_aktivitas');
            $table->string('tahun_aktivitas');
            $table->string('tanggal_laporan_aktivasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan__aktivitas__gym__bulanans');
    }
};