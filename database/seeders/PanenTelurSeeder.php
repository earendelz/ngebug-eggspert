<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PanenTelur;

class PanenTelurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan 3 data panen telur
        PanenTelur::create([
            'jumlah_telur' => 150,
            'kondisi_telur' => 'Bagus',
            'tanggal_panen' => now(),
            'id_kandang' => 1,  // ID Kandang yang sesuai
            'id_gudang' => 1,   // ID Gudang yang sesuai
            'memo' => 'Panen pertama untuk kandang A',
        ]);

        PanenTelur::create([
            'jumlah_telur' => 200,
            'kondisi_telur' => 'Bagus',
            'tanggal_panen' => now(),
            'id_kandang' => 2,  // ID Kandang yang sesuai
            'id_gudang' => 1,   // ID Gudang yang sesuai
            'memo' => 'Panen kedua untuk kandang B',
        ]);

        PanenTelur::create([
            'jumlah_telur' => 180,
            'kondisi_telur' => 'Cacat',
            'tanggal_panen' => now(),
            'id_kandang' => 3,  // ID Kandang yang sesuai
            'id_gudang' => 2,   // ID Gudang yang sesuai
            'memo' => 'Panen ketiga dengan sedikit kerusakan',
        ]);
    }
}
