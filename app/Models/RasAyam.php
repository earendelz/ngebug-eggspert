<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasAyam extends Model
{


    use HasFactory;

    protected $table = 'ras_ayams';
    protected $fillable = ['nama_ras_ayam', 
    'jenis_ayam', 
    'id_peternak',];

    public function gudangs()
    {
        return $this->hasMany(Gudang::class, 'id_ras_ayam');
    }

    // Di dalam model RasAyam
    public function peternak()
    {
        return $this->belongsTo(User::class, 'id_peternak');
    }

}
