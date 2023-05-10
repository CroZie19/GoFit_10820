<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelas')->insert([
            'jenis_kelas'  => 'SPINE Corrector',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Wall Swing',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Basic Swing',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'MUAYTHAI',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'ASTHANGA',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Body Combat',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'ZUMBA',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'HATHA',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Bellydance',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Swing For Kids',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'PILATES',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'BUNGEE',
            'harga_kelas' => 200000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Yogalates',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'BOXING',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Calisthenics',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Pound Fit',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Trampoline Workout',
            'harga_kelas' => 200000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Yoga For Kids',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);

        DB::table('kelas')->insert([
            'jenis_kelas'  => 'Abs Pilates',
            'harga_kelas' => 150000,
            'jumlah_kapasitas_kelas' => 10,
        ]);
    }
}
