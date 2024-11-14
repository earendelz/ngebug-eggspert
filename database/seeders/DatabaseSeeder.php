<?php

namespace Database\Seeders;

use App\Models\Pakan;
use App\Models\RasAyam;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            GudangSeeder::class,
            LaporanAyamSeeder::class,
            LaporanGudangSeeder::class,
            PakanSeeder::class,
            RasAyamSeeder::class,
            PanenTelurSeeder::class
        ]);
    }
}
