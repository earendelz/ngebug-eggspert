<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGudang extends Model
{
    use HasFactory;

    protected $table = 'laporan_gudang';

    protected $fillable = ['id_gudang', 'id_peternak', 'jumlah_telur', 'keterangan', 'tanggal_laporan_gudang'];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
