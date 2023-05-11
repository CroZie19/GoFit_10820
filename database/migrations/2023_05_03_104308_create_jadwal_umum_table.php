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
        Schema::create('jadwal_umum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jadwal_harian')->constrained('jadwal_harian');
            $table->foreignId('id_kelas')->constrained('kelas');
            $table->foreignId('id_instruktur')->constrained('instruktur');
            $table->string('hari_kelas_umum');
            $table->string('jam_kelas_umum');
            $table->string('status_kelas_umum');
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
        Schema::dropIfExists('jadwal__umum');
    }
};
