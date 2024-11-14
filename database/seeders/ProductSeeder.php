<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createdAt = Carbon::today()->toDateString();
        $updatedAt = Carbon::today()->toDateString();

        Product::insert([
            'name' => 'Kandang 1',
            'capacity' => 50,
            'chicken_count' => 25,
            'chicken_breed' => 'Broiler',
            'id_peternak' => '1',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        Product::insert([
            'name' => 'Kandang 2',
            'capacity' => 50,
            'chicken_count' => 20,
            'chicken_breed' => 'Araucana',
            'id_peternak' => '1',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        Product::insert([
            'name' => 'Kandang 3',
            'capacity' => 50,
            'chicken_count' => 23,
            'chicken_breed' => 'Plymouth Rock',
            'id_peternak' => '2',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        Product::insert([
            'name' => 'Kandang 4',
            'capacity' => 55,
            'chicken_count' => 43,
            'chicken_breed' => 'Sussex',
            'id_peternak' => '3',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        Product::insert([
            'name' => 'Kandang 5',
            'capacity' => 56,
            'chicken_count' => 40,
            'chicken_breed' => 'Silkie',
            'id_peternak' => '4',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);

        Product::insert([
            'name' => 'Kandang 6',
            'capacity' => 56,
            'chicken_count' => 45,
            'chicken_breed' => 'Cochin',
            'id_peternak' => '4',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ]);
    }
}
