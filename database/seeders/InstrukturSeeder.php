<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Instruktur;

class InstrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jessi = Instruktur::create([
            'nama_instruktur' => 'Jessi Jazz',
            'username_instruktur' => 'jessi123@gmail.com',
            'password_instruktur' => Hash::make('Jessi321'),
            'tanggal_lahir_instruktur' => '1974-10-13',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 450',
        ]);

        $joon = Instruktur::create([
            'nama_instruktur' => 'Joon Bun',
            'username_instruktur' => 'joon123@gmail.com',
            'password_instruktur' => Hash::make('Joon321'),
            'tanggal_lahir_instruktur' => '1994-09-13',
            'noTelp_instruktur' => '089506266098',
            'alamat_instruktur' => 'JL. Kemuning IV no 459',
            
        ]);

        $jk = Instruktur::create([
            'nama_instruktur' => 'JK Rowling',
            'username_instruktur' => 'jk123@gmail.com',
            'password_instruktur' => Hash::make('JK321'),
            'tanggal_lahir_instruktur' => '1974-10-14',
            'noTelp_instruktur' => '089506266980',
            'alamat_instruktur' => 'JL. Kemuning IV no 459',
            
        ]);

        $hobby = Instruktur::create([
            'nama_instruktur' => 'Hobby Ben',
            'username_instruktur' => 'hobby123@gmail.com',
            'password_instruktur' => Hash::make('Hobby321'),
            'tanggal_lahir_instruktur' => '1994-07-12',
            'noTelp_instruktur' => '089506266786',
            'alamat_instruktur' => 'JL. Kemuning IV no 456',
            
        ]);

        $v = Instruktur::create([
            'nama_instruktur' => 'V Gambo',
            'username_instruktur' => 'v123@gmail.com',
            'password_instruktur' => Hash::make('V321'),
            'tanggal_lahir_instruktur' => '1974-10-12',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 450',
           
        ]);

        $lisa = Instruktur::create([
            'nama_instruktur' => 'Lisa Manoban',
            'username_instruktur' => 'lisa123@gmail.com',
            'password_instruktur' => Hash::make('Lisa321'),
            'tanggal_lahir_instruktur' => '1974-10-17',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 450',
           
        ]);

        $jenny = Instruktur::create([
            'nama_instruktur' => 'Jenny',
            'username_instruktur' => 'jenny123@gmail.com',
            'password_instruktur' => Hash::make('Jenny321'),
            'tanggal_lahir_instruktur' => '1974-10-12',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 451',
            
        ]);

        $rose = Instruktur::create([
            'nama_instruktur' => 'Rose Mawar',
            'username_instruktur' => 'rose123@gmail.com',
            'password_instruktur' => Hash::make('Rose321'),
            'tanggal_lahir_instruktur' => '1994-09-12',
            'noTelp_instruktur' => '089506266987',
            'alamat_instruktur' => 'JL. Kemuning IV no 456',
        ]);

        $jin = Instruktur::create([
            'nama_instruktur' => 'Jin Kamen',
            'username_instruktur' => 'jin123@gmail.com',
            'password_instruktur' => Hash::make('Jin321'),
            'tanggal_lahir_instruktur' => '1974-10-21',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 450',
        ]);

        $jisoo = Instruktur::create([
            'nama_instruktur' => 'Jisoo Blekping',
            'username_instruktur' => 'jisoo123@gmail.com',
            'password_instruktur' => Hash::make('Jisoo321'),
            'tanggal_lahir_instruktur' => '1974-10-12',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 450',
           
        ]);

        $suga = Instruktur::create([
            'nama_instruktur' => 'Suga Sugar',
            'username_instruktur' => 'suga123@gmail.com',
            'password_instruktur' => Hash::make('Suga321'),
            'tanggal_lahir_instruktur' => '1974-10-12',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 450',
            
        ]);

        $jimin = Instruktur::create([
            'nama_instruktur' => 'Jimin Ngroo',
            'username_instruktur' => 'jimin123@gmail.com',
            'password_instruktur' => Hash::make('Jimin321'), 
            'tanggal_lahir_instruktur' => '1974-10-12',
            'noTelp_instruktur' => '089506266564',
            'alamat_instruktur' => 'JL. Kemuning IV no 450',
        ]);

        

        $instruktur =  Role::create(['guard_name' => 'instruktur', 'name' => 'Instruktur']);

       
        $jk->assignRole($instruktur);
        $jisoo->assignRole($instruktur);
        $lisa->assignRole($instruktur);
        $v->assignRole($instruktur);
        $hobby->assignRole($instruktur);
        $suga->assignRole($instruktur);
        $jenny->assignRole($instruktur);
        $rose->assignRole($instruktur);
        $jin->assignRole($instruktur);
        $joon->assignRole($instruktur);
        $jimin->assignRole($instruktur);
        $jessi->assignRole($instruktur);
    }
}