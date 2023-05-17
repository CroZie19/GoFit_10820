<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('member')->insert([
            'nama_member'  => 'Chrsitoper Nolan',
            'tanggal_lahir_member' => Carbon::parse('1998-02-20'),
            'alamat_member' => 'Jl Setia Budi No.89 Caturtunggal',
            'noTelp_member' =>'081233456789',
            'jumlah_deposit_member' => 500000,
            'email' => 'nolan@gmail.com',
            'password' => 'nolan123',
            'tanggal_kardaluasa_member' => Carbon::parse('2023-06-20'),
        ]);

        DB::table('member')->insert([
            'nama_member'  => 'Alex Bhizer',
            'tanggal_lahir_member' => Carbon::parse('1999-02-20'),
            'alamat_member' => 'Jl Setia Budi No.90 Caturtunggal',
            'noTelp_member' =>'081233456765',
            'jumlah_deposit_member' => 600000,
            'email' => 'alex@gmail.com',
            'password' => 'alex123',
            'tanggal_kardaluasa_member' => Carbon::parse('2023-07-20'),
        ]);


        DB::table('member')->insert([
            'nama_member'  => 'LeBron James',
            'tanggal_lahir_member' => Carbon::parse('1997-02-20'),
            'alamat_member' => 'Jl Setia Budi No.91 Caturtunggal',
            'noTelp_member' =>'081233456123',
            'jumlah_deposit_member' => 700000,
            'email' => 'james@gmail.com',
            'password' => 'james123',
            'tanggal_kardaluasa_member' => Carbon::parse('2023-08-20'),
        ]);


    }
} 
