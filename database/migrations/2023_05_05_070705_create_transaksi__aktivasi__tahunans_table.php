<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi__aktivasi__tahunans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_member')->constrained('member');
            $table->foreignId('id_pegawai')->constrained('pegawai');
            $table->date('tanggal_transaksi_aktivasi');
            $table->integer('jumlah_pembayaran_aktivasi');
            $table->string('metode_pembayaran_aktivasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi__aktivasi__tahunans');
    }
};
