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

        // DB::table('transaksi__perijinan__instrukturs')->insert([
        //     'id_jadwal_harian' =>'12',
        //     'id_instruktur' => '3',
        //     'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-25'),
        //     'sesi_perijinan_instruktur' => '09:30 AM',
        //     'keterangan_perijinan_instruktur' => 'Demam Tidak Enak Badan',
        // ]);

        // DB::table('transaksi__perijinan__instrukturs')->insert([
        //     'id_jadwal_harian' =>'11',
        //     'id_instruktur' => '12',
        //     'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-24'),
        //     'sesi_perijinan_instruktur' => '8 AM',
        //     'keterangan_perijinan_instruktur' => 'Ada Keluarga yang Menikah ',
        // ]);
    }
}