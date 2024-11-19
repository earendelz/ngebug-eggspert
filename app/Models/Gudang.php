<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';
    protected $fillable = ['nama', 'tanggal_pembuatan', 'jumlah_telur', 'id_ras_ayam', 'id_peternak'];

    // Define the relationship with LaporanGudang
    public function laporanGudang()
    {
        return $this->hasMany(LaporanGudang::class, 'id_gudang_telur');
    }
    public function panenTelur()
    {
        return $this->hasMany(PanenTelur::class, 'id_gudang');
    }

    public function rasAyam()
    {
        return $this->belongsTo(RasAyam::class, 'id_ras_ayam');
    }
}
