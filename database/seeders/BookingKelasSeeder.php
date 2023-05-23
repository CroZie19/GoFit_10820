<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Transaksi_Booking_Kelas;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookingKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi__booking__kelas')->insert([
            'id_booking_kelas' => '23.02.1',
            'id_member' =>'1',
            'id_pegawai' => '2',
            'id_kelas' => '2',
            'id_instruktur' => '8',
            'id_transaksi_deposit_kelas' => '1',
            'id_transaksi_deposit_uang' => '1',
            'tanggal_booking_kelas'  => Carbon::parse('2023-02-20'),
            'sesi_kelas' => '07:00 A.M - 09:00 A.M',
            'konfirmasi_presensi' => 0,
        ]);

        DB::table('transaksi__booking__kelas')->insert([
            'id_booking_kelas' => '23.02.2',
            'id_member' =>'6',
            'id_pegawai' => '2',
            'id_kelas' => '9',
            'id_instruktur' => '10',
            'id_transaksi_deposit_kelas' => '2',
            'id_transaksi_deposit_uang' => '2',
            'tanggal_booking_kelas'  => Carbon::parse('2023-02-21'),
            'sesi_kelas' => '09:00 A.M - 11:00 A.M',
            'konfirmasi_presensi' => 0,
        ]);

        DB::table('transaksi__booking__kelas')->insert([
            'id_booking_kelas' => '23.02.3',
            'id_member' =>'7',
            'id_pegawai' => '3',
            'id_kelas' => '9',
            'id_instruktur' => '10',
            'id_transaksi_deposit_kelas' => '2',
            'id_transaksi_deposit_uang' => '2',
            'tanggal_booking_kelas'  => Carbon::parse('2023-05-19'),
            'sesi_kelas' => '09:00 A.M - 11:00 A.M',
            'konfirmasi_presensi' => 0,
        ]);
    
    }
}