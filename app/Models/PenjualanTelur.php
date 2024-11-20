<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanTelur extends Model
{
    use HasFactory;

    protected $table = 'penjualan_telurs';
    protected $fillable = [
        'kondisi_telur',
        'harga_perkilo',
        'telur_terjual',
        'harga_total',
        'id_gudang',
        'tanggal_penjualan',
        'id_peternak'
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
}
