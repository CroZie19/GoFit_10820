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
        Schema::create('laporan__pendapatan__bulanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aktivasi_tahunan')->constrained('transaksi__aktivasi__tahunans');
            $table->foreignId('id_transaksi_deposit_kelas')->constrained('transaksi__deposit__kelas');
            $table->foreignId('id_transaksi_deposit_uang')->constrained('transaksi__deposit__uangs');
            $table->integer('total_deposit');
            $table->integer('total_aktivasi');
            $table->boolean('total_keseluruhan');
            $table->date('tanggal_laporan_perBulan');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan__pendapatan__bulanans');
    }
};
