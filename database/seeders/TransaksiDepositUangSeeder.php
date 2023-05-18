<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Transaksi_Deposit_Uang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiDepositUangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi__deposit__uangs')->insert([
            'id_member' =>'1',
            'id_pegawai' => '2',
            'tanggal_transaksi_deposit_uang'  => Carbon::parse('2023-02-20'),
            'jumlah_deposit_uang' => '500000 ',
            'total_pembayaran_deposit_uang' => '500000',
            'bonus_deposit_uang' => ' 0 ',
        ]);

        DB::table('transaksi__deposit__uangs')->insert([
            'id_member' =>'2',
            'id_pegawai' => '2',
            'tanggal_transaksi_deposit_uang'  => Carbon::parse('2023-02-21'),
            'jumlah_deposit_uang' => '500000 ',
            'total_pembayaran_deposit_uang' => '500000',
            'bonus_deposit_uang' => ' 0 ',
        ]);
    }
}