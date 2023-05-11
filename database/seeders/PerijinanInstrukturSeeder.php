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

class TransaksiPerijinanInstrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi_perijinan_instrukturs')->insert([
            'id_jadwal_harian' =>'1',
            'id_instruktur' => '2',
            'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-20'),
            'sesi_perijinan_instruktur' => '8 AM',
            'keterangan_perijinan_instruktur' => 'Sakit Terkena Hujan',
        ]);

        DB::table('transaksi_perijinan_instrukturs')->insert([
            'id_jadwal_harian' =>'5',
            'id_instruktur' => '5',
            'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-20'),
            'sesi_perijinan_instruktur' => '8 AM',
            'keterangan_perijinan_instruktur' => 'Acara keluarga yang mendadak',
        ]);

        DB::table('transaksi_perijinan_instrukturs')->insert([
            'id_jadwal_harian' =>'9',
            'id_instruktur' => '9',
            'tanggal_perijinan_instruktur'  => Carbon::parse('2023-02-24'),
            'sesi_perijinan_instruktur' => '8 AM',
            'keterangan_perijinan_instruktur' => 'Ada Keluarga yang Menikah ',
        ]);


        
    }
}
