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
        Schema::create('transaksi__deposit__kelas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi_deposit_kelas');
            $table->integer('jumlah_deposit_kelas');
            $table->integer('total_pembayaran_deposit_kelas');
            $table->string('bonus_deposit_kelas');
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
        Schema::dropIfExists('transaksi__deposit__kelas');
    }
};
