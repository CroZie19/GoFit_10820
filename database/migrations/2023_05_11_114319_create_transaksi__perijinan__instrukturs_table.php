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
        Schema::create('transaksi__perijinan__instrukturs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_jadwal_harian')->constrained('jadwal_harian');
            $table->foreignId('id_instruktur')->constrained('instruktur');
            $table->date('tanggal_perijinan_instruktur');
            $table->string('sesi_perijinan_instruktur');
            $table->string('keterangan_perijinan_instruktur');          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi__perijinan__instrukturs');
    }
};
