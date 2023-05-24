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

class BookingGymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi__booking__gyms')->insert([
            'id_aktivasi_tahunan' => '23.02.1',
            'id_transaksi_deposit_kelas' =>'1',
            'id_transaksi_deposit_uang' => '2',
            'total_deposit'  => Carbon::parse('2023-02-20'),
            'total_aktivasi' => '07:00 A.M - 09:00 A.M',
            'total_keseluruhan' => 10,
            'tanggal_laporan_perBulan' => 
        ]);
        
    }
}