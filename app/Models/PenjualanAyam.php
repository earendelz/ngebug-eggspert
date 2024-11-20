<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanAyam extends Model
{
    use HasFactory;

    protected $table = 'penjualan_ayams';

    protected $fillable = [
        'jumlah_terjual',
        'harga_perekor',
        'harga_total',
        'id_kandang',
        'tanggal_penjualan',
        'id_peternak'
    ];

    public function kandang()
    {
        return $this->belongsTo(Product::class, 'id_kandang');
    }
}
