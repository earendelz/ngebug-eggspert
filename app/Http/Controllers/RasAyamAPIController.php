<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RasAyam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RasAyamAPIController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $rasAyam = RasAyam::where('id_peternak', $userId)->get();    
        return response()->json($rasAyam);
    }

    public function store(Request $request)
    {

        $userId = Auth::id();

        $validated = $request->validate([
            'nama_ras_ayam' => 'required|string|max:255',
            'jenis_ayam' => 'required|string|max:255',
        ]);

        $rasAyam = RasAyam::create([
            'nama_ras_ayam' => $request->nama_ras_ayam,
            'jenis_ayam' => $request->jenis_ayam,
            'id_peternak' => $userId,
        ]);
        
        return response()->json($rasAyam);
    }

    public function show(string $id)
    {

        $rasAyam = RasAyam::where('id', $id)->get();
        return response()->json($rasAyam);
    }

    // public function getByJenisRasAyam($nama_ras_ayam)
    // {
    //     $rasAyam = RasAyam::where('nama_ras_ayam', $nama_ras_ayam)->get();

    //     // Jika tidak ada ras ayam yang ditemukan
    //     if ($rasAyam->isEmpty()) {
    //         return response()->json(['message' => 'Ras ayam dengan jenis tersebut tidak ditemukan'], 404);
    //     }

    //     return response()->json($rasAyam);
    // }

    public function update(Request $request, $id)
    {

        $rasAyam = RasAyam::findOrFail($id);

        $validated = $request->validate([
            'nama_ras_ayam' => 'required|string|max:255',
            'jenis_ayam' => 'required|string|max:255',
        ]);

        $rasAyam->update($validated);

        return response()->json($rasAyam);
    }

    public function destroy(string $id)
    {
        $rasAyam = RasAyam::findOrFail($id);
        $rasAyam->delete();

        return response()->json(null, 204);
    }
}
