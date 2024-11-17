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
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'egg_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
        ]);

        $gudang = Gudang::create([
            'name' => $request->name,
            'date' => $request->date,
            'egg_count' => $request->egg_count,
            'chicken_breed' => $request->chicken_breed,
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
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'egg_count' => 'required|integer',
            'chicken_breed' => 'required|string|max:255',
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

