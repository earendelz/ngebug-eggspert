<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RasAyamSeeder extends Seeder
{
    /**
     * Seed the database with ras_ayam data.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ras_ayams')->insert([
            [
                'nama_ras_ayam' => 'Broiler',
                'jenis_ayam' => 'Pedaging',
            ],
            [
                'nama_ras_ayam' => 'Layer',
                'jenis_ayam' => 'Petelur',
            ],
            [
                'nama_ras_ayam' => 'Kampung',
                'jenis_ayam' => 'Pedaging',
            ],
            [
                'nama_ras_ayam' => 'Silkie',
                'jenis_ayam' => 'Petelur',
            ],
        ]);
    }
}
