<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaporanGudang;
use Carbon\Carbon;

class LaporanGudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Manually define the data
        LaporanGudang::create([
            'id_gudang_telur' => 1, // Assume the Gudang with id 1 exists
            'keterangan' => 'Telur rusak karena suhu terlalu tinggi',
            'nama_laporan_gudang' => 'Laporan Gudang 1',
            'jumlah_telur' => 100,
            'tanggal_laporan_gudang' => Carbon::now()->toDateString(),
        ]);

        LaporanGudang::create([
            'id_gudang_telur' => 2, // Assume the Gudang with id 2 exists
            'keterangan' => 'Telur hilang karena pencurian',
            'nama_laporan_gudang' => 'Laporan Gudang 2',
            'jumlah_telur' => 50,
            'tanggal_laporan_gudang' => Carbon::now()->toDateString(),
        ]);

        // You can add more records here as needed
    }
}
