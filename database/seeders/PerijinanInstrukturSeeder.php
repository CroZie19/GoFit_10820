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

class PerijinanInstrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi__perijinan__instrukturs')->insert([
            'id_jadwal_harian' =>'1',
            'id_instruktur' => '2',
            'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-20'),
            'sesi_perijinan_instruktur' => '8 AM',
            'keterangan_perijinan_instruktur' => 'Sakit Terkena Hujan',
        ]);

        DB::table('transaksi__perijinan__instrukturs')->insert([
            'id_jadwal_harian' =>'5',
            'id_instruktur' => '5',
            'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-20'),
            'sesi_perijinan_instruktur' => '8 AM',
            'keterangan_perijinan_instruktur' => 'Acara keluarga yang mendadak',
        ]);

        DB::table('transaksi__perijinan__instrukturs')->insert([
            'id_jadwal_harian' =>'9',
            'id_instruktur' => '9',
            'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-24'),
            'sesi_perijinan_instruktur' => '8 AM',
            'keterangan_perijinan_instruktur' => 'Ada Keluarga yang Menikah ',
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