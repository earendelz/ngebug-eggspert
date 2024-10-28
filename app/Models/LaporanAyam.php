<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAyam extends Model
{
    use HasFactory;

    protected $table = 'laporan_ayams'; // Nama tabel

    // Tambahkan atribut yang bisa diisi (fillable) jika diperlukan
    protected $fillable = [
        'chicken_count',
        'date',
        'live_chicken_count',
        'dead_chicken_count',
        'user_id',
    ];
}
