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
        $vaksinasi = Vaksinasi::whereHas('product', function ($query) use ($userId) {
            $query->where('id_peternak', $userId);
        })->get();

        return response()->json($vaksinasi);
    }

    public function showByIDKandang(string $idProduct)
    {
        $vaksinasi = Vaksinasi::where('id_product', $idProduct)->get();    
        return response()->json($vaksinasi);
    }

    
    public function store(Request $request)
    {
        $userId = Auth::id();
        
        $request->validate([
            'jenis_vaksin' => 'required|string|max:255',
            'tanggal_vaksinasi' => 'required|date',
            'id_product' => 'required|exists:products,id'
        ]);

        $vaksinasi = Vaksinasi::create([
            'jenis_vaksin' => $request->jenis_vaksin,
            'tanggal_vaksinasi' => $request->tanggal_vaksinasi,
            'id_product' => $request->id_product,
            'id_peternak' => $userId,
            
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
        $userId = Auth::id();
        $vaksinasi = Vaksinasi::findOrFail($id);

        $request->validate([
            'jenis_vaksin' => 'required|string|max:255',
            'tanggal_vaksinasi' => 'required|date',
            'id_product' => 'required|exists:products,id'
        ]);

        $requestData = $request->all();
        $requestData['id_peternak'] = $userId;

        $vaksinasi->update($requestData);

        return response()->json($vaksinasi);

    }
    
    public function destroy(string $id)
    {
        $vaksinasi = Vaksinasi::findOrFail($id);
        $vaksinasi->delete();

        return response()->json('successfully deleted', 204);
    }
}
