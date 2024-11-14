<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGudang extends Model
{
    use HasFactory;

    protected $table = 'laporan_gudang';
    protected $fillable = ['id_gudang_telur', 'keterangan', 'nama_gudang', 'jumlah_telur', 'tanggal_laporan_gudang'];

    // Define the relationship with Gudang
    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang_telur');
    }
}
