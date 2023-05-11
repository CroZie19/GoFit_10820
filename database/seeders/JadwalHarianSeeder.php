<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Jadwal_Harian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JadwalHarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Jessi = 1   Spine = 1
        // Joon = 2   Wall = 2 
        // JK = 3     Basic = 3
        // Hobby =4   Muaythai = 4
        // V = 5      Asthanga = 5  
        // Lisa = 6   Body Combat = 6
        // Jenny = 7  Zumba = 7
        // Rose = 8     Hatha = 8
        // Jin = 9      Bellydance = 9
        // Jisoo = 10   Swing for Kids = 10
        // Suga = 11    Pilates = 11
        // Jimin = 12   Bungee = 12
        // //Kelas dan Id
        // Yogalates = 13      Trampoline Workout = 17
        // Boxing = 14         Yoga For Kids = 18
        // Calisthenics = 15   Abs Pilates = 19
        // Pound fit = 16
        DB::table('jadwal_harian')->insert([
            'id_kelas' => 1,
            'id_instruktur'  => 2,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-20'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 4,
            'id_instruktur'  => 3,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-20'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 11,
            'id_instruktur'  => 6,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-21'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 5,
            'id_instruktur'  => 4,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-21'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 6,
            'id_instruktur'  => 5,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-22'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 7,
            'id_instruktur'  => 7,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-22'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 2,
            'id_instruktur'  => 8,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-23'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 3,
            'id_instruktur'  => 9,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-23'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 8,
            'id_instruktur'  => 9,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-24'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 9,
            'id_instruktur'  => 10,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-24'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 12,
            'id_instruktur'  => 12,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-25'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 14,
            'id_instruktur'  => 3,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-25'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 15,
            'id_instruktur'  => 2,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-26'),
        ]);
        
        DB::table('jadwal_harian')->insert([
            'id_kelas' => 10,
            'id_instruktur'  => 4,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-20'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 16,
            'id_instruktur'  => 4,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-20'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 15,
            'id_instruktur'  => 2,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-21'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 1,
            'id_instruktur'  => 11,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-21'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 17,
            'id_instruktur'  => 8,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-21'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 18,
            'id_instruktur'  => 1,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-22'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 3,
            'id_instruktur'  => 12,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-22'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 12,
            'id_instruktur'  => 12,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-22'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 19,
            'id_instruktur'  => 7,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-23'),
        ]);

        DB::table('jadwal_harian')->insert([
            'id_kelas' => 6,
            'id_instruktur'  => 5,
            'status_kelas_harian' => 'Kelas Bertugas',
            'tanggal_kelas_harian' => Carbon::parse('2023-02-20'),
        ]);
    }
}
