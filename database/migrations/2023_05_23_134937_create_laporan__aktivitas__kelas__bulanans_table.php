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
        Schema::create('laporan__aktivitas__kelas__bulanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_member')->constrained('member');
            $table->foreignId('id_kelas')->constrained('kelas');
            $table->foreignId('id_instruktur')->constrained('instruktur');
            $table->string('id_booking_kelas');
            $table->foreign('id_booking_kelas')->references('id_booking_kelas')->on('transaksi__booking__kelas'); 
            $table->string('bulan_aktivitas');
            $table->string('tahun_aktivitas');
            $table->date('tanggal_laporan_kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan__aktivitas__kelas__bulanans');
    }
};