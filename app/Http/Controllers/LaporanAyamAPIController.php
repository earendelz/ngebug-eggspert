<?php

namespace App\Http\Controllers;

use App\Models\LaporanAyam;
use Illuminate\Http\Request;
use App\Models\User;

class LaporanAyamAPIController extends Controller
{
    // Menampilkan semua laporan ayam
    public function index()
    {
        $laporanAyam = LaporanAyam::all();
        return response()->json($laporanAyam);
    }

    // Menyimpan laporan ayam baru
    public function store(Request $request)
    {
        $request->validate([
            'chicken_count' => 'required|integer',
            'date' => 'required|date',
            'live_chicken_count' => 'required|integer',
            'dead_chicken_count' => 'required|integer',
            'user_id' => 'required|exists:users,id', // Mengganti id_peternak dengan user_id
        ]);

        $laporanAyam = new LaporanAyam();
        $laporanAyam->chicken_count = $request->chicken_count;
        $laporanAyam->date = $request->date;
        $laporanAyam->live_chicken_count = $request->live_chicken_count;
        $laporanAyam->dead_chicken_count = $request->dead_chicken_count;
        $laporanAyam->user_id = $request->user_id; // Mengganti id_peternak dengan user_id
        $laporanAyam->save();

        return response()->json($laporanAyam);
    }

    // Menampilkan laporan ayam berdasarkan ID
    public function show(string $id)
    {
        $laporanAyam = LaporanAyam::find($id);
        return response()->json($laporanAyam);
    }

    // Mengupdate laporan ayam berdasarkan ID
    public function update(Request $request, string $id)
    {
        $request->validate([
            'chicken_count' => 'integer',
            'date' => 'date',
            'live_chicken_count' => 'integer',
            'dead_chicken_count' => 'integer',
            'user_id' => 'exists:users,id', // Mengganti id_peternak dengan user_id
        ]);

        // Temukan catatan LaporanAyam
        $laporanAyam = LaporanAyam::find($id);

        // Jika catatan tidak ditemukan
        if (!$laporanAyam) {
            return response()->json(['message' => 'Laporan Ayam not found'], 404);
        }

        $laporanAyam->chicken_count = $request->chicken_count;
        $laporanAyam->date = $request->date;
        $laporanAyam->live_chicken_count = $request->live_chicken_count;
        $laporanAyam->dead_chicken_count = $request->dead_chicken_count;
        $laporanAyam->user_id = $request->user_id; // Mengganti id_peternak dengan user_id

        // Simpan catatan yang diperbarui
        $laporanAyam->save();

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

}
