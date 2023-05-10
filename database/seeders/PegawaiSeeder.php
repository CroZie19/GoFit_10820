<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Pegawai; 

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filbert = Pegawai::create([
            'nama_pegawai' => 'filbert',
            'username_pegawai' => 'filbert123@gmail.com',
            'password_pegawai' => Hash::make('Filbert321'),
            'tanggal_lahir_pegawai' => '1984-09-12',
            'noTelp_pegawai' => '089506266987',
            'alamat_pegawai' => 'JL. Kemuning IV no 456',
            'jabatan_pegawai' => 'Manager Operasional',
        ]);

        $yunita = Pegawai::create([
            'nama_pegawai' => 'yunita',
            'username_pegawai' => 'yunita123@gmail.com',
            'password_pegawai' => Hash::make('yunita321'),
            'tanggal_lahir_pegawai' => '1985-09-12',
            'noTelp_pegawai' => '089506266456',
            'alamat_pegawai' => 'JL. Kemuning IV no 455',
            'jabatan_pegawai' => 'Kasir'

        ]);

        $yanto = Pegawai::create([
            'nama_pegawai' => 'yanto',
            'username_pegawai' => 'yanto123@gmail.com',
            'password_pegawai' => Hash::make('yanto321'),
            'tanggal_lahir_pegawai' => '1986-09-12',
            'noTelp_pegawai' => '089506266453',
            'alamat_pegawai' => 'JL. Kemuning III no 455',
            'jabatan_pegawai' => 'Kasir'
        ]);

        $mamang = Pegawai::create([
            'nama_pegawai' => 'Mamang',
            'username_pegawai' => 'mamang123@gmail.com',
            'password_pegawai' => Hash::make('mamang321'),
            'tanggal_lahir_pegawai' => '1989-09-12',
            'noTelp_pegawai' => '089506266234',
            'alamat_pegawai' => 'JL. Kemuning II no 455',
            'jabatan_pegawai' => 'Admin'

        ]);

        $guntur = Pegawai::create([
            'nama_pegawai' => 'Guntur',
            'username_pegawai' => 'guntur123@gmail.com',
            'password_pegawai' => Hash::make('guntur321'),
            'tanggal_lahir_pegawai' => '1990-09-12',
            'noTelp_pegawai' => '089506266342',
            'alamat_pegawai' => 'JL. Kemuning II no 455',
            'jabatan_pegawai' => 'Admin'
        ]);

        $managerOperasional = Role::create(['name' => 'Manager Operasional']);
        $kasir = Role::create(['name' => 'Kasir']);
        $admin = Role::create(['name' => 'Admin']);
        

        $filbert->assignRole($managerOperasional);
        $yunita->assignRole($kasir);
        $yanto->assignRole($kasir);
        $mamang->assignRole($admin);
        $guntur->assignRole($admin);

    }
}
