<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PakanAPIController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pakan = Pakan::where('id_peternak', $userId)->get();    
        return response()->json($pakan);
    }

    public function store(Request $request)
    {

        $userId = Auth::id();

        $validated = $request->validate([
            'jenis_pakan' => 'required|string|max:255',
        ]);

        $pakan = Pakan::create([
            'jenis_pakan' => $request->jenis_pakan,
            'id_peternak' => $userId,
        ]);
        
        return response()->json($pakan);
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

    public function show(string $id)
    {
        $pakan = Pakan::where('id_peternak', $id)->get();
        return response()->json($pakan);
    }

    public function update(Request $request, $id)
    {
        $pakan = Pakan::findOrFail($id);

        $validated = $request->validate([
            'jenis_pakan' => 'required|string|max:255',
        ]);

        $pakan->update($validated);

        return response()->json($pakan);
    }

    public function destroy($id)
    {
        $pakan = Pakan::findOrFail($id);
        $pakan->delete();

        return response()->json(null, 204);
    }
}
