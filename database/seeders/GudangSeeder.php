<?php

namespace Database\Seeders;

use App\Models\Gudang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createdAt = Carbon::today()->toDateString();
        $updatedAt = Carbon::today()->toDateString();

        Gudang::insert([
            'name' => 'Gudang 1',
            'date' => '2024-07-09',
            'egg_count' => 25,
            'chicken_breed' => 'Broiler',
            'id_peternak' => '1',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        Gudang::insert([
            'name' => 'Gudang 1',
            'date' => '2024-07-09',
            'egg_count' => 25,
            'chicken_breed' => 'Broiler',
            'id_peternak' => '2',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        Gudang::insert([
            'name' => 'Gudang 1',
            'date' => '2024-07-09',
            'egg_count' => 25,
            'chicken_breed' => 'Ayam Kampung',
            'id_peternak' => '3',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);
    }
}
