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
        Schema::create('transaksi__deposit__uangs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi_deposit_uang');
            $table->integer('jumlah_deposit_uang');
            $table->integer('total_pembayaran_deposit_uang');
            $table->integer('bonus_deposit_uang');
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
        Schema::dropIfExists('transaksi__deposit__uangs');
    }
};
