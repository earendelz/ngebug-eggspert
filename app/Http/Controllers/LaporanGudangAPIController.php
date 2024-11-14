<?php

namespace App\Http\Controllers;

use App\Models\LaporanGudang;
use Illuminate\Http\Request;

class LaporanGudangAPIController extends Controller
{
    public function index()
    {
        return LaporanGudang::with('gudang')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_gudang_telur' => 'required|exists:gudang,id',
            'keterangan' => 'required|string',
            'nama_laporan_gudang' => 'required|string',
            'jumlah_telur' => 'required|integer',
            'tanggal_laporan_gudang' => 'required|date',
        ]);

        $laporan = LaporanGudang::create($request->all());

        return response()->json($laporan, 201);
    }

    public function show($id)
    {
        $laporan = LaporanGudang::with('gudang')->findOrFail($id);
        return response()->json($laporan);
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanGudang::findOrFail($id);
        $laporan->update($request->all());

        return response()->json($laporan);
    }

    public function destroy($id)
    {
        LaporanGudang::destroy($id);
        return response()->json(['message' => 'Record deleted successfully']);
    }

    // search by nama_laporan_gudang
    public function getByNamaLaporanGudang($nama_laporan_gudang)
    {
        // Search laporan by nama_laporan_gudang
        $laporan = LaporanGudang::where('nama_laporan_gudang', '=', $nama_laporan_gudang)
        ->with('gudang')
        ->get();


        // If no laporan found
        if ($laporan->isEmpty()) {
            return response()->json(['message' => 'Laporan Gudang not found'], 404);
        }

        // Return if the laporan found
        return response()->json($laporan);
    }
}
