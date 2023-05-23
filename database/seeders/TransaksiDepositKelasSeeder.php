<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Transaksi_Deposit_Kelas;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiDepositKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi__deposit__kelas')->insert([
            'id_kelas' =>'1',
            'id_pegawai' => '2',
            'id_member'  => '4',
            'tanggal_transaksi_deposit_kelas' =>  Carbon::parse('2023-02-20'),
            'jumlah_deposit_kelas' => '900000',
            'total_pembayaran_deposit_kelas' => '750000',
            'bonus_deposit_kelas' => '150000',
        ]);

        DB::table('transaksi__deposit__kelas')->insert([
            'id_kelas' =>'2',
            'id_pegawai' => '2',
            'id_member'  => '2',
            'tanggal_transaksi_deposit_kelas' =>  Carbon::parse('2023-02-21'),
            'jumlah_deposit_kelas' => '900000',
            'total_pembayaran_deposit_kelas' => '750000',
            'bonus_deposit_kelas' => '150000',
        ]);

        DB::table('transaksi__deposit__kelas')->insert([
            'id_kelas' =>'2',
            'id_pegawai' => '3',
            'id_member'  => '7',
            'tanggal_transaksi_deposit_kelas' =>  Carbon::parse('2023-02-21'),
            'jumlah_deposit_kelas' => '900000',
            'total_pembayaran_deposit_kelas' => '750000',
            'bonus_deposit_kelas' => '150000',
        ]);

    }
}