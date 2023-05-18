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
            'judul'  => 'Menu Pilihan',
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

        $menu7 = Menu::create([
            'judul'  => 'Aktivasi',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-cash',
            'url' => '/aktivasiMember',
            'urut' => '7',
        ]);

        $menu8 = Menu::create([
            'judul'  => 'DepositUang',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-cash-fast',
            'url' => '/depositUang',
            'urut' => '8',
        ]);

        $menu9 = Menu::create([
            'judul'  => 'DepositKelas',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-google-classroom',
            'url' => '/depositKelas',
            'urut' => '9',
        ]);

        $menu10 = Menu::create([
            'judul'  => 'bookingGym',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-weight-lifter',
            'url' => '/bookingGym',
            'urut' => '10',
        ]);

        $menu11 = Menu::create([
            'judul'  => 'presensiKelas',
            'id_induk' => 1,
            'ikon' => 'mdi mdi-account-group',
            'url' => '/presensiKelas',
            'urut' => '11',
        ]);



        $menu1->assignRole('Manager Operasional');
        $menu1->assignRole('Admin');
        $menu1->assignRole('Kasir');

        $menu2->assignRole('Admin');

        $menu3->assignRole('Kasir');
        $menu7->assignRole('Kasir');
        $menu8->assignRole('Kasir');
        $menu9->assignRole('Kasir');
        $menu10->assignRole('Kasir');
        $menu11->assignRole('Kasir');

        $menu4->assignRole('Manager Operasional');
        $menu5->assignRole('Manager Operasional');
        $menu6->assignRole('Manager Operasional');
    }
}