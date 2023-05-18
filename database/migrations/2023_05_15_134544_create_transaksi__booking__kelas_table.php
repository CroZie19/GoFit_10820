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
        Schema::create('transaksi__booking__kelas', function (Blueprint $table) {
            $table->string('id_booking_kelas', 10)->primary();
            $table->foreignId('id_member')->constrained('member');
            $table->foreignId('id_pegawai')->constrained('pegawai');
            $table->foreignId('id_kelas')->constrained('kelas');
            $table->foreignId('id_instruktur')->constrained('instruktur');
            $table->foreignId('id_transaksi_deposit_kelas')->constrained('transaksi__deposit__kelas');
            $table->foreignId('id_transaksi_deposit_uang')->constrained('transaksi__deposit__uangs');
            $table->string('sesi_kelas');
            $table->boolean('konfirmasi_presensi')->default();
            $table->boolean('status_presensi')->nullable();
            $table->date('tanggal_booking_kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi__booking__kelas');
    }
};
