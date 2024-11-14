<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pakan;

class PakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pakan::create(['jenis_pakan' => 'Pelet Ayam']);
        Pakan::create(['jenis_pakan' => 'Pelet Ikan']);
        Pakan::create(['jenis_pakan' => 'Jagung']);
        Pakan::create(['jenis_pakan' => 'Dedak']);
        Pakan::create(['jenis_pakan' => 'Konsentrat']);
    }
}
