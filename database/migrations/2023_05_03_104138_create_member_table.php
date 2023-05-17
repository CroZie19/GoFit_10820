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
        Schema::create('member', function (Blueprint $table) {
            $table->id();
            $table->string('nama_member');
            $table->date('tanggal_lahir_member');
            $table->string('alamat_member');
            $table->string('noTelp_member', 12);
            $table->integer('jumlah_deposit_member')->nullable();
            $table->string('email');
            $table->string('password');
            $table->date('tanggal_kardaluasa_member')->nullable();
            $table->boolean('status_member')->default(0);
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
        Schema::dropIfExists('member');
    }
};