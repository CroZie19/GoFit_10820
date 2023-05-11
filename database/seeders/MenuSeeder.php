<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu1 = Menu::create([
            'judul'  => 'Data Master',
            'id_induk' => null,
            'ikon' => 'mdi mdi-database',
            'url' => null,
            'urut' => '1',
        ]);

        $menu2 = Menu::create([
            'judul'  => 'Instruktur',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-account-tie',
            'url' => '/instruktur',
            'urut' => '2',
        ]);

        $menu3 = Menu::create([
            'judul'  => 'Member',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-account',
            'url' => '/member',
            'urut' => '3',
        ]);

        $menu4 = Menu::create([
            'judul'  => 'Jadwal',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-calendar-blank',
            'url' => '/jadwal',
            'urut' => '4',
        ]);

        $menu5 = Menu::create([
            'judul'  => 'Jadwal Harian',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-calendar-month',
            'url' => '/jadwal-harian',
            'urut' => '5',
        ]);

        $menu6 = Menu::create([
            'judul'  => 'Perijinan',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-pencil',
            'url' => '/perijinanInstruktur',
            'urut' => '6',
        ]);

        $menu1->assignRole('Manager Operasional');
        $menu1->assignRole('Admin');
        $menu1->assignRole('Kasir');

        $menu2->assignRole('Admin');
        $menu3->assignRole('Kasir');
        $menu4->assignRole('Manager Operasional');
        $menu5->assignRole('Manager Operasional');
        $menu6->assignRole('Manager Operasional');
    }
}