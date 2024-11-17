<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangAPIController extends Controller
{

    public function index(){

        $userId = Auth::id();
        $gudang = Gudang::where('id_peternak', $userId)->get();    
        return response()->json($gudang);
    }
    
    public function store(Request $request)  
    {

        $userId = Auth::id();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_pembuatan' => 'required|date',
            'jumlah_telur' => 'required|integer',
            'id_ras_ayam' => 'required|exists:ras_ayams,id',
        ]);

        $gudang = Gudang::create([
            'nama' => $request->nama,
            'tanggal_pembuatan' => $request->tanggal_pembuatan,
            'jumlah_telur' => $request->jumlah_telur,
            'id_ras_ayam' => $request->id_ras_ayam,
            'id_peternak' => $userId,
        ]);
        
        return response()->json($gudang);
    }

    public function show(string $id)
    {
        $gudang = Gudang::where('id_peternak', $id)->get();
        return response()->json($gudang);
    }

    public function update(Request $request, $id) {
        
        $gudang = Gudang::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_pembuatan' => 'required|date',
            'jumlah_telur' => 'required|integer',
            'id_ras_ayam' => 'exists:ras_ayams,id',
        ]);

        $gudang->update($validated);

        return response()->json($gudang);

    }
    

    public function destroy(string $id){     
        $gudang = Gudang::findOrFail($id);
        $gudang->delete();

        return response()->json(null, 204);
    }
    
}

