<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vaksinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaksinasiAPIController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $vaksinasi = Vaksinasi::with('kandang')
        ->where('id_peternak', $userId)
        ->get();
        return response()->json($vaksinasi);

    }

    public function showByIDKandang(string $idKandang)
    {
        $vaksinasi = Vaksinasi::where('id_kandang', $idKandang)->get();    
        return response()->json($vaksinasi);
    }

    
    public function store(Request $request)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'jenis_vaksin' => 'required|string|max:255',
            'tanggal_vaksinasi' => 'required|date',
            'id_kandang' => 'required|exists:products,id'
        ]);

        $vaksinasi = Vaksinasi::create([
            'jenis_vaksin' => $validated['jenis_vaksin'],
            'tanggal_vaksinasi' => $validated['tanggal_vaksinasi'],
            'id_kandang' => $validated['id_kandang'],
            'id_peternak' => $userId
        ]);

        return response()->json($vaksinasi);

    }

    public function show(string $id)
    {
        $vaksinasi = Vaksinasi::where('id', $id)->first();
        if (!$vaksinasi) {
            return response()->json(['message' => 'Vaksinasi not found'], 404);
        }
        return response()->json($vaksinasi);
    }

    public function update(Request $request, string $id) 
    {
        $vaksinasi = Vaksinasi::findOrFail($id);

        $validated = $request->validate([
            'jenis_vaksin' => 'required|string|max:255',
            'tanggal_vaksinasi' => 'required|date',
        ]);

        $vaksinasi->update($validated);

        return response()->json($vaksinasi);

    }
    
    public function destroy(string $id)
    {
        $vaksinasi = Vaksinasi::findOrFail($id);
        $vaksinasi->delete();

        return response()->json('successfully deleted', 204);
    }
}
