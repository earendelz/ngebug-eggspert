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
        User::insert([
            'nama' => 'Faiq',
            'username' => 'faiq',
            'password' => bcrypt('123'),
            'email' => 'faiq@gmail.com',
            'alamat' => 'Bogor',
        ]);

        User::insert([
            'nama' => 'Farrel',
            'username' => 'farrel',
            'password' => bcrypt('123'),
            'email' => 'farrel@gmail.com',
            'alamat' => 'Bogor',
        ]);

        User::insert([
            'nama' => 'Rafii',
            'username' => 'rafii',
            'password' => bcrypt('123'),
            'email' => 'pii@gmail.com',
            'alamat' => 'Bogor',
        ]);

        User::insert([
            'nama' => 'Faris',
            'username' => 'faris',
            'password' => bcrypt('123'),
            'email' => 'faris@gmail.com',
            'alamat' => 'Bogor',
        ]);
    }
}
