<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PenjualanAyam;
use App\Models\PenjualanTelur;

class BerandaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $userId = $user->id; // Ambil ID user yang sedang login

        // Ambil data penjualan telur dan ayam berdasarkan bulan
        $penjualanTelurData = PenjualanTelur::where('id_peternak', $userId)
            ->selectRaw('MONTH(tanggal_penjualan) as bulan, SUM(telur_terjual) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $penjualanAyamData = PenjualanAyam::where('id_peternak', $userId)
            ->selectRaw('MONTH(tanggal_penjualan) as bulan, SUM(jumlah_terjual) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Kirim data ke view beranda
        return view('beranda', compact('user', 'penjualanTelurData', 'penjualanAyamData'));
    }
}
