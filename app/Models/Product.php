<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'capacity',
        'chicken_count',
        'chicken_breed',
        'id_peternak',
    ];

    /**
     * Relasi dengan PanenTelur
     */
    public function panenTelur()
    {
        return $this->hasMany(PanenTelur::class, 'id_kandang');
    }
}

