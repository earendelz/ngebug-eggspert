<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\PenjualanTelur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanTelurAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $penjualanTelur = PenjualanTelur::with('gudang')
        ->where('id_peternak', $userId)
        ->get();
        return response()->json($penjualanTelur);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $validated = $request->validate([
            'kondisi_telur' => 'required|string|max:255',
            'harga_perkilo' => 'required|integer',
            'telur_terjual' => 'required|integer|min:1',
            'harga_total' => 'required|integer',
            'id_gudang' => 'required|exists:gudang,id',
            'tanggal_penjualan' => 'date'
        ]);
        
        $gudang = Gudang::findOrFail($validated['id_gudang']);
        $penjualanTelur = PenjualanTelur::create([
            'kondisi_telur' => $validated['kondisi_telur'],
            'harga_perkilo' => $validated['harga_perkilo'],
            'telur_terjual' => $validated['telur_terjual'],
            'harga_total' => $validated['harga_total'],
            'id_gudang' => $validated['id_gudang'],
            'tanggal_penjualan' => $validated['tanggal_penjualan'],
            'id_peternak' => $userId
        ]);
        if ($gudang->jumlah_telur < $validated['telur_terjual']) {
            return response()->json(['error' => 'Telur di dalam gudang tidak mencukupi'], 400);
        }
        $gudang -> jumlah_telur -= $validated['telur_terjual'];
        $gudang -> save();
        return response()->json($penjualanTelur, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualanTelur = PenjualanTelur::with(['gudang'])
                        ->where('id', $id)
                        ->get();
        return response()->json($penjualanTelur);
    }

    /**
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::id();
        $penjualanTelur = PenjualanTelur::findOrFail($id);
        try{
            $validated = $request->validate([
                'kondisi_telur' => 'required|string|max:255',
                'harga_perkilo' => 'required|integer',
                'telur_terjual' => 'required|integer|min:1',
                'harga_total' => 'required|integer',
                'id_gudang' => 'required|exists:gudang,id',
                'tanggal_penjualan' => 'data'
            ]);

            $validated['id_peternak'] = $userId;
            $penjualanTelur -> update($validated);
            return response() -> json($penjualanTelur);
        }catch(\Illuminate\Validation\ValidationException $e){
            \Log::error('Validation errors: ' . json_encode($e->errors()));

            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penjualanTelur = PenjualanTelur::findOrFail($id);
        $penjualanTelur -> delete();
        return response()->json('berhasil dihapus', 204);
    }
}
