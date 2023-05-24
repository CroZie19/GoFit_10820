<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Laporan_Aktivitas_Gym_Bulanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanAktivitasGymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laporan__aktivitas__gym__bulanans')->insert([
            'id_member' =>'1',
            'id_booking_gym' => '23.02.1',
            'bulan_aktivitas'  => 'febuari',
            'tahun_aktivitas' => '2023',
            'tanggal_laporan_aktivasi' => '2023-02-20',
        ]);
        
    }
}