<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PakanAPIController extends Controller
{

     /**
     * GET all pakan
     */
    public function index()
    {
        $userId = Auth::id();
        $pakan = Pakan::where('id_peternak', $userId)->get();    
        return response()->json($pakan);
    }

    /**
     * POST create new pakan
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'jenis_pakan' => 'required|string|max:255',
        ]);

        // Simpan data pakan baru
        $pakan = Pakan::create([
            'jenis_pakan' => $request->jenis_pakan,
            'id_peternak' => $userId,
        ]);

        // Kembalikan respon dengan data yang baru dibuat
        return response()->json($pakan, 201);
    }

    /**
     * GET pakan by jenis_pakan
     */
    public function show($id)
    {
        $pakan = Pakan::where('id', $id)->get();
        return response()->json($pakan);
    }

    /**
     * PUT update pakan by id
     */
    public function update(Request $request, $id)
    {
        $pakan = Pakan::findOrFail($id);

        $validated = $request->validate([
            'jenis_pakan' => 'required|string|max:255',
        ]);

        $pakan->update($validated);

        return response()->json($pakan);

    }
    /**
     * DELETE pakan by id
     */
    public function destroy($id)
    {
        $pakan = Pakan::findOrFail($id);
        $pakan->delete();

        return response()->json(null, 204);
    }
}
