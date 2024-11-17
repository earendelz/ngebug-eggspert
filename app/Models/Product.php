<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nama',
        'jenis_kandang',
        'kapasitas',
        'jumlah_ayam',
        'id_ras_ayam',
        'id_pakan',
        'id_peternak',
        'status_pakan',
    ];

    /**
     * Relasi dengan PanenTelur
     */
    public function panenTelur()
    {
        return $this->hasMany(PanenTelur::class, 'id_kandang');
    }

    public function rasAyam()
{
    return $this->belongsTo(RasAyam::class, 'id_ras_ayam'); 
}

    public function pakan()
{
    return $this->belongsTo(Pakan::class, 'id_pakan'); 
}



}

