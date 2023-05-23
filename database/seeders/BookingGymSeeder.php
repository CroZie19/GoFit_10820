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
            'id_booking_gym' => '23.02.1',
            'id_member' =>'1',
            'id_pegawai' => '2',
            'tanggal_booking_gym'  => Carbon::parse('2023-02-20'),
            'sesi_gym' => '07:00 A.M - 09:00 A.M',
            'jumlah_kapasitas_gym' => 10,
        ]);

        DB::table('transaksi__booking__gyms')->insert([
            'id_booking_gym' => '23.02.2',
            'id_member' =>'2',
            'id_pegawai' => '2',
            'tanggal_booking_gym'  => Carbon::parse('2023-02-20'),
            'sesi_gym' => '09:00 A.M - 11:00 A.M',
            'jumlah_kapasitas_gym' => 10,
        ]);

        DB::table('transaksi__booking__gyms')->insert([
            'id_booking_gym' => '23.02.3',
            'id_member' =>'3',
            'id_pegawai' => '2',
            'tanggal_booking_gym'  => Carbon::parse('2023-02-20'),
            'sesi_gym' => '11:00 A.M - 13:00 P.M',
            'jumlah_kapasitas_gym' => 10,
        ]);

           DB::table('transaksi__booking__gyms')->insert([
            'id_booking_gym' => '23.02.4',
            'id_member' =>'6',
            'id_pegawai' => '2',
            'tanggal_booking_gym'  => Carbon::parse('2023-02-20'),
            'sesi_gym' => '11:00 A.M - 13:00 P.M',
            'jumlah_kapasitas_gym' => 10,
        ]);

           DB::table('transaksi__booking__gyms')->insert([
            'id_booking_gym' => '23.05.19',
            'id_member' =>'7',
            'id_pegawai' => '3',
            'tanggal_booking_gym'  => Carbon::parse('2023-05-19'),
            'sesi_gym' => '11:00 A.M - 13:00 P.M',
            'jumlah_kapasitas_gym' => 10,
        ]);
        
    }
}