<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanAPIController extends Controller
{
    /**
     * GET all pakan
     */
    public function index()
    {
        return Pakan::all();
    }

    /**
     * POST create new pakan
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_pakan' => 'required|string|max:255',
        ]);

        // Simpan data pakan baru
        $pakan = Pakan::create([
            'jenis_pakan' => $request->jenis_pakan,
        ]);

        // Kembalikan respon dengan data yang baru dibuat
        return response()->json($pakan, 201);
    }

    /**
     * GET pakan by jenis_pakan
     */
    public function getByJenisPakan($jenis_pakan)
    {
        $pakan = Pakan::where('jenis_pakan', $jenis_pakan)->get();

        // Jika tidak ada pakan yang ditemukan
        if ($pakan->isEmpty()) {
            return response()->json(['message' => 'Pakan dengan jenis tersebut tidak ditemukan'], 404);
        }

        return response()->json($pakan);
    }

    /**
     * GET pakan by id
     */
    public function show($id)
    {
        return Pakan::findOrFail($id);
    }

    /**
     * PUT update pakan by id
     */
    public function update(Request $request, $id)
    {
        $pakan = Pakan::findOrFail($id);
        $pakan->update($request->all());
        return response()->json($pakan);
    }

    /**
     * DELETE pakan by id
     */
    public function destroy($id)
    {
        $pakan = Pakan::findOrFail($id);
        $pakan->delete();
        return response()->json(['message' => 'Pakan deleted successfully']);
    }
}
