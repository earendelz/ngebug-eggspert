<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaksinasi extends Model
{
    protected $table = 'vaksinasis';

    protected $fillable = [
        'jenis_vaksin', 'tanggal_vaksinasi', 'id_product'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
