<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Transaksi_Perijinan_Instruktur;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanAktivitasKelasBulananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laporan__aktivitas__kelas__bulanans')->insert([
            'id_member' =>'1',
            'id_kelas' => '2',
            'id_instruktur' => '8',
            'id_booking_kelas' => '23.02.1',
            'bulan_aktivitas' => 'febuari',
            'tahun_aktivitas' => '2023',
            'tanggal_laporan_kelas'  => Carbon::parse('2023-02-20'),      
        ]);

    }
}