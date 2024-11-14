<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';
    protected $fillable = ['name', 'date', 'egg_count', 'chicken_breed', 'id_peternak'];

    // Define the relationship with LaporanGudang
    public function laporanGudang()
    {
        return $this->hasMany(LaporanGudang::class, 'id_gudang_telur');
    }
}
