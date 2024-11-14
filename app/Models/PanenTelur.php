<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanenTelur extends Model
{
    use HasFactory;

    protected $table = 'panen_telurs';

    protected $fillable = [
        'jumlah_telur',
        'kondisi_telur',
        'tanggal_panen',
        'memo',
        'id_kandang',
        'id_gudang',
    ];

    /**
     * Relasi dengan Product (kandang)
     */
    public function kandang()
    {
        return $this->belongsTo(Product::class, 'id_kandang');
    }
}