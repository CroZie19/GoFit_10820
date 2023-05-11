<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PegawaiSeeder::class);
        $this->call(InstrukturSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(JadwalHarianSeeder::class);
        $this->call(TransaksiPerijinanInstrukturSeeder::class);
    }
}