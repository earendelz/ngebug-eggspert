<?php

namespace App\Http\Controllers;

use App\Models\LaporanAyam;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LaporanAyamAPIController extends Controller
{
    // Menampilkan semua laporan ayam
    public function index()
    {
        $userId = Auth::id();
        $laporanAyam = LaporanAyam::with('kandang:id,nama')
        ->where('id_peternak', $userId)
        ->get();
        return response()->json($laporanAyam);}

    // Menyimpan laporan ayam baru
    public function store(Request $request)
    {
        $userId = Auth::id();
        $validated = $request -> validate([
            'jumlah_ayam' => 'required|integer|min:1',
            'jenis_laporan' => 'required|string|in:Kematian,Kelahiran',
            'tanggal_peristiwa' => 'required|date',
            'id_kandang' => 'required|exists:products,id',

        ]);

        $kandang = Product::findOrFail($validated['id_kandang']);

        $laporanAyam = LaporanAyam::create([
            'jumlah_ayam' => $validated['jumlah_ayam'],
            'jenis_laporan' => $validated['jenis_laporan'],
            'tanggal_peristiwa' => $validated['tanggal_peristiwa'],
            'id_kandang' => $validated['id_kandang'],
            'id_peternak' => $userId
        ]);
        $validated['jumlah_ayam'] = $validated['jumlah_ayam'] + 0;
        if($validated['jenis_laporan'] == "Kematian"){
            $kandang -> jumlah_ayam -= $validated['jumlah_ayam'];   
        }else{
            $kandang -> jumlah_ayam += $validated['jumlah_ayam'];
        };

        $kandang->save();

        return response()->json($laporanAyam);
    }

    // Menampilkan laporan ayam berdasarkan ID
    public function show(string $id)
    {
        $laporanAyam = LaporanAyam::with('kandang')
                        ->where('id', $id)
                        ->get();
        return response()->json($laporanAyam);
    }

    // Mengupdate laporan ayam berdasarkan ID
    public function update(Request $request, string $id)
    {
        $laporanAyam = LaporanAyam::findOrFail($id);

        $validated = $request->validate([
            'jumlah_ayam' => 'required|integer|min:1',
            'jenis_laporan' => 'required|string|in:Kematian,Kelahiran',
            'tanggal_peristiwa' => 'required|date',
            'id_kandang' => 'required|exists:products,id',
        ]);

        $laporanAyam->update($validated);

        // Kembalikan catatan yang diperbarui
        return response()->json($laporanAyam);
    }

    // Menghapus laporan ayam berdasarkan ID
    public function destroy(string $id)
    {
        LaporanAyam::destroy($id);
        return response()->json(['message' => 'Deleted']);
    }

    // Mendapatkan laporan ayam berdasarkan username
    public function getByUsername($username)
    {
        // Temukan user berdasarkan username
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Ambil laporan ayam berdasarkan user_id
        $laporanAyams = LaporanAyam::where('user_id', $user->id)->get();

        // Kembalikan laporan ayam sebagai respons
        return response()->json($laporanAyams);
    }

    public function getByUserId($id)
    {
        // Temukan laporan ayam berdasarkan user_id
        $laporanAyams = LaporanAyam::where('user_id', $id)->get();

        if ($laporanAyams->isEmpty()) {
            return response()->json(['message' => 'No reports found for this user.'], 404);
        }

        return response()->json($laporanAyams);
    }

    public function showByIDLaporan(string $id)
    {
        $laporanAyam = LaporanAyam::with('kandang')
                        ->where('id', $id)
                        ->get();
        return response()->json($laporanAyam);
    }

}
