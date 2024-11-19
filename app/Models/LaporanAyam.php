<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAyam extends Model
{
    use HasFactory;

    protected $table = 'laporan_ayams'; // Nama tabel

    // Tambahkan atribut yang bisa diisi (fillable) jika diperlukan
    protected $fillable = [
        'jumlah_ayam',
        'jenis_laporan',
        'tanggal_peristiwa',
        'id_kandang',
        'id_peternak',
    ];
    public function kandang()
    {
        return $this->belongsTo(Product::class, 'id_kandang');
    }

}
