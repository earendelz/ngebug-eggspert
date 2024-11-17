<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasAyam extends Model
{
    use HasFactory;
    protected $fillable = ['nama_ras_ayam', 
    'jenis_ayam', 
    'id_peternak',];
}
