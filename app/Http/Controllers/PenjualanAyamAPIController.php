<?php

namespace App\Http\Controllers;

use App\Models\PenjualanAyam;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanAyamAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $penjualanAyam = PenjualanAyam::with('kandang')
        ->where('id_peternak', $userId)
        ->get();
        return response()->json($penjualanAyam);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $validated = $request->validate([
        'jumlah_terjual' => 'required|integer|min:1',
        'harga_perekor' => 'required|integer',
        'harga_total' => 'required|integer',
        'id_kandang' => 'required|exists:products,id',
        'tanggal_penjualan' => 'date',
        ]);

        $kandang = Product::findOrFail($validated['id_kandang']);
        $penjualanAyam = PenjualanAyam::create([
            'jumlah_terjual' => $validated['jumlah_terjual'],
            'harga_perekor' => $validated['harga_perekor'],
            'harga_total' => $validated['harga_total'],
            'id_kandang' => $validated['id_kandang'],
            'tanggal_penjualan' => $validated['tanggal_penjualan'],
            'id_peternak' => $userId
        ]);
// convert ke integer
        $validated['jumlah_terjual'] = $validated['jumlah_terjual'] + 0;
        if ($kandang->jumlah_ayam < $validated['jumlah_terjual']) {
            return response()->json(['error' => 'Ayam di dalam kandang tidak mencukupi'], 400);
        }
        $kandang -> jumlah_ayam -= $validated['jumlah_terjual'];
        $kandang -> save();

        return response()->json($penjualanAyam, 201); //mengembalikan data yang baru dibuat
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penjualanAyam = PenjualanAyam::with(['kandang'])
                        ->where('id', $id)
                        ->get();
        return response()->json($penjualanAyam);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::id();
        $penjualanAyam = PenjualanAyam::findOrFail($id);
        try{
            $validated = $request->validate([
                'jumlah_terjual' => 'required|integer|min:1',
                'harga_perekor' => 'required|integer',
                'harga_total' => 'required|integer',
                'id_kandang' => 'required|exists:products,id',
                'tanggal_penjualan' => 'date',
            ]);

            $validated['id_peternak'] = $userId;
            $penjualanAyam->update($validated);
            return response()-> json($penjualanAyam);
        }catch (\Illuminate\Validation\ValidationException $e) {
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
        $penjualanAyam = PenjualanAyam::findOrFail($id);
        $penjualanAyam->delete();

        return response()->json('successfully deleted', 204);
    }
}
