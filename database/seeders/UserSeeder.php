<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Using firstOrCreate to avoid duplicate entries based on unique columns
        User::firstOrCreate(
            ['email' => 'faiq@gmail.com'], // Check if the email already exists
            [
                'nama' => 'Faiq',
                'username' => 'faiq',
                'password' => bcrypt('123'),
                'alamat' => 'Bogor',
            ]
        );

        User::firstOrCreate(
            ['email' => 'farrel@gmail.com'], // Check if the email already exists
            [
                'nama' => 'Farrel',
                'username' => 'farrel',
                'password' => bcrypt('123'),
                'alamat' => 'Bogor',
            ]
        );

        User::firstOrCreate(
            ['email' => 'pii@gmail.com'], // Check if the email already exists
            [
                'nama' => 'Rafii',
                'username' => 'rafii',
                'password' => bcrypt('123'),
                'alamat' => 'Bogor',
            ]
        );

        User::firstOrCreate(
            ['email' => 'faris@gmail.com'], // Check if the email already exists
            [
                'nama' => 'Faris',
                'username' => 'faris',
                'password' => bcrypt('123'),
                'alamat' => 'Bogor',
            ]
        );
    }
}
