<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaporanAyam;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LaporanAyamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar username dan data laporan ayam untuk setiap user
        $data = [
            'farrel' => [
                ['chicken_count' => 100, 'date' => '2024-10-01', 'live_chicken_count' => 95, 'dead_chicken_count' => 5],
                ['chicken_count' => 150, 'date' => '2024-10-02', 'live_chicken_count' => 145, 'dead_chicken_count' => 5],
            ],
            'faiq' => [
                ['chicken_count' => 200, 'date' => '2024-10-01', 'live_chicken_count' => 195, 'dead_chicken_count' => 5],
                ['chicken_count' => 250, 'date' => '2024-10-02', 'live_chicken_count' => 240, 'dead_chicken_count' => 10],
            ],
            'rafii' => [
                ['chicken_count' => 300, 'date' => '2024-10-01', 'live_chicken_count' => 290, 'dead_chicken_count' => 10],
                ['chicken_count' => 350, 'date' => '2024-10-02', 'live_chicken_count' => 340, 'dead_chicken_count' => 10],
            ],
            'faris' => [
                ['chicken_count' => 400, 'date' => '2024-10-01', 'live_chicken_count' => 390, 'dead_chicken_count' => 10],
                ['chicken_count' => 450, 'date' => '2024-10-02', 'live_chicken_count' => 440, 'dead_chicken_count' => 10],
            ],
        ];

        // Iterasi melalui setiap username dan tambahkan data laporan ayam
        foreach ($data as $username => $laporans) {
            $user = User::where('username', $username)->first();

            if ($user) {
                foreach ($laporans as $laporan) {
                    LaporanAyam::create(array_merge($laporan, ['user_id' => $user->id]));
                }
            } else {
                Log::warning("User dengan username '$username' tidak ditemukan.");
            }
        }
    }
}
